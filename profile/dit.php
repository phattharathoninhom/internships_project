<?php session_start(); ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติอาจารย์ - นาย ดิษฐ์ สุทธิวงศ์</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <?php include ('../includes/navbar.php'); ?>

    <div class="main-content">
        <div class="container">
            <div class="profile-card">
                
                <div class="profile-header">
                    <div class="profile-img-box">
                        <img src="https://is.hu.swu.ac.th/wp-content/uploads/2021/01/Dit-scaled.jpg" alt="อ.ดร.ดิษฐ์">
                    </div>
                    <div class="profile-title">
                        <h1>อ.ดร.ดิษฐ์ สุทธิวงศ์</h1>
                        <p class="en-name">DIT SUTHIWONG</p>
                        <p class="tag">ประธานหลักสูตร</p>
                    </div>
                </div>

                <div class="profile-grid">
                    <div class="profile-sidebar">
                        <div class="info-box">
                            <h3><i class="fas fa-address-card"></i> ข้อมูลส่วนตัว</h3>
                            <p><strong>ตำแหน่งวิชาการ:</strong> อาจารย์</p>
                            <p><strong>ที่ทำงาน:</strong>ห้อง 236 อาคาร 2 คณะมนุษยศาสตร์ มหาวิทยาลัยศรีนครินทรวิโรฒ</p>
                            <p><strong>เบอร์โทรศัพท์:</strong> 02-649-5000 ต่อ 16508</p>
                            <p><strong>Email:</strong> dit@g.swu.ac.th</p>
                        </div>
                    </div>

                    <div class="profile-main">
                        <div class="section">
                            <h3><i class="fas fa-graduation-cap"></i> คุณวุฒิการศึกษา</h3>
                            <table class="edu-table">
                                <thead>
                                    <tr>
                                        <th>วุฒิ</th>
                                        <th>สาขาวิชา</th>
                                        <th>สถาบัน</th>
                                        <th>ปีที่สำเร็จการศึกษา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>วท.บ.</td>
                                        <td>ศาสตร์คอมพิวเตอร์</td>
                                        <td>มหาวิทยาลัยธรรมศาสตร์</td>
                                        <td>2538</td>
                                    </tr>
                                    <tr>
                                        <td>วท.ม.</td>
                                        <td>การจัดการเทคโนโลยีสารสนเทศ</td>
                                        <td>มหาวิทยาลัยหอการค้าไทย</td>
                                        <td>2542</td>
                                    </tr>
                                    <tr>
                                        <td>Ph.D.</td>
                                        <td>Information Technology</td>
                                        <td>มหาวิทยาลัยพระจอมเกล้าพระนครเหนือ</td>
                                        <td>2562</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="section">
                            <h3><i class="fas fa-star"></i> ความเชี่ยวชาญ</h3>
                            <ul class="skill-list">
                                <li>ประสบการณ์ด้าน Project Management Skill สิบปีในธุรกิจ Banking/Finance/Insurance</li>
                                <li>บริหารจัดการเทคโนโลยีสารสนเทศ ธุรกิจ Media Broadcast</li>
                                <li>บริหารจัดการ IT Infrastructure ด้วย ITIL Standard</li>
                            </ul>
                        </div>

                        <div class="section">
                            <h3><i class="fas fa-book"></i> ผลงานทางวิชาการ</h3>
                            <div class="work-item">
                                <strong>บทความวิจัยตีพิมพ์ในวารสาร (สกอ.)</strong>
                                <p>Suthiwong, D, et. al. (2019). An improved quick Artificial Bee Colony Algorithm for Portfolio Selection... Vol. 18, No. 01.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile-footer">
                    <a href="../teach.php" class="btn-back"><i class="fas fa-arrow-left"></i> กลับหน้ารายชื่ออาจารย์</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>