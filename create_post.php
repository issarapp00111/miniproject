<?php
// เริ่ม session หรือเช็คการล็อคอิน
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // กระโดดไปหน้าล็อคอินถ้ายังไม่ล็อคอิน
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากแบบฟอร์ม
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    // เชื่อมต่อฐานข้อมูล    
    $db = new mysqli('localhost', 'root', '', 'myforum');

    if ($db->connect_error) {
        die('Connection failed: ' . $db->connect_error);
    }

    // สร้างคำสั่ง SQL เพื่อเพิ่มกระทู้ใหม่
    $sql = "INSERT INTO posts (title, content, user_id) VALUES ('$title', '$content', $user_id)";

    if ($db->query($sql) === TRUE) {
        header('Location: profile.php'); // เมื่อเพิ่มกระทู้สำเร็จ กลับไปยังโปรไฟล์
        exit;
    } else {
        echo 'Error: ' . $sql . '<br>' . $db->error;
    }

    $db->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link rel="stylesheet" href="creat1.css">
</head>
<body>
<div class="body">
    <h2 class="logo">CREAT POST</h2>
    <ul>
        <li><a href="login.php">LOGIN</a></li>
        <li><a href="home.php">HOMEPAGE</a></li>
        <li><a href="index.php">WEBBORD</a></li>
    </ul>
</div>
    <main>
        <form action="create_post_process.php" method="POST">
            <div class="form-group">
                <label for="title">หัวข้อ:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">เรื่อง:</label>
                <input type="text" id="content" name="content" required>
            </div>
            <div class="form-group">
                <button  n type="submit">SUBMIT</button>
            </div>
        </form>
    </main>
</body>
</html>
