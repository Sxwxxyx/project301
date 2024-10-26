<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        .reservation {
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 1%
                /* height: 80vh;  */
        }

        .container {

            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            align-self: flex-start;
            /* ให้อยู่ด้านบนของ container */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #c4c4c4;
            text-align: center;
            padding: 10px;
            background-color: #a9c0e7;
        }

        th {
            background-color: #003366;
            color: white;
            vertical-align: top;
            /* ให้อักษรอยู่ด้านบนของเซลล์ */
        }

        form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
            color: #0050b3;
        }

        input[type="text"] {
            width: 96.5%;
            padding: 10px;
            border: 1px solid #c4c4c4;
            border-radius: 4px;
            background-color: #c4d9f2;
        }

        input[type="date"] {
            width: 96.5%;
            padding: 10px;
            border: 1px solid #c4c4c4;
            border-radius: 4px;
            background-color: #c4d9f2;
        }

        input[type="time"] {
            width: 96.5%;
            padding: 10px;
            border: 1px solid #c4c4c4;
            border-radius: 4px;
            background-color: #c4d9f2;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #003366;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #002244;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="navbar-left">
            <img src="https://www.psu.ac.th/img/introduce/introduce3/psubrand.png" alt="Website Logo">
            <a href="reservation.php">Reservation</a>
            <a href="calenders.php">Calendar</a>
            <a href="plan.php">Room plan</a>
            <a href="contact.php">Contact us</a>
        </div>
        <div class="navbar-right">
            <div class="hamburger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="dropdown-menu" id="menu">
                <a href="login.php">Sign in</a>
                <a href="#">Log out</a>
                <a href="profile.php">Profile</a>
                <a href="participation.php">Participation</a>
            </div>
        </div>
    </div>

    <div class="reservation">
        <div class="container">
            <h1>RESERVATION</h1>
            <!-- ตารางที่อยู่ด้านบน -->
            <table>
                <thead>
                    <tr>
                        <th>Room Type</th>
                        <th>Min. (Persons)</th>
                        <th>Max. (Persons)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>A</td>
                        <td>1</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>B</td>
                        <td>2</td>
                        <td>8</td>
                    </tr>
                    <tr>
                        <td>C</td>
                        <td>8</td>
                        <td>16</td>
                    </tr>
                </tbody>
            </table>

            <!-- แบบฟอร์มกรอกข้อมูลที่อยู่ด้านล่างตาราง -->
            <form>
                <div class="form-group">
                    <label for="user">User</label>
                    <input type="text" id="user" name="user" required>
                </div>
                <div class="form-group">
                    <label for="date">Date (YYYY-MM-DD)</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="start-time">Start Time</label>
                    <input type="time" id="start-time" name="start-time" required>
                </div>
                <div class="form-group">
                    <label for="end-time">End Time</label>
                    <input type="time" id="end-time" name="end-time" required>
                </div>
            </form>

            <button type="button">Check</button>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        // Close the dropdown menu if clicked outside
        window.onclick = function (event) {
            var menu = document.getElementById("menu");
            if (!event.target.matches('.hamburger') && menu.style.display === "block") {
                menu.style.display = "none";
            }
        }
    </script>

</body>

</html>