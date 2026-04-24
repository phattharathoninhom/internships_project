<?php
session_start();
require_once 'includes/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $conn->real_escape_string($_POST['password']);

    $res =$conn->query("select * from students where student_id='$user' and password='$pass'");
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $_SESSION['user_id'] = $row['student_id'];
        $_SESSION['name'] = $row['firstName']. " " . $row['lastName'];
        $_SESSION['role'] = 'student';
        header("Location: student/student_dashboard.php");
        exit();
    }
    $res = $conn->query("select * from staff where username='$user' and password='$pass'");
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $_SESSION['user_id'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];

        if ($_SESSION['role'] == 'admin') {
            header("Location: admin/admin_dashboard.php");
         } else {
            header("Location: teacher/teacher_dashboard.php");
        }
        exit();
    }

    echo "<script>
            alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
            window.location.href='index.html';
          </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWU Internship Management System</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="main-content">
        <div class="login-container">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/dd/Logo_of_Srinakharinwirot_University.svg/1280px-Logo_of_Srinakharinwirot_University.svg.png" alt="SWU Logo" class="logo">
            
            <h2>เข้าสู่ระบบ</h2>
            <p style="margin-top: 5px; color: #58595b;">คณะมนุษยศาสตร์ มหาวิทยาลัยศรีนครินทรวิโรฒ</p>
            <p style="font-weight: bold; color: #9e1b32; font-size: 0.9rem;">
            หลักสูตรศิลปศาสตรบัณฑิต สาขาวิชาสารสนเทศศึกษา
            </p>

            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">ชื่อผู้ใช้งาน</label>
                    <input type="text" id="username" name="username" placeholder="รหัสนิสิต" required>
                </div>

                <div class="form-group">
                    <label for="password">รหัสผ่าน</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="login-btn">เข้าสู่ระบบ</button>
            </form>

            
        </div>
    </div>

</body>
</html>หลัก