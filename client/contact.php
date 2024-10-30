<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }


        /* เมนูบาร์ */
        .navbar {
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* เมนูซ้าย */
        .navbar-left {
            display: flex;
            align-items: center;
        }

        /* โลโก้ */
        .navbar-left img {
            height: 50px;
            margin-right: 20px;
        }

        /* ลิงก์เมนู */
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

        /* ปุ่มแฮมเบอร์เกอร์ */
        .hamburger {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 22px;
        }

        .hamburger div {
            background-color: #333;
            height: 3px;
            width: 100%;
        }

        /* เมนูแสดงซ่อน */
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 30px;
            top: 60px;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px;
            border-radius: 4px;
            z-index: 1;
            /* Ensure it appears above other content */
        }

        .dropdown-menu a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 10px 15px;
            font-size: 14px;
        }

        .dropdown-menu a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .contact {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            /* color: white; */
            margin: 0;
            padding: 0;
            padding-top: 1%;
            /* height: 100vh; */
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: cover;
        }


        .contact-container {
            background-color: #f7f7f7;
            padding: 0px 0px 0px50px;
            border-radius: 12px;
            /* border: 3px solid white; */
            text-align: center;
            width: 600px;
            /* max-width: 80%; */
            /* กำหนดความกว้างสูงสุดให้เป็น 80% */
            /* box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.3); */
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            /* กำหนดตัวอักษรให้ใหญ่ขึ้น */
            /* color: white; */
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
            /* display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%; */
        }

        label {
            /* margin: 10px 0 5px;
            text-align: left;
            width: 100%;
            font-size: 16px;

            .text {
                font-size: 14px; */
            /* กำหนดขนาดตัวอักษร */
        }

        input,
        textarea {
            padding: 15px;
            /* margin-bottom: 20px;
            border: 1 px;
            border-radius: 6px;
            width: 100%;
            background-color: white;
            color: #333;
            font-size: 16px; */
        }

        textarea {
            /* height: 150px; */
            /* กำหนดความสูงของ textarea */
        }

        button {
            /* padding: 15px 30px;
            background-color: #3b75e5;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            width: 30%;
            transition: background-color 0.3s ease; */
        }

        button:hover {
            /* background-color: #2a5db7; */
        }

        .contact-form {
            /* max-width: 400px; */
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-group label {
            width: 100px;
            /* ความกว้างสำหรับชื่อฟิลด์ */
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
            box-sizing: border-box;
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

        /* Media Query เพื่อให้รองรับหน้าจอขนาดต่าง ๆ */
        @media (max-width: 1024px) {
            .contact-container {
                padding: 30px;
                max-width: 90%;
            }

            h1 {
                font-size: 28px;
            }

            button {
                width: 100%;
                /*  */
            }
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
            <!-- <a href="calenders.php">Calendar</a> -->
            <a href="plan.php">Room plan</a>
            <a href="contact.php">Contact us</a>
        </div>
        <!-- <div class="navbar-right">
            <div class="hamburger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="dropdown-menu" id="menu">
                <a href="login.php">Sign in</a>
                <a href="longout">Log out</a>
                <a href="profile.php">Profile</a>
                <a href="participation.php">Participation</a>
            </div>
        </div> -->
    </div>
    <div class="contact">
        <div class="contact-container">
            <h1>CONTACT US</h1>
            <p class="contact-desc">You can comment / ask / report through this form</p>
            <form class="contact-form">
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
            </form>
        </div>
    </div>
</body>

</html>