<?php session_start(); ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลอาจารย์ - SWU Internship</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/teach.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="main-container">
        <div class="page-header">
            <h2>รายชื่ออาจารย์ที่ปรึกษา</h2>
            <p>ข้อมูลคณาจารย์ผู้ดูแลและประสานงานโครงการฝึกงาน</p>
        </div>

        <div class="teacher-grid">
            <div class="teacher-card top-red">
                <div class="avatar-wrapper">
                    <img src="https://is.hu.swu.ac.th/wp-content/uploads/2021/01/Dit-scaled.jpg" alt="อ.ดร.ดิษฐ์">
                </div>
                <h3 class="t-name">อ.ดร.ดิษฐ์ สุทธิวงศ์</h3>
                <p class="t-pos">ประธานหลักสูตร</p>
                <div class="t-divider"></div>
                <div class="t-contact">
                    <p><i class="fas fa-phone-alt"></i> 02-649-5000 ต่อ 16508</p>
                    <p><i class="fas fa-envelope"></i> dit@g.swu.ac.th</p>
                </div>
            </div>

            <div class="teacher-card">
                <div class="avatar-wrapper">
                    <img src="https://is.hu.swu.ac.th/wp-content/uploads/2021/01/thiti-scaled.jpg" alt="อ.ดร.ฐิติ">
                </div>
                <h3 class="t-name">อ.ดร.ฐิติ อติชาติชยากร</h3>
                <p class="t-pos">เลขานุการประจำหลักสูตร</p>
                <div class="t-divider"></div>
                <div class="t-contact">
                    <p><i class="fas fa-phone-alt"></i> 02-649-5000 ต่อ 16087</p>
                    <p><i class="fas fa-envelope"></i> thitik@g.swu.ac.th</p>
                </div>
            </div>

            <div class="teacher-card">
                <div class="avatar-wrapper">
                    <img src="https://is.hu.swu.ac.th/wp-content/uploads/2020/02/Vipakorn-683x1024.jpg" alt="ผศ.ดร.วิภากร">
                </div>
                <h3 class="t-name">ผศ.ดร.วิภากร วัฒนสินธุ์</h3>
                <p class="t-pos">อาจารย์ประจำหลักสูตร</p>
                <div class="t-divider"></div>
                <div class="t-contact">
                    <p><i class="fas fa-phone-alt"></i> 02-649-5000 ต่อ 16508</p>
                    <p><i class="fas fa-envelope"></i> vipakorn@g.swu.ac.th</p>
                </div>
            </div>

            <div class="teacher-card">
                <div class="avatar-wrapper">
                    <img src="https://is.hu.swu.ac.th/wp-content/uploads/2025/11/Chotima.jpg" alt="อ.โชติมา">
                </div>
                <h3 class="t-name">อ.โชติมา วัฒนะ</h3>
                <p class="t-pos">อาจารย์ประจำหลักสูตร</p>
                <div class="t-divider"></div>
                <div class="t-contact">
                    <p><i class="fas fa-phone-alt"></i> 02-649-5000 ต่อ 16508</p>
                    <p><i class="fas fa-envelope"></i> chotimaw@g.swu.ac.th</p>
                </div>
            </div>

            <div class="teacher-card">
                <div class="avatar-wrapper">
                    <img src="https://is.hu.swu.ac.th/wp-content/uploads/2025/02/Chokthamrong.jpg" alt="อ.ดร.โชคธำรงค์">
                </div>
                <h3 class="t-name">อ.ดร.โชคธำรงค์ จงจอหอ</h3>
                <p class="t-pos">อาจารย์ประจำหลักสูตร</p>
                <div class="t-divider"></div>
                <div class="t-contact">
                    <p><i class="fas fa-phone-alt"></i> 02-649-5000 ต่อ 16508</p>
                    <p><i class="fas fa-envelope"></i> chokthamrong@g.swu.ac.th</p>
                </div>
            </div>

            <div class="teacher-card">
                <div class="avatar-wrapper">
                    <img src="https://is.hu.swu.ac.th/wp-content/uploads/2020/02/Dussadee-683x1024.jpg" alt="ผศ.ดร.ดุษฎี">
                </div>
                <h3 class="t-name">ผศ.ดร.ดุษฎี สีวังคำ</h3>
                <p class="t-pos">อาจารย์ประจำหลักสูตร</p>
                <div class="t-divider"></div>
                <div class="t-contact">
                    <p><i class="fas fa-phone-alt"></i> 02-649-5000 ต่อ 16508</p>
                    <p><i class="fas fa-envelope"></i> dussadee@g.swu.ac.th</p>
                </div>
            </div>

            <div class="teacher-card">
                <div class="avatar-wrapper">
                    <img src="https://is.hu.swu.ac.th/wp-content/uploads/2020/02/Sasipimol-683x1024.jpg" alt="ผศ.ดร.ศศิพิมล ประพินพงศกร">
                </div>
                <h3 class="t-name">ผศ.ดร.ศศิพิมล ประพินพงศกร</h3>
                <p class="t-pos">อาจารย์ประจำหลักสูตร</p>
                <div class="t-divider"></div>
                <div class="t-contact">
                    <p><i class="fas fa-phone-alt"></i> 02-649-5000 ต่อ 16508</p>
                    <p><i class="fas fa-envelope"></i>sasipimol@g.swu.ac.th</p>
                </div>
            </div>

            <div class="teacher-card">
                <div class="avatar-wrapper">
                    <img src="https://is.hu.swu.ac.th/wp-content/uploads/2020/02/Sumattra-683x1024.jpg" alt="อาจารย์ ดร. ศุมรรษตรา แสนวา">
                </div>
                <h3 class="t-name">อาจารย์ ดร. ศุมรรษตรา แสนวา</h3>
                <p class="t-pos">อาจารย์ประจำหลักสูตร</p>
                <div class="t-divider"></div>
                <div class="t-contact">
                    <p><i class="fas fa-phone-alt"></i> 02-649-5000 ต่อ 16508</p>
                    <p><i class="fas fa-envelope"></i>sumattra@g.swu.ac.th</p>
                </div>
            </div>

        </div> </div> </body>
</html>