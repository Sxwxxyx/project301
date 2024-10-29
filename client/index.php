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
        }

        /* Navbar */
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

        /* Left menu */
        .navbar-left {
            display: flex;
            align-items: center;
        }

        /* Logo */
        .navbar-left img {
            height: 50px;
            margin-right: 20px;
        }

        /* Navbar links */
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

        /* Hamburger button */
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

        /* Dropdown menu */
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

        /* Sidebar */
        .sidebar {
            width: 240px;
            background-color: #f7f7f7;
            padding: 20px;
            border-right: 1px solid #ddd;
            margin-top: 70px;
            /* Offset for navbar */
            height: calc(100vh - 70px);
            overflow-y: auto;
        }

        /* Sidebar content styling */
        .status-box,
        .calendar-box,
        .qr-code-box {
            margin-bottom: 20px;
        }

        .status-box {
            background-color: #fff;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .calendar-box {
            background-color: #fff;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .qr-code-box img {
            width: 100%;
            border-radius: 4px;
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

        /* Main content */
        .main-content {
            flex: 1;
            /* padding: 20px;
            padding-top: 80px; */
            /* margin-left: 240px; */
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        /* Image container */
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
            /* width : 100% */
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
                <a href="#">Participation</a>
            </div>
        </div>
    </div>

    <div class="sidebar">
        <div class="status-box">
            <p>📅 ปิดภาคการศึกษาที่ 1 (เสาร์-อาทิตย์)<br>26/10/2567 - 27/10/2567<br><span
                    style="color:red;">CLOSED</span></p>
        </div>
        <div class="calendar-box">
            <p><strong>October 2024</strong></p>
            <!-- Calendar structure (add a dynamic calendar here if needed) -->
            <p>Sun Mon Tue Wed Thu Fri Sat</p>
            <p>... calendar dates ...</p>
        </div>
        <a id="loginButton" href="login.php" class="login-button">
            Sign in
        </a>

        <div class="qr-code-box">
            <img src="https://via.placeholder.com/150" alt="QR Code">
        </div>
    </div>

    <div class="main-content">
        <div class="image-container">
            <img src="../image/P1.jpg" alt="Preview Image 1">
            <img src="../image/P2.jpg" alt="Preview Image 2">
            <img src="../image/P3.jpg" alt="Preview Image 3">
        </div>
    </div>

    <script>
        // // กำหนดสถานะการเข้าสู่ระบบจาก PHP
        // let isLoggedIn = <?php echo isset($_SESSION['login']) ? 'true' : 'false'; ?>;

        window.onload = function () {
            const loginButton = document.getElementById("loginButton");
            if (isLoggedIn) {
                loginButton.innerHTML = "Log out";
                loginButton.href = "logout.php";
            } else {
                loginButton.innerHTML = "Sign in";
                loginButton.href = "login.php";
            }
        }

        let currentImageIndex = 0;
        const images = document.querySelectorAll('.image-container img');
        function switchImage() {
            images[currentImageIndex].classList.remove('active');
            currentImageIndex = (currentImageIndex + 1) % images.length;
            images[currentImageIndex].classList.add('active');
        }
        setInterval(switchImage, 5000);

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