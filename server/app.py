from flask import Flask, request, jsonify
from pymongo import MongoClient
from werkzeug.security import generate_password_hash, check_password_hash  # ใช้สำหรับเข้ารหัสรหัสผ่าน
import re

app = Flask(__name__)

client = MongoClient("mongodb://localhost:27017")
db = client["project301"]
registers = db["registers"]
reservations = db["reservations"]  # สร้าง collection สำหรับการจอง


@app.route('/')
def home():
    return 'Hello, Flask!'

@app.route('/register', methods=['POST'])
def register():
    data = request.json
    id_student = data.get('id_student')
    username = data.get('username')
    email = data.get('email')
    password = data.get('password')

    # ตรวจสอบว่าไม่มีฟิลด์ว่างเปล่า
    if not all([id_student, username, email, password]):
        return jsonify({"message": "Missing required fields"}), 400
    
    # ตรวจสอบรูปแบบอีเมล
    if not re.match(r"[^@]+@[^@]+\.[^@]+", email):
        return jsonify({"message": "Invalid email format"}), 400

    # ตรวจสอบว่า id_student มีในฐานข้อมูลแล้วหรือไม่
    db_id = registers.find_one({"id_student": id_student})
    if db_id:
        return jsonify({"message": "Already have this student ID account."}), 400

    # เข้ารหัสรหัสผ่าน
    hashed_password = generate_password_hash(password)

    # บันทึกข้อมูลใน MongoDB
    result = registers.insert_one({
        'id_student': id_student,
        'username': username,
        'email': email,
        'password': hashed_password
    })
    return jsonify({
        "id": str(result.inserted_id),
        "username": username,
        "email": email,
        "message": "User registered successfully!"
    }), 201

@app.route('/login', methods=['POST'])
def login():
    data = request.json
    email = data.get('email')
    password = data.get('password')

    # ตรวจสอบว่าอีเมลและรหัสผ่านไม่ว่างเปล่า
    if not email or not password:
        return jsonify({"status": "Bad request, email and password are required"}), 400

    try:
        # ค้นหาบัญชีที่มีอีเมลตรงกับที่ผู้ใช้ระบุ
        user = registers.find_one({"email": email})
        
        # ตรวจสอบว่าพบรหัสผ่านที่ตรงกันในฐานข้อมูลหรือไม่
        if user and check_password_hash(user['password'], password):
            return jsonify({"status": "Login successful", "id_student": user['id_student'], "email": user['email']}), 200
        else:
            return jsonify({"status": "Invalid credentials"}), 401

    except Exception as e:
        # ตอบกลับเมื่อเกิดข้อผิดพลาดจากการเชื่อมต่อฐานข้อมูล
        return jsonify({"status": "Database connection error"}), 500

@app.route('/reservation', methods=['POST'])
def reservation():
    data = request.json
    email = data.get('email')  # เพิ่มการรับ email
    id_student = data.get('id_student')
    room_type = data.get('room_type')
    date = data.get('date')
    start_time = data.get('start_time')
    end_time = data.get('end_time')

    # ตรวจสอบว่าไม่มีฟิลด์ว่างเปล่า
    if not all([email, id_student, room_type, date, start_time, end_time]):
        return jsonify({"message": "กรอกข้อมูลให้ครบด้วยครับ"}), 400

    # ตรวจสอบว่า email มี id_student ใน collection 'registers' หรือไม่
    student = registers.find_one({"email": email})
    if not student or student['id_student'] != id_student:
        return jsonify({"message": "ไม่พบ email หรือ id_student ในระบบ"}), 404

    # ตรวจสอบการจองซ้ำ (หากมีการจองในช่วงวันและเวลานี้แล้ว)
    existing_reservation = reservations.find_one({
        "id_student": id_student,
        "date": date,
        "start_time": start_time,
        "end_time": end_time
    })

    if existing_reservation:
        return jsonify({"message": "มีการจองห้องนี้ในช่วงเวลานี้แล้ว"}), 400

    # บันทึกข้อมูลการจองใน MongoDB
    result = reservations.insert_one({
        'id_student': id_student,
        'room_type': room_type,
        'date': date,
        'start_time': start_time,
        'end_time': end_time
    })
    
    return jsonify({
        'id': str(result.inserted_id),
        'id_student': id_student, # ส่งค่า id_student กลับไป
        'room_type': room_type,
        'date': date,
        'start_time': start_time,
        'end_time': end_time,
        "message": "จองห้องสำเร็จ!"
    }), 201
    
@app.route('/all_reservation', methods=['POST','GET'])
def all_reservation():
    try:
        # ดึงข้อมูลการจองทั้งหมดและเรียงลำดับ
        all_reservations = list(reservations.find({}, {'_id': 0}).sort([('date', 1), ('room_type', 1), ('start_time', 1)]))
        reservations_with_username = []

        for reservation in all_reservations:
            # ใช้ id_student ของการจองเพื่อค้นหาข้อมูลผู้ใช้
            student_info = registers.find_one({"id_student": reservation['id_student']}, {"username": 1, "_id": 0})
            reservation['username'] = student_info['username'] if student_info else "ไม่ทราบชื่อผู้ใช้"

            reservations_with_username.append(reservation)

        # ตรวจสอบว่ามีข้อมูลการจองหรือไม่
        if not reservations_with_username:
            return jsonify({"message": "ไม่พบข้อมูลการจองในระบบ"}), 200  # เปลี่ยนสถานะจาก 404 เป็น 200

        return jsonify(reservations_with_username), 200

    except Exception as e:
        return jsonify({"error": "ไม่สามารถดึงข้อมูลการจองได้", "details": str(e)}), 500

    
    

    
if __name__ == '__main__':
    app.run(debug=True)