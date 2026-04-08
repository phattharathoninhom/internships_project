<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['user_id'])  ||  $_SESSION['role'] !== 'student') {
    header("Location: index.html");
    exit();
}

$student_id = $_SESSION['user_id'];

$sql = "select s.*, r.company_name, r.status_code, st.status_name
    from students s
    left join internship_request r on s.student_id = r.student_id
    left join status_list st on r.status_code = st.status_code
    where s.student_id = '$student_id'";

$result = $conn->query($sql);
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
</head>
<body>
    <h2><?php echo $data['firstName'] . " " . $data['lastName'];?></h2>
    <p>Student ID: <?php echo $data['student_id']; ?></p>
    <p>Email: <?php echo $data['email']; ?></p>

    <hr>

    <h3>Internship Detail</h3>
    <?php if ($data['company_name']): ?>
        <p><strong>บริษัท:</strong> <?php echo $data['company_name']; ?></p>
        <p><strong>สถานะ:</strong>
            <span style="color:blue;"><?php echo $data['status_name']; ?></span>
        </p>
    <?php else: ?>
        <a href="add_request.php"><button>บันทึก</button></a>
    <?php endif; ?>

    <br><br>
    <a href="index.html">ออกจากระบบ</a>
</body>
</html>