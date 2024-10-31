<?php
$responseMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $url = 'http://127.0.0.1:5000/contact';
    $data = [
        'title' => $title,
        'fullname' => $fullname,
        'email' => $email,
        'message' => $message,
    ];

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($response === FALSE || $httpCode !== 201) {
        $responseMessage = '<span style="color: red;">ไม่สามารถแสดงความคิดเห็นได้. รหัสข้อผิดพลาด: ' . $httpCode . ' รายละเอียด: ' . $response . '</span>';
    } else {
        $result = json_decode($response, true);
        $responseMessage = '<span style="color: green;">' . ($result['message'] ?? 'เพิ่มความคิดเห็นแล้ว') . '</span>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Style adjustments */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .navbar {
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-left {
            display: flex;
            align-items: center;
        }

        .navbar-left img {
            height: 50px;
            margin-right: 20px;
        }

        .navbar-left a {
            text-decoration: none;
            color: #333;
            padding: 0 20px;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s;
        }

        .navbar-left a:hover {
            color: #007bff;
        }

        .contact {
            display: flex;
            justify-content: center;
            padding-top: 1%;
            background-size: cover;
        }

        .contact-container {
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            width: 600px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }

        .contact-desc {
            margin-bottom: 20px;
            font-size: 14px;
            color: red;
            white-space: nowrap;
        }

        .contact-form {
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-group label {
            width: 100px;
            margin-right: 10px;
            font-weight: bold;
        }

        .contact-form input[type="text"],
        .contact-form input[type="email"],
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .contact-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #0056b3;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .contact-container {
                padding: 30px;
                max-width: 90%;
            }
        }

        .response-message {
            font-size: 16px;
            margin-top: 15px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="navbar-left">
            <a href="index.php">
                <img src="https://www.psu.ac.th/img/introduce/introduce3/psubrand.png" alt="Website Logo">
            </a>
            <a href="reservation.php">Reservation</a>
            <a href="all_reservation.php">การจองทั้งหมด</a>
            <a href="plan.php">Room plan</a>
            <a href="contact.php">Contact us</a>
        </div>
    </div>

    <div class="contact">
        <div class="contact-container">
            <h1>CONTACT US</h1>
            <p class="contact-desc">You can comment / ask / report through this form</p>
            <form class="contact-form" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="form-group">
                    <label for="fullname">Full name</label>
                    <input type="text" id="fullname" name="fullname" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>

                <button type="submit">Send</button>
            </form>
            <p class="response-message"><?= $responseMessage; ?></p>
        </div>
    </div>
</body>

</html>