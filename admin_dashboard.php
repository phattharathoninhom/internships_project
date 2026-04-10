<?php
session_start();
require_once 'connect.php';

// เช็คสิทธิ์ (ต้องเป็น admin เท่านั้น)
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.html");
    exit();
}

$sql = "SELECT r.*, s.firstName, s.lastName, st.status_name
        FROM internship_request r
        JOIN students s ON r.student_id = s.student_id
        JOIN status_list st ON r.status_code = st.status_code
        ORDER BY r.request_id ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SWU Internship</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        /* ตกแต่งเพิ่มเติมสำหรับหน้า Dashboard */
        .admin-content {
            padding: 40px 20px;
            max-width: 1200px;
            margin: 60px auto 0 auto;
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

        tr:hover {
            background-color: #fff9f9;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            background: #e8f0fe;
            color: #1967d2;
            font-weight: bold;
        }

        select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-family: 'Sarabun', sans-serif;
            outline: none;
        }

        .btn-detail {
            text-decoration: none;
            color: #9e1a32;
            font-weight: bold;
            border: 1px solid #9e1a32;
            padding: 5px 10px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-detail:hover {
            background: #9e1a32;
            color: white;
        }

        .logout-btn {
            color: #9e1a32;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-logo">SWU Internship Admin</a>
            <ul class="nav-menu">
                <li><a href="logout.php" class="logout-btn">ออกจากระบบ</a></li>
            </ul>
        </div>
    </nav>

    <div class="admin-content">
        <div class="header-box">
            <div>
                <h2 style="color: #9e1a32; margin: 0;">จัดการข้อมูลการฝึกงาน</h2>
                <p style="margin: 5px 0 0 0; color: #666;">รายการคำขอฝึกงานจากนิสิตทั้งหมด</p>
            </div>
            <div style="text-align: right;">
                <strong>เจ้าหน้าที่:</strong> <?php echo $_SESSION['name']; ?>
            </div>
        </div>

        <div class="table-container">
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
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?php echo $row['student_id']; ?></strong></td>
                            <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                            <td><?php echo $row['company_name']; ?></td>
                            <td>
                                <span class="status-badge"><?php echo $row['status_name']; ?></span>
                            </td>
                            <td>
                                <form action="update_status.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
                                    <select name="new_status" onchange="if(confirm('ยืนยันการเปลี่ยนสถานะ?')) this.form.submit()">
                                        <option value="">-- แก้ไข --</option>
                                        <option value="1">1: รับเรื่องเข้าระบบ</option>
                                        <option value="2">2: อาจารย์ที่ปรึกษาอนุมัติ</option>
                                        <option value="3">3: ออกใบส่งตัวแล้ว</option>
                                        <option value="4">4: ฝึกงานเสร็จสิ้น</option>
                                        <option value="9">9: ยกเลิก</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <a href="view_detail.php?id=<?php echo $row['request_id']; ?>" class="btn-detail">ดูข้อมูล</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center; padding: 50px; color: #999;">ยังไม่มีนิสิตบันทึกข้อมูลเข้าระบบ</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>