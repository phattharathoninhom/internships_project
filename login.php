<?php
session_start();
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $conn->real_escape_string($_POST['username']);
    $pass = $conn->real_escape_string($_POST['password']);

    $res =$conn->query("select * from students where student_id='$user' and password='$pass'");
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $_SESSION['user_id'] = $row['student_id'];
        $_SESSION['name'] = $row['firstName']. " " . $row['lastName'];
        $_SESSION['role'] = 'student';
        header("Location: student_dashboard.php");
        exit();
    }
    $res = $conn->query("select * from staff where username='$user' and password='$pass'");
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $_SESSION['user_id'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];

        if ($_SESSION['role'] == 'admin') {
            header("Location: admin_dashboard.php");
         } else {
            header("Location: teacher_dashboard.php");
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