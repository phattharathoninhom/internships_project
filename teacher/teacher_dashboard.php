<?php
session_start();
require_once('../includes/connect.php');

// ตรวจสอบ Login (role ของอาจารย์คือ 'teacher')
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: index.html");
    exit();
}

$teacher_id = $_SESSION['user_id'];

// --- ดึงข้อมูลนิสิตและรายการคำขอ (ตามข้อ 5.1) ---
// ใช้ INNER JOIN เพื่อดึงเฉพาะนิสิตที่มีการส่งคำขอเข้ามาแล้ว
$sql = "SELECT s.*, r.request_id, r.company_name, r.status_code, st.status_name
        FROM internship_request r
        INNER JOIN students s ON r.student_id = s.student_id
        LEFT JOIN status_list st ON r.status_code = st.status_code
        ORDER BY r.request_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard | SWU Internship</title>
    <link rel="stylesheet" href="/internship_project/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .teacher-content { padding: 40px 20px; max-width: 1200px; margin: 60px auto 0 auto; }
        .header-box { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .table-container { background: white; padding: 25px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-family: 'Sarabun', sans-serif; }
        th { background-color: #9e1a32; color: white; padding: 15px; text-align: left; font-weight: 400; }
        td { padding: 15px; border-bottom: 1px solid #eee; color: #444; }
        tr:hover { background-color: #fff9f9; }
        .status-badge { padding: 6px 12px; border-radius: 20px; font-size: 0.85em; font-weight: bold; display: inline-block; white-space: nowrap; }
        .status-1 { background-color: #fff4e5; color: #ff9800; }
        .status-2 { background-color: #e3f2fd; color: #1976d2; }
        .status-3 { background-color: #f3e5f5; color: #7b1fa2; }
        .status-4 { background-color: #e8f5e9; color: #2e7d32; }
        .status-9 { background-color: #ffebee; color: #c62828; }
        .status-default { background-color: #f5f5f5; color: #666; }
        select { padding: 8px; border-radius: 5px; border: 1px solid #ddd; font-family: 'Sarabun', sans-serif; cursor: pointer; }
        .btn-action { text-decoration: none; padding: 5px 12px; border-radius: 5px; font-size: 0.9em; font-weight: bold; transition: 0.3s; display: inline-block; }
        .btn-view { border: 1px solid #9e1a32; color: #9e1a32; margin-right: 5px; }
        .btn-view:hover { background: #9e1a32; color: white; }
        .btn-note { border: 1px solid #555; color: #555; }
        .btn-note:hover { background: #555; color: white; }
        .logout-btn { color: #9e1a32; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <?php include('../includes/navbar.php'); ?>

    <div class="teacher-content">
        <div class="header-box">
            <div>
                <h2 style="color: #9e1a32; margin: 0;">ระบบอาจารย์ที่ปรึกษา</h2>
                <p style="margin: 5px 0 0 0; color: #666;">รายการคำขอฝึกงานที่รอดำเนินการ</p>
            </div>
            <div style="text-align: right;">
                <strong>อาจารย์:</strong> <?php echo $_SESSION['name']; ?>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>บริษัทที่สมัคร</th>
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                        <th>รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?php echo $row['student_id']; ?></strong></td>
                            <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                            <td><?php echo $row['company_name'] ?? '-'; ?></td>
                            <td>
                                <?php 
                                    $s_code = $row['status_code'];
                                    $status_class = "status-default";
                                    if($s_code == 1) $status_class = "status-1";
                                    else if($s_code == 2) $status_class = "status-2";
                                    else if($s_code == 3) $status_class = "status-3";
                                    else if($s_code == 4) $status_class = "status-4";
                                    else if($s_code == 9) $status_class = "status-9";
                                ?>
                                <span class="status-badge <?php echo $status_class; ?>">
                                    <?php echo $row['status_name'] ?? 'ไม่มีข้อมูล'; ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($row['status_code'] == '1'): ?>
                                    <form action="update_status.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                                        <select name="new_status" onchange="if(confirm('ยืนยันการอนุมัติคำขอฝึกงานของนิสิต?')) this.form.submit()">
                                            <option value="" selected disabled>รับเรื่องเข้าระบบ</option>
                                            <option value="2">อาจารย์ที่ปรึกษาอนุมัติ</option>
                                        </select>
                                    </form>
                                <?php else: ?>
                                    <span style="color: #2e7d32; font-size: 0.9em;">อนุมัติแล้ว</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="view_detail.php?id=<?php echo $row['request_id']; ?>" class="btn-action btn-view">ดูข้อมูล</a>
                                <a href="supervision_form.php?id=<?php echo $row['request_id']; ?>" class="btn-action btn-note">บันทึกนิเทศ</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align:center; padding:30px;">ไม่พบรายการคำขอฝึกงาน</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>