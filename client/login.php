<?php
session_start();
$responseMessage = ''; // เริ่มต้นตัวแปรข้อความตอบกลับ

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบว่าอีเมลและรหัสผ่านไม่ว่างเปล่า
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $responseMessage = 'Please enter both email and password.';
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // ตรวจสอบความถูกต้องของอีเมล
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $responseMessage = 'Invalid email format.';
        } else {
            // API endpoint
            $url = 'http://127.0.0.1:5000/login';
            // Data to send
            $data = [
                'email' => $email,
                'password' => $password,
            ];

            // Initialize cURL
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

            // Execute the request
            $response = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            if ($response === false) {
                $responseMessage = 'Error: Unable to reach the API.';
            } else {
                $result = json_decode($response, true);
                // ใช้โค้ด HTTP เพื่อตรวจสอบสถานะการเข้าสู่ระบบ
                if ($httpCode === 401) {
                    $responseMessage = 'Invalid credentials. Please try again.';
                } elseif ($httpCode === 200) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['id_student'] = $result['id_student']; // เก็บ id_student ลงใน session
                    header("Location: index.php"); // เปลี่ยนเส้นทางไปยังหน้าหลัก
                    exit();
                } else {
                    $responseMessage = 'Unexpected error occurred. Please try again later.';
                }
            }
        }
    }
}

// ล็อกเอาท์
if (isset($_POST['logout'])) {
    session_unset(); // ล้างข้อมูล session
    session_destroy(); // ทำลาย session
    header("Location: index.php"); // เปลี่ยนเส้นทางไปยังหน้าหลัก
    exit();
}
?>


<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSU Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="left">
            <img src="../image/PSU Logo.png" alt="PSU Logo">
        </div>
        <div class="right">
            <div class="login-box">
                <h2>LOGIN</h2>
                <form action="" method="post">
                    <input type="text" id="email" name="email" placeholder="Email" required>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <input type="submit" value="SIGN IN">
                </form>
                <!-- <a href="#">Forgot password: "PSU Passport"</a> -->
                <?php if (isset($responseMessage)): ?>
                    <p class="response-message"><?= htmlspecialchars($responseMessage); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>