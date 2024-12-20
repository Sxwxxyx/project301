<?php
session_start();

?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Fade Transition</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            display: flex;
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

        .sidebar {
            width: 240px;
            background-color: #f7f7f7;
            padding: 20px;
            border-right: 1px solid #ddd;
            margin-top: 70px;
            height: calc(100vh - 70px);
            overflow-y: auto;
        }

        .status-box,
        .calendar-box,
        .qr-code-box {
            margin-bottom: 20px;
        }

        .status-box,
        .calendar-box {
            background-color: #fff;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
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
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: auto;
            opacity: 0;
            transition: opacity 2s ease-in-out;
        }

        .image-container img.active {
            opacity: 1;
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
                <a href="#">Log out</a>
                <a href="profile.php">Profile</a>
                <a href="#">Participation</a>
            </div>
        </div> -->
    </div>

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
                href="<?php echo isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'logout.php' : 'login.php'; ?>"
                class="login-button">
                <?php echo isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'Log out' : 'Sign in'; ?>
            </a>


        </div>
        <!-- <div class="qr-code-box">
            <img src="https://via.placeholder.com/150" alt="QR Code">
        </div> -->
    </div>

    <div class="main-content">
        <div class="image-container">
            <img src="../image/P1.jpg" alt="Preview Image 1" class="active">
            <img src="../image/P2.jpg" alt="Preview Image 2">
            <img src="../image/P3.jpg" alt="Preview Image 3">
        </div>
    </div>

    <script>
        const reservedDates = ['2024-10-26', '2024-10-27']; // วันที่ที่มีการจอง
        const monthYear = document.getElementById('monthYear');
        const datesContainer = document.getElementById('dates');
        const prevMonthBtn = document.getElementById('prevMonth');
        const nextMonthBtn = document.getElementById('nextMonth');

        let currentDate = new Date();

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

            const selectedDate = sessionStorage.getItem('selectedDate'); // ดึงวันที่ที่ถูกเลือก

            for (let day = 1; day <= daysInMonth; day++) {
                const dateDiv = document.createElement('div');
                dateDiv.textContent = day;
                dateDiv.classList.add('date');

                const fullDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

                // ไฮไลท์วันที่ปัจจุบัน
                if (day === currentDate.getDate() && currentDate.getMonth() === new Date().getMonth() && currentDate.getFullYear() === new Date().getFullYear()) {
                    dateDiv.classList.add('today');
                }

                // ไฮไลท์วันที่ที่ถูกเลือก
                if (selectedDate === fullDate) {
                    dateDiv.classList.add('selected');
                }
                // เพิ่ม event listener ให้คลิกวันที่ไปยัง all_reservation.php พร้อมพารามิเตอร์วันที่
                dateDiv.addEventListener('click', () => {
                    sessionStorage.setItem('selectedDate', fullDate); // บันทึกวันที่ที่เลือก
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

        dateDiv.addEventListener('click', () => {
            // บันทึกวันที่ที่เลือกลงใน Session Storage
            sessionStorage.setItem('selectedDate', fullDate);
            window.location.href = `all_reservation.php?date=${fullDate}`;
        });

    </script>
</body>

</html>