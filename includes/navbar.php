<?php
$current_page = basename($_SERVER['PHP_SELF']);
$std_pages = ['std1.php', 'std2.php', 'std3.php', 'std4.php']; 
$base_url = "/internship_project/"; 
?>

<nav class="navbar">
    <div class="nav-container">
        <a href="<?php echo $base_url; ?>index.php" class="nav-logo">Information Studies | SWU</a>
        
        <ul class="nav-menu">
            <li><a href="<?php echo $base_url; ?>index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">หน้าแรก</a></li>
            <li><a href="<?php echo $base_url; ?>showcase.php" class="<?php echo ($current_page == 'showcase.php') ? 'active' : ''; ?>">Showcase</a></li>
            
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn <?php echo (in_array($current_page, $std_pages)) ? 'active' : ''; ?>">ข้อมูลนิสิต</a>
                <div class="dropdown-content">
                    <a href="<?php echo $base_url; ?>std1.php">นิสิตชั้นปีที่ 1</a>
                    <a href="<?php echo $base_url; ?>std2.php">นิสิตชั้นปีที่ 2</a>
                    <a href="<?php echo $base_url; ?>std3.php">นิสิตชั้นปีที่ 3</a>
                    <a href="<?php echo $base_url; ?>std4.php">นิสิตชั้นปีที่ 4</a>
                </div>
            </li>
            
            <li><a href="<?php echo $base_url; ?>teach.php" class="<?php echo ($current_page == 'teach.php') ? 'active' : ''; ?>">ข้อมูลอาจารย์</a></li>

            <?php if(isset($_SESSION['user_id'])): ?>
                <?php 
                    $role = $_SESSION['role']; 
                    $dash_link = ($role == 'admin') ? $base_url."admin/admin_dashboard.php" : (($role == 'teacher') ? $base_url."teacher/teacher_dashboard.php" : $base_url."student/student_dashboard.php");
                ?>
                <li class="user-display">
                    <a href="<?php echo $dash_link; ?>" class="user-name active">
                        <i class="fa fa-user-circle"></i> <?php echo $_SESSION['name'];?>
                    </a>
                </li>
                <li><a href="<?php echo $base_url; ?>logout.php">ออกจากระบบ</a></li>
            <?php else: ?>
                <li><a href="<?php echo $base_url; ?>login.php">เข้าสู่ระบบ</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>