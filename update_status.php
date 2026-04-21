<?php
session_start();
require_once 'connect.php';

// แก้ตรงนี้: เช็คว่าต้อง login แล้ว และเป็น admin "หรือ" teacher ก็ได้
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['role']) && 
   ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'teacher')) {
    
    $request_id = $_POST['request_id'];
    $new_status = $_POST['new_status'];

    if (!empty($new_status)) {
        // ใช้ Prepared Statement เพื่อความปลอดภัย
        $stmt = $conn->prepare("UPDATE internship_request SET status_code = ? WHERE request_id = ?");
        $stmt->bind_param("ii", $new_status, $request_id);
        
        if ($stmt->execute()) {
            // เมื่ออัปเดตเสร็จ ให้ดีดกลับไปหน้า Dashboard ของตัวเอง
            if ($_SESSION['role'] === 'admin') {
                echo "<script>alert('อัปเดตสำเร็จ'); window.location.href='admin_dashboard.php';</script>";
            } else {
                echo "<script>alert('อัปเดตสำเร็จ'); window.location.href='teacher_dashboard.php';</script>";
            }
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    header("Location: index.html");
    exit();
}
?>