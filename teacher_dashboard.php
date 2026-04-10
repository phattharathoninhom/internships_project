<?php
session_start();
require_once 'connect.php';

// ตรวจสอบ Login (role ของอาจารย์คือ 'teacher')
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: index.html");
    exit();
}

$teacher_id = $_SESSION['user_id'];

// --- ดึงข้อมูลนิสิตทั้งหมด (ตามข้อ 5.1) ---
$sql = "SELECT s.*, r.request_id, r.company_name, r.status_code, st.status_name
        FROM students s
        LEFT JOIN internship_request r ON s.student_id = r.student_id
        LEFT JOIN status_list st ON r.status_code = st.status_code
        ORDER BY s.student_id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard | SWU Internship</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        .teacher-content {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 100px auto 0 auto; /* แก้ปัญหาโดน Navbar ทับ */
        }
        
        .header-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .table-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Sarabun', sans-serif;
        }

        th {
            background-color: #9e1a32; /* สีแดง มศว */
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 400;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            color: #444;
        }

        tr:hover { background-color: #fff9f9; }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: bold;
            white-space: nowrap;
            display: inline-block;
        }
        
        .status-1 { background: #fff4e5; color: #ff9800; } /* รอรับเรื่อง */
        .status-other { background: #e8f5e9; color: #2e7d32; } /* สถานะอื่นๆ */

        select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-family: 'Sarabun', sans-serif;
            outline: none;
            cursor: pointer;
        }

        .btn-action {
            text-decoration: none;
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 0.9em;
            font-weight: bold;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-view { border: 1px solid #9e1a32; color: #9e1a32; margin-right: 5px; }
        .btn-view:hover { background: #9e1a32; color: white; }

        .btn-note { border: 1px solid #555; color: #555; }
        .btn-note:hover { background: #555; color: white; }

        .logout-btn { color: #9e1a32; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="teacher_dashboard.php" class="nav-logo">SWU Internship Teacher</a>
            <ul class="nav-menu">
                <li><a href="logout.php" class="logout-btn">ออกจากระบบ</a></li>
            </ul>
        </div>
    </nav>

    <div class="teacher-content">
        <div class="header-box">
            <div>
                <h2 style="color: #9e1a32; margin: 0;">ระบบอาจารย์ที่ปรึกษา</h2>
                <p style="margin: 5px 0 0 0; color: #666;">จัดการและอนุมัติการฝึกงานของนิสิต</p>
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
                        <th>จัดการสถานะ</th>
                        <th>รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><strong><?php echo $row['student_id']; ?></strong></td>
                        <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                        <td><?php echo $row['company_name'] ?? '-'; ?></td>
                        <td>
                            <?php $class = ($row['status_code'] == '1') ? 'status-1' : 'status-other'; ?>
                            <span class="status-badge <?php echo $class; ?>">
                                <?php echo $row['status_name'] ?? 'ไม่มีข้อมูล'; ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($row['status_code'] == '1'): ?>
                                <form action="update_status.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                                    <select name="new_status" onchange="if(confirm('ยืนยันการอนุมัติคำขอ?')) this.form.submit()">
                                        <option value="" selected disabled><?php echo $row['status_name']; ?></option>
                                        <option value="2">อาจารย์ที่ปรึกษาอนุมัติ</option>
                                    </select>
                                </form>
                            <?php else: ?>
                                <span style="color: #ccc; font-size: 0.9em;">ดำเนินการแล้ว</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="view_detail.php?id=<?php echo $row['student_id']; ?>" class="btn-action btn-view">ดูข้อมูล</a>
                            <a href="supervision_form.php?id=<?php echo $row['student_id']; ?>" class="btn-action btn-note">บันทึกนิเทศ</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>