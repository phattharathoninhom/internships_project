<?php
session_start();
require_once 'connect.php';

// ตรวจสอบ Login (สมมติว่า role ของอาจารย์คือ 'teacher')
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: index.html");
    exit();
}

$teacher_id = $_SESSION['user_id'];

// --- 5.2 Logic สำหรับการกดอนุมัติ ---
if (isset($_GET['approve_id'])) {
    $request_id = $_GET['approve_id'];
    // เปลี่ยนสถานะจาก 1 เป็น 2
    $update_sql = "UPDATE internship_request SET status_code = '2' WHERE student_id = ? AND status_code = '1'";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("s", $request_id);
    $stmt->execute();
    header("Location: teacher_dashboard.php");
    exit();
}

// --- 5.1 ดึงข้อมูลนิสิตทั้งหมดที่บันทึกคำขอเข้ามา ---
// ปรับ SQL ให้ Join เหมือนหน้า Student แต่ดึงทุกคน
$sql = "SELECT s.*, r.company_name, r.status_code, st.status_name
        FROM students s
        LEFT JOIN internship_request r ON s.student_id = r.student_id
        LEFT JOIN status_list st ON r.status_code = st.status_code
        ORDER BY s.student_id ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .status-wait { color: orange; font-weight: bold; }
        .status-approve { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <h1>อาจารย์ที่ปรึกษา: ระบบจัดการการฝึกงาน</h1>
    <hr>

    <h2>รายชื่อนิสิตและสถานะคำขอฝึกงาน</h2>
    <table>
        <thead>
            <tr>
                <th>รหัสนิสิต</th>
                <th>ชื่อ-นามสกุล</th>
                <th>บริษัทที่สมัคร</th>
                <th>สถานะปัจจุบัน</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['student_id']; ?></td>
                <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                <td><?php echo $row['company_name'] ?? 'ยังไม่ได้ระบุ'; ?></td>
                <td>
                    <span class="<?php echo ($row['status_code'] == '1') ? 'status-wait' : 'status-approve'; ?>">
                        <?php echo $row['status_name'] ?? 'ไม่มีข้อมูล'; ?>
                    </span>
                </td>
                <td>
                    <a href="view_detail.php?id=<?php echo $row['student_id']; ?>">ดูรายละเอียด</a> | 

                    <?php if ($row['status_code'] == '1'): ?>
                        <a href="?approve_id=<?php echo $row['student_id']; ?>" 
                           onclick="return confirm('ยืนยันการอนุมัติคำขอของนิสิตท่านนี้?')">อนุมัติ</a> |
                    <?php endif; ?>

                    <a href="supervision_form.php?id=<?php echo $row['student_id']; ?>">บันทึกการนิเทศ</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <br><br>
    <a href="index.html">ออกจากระบบ</a>
</body>
</html>