<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: index.html");
    exit();
}

$student_id = $_SESSION['user_id'];

// 1. ดึงข้อมูลส่วนตัวนิสิต (ดึงแถวเดียว)
$sql_student = "SELECT * FROM students WHERE student_id = '$student_id'";
$res_student = $conn->query($sql_student);
$student = $res_student->fetch_assoc();

// 2. ดึงรายการคำขอฝึกงานทั้งหมด (ดึงทุกแถวที่เคยยื่น)
$sql_req = "SELECT r.*, st.status_name 
            FROM internship_request r
            LEFT JOIN status_list st ON r.status_code = st.status_code
            WHERE r.student_id = '$student_id'
            ORDER BY r.request_date DESC"; // เอาล่าสุดขึ้นก่อน
$result_req = $conn->query($sql_req);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard | SWU Internship</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        .student-content { padding: 40px 20px; max-width: 900px; margin: 80px auto 0 auto; }
        
        /* Card ข้อมูลนิสิต */
        .profile-card {
            background: white; padding: 25px; border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08); border-top: 5px solid #9e1a32;
            margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;
        }

        .info-item { margin-bottom: 5px; }
        .info-label { color: #888; font-size: 0.85em; margin-right: 10px; }
        .info-value { color: #333; font-weight: bold; }

        /* ส่วนตารางรายการ */
        .request-section { background: white; padding: 25px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { text-align: left; padding: 12px; border-bottom: 2px solid #f0f0f0; color: #666; font-size: 0.9em; }
        td { padding: 15px 12px; border-bottom: 1px solid #f9f9f9; vertical-align: middle; }

        /* Badge Status */
        .status-badge {
            padding: 5px 12px; border-radius: 15px; font-size: 0.85em; font-weight: bold; display: inline-block;
        }
        .status-1 { background: #fff4e5; color: #ff9800; }
        .status-2 { background: #e3f2fd; color: #1976d2; }
        .status-3 { background: #f3e5f5; color: #7b1fa2; }
        .status-4 { background: #e8f5e9; color: #2e7d32; }
        .status-9 { background: #ffebee; color: #c62828; }

        .btn-request {
            background: #9e1a32; color: white; padding: 10px 20px; border-radius: 8px;
            text-decoration: none; font-weight: bold; transition: 0.3s; font-size: 0.9em;
        }
        .btn-request:hover { background: #7a1426; box-shadow: 0 4px 12px rgba(158, 26, 50, 0.3); }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="student_dashboard.php" class="nav-logo">SWU Internship</a>
            <ul class="nav-menu">
                <li><a href="logout.php" style="color: #9e1a32; font-weight: bold; text-decoration: none;">ออกจากระบบ</a></li>
            </ul>
        </div>
    </nav>

    <div class="student-content">
        <div class="profile-card">
            <div>
                <h2 style="margin: 0 0 10px 0; color: #9e1a32;">ยินดีต้อนรับ</h2>
                <div class="info-item">
                    <span class="info-label">ชื่อ-นามสกุล:</span>
                    <span class="info-value"><?= $student['firstName'] . " " . $student['lastName']; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">รหัสนิสิต:</span>
                    <span class="info-value"><?= $student['student_id']; ?></span>
                </div>
            </div>
            <a href="student_internships_req.php" class="btn-request">+ ยื่นคำขอใหม่</a>
        </div>

        <div class="request-section">
            <h3 style="margin-top: 0; color: #444;">ประวัติการยื่นคำขอฝึกงาน</h3>
            
            <?php if ($result_req->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>วันที่ยื่น</th>
                            <th>สถานประกอบการ</th>
                            <th>สถานะ</th>
                            <th>หมายเหตุจากอาจารย์</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result_req->fetch_assoc()): ?>
                            <tr>
                                <td style="font-size: 0.9em; color: #666;">
                                    <?= date('d/m/Y', strtotime($row['request_date'])); ?>
                                </td>
                                <td>
                                    <strong style="color: #333;"><?= $row['company_name']; ?></strong><br>
                                    <small style="color: #888;">เริ่ม: <?= date('d/m/Y', strtotime($row['start_date'])); ?></small>
                                </td>
                                <td>
                                    <?php 
                                        $s_code = $row['status_code'];
                                        $class = "status-default";
                                        if($s_code == 1) $class = "status-1";
                                        else if($s_code == 2) $class = "status-2";
                                        else if($s_code == 3) $class = "status-3";
                                        else if($s_code == 4) $class = "status-4";
                                        else if($s_code == 9) $class = "status-9";
                                    ?>
                                    <span class="status-badge <?= $class; ?>">
                                        <?= $row['status_name']; ?>
                                    </span>
                                </td>
                                <td style="font-size: 0.85em; color: #d63384;">
                                    <?= $row['advisor_note'] ? $row['advisor_note'] : '-'; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div style="text-align: center; padding: 40px; color: #999;">
                    <p>ยังไม่มีประวัติการยื่นคำขอฝึกงาน</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>