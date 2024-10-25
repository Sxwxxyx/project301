<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="script.js" defer></script>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #87CEEB; /* à¹€à¸›à¸¥à¸µà¹ˆà¸¢à¸™à¸ªà¸µà¸žà¸·à¹‰à¸™à¸«à¸¥à¸±à¸‡à¹€à¸›à¹‡à¸™à¸ªà¸µà¸Ÿà¹‰à¸² */
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 400px;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}

.profile-info {
    margin-bottom: 20px;
}

.profile-info label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
    color: #555;
}

.profile-info input {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.edit-button {
    display: block;
    width: 100%;
    background-color: #28a745;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
}

.edit-button:hover {
    background-color: #218838;
}
    </style>
</head>

<body>
    <div class="container">
        <h1>Profile</h1>
        <div class="profile-info">
            <label for="username">Username (Student ID)</label>
            <input type="text" id="username" value="62010456" disabled>

            <label for="email">E-mail (Student Email)</label>
            <input type="email" id="email" value="example@student.edu" disabled>

            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" value="John Doe" disabled>

            <label for="phone">Mobile Phone</label>
            <input type="tel" id="phone" value="0812345678" disabled>

            <label for="group">Group (Status)</label>
            <input type="text" id="group" value="Student" disabled>

            <label for="faculty">Faculty</label>
            <input type="text" id="faculty" value="Faculty of Management Sciences" disabled>

            <label for="createdate">Create Date</label>
            <input type="text" id="createdate" value="2022-08-25" disabled>

            <label for="lastlogin">Last Log in</label>
            <input type="text" id="lastlogin" value="2024-10-20" disabled>
        </div>

        <button class="edit-button" onclick="enableEditing()">Edit Profile</button>
    </div>

    <script>
        function enableEditing() {
    document.querySelectorAll('.profile-info input').forEach(input => {
        if (input.id !== 'username' && input.id !== 'createdate' && input.id !== 'lastlogin') {
            input.disabled = false;
            input.style.border = "1px solid #28a745"; // เปลี่ยนสีของช่องเมื่อแก้ไขได้
        }
    });
    document.querySelector('.edit-button').textContent = 'Save Profile';
    document.querySelector('.edit-button').style.backgroundColor = '#007bff';
    document.querySelector('.edit-button').onclick = saveProfile;
}

function saveProfile() {
    document.querySelectorAll('.profile-info input').forEach(input => {
        input.disabled = true;
        input.style.border = "1px solid #ccc"; // เปลี่ยนกลับสีของช่องเมื่อบันทึกแล้ว
    });
    document.querySelector('.edit-button').textContent = 'Edit Profile';
    document.querySelector('.edit-button').style.backgroundColor = '#28a745';
    document.querySelector('.edit-button').onclick = enableEditing;
    // สามารถส่งข้อมูลไปยัง backend หรือ API ได้เมื่อบันทึกเสร็จ
}
    </script>
</body>

</html>