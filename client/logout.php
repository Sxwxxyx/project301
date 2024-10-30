<?php
session_start();

// ทำลาย session ทั้งหมด
session_unset();
session_destroy();

// ส่งผู้ใช้กลับไปที่หน้า index.php หลังจากออกจากระบบ
header("Location: index.php");
exit();
?>