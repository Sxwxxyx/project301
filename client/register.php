<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
        }

        .container {
            width: 300px;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #333333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-size: 14px;
            font-weight: bold;
            text-align: left;
            color: #333333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 8px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            padding: 10px;
            width: 100%;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .signin-btn {
            background-color: #007bff;
            color: #ffffff;
        }

        button:hover {
            opacity: 0.9;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form id="registrationForm" action="#" method="post" onsubmit="return validateForm()">
            <label for="student-id">ID Student</label>
            <input type="text" id="student-id" name="student-id" placeholder="Student ID" required>
            <div id="student-id-error" class="error"></div>

            <label for="fullname">Name</label>
            <input type="text" id="fullname" name="fullname" placeholder="Enter Full Name" required>
            
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="E-mail" required>
            <div id="email-error" class="error"></div>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <div id="password-error" class="error"></div>
            
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
            <div id="confirm-password-error" class="error"></div>
            
            <button type="submit" class="signin-btn">Sign Up</button>
        </form>
    </div>

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
</body>
</html>
