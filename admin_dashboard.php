<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['role']) ||  $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$sql = "SELECT r.*, s.firstName, s.lastName, st.status_name
        FROM internship_request r
        JOIN students s ON r.student_id = s.student_id
        JOIN status_list st ON r.status_code = st.status_code
        ORDER BY r.request_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left;}
        th { background-color: f4f4f4; }
        .status-badge { padding: 5px 10px; border-radius: 4px; font-size: 0.9em; }
    </style>
</head>
<body>
    <h2>จัดการข้อมูลการฝึกงาน (เจ้าหน้าที่คณะ)</h2>
    <p>สวัสดีคุณ: <?php echo $_SESSION['name']; ?> | <a href="logout.php">ออกจากระบบ</a></p>

    <table>
        <thead>
            <tr>
                <th>รหัสนิสิต</th>
                <th>ชื่อ-นามสกุล</th>
                <th>บริษัทที่ฝึกงาน</th>
                <th>สถานะปัจจุบัน</th>
                <th>จัดการสถานะ</th>
                <th>รายละเอียด</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['student_id']; ?></td>
                <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                <td><?php echo $row['company_name']; ?></td>
                <td>
                    <span class="status-badge"><?php echo $row['status_name']; ?></span>
                </td>
                <td>
                    <form action="update_status.php" method="POST" style="display:inline;">
                        <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                        <select name="new_status" onchange="this.form.submit()">
                            <option value="">-- เปลี่ยนสถานะ --</option>
                            <option value="1">1: รับเรื่องเข้าระบบ</option>
                            <option value="2">2: อาจารย์ที่ปรึกษาอนุมัติ</option>
                            <option value="3">3: ออกใบส่งตัวแล้ว</option>
                            <option value="4">4: ฝึกงานเสร็จสิ้น</option>
                            <option value="9">9: ยกเลิก</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href="view_detail.php?id=<?php echo $row['request_id']; ?>">ดูรายละเอียด</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>