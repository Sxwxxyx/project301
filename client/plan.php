<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room plan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            align-items: center;
            justify-content: center;
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

        .plan {
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            padding-top: 1% font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            color: white;
        }

        h1 {
            margin-top: 20px;
            /* Adds space above the heading */
            margin-bottom: 20px;
            font-size: 24px;
            color: black;
        }


        img {
            max-width: 70%;
            height: auto;
            border: 3px solid white;
            border-radius: 8px;
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
                <a href="logout.php">Log out</a>
                <a href="profile.php">Profile</a>
                <a href="participation.php">Participation</a>
            </div>
        </div> -->
    </div>
    <div class="plan">
        <div class="container">
            <h1>ROOM PLAN</h1>
            <img src="../image/plan.png" alt="Studyroom Plan">
        </div>
    </div>

</body>

</html>