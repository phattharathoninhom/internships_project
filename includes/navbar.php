<nav class="navbar">
    <div class="nav-container">
        <a href="/internship_project/index.php" class="nav-logo">Information Studies | SWU</a>
        
        <ul class="nav-menu">
            <li><a href="/internship_project/index.php">หน้าแรก</a></li>
            <li><a href="/internship_project/showcase.php">Showcase</a></li>
            
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">ข้อมูลนิสิต</a>
                <div class="dropdown-content">
                    <a href="/internship_project/std1.php">นิสิตชั้นปีที่ 1</a>
                    <a href="/internship_project/std2.php">นิสิตชั้นปีที่ 2</a>
                    <a href="/internship_project/std3.php">นิสิตชั้นปีที่ 3</a>
                    <a href="/internship_project/std4.php">นิสิตชั้นปีที่ 4</a>
                </div>
            </li>
            
            <li><a href="/internship_project/teach.php">ข้อมูลอาจารย์</a></li>

            <?php if(isset($_SESSION['user_id'])): ?>
                <?php 
                    // เช็คสิทธิ์เพื่อส่งไปหน้า Dashboard ที่ถูกต้อง
                    $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'student'; 
                    
                    if ($role == 'admin') {
                        $dash_link = "/internship_project/admin/admin_dashboard.php";
                    } elseif ($role == 'teacher') {
                        $dash_link = "/internship_project/teacher/teacher_dashboard.php";
                    } else {
                        $dash_link = "/internship_project/student/student_dashboard.php";
                    }
                ?>
                <li class="user-display">
                    <a href="<?php echo $dash_link; ?>" style="text-decoration: none; color: #0e0e0e; font-weight: bold;">
                        <i class="fa fa-user-circle"></i> <?php echo $_SESSION['name'];?>
                    </a>
                </li>
                <li><a href="/internship_project/logout.php" class="login-link logout-style">ออกจากระบบ</a></li>
            <?php else: ?>
                <li><a href="/internship_project/login.php" class="login-link">เข้าสู่ระบบ</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>