<?php
session_start();
require_once 'connect.php';

/**
 * 1. ACCESS CONTROL & INITIALIZATION
 */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: index.html");
    exit();
}

$session_student_id = $_SESSION['user_id'];
date_default_timezone_set('Asia/Bangkok');

$is_submitted = false;
$error_message = "";
$full_name = "ไม่พบข้อมูลชื่อในระบบ";

/**
 * 2. FETCH STUDENT NAME (MySQLi Style)
 * ดึงชื่อมาแสดงผลเฉยๆ ไม่ได้ส่งเข้าตาราง request
 */
$stmt_user = $conn->prepare("SELECT firstName, lastName FROM students WHERE student_id = ?");
$stmt_user->bind_param("s", $session_student_id);
$stmt_user->execute();
$result_user = $stmt_user->get_result();

if ($user_data = $result_user->fetch_assoc()) {
    $full_name = $user_data['firstName'] . " " . $user_data['lastName'];
}
$stmt_user->close();

/**
 * 3. FORM PROCESSING (MySQLi Style)
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $company_name    = trim($_POST['company_name']);
    $company_address = trim($_POST['company_address']);
    $contact_person  = trim($_POST['contact_person']);
    $start_date      = $_POST['start_date'];
    $end_date        = $_POST['end_date'];
    $request_date    = date("Y-m-d H:i:s");

    // ใช้เครื่องหมาย ? สำหรับ MySQLi bind_param
    $sql = "INSERT INTO internship_request 
            (student_id, company_name, company_address, contact_person, start_date, end_date, request_date, status_code) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
    
    if ($stmt = $conn->prepare($sql)) {
        // s = string, i = integer (ลำดับ: sid, cname, caddr, cperson, sdate, edate, rdate)
        $stmt->bind_param("sssssss", 
            $session_student_id, 
            $company_name, 
            $company_address, 
            $contact_person, 
            $start_date, 
            $end_date, 
            $request_date
        );

        if ($stmt->execute()) {
            $is_submitted = true;
        } else {
            $error_message = "เกิดข้อผิดพลาดในการบันทึก: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error_message = "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ยื่นคำขอฝึกงาน | SWU Internship</title>
    
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    
    <style>
        .req-content {
            padding: 40px 20px;
            max-width: 700px;
            margin: 80px auto 0 auto;
        }
        
        .form-card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-top: 6px solid #9e1a32;
        }

        .form-header {
            margin-bottom: 25px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
        }

        .form-group { margin-bottom: 20px; }
        
        label { 
            display: block; 
            margin-bottom: 8px; 
            font-weight: bold; 
            color: #444;
            font-size: 0.95em;
        }

        input[type="text"], 
        input[type="date"], 
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-family: 'Sarabun', sans-serif;
            font-size: 1em;
            transition: 0.3s;
        }

        input:focus, textarea:focus {
            border-color: #9e1a32;
            outline: none;
            box-shadow: 0 0 0 3px rgba(158, 26, 50, 0.1);
        }

        .btn-submit {
            background-color: #9e1a32;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 1.1em;
            font-weight: bold;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background-color: #7a1426;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(158, 26, 50, 0.3);
        }

        .btn-secondary {
            display: inline-block;
            margin-top: 15px;
            color: #666;
            text-decoration: none;
            font-size: 0.9em;
        }

        .alert {
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            text-align: center;
        }
        .alert-success { background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; }
        .alert-error { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="student_dashboard.php" class="nav-logo">SWU Internship</a>
            <ul class="nav-menu">
                <li><a href="student_dashboard.php" style="color: #9e1a32; font-weight: bold; text-decoration: none;">หน้าหลัก</a></li>
            </ul>
        </div>
    </nav>

    <div class="req-content">
        
        <?php if ($is_submitted): ?>
            <div class="alert alert-success">
                <h3 style="margin-top:0;">ส่งคำขอสำเร็จ!</h3>
                <p>ข้อมูลการฝึกงานของคุณถูกส่งเข้าระบบเรียบร้อยแล้ว</p>
                <a href="student_dashboard.php" class="btn-submit" style="display:block; text-decoration:none;">กลับหน้า Dashboard</a>
            </div>

        <?php else: ?>
            <div class="form-card">
                <div class="form-header">
                    <h2 style="color: #9e1a32; margin: 0;">ยื่นคำขอฝึกงานใหม่</h2>
                    <p style="color: #666; margin: 5px 0 0 0;">กรอกข้อมูลสถานประกอบการที่คุณต้องการเข้าฝึกงาน</p>
                </div>

                <?php if ($error_message): ?>
                    <div class="alert alert-error"><?= $error_message; ?></div>
                <?php endif; ?>

                <form action="" method="POST">
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 15px;">
                        <div class="form-group">
                            <label>รหัสนิสิต</label>
                            <input type="text" value="<?= htmlspecialchars($session_student_id); ?>" readonly style="background: #f5f5f5; color: #888;">
                        </div>
                        <div class="form-group">
                            <label>ชื่อ-นามสกุล</label>
                            <input type="text" value="<?= htmlspecialchars($full_name); ?>" readonly style="background: #f5f5f5; color: #888;">
                        </div>
                    </div>

                    <hr style="border: 0; border-top: 1px solid #eee; margin: 10px 0 25px 0;">

                    <div class="form-group">
                        <label>ชื่อสถานประกอบการ <span style="color:red;">*</span></label>
                        <input type="text" name="company_name" required placeholder="เช่น บริษัท เอบีซี จำกัด">
                    </div>

                    <div class="form-group">
                        <label>ที่อยู่สถานประกอบการ <span style="color:red;">*</span></label>
                        <textarea name="company_address" required rows="3" placeholder="บ้านเลขที่, ถนน, แขวง/ตำบล, เขต/อำเภอ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>ชื่อผู้ติดต่อ / พี่เลี้ยง <span style="color:red;">*</span></label>
                        <input type="text" name="contact_person" required placeholder="ชื่อ-นามสกุล (แนะนำให้ระบุเบอร์โทรศัพท์)">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label>วันที่เริ่มต้น <span style="color:red;">*</span></label>
                            <input type="date" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label>วันที่สิ้นสุด <span style="color:red;">*</span></label>
                            <input type="date" name="end_date" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">ส่งข้อมูลคำขอ</button>
                    
                    <div style="text-align: center;">
                        <a href="student_dashboard.php" class="btn-secondary">ยกเลิกและกลับหน้าหลัก</a>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>