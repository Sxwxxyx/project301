<?php
session_start();

// ตั้งค่า URL ของ API
$url = 'http://127.0.0.1:5000/all_reservation';

// เริ่มต้น cURL
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

// ส่ง request ในรูปแบบ GET
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');

// ดึงข้อมูลจาก API
$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

// ตรวจสอบว่าการเรียก API สำเร็จหรือไม่
$reservations = [];
$error_message = '';

if ($httpCode == 200) {
    // แปลงข้อมูล JSON ที่ได้รับเป็น array
    $reservations = json_decode($response, true);
} else {
    // กรณีเกิดข้อผิดพลาด
    $error_message = "ไม่สามารถดึงข้อมูลการจองได้ (HTTP Code: $httpCode)";
}

// รับวันที่จาก URL
$dateFilter = isset($_GET['date']) ? $_GET['date'] : ''; // รับวันที่จาก URL
if ($dateFilter) {
    $reservations = array_filter($reservations, function ($reservation) use ($dateFilter) {
        return $reservation['date'] === $dateFilter; // เปรียบเทียบวันที่
    });
}

// เช็ควันที่มีการจอง
$bookedDates = array_map(function ($reservation) {
    return $reservation['date'];
}, $reservations);
?>


<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Reservations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
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

        .main-container {
            display: flex;
            flex: 1;
            padding-top: 70px;
        }

        .sidebar {
            width: 240px;
            background-color: #f7f7f7;
            padding: 20px;
            border-right: 1px solid #ddd;
            height: calc(100vh - 70px);
            overflow-y: auto;
        }

        .status-box,
        .calendar-box {
            background-color: #fff;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
        }

        .login-button {
            display: block;
            width: 90%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            text-align: center;
            border-radius: 4px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .error {
            color: red;
            font-weight: bold;
        }


        .calendar {
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .days {
            display: flex;
            justify-content: space-between;
            background-color: #5a4b8a;
            color: white;
            padding: 5px;
            border-radius: 5px;
            font-size: 14px;
        }

        .dates {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin-top: 5px;
            justify-content: space-between;

        }

        .date {
            width: 25px;
            height: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #e0e0e0;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;

        }

        .date:hover {
            background-color: #d4d4d4;
        }

        .date.today {
            background-color: #5a4b8a;
            color: white;
        }

        .date.selected {
            background-color: #007bff;
            color: white;
        }

        h2 {
            font-size: 20px;
        }

        .date.booked {
            background-color: #AFD7F6;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="navbar-left">
            <a href="index.php"><img src="https://www.psu.ac.th/img/introduce/introduce3/psubrand.png"
                    alt="Website Logo"></a>
            <a href="reservation.php">Reservation</a>
            <a href="all_reservation.php">การจองทั้งหมด</a>
            <a href="plan.php">Room plan</a>
            <a href="contact.php">Contact us</a>
        </div>
    </div>

    <div class="main-container">
        <div class="sidebar">
            <div class="status-box">
                <p>📅 ปิดภาคการศึกษาที่ 1 (เสาร์-อาทิตย์)<br>26/10/2567 - 27/10/2567<br><span
                        style="color:red;">CLOSED</span></p>
            </div>
            <div class="calendar">
                <div class="header">
                    <button id="prevMonth">Previous</button>
                    <h2 id="monthYear"></h2>
                    <button id="nextMonth">Next</button>
                </div>
                <div class="days">
                    <div class="day">Sun</div>
                    <div class="day">Mon</div>
                    <div class="day">Tue</div>
                    <div class="day">Wed</div>
                    <div class="day">Thu</div>
                    <div class="day">Fri</div>
                    <div class="day">Sat</div>
                </div>
                <div class="dates" id="dates"></div>
            </div>
            <div style="padding-top: 20px;">
                <a id="loginButton"
                    href="<?= isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'logout.php' : 'login.php'; ?>"
                    class="login-button">
                    <?= isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'Log out' : 'Sign in'; ?>
                </a>
            </div>
        </div>

        <div class="main-content">
            <h2>All Reservations</h2>
            <?php if (!empty($error_message)): ?>
                <p class="error"><?= htmlspecialchars($error_message); ?></p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Room Type</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($reservations)): ?>
                            <tr>
                                <td colspan="5">ไม่พบข้อมูลการจอง</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr>
                                    <td><?= date('d/m/Y', strtotime($reservation['date'])); ?></td>
                                    <td><?= htmlspecialchars($reservation['room_type']); ?></td>
                                    <td><?= date('H:i', strtotime($reservation['start_time'])); ?></td>
                                    <td><?= date('H:i', strtotime($reservation['end_time'])); ?></td>
                                    <td><?= htmlspecialchars($reservation['username']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    <script>
        const monthYear = document.getElementById('monthYear');
        const datesContainer = document.getElementById('dates');
        const prevMonthBtn = document.getElementById('prevMonth');
        const nextMonthBtn = document.getElementById('nextMonth');
        let currentDate = new Date();

        // กำหนดข้อมูลวันที่ที่มีการจอง (จาก PHP array $bookedDates)
        const bookedDates = <?= json_encode($bookedDates); ?>;

        function renderCalendar() {
            datesContainer.innerHTML = '';
            const month = currentDate.getMonth();
            const year = currentDate.getFullYear();
            monthYear.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${year}`;
            const firstDayOfMonth = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            // Padding for days before the 1st
            for (let i = 0; i < firstDayOfMonth; i++) {
                const emptyDiv = document.createElement('div');
                datesContainer.appendChild(emptyDiv);
            }

            // Render each day of the month
            for (let day = 1; day <= daysInMonth; day++) {
                const dateDiv = document.createElement('div');
                dateDiv.textContent = day;
                dateDiv.classList.add('date');

                const fullDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

                // เพิ่มคลาส 'today' สำหรับวันที่ปัจจุบัน
                if (day === currentDate.getDate() && currentDate.getMonth() === new Date().getMonth() && currentDate.getFullYear() === new Date().getFullYear()) {
                    dateDiv.classList.add('today');
                }

                // เพิ่มคลาส 'booked' ถ้าวันนั้นมีการจอง
                if (bookedDates.includes(fullDate)) {
                    dateDiv.classList.add('booked');
                }

                // กำหนดการคลิกสำหรับแต่ละวันที่เพื่อกรองข้อมูลการจอง
                dateDiv.addEventListener('click', () => {
                    window.location.href = `all_reservation.php?date=${fullDate}`;
                });

                datesContainer.appendChild(dateDiv);
            }
        }

        prevMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        nextMonthBtn.addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        renderCalendar();
    </script>

</body>

</html>