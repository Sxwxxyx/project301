<?php
session_start();
$responseMessage = '';
$responseClass = ''; // กำหนดค่าเริ่มต้น

// ตรวจสอบการล็อกอินของผู้ใช้
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("Location: login.php");
    exit();
}

// หากมีการส่งแบบฟอร์ม
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_student = $_SESSION['id_student'];
    $room_type = $_POST['room_type'];
    $date = $_POST['date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // เช็ควันและเวลา
    if (strtotime($date) < strtotime('today')) {
        $responseMessage = 'Date must be today or in the future!';
        $responseClass = 'error';
    } elseif ($start_time >= $end_time) {
        $responseMessage = 'Start time must be earlier than end time!';
        $responseClass = 'error';
    } else {
        $url = 'http://127.0.0.1:5000/reservation';
        $data = [
            'email' => $_SESSION['email'],
            'id_student' => $id_student,
            'room_type' => $room_type,
            'date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($response === false || $httpCode !== 201) {
            $responseMessage = 'Failed to reserve. Please try again.';
            $responseClass = 'error';
        } else {
            $result = json_decode($response, true);
            $responseMessage = 'Reservation successful! Room Type: ' . $room_type . ', Date: ' . $date . ', Start Time: ' . $start_time . ', End Time: ' . $end_time;
            $responseClass = 'success';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
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

        .reservation {
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 1%
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

        input[type="text"],
        input[type="date"],
        input[type="time"]
        {
        width: 96.5%;
        padding: 10px;
        border: 1px solid #c4c4c4;
        border-radius: 4px;
        background-color: #c4d9f2;
        }

        select.room {
            width: 100%;
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

        /* สไตล์ข้อความสำเร็จ */
        .success {
            color: green;
            margin-top: 8px;
        }

        /* สไตล์ข้อความผิดพลาด */
        .error {
            color: red;
            margin-top: 10px;
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

    <div class="reservation">
        <div class="container">
            <h1>RESERVATION</h1>
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

            <form action="reservation.php" method="POST">
                <div class="form-group">
                    <label for="id_student">User ID</label>
                    <?php if (isset($_SESSION['id_student'])): ?>
                        <input type="text" id="id_student" name="id_student"
                            value="<?= htmlspecialchars($_SESSION['id_student']); ?>" readonly>
                    <?php else: ?>
                        <p>กรุณาเข้าสู่ระบบเพื่อทำการจอง</p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="room_type">Select Room</label>
                    <select id="room_type" name="room_type" required class="room">
                        <option value="">Select Room</option>
                        <option value="A1">A1</option>
                        <option value="A2">A2</option>
                        <option value="A3">A3</option>
                        <option value="A4">A4</option>
                        <option value="A5">A5</option>
                        <option value="A6">A6</option>
                        <option value="A7">A7</option>
                        <option value="A8">A8</option>
                        <option value="A9">A9</option>
                        <option value="A10">A10</option>
                        <option value="A11">A11</option>
                        <option value="A12">A12</option>
                        <option value="A13">A13</option>
                        <option value="A14">A14</option>
                        <option value="A15">A15</option>
                        <option value="A16">A16</option>
                        <option value="A17">A17</option>
                        <option value="A18">A18</option>
                        <option value="B1">B1</option>
                        <option value="B2">B2</option>
                        <option value="B3">B3</option>
                        <option value="B4">B4</option>
                        <option value="B5">B5</option>
                        <option value="B6">B6</option>
                        <option value="B7">B7</option>
                        <option value="B8">B8</option>
                        <option value="B9">B9</option>
                        <option value="B10">B10</option>
                        <option value="B11">B11</option>
                        <option value="B12">B12</option>
                        <option value="B13">B13</option>
                        <option value="C1">C1</option>
                        <option value="C2">C2</option>
                        <option value="C3">C3</option>
                        <option value="C4">C4</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Date (YYYY-MM-DD)</label>
                    <input type="date" id="date" name="date" required>
                </div>

                <div class="form-group">
                    <label for="start_time">Start Time</label>
                    <input type="time" id="start-time" name="start_time" required>
                </div>

                <div class="form-group">
                    <label for="end_time">End Time</label>
                    <input type="time" id="end-time" name="end_time" required>
                </div>

                <div class="form-group">
                    <button type="submit">Check</button>
                </div>
            </form>

            <?php if (!empty($responseMessage)): ?>
                <p class="<?= htmlspecialchars($responseClass); ?>"><?= htmlspecialchars($responseMessage); ?></p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        // Close dropdown menu if clicked outside
        window.onclick = function (event) {
            var menu = document.getElementById("menu");
            if (!event.target.matches('.hamburger') && menu.style.display === "block") {
                menu.style.display = "none";
            }
        }
    </script>
</body>

</html>