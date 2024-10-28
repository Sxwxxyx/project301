<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_student = $_POST['id_student'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //create the URL and call the API
        $url = 'http://127.0.0.1:5000/register?id_student=' . urlencode($id_student) . '&username=' . urlencode($username) .'&email='. urlencode($email) .'&password='. urlencode($password);
        $response = file_get_contents($url);

        // Check for errors
        if ($response === FALSE) {
            echo 'ไม่ให้สมัครค่ะ';
        }
        else {
            echo $response; //Display the API response
        }

         // แปลงการตอบกลับจาก JSON เป็น array
         $result = json_decode($response, true);

         if (!$result['success']) {
             echo $result['ID ซ้ำ ไม่สามารถสมัครได้']; // "ID ซ้ำ ไม่สามารถสมัครได้"
         } else {
             echo $result['สมัครสมาชิกสำเร็จ']; // "สมัครสมาชิกสำเร็จ"
         }
    }
?>


from flask import Flask, request
from pymongo import MongoClient


app = Flask(__name__)

client = MongoClient("mongodb://localhost:27017")
db = client["project301"]
register = db["register"]

@app.route('/')
def home():
    return 'Hello, Flask!'

@app.route('/register', methods=['GET' , 'POST'])
def register():
    # Get form data from the POST request
    id_student = request.args.get('id_student')
    username = request.args.get('username')
    email = request.args.get('email')
    password = request.args.get('password') 

    # Insert the data into MongoDB
    if id_student and username and email and password:  # Ensure both fields are provided
        result = accounts.insert_one({'id_student': id_student, 'username': username, 'email': email, 'password': password})
        return {
            "id": str(result.inserted_id),
            "username": username,
            "password": password
        }
        
        
    result = register.insert_one({
        "id_student": data['id_student'],
        "username": data['username'],
        "email": data['email'],
        "password": data['password']
    })
    
    return jsonify({"message": "User added successfully!", "user_id": str(result.inserted_id)}), 201

if __name__ == '__main__':
    app.run(debug=True)







    <script>
        function validateForm() {
            let isValid = true;

            // Clear previous error messages
            document.getElementById('student-id-error').innerText = '';
            document.getElementById('email-error').innerText = '';
            document.getElementById('password-error').innerText = '';
            document.getElementById('confirm-password-error').innerText = '';

            // Validate Student ID (10 digits)
            const studentID = document.getElementById('student-id').value;
            if (!/^\d{10}$/.test(studentID)) {
                document.getElementById('student-id-error').innerText = 'Student ID must be exactly 10 digits.';
                isValid = false;
            }

            // Validate Email (must include "@gmail.com")
            const email = document.getElementById('email').value;
            if (!/@gmail\.com$/.test(email)) {
                document.getElementById('email-error').innerText = 'Email must contain "@gmail.com".';
                isValid = false;
            }

            // Validate Password (at least 6 characters, contains letters and numbers)
            const password = document.getElementById('password').value;
            if (!/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/.test(password)) {
                document.getElementById('password-error').innerText = 'Password must be at least 6 characters and contain letters and numbers.';
                isValid = false;
            }

            // Validate Confirm Password (matches Password)
            const confirmPassword = document.getElementById('confirm-password').value;
            if (confirmPassword !== password) {
                document.getElementById('confirm-password-error').innerText = 'Passwords do not match.';
                isValid = false;
            }

            return isValid;
        }
    </script>