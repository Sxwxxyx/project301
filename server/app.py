from flask import Flask, request, jsonify
from pymongo import MongoClient
from werkzeug.security import generate_password_hash, check_password_hash  # ใช้สำหรับเข้ารหัสรหัสผ่าน
import re

app = Flask(__name__)

client = MongoClient("mongodb://localhost:27017")
db = client["project301"]
registers = db["registers"]

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
            return jsonify({"status": "Login successful"}), 200
        else:
            return jsonify({"status": "Invalid credentials"}), 401

    except Exception as e:
        # ตอบกลับเมื่อเกิดข้อผิดพลาดจากการเชื่อมต่อฐานข้อมูล
        return jsonify({"status": "Database connection error"}), 500

    
    
if __name__ == '__main__':
    app.run(debug=True)
