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
            z-index: 1; /* Ensure it appears above other content */
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

        /* CSS สำหรับภาพที่จะเปลี่ยน */
        .image-container {
            position: relative;
            width: 100%;
            height: auto;
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
    </style>
</head>
<body>

    <div class="navbar">
        <div class="navbar-left">
            <img src="https://www.psu.ac.th/img/introduce/introduce3/psubrand.png" alt="Website Logo">
            <a href="#">Reservation</a>
            <a href="#">Calendar</a>
            <a href="#">Room plan</a>
            <a href="#">Contact us</a>
        </div>
        <div class="navbar-right">
            <div class="hamburger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="dropdown-menu" id="menu">
                <a href="#">Sign in</a>
                <a href="#">Log out</a>
                <a href="#">Profile</a>
                <a href="#">Participation</a>
            </div>
        </div>
    </div>

    <div class="image-container">
        <img src="https://scontent-bkk1-2.xx.fbcdn.net/v/t39.30808-6/461987385_1050974450152466_7396870744103942720_n.jpg?stp=cp6_dst-jpg&_nc_cat=105&ccb=1-7&_nc_sid=833d8c&_nc_ohc=P6xWelmv98oQ7kNvgGvq2_z&_nc_zt=23&_nc_ht=scontent-bkk1-2.xx&_nc_gid=A6q4Flu1eUlGATUbxt23agI&oh=00_AYCikJOhR2Z1hjeEDhStHZqzJw8dyekN_tUnMu-i29Nj3Q&oe=671E5098" class="active" alt="Preview Image 1">
        <img src="https://f.ptcdn.info/001/009/000/1377702895-DSC0085JPG-o.jpg" alt="Preview Image 2">
    </div>

    <script>
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

        // Close the dropdown menu if clicked outside
        window.onclick = function(event) {
            var menu = document.getElementById("menu");
            if (!event.target.matches('.hamburger') && menu.style.display === "block") {
                menu.style.display = "none";
            }
        }
    </script>
</body>
</html>
