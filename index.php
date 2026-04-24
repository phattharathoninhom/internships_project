<?php session_start(); ?> <!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประชาสัมพันธ์ - SWU Internship</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <?php include 'includes/navbar.php'; ?>

    <div class="main-content">
        <div class="container">
            
            <div class="page-header">
                <h2>ข่าวประชาสัมพันธ์</h2>
                <p>รวมประกาศ กิจกรรม และข้อมูลสำคัญสำหรับการฝึกงานนิสิต มศว</p>
            </div>

            <div class="news-grid">
                <div class="news-card featured">
                    <div class="news-image">
                        <div class="news-badge">ข่าวเด่น</div>
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1000&auto=format&fit=crop" alt="Featured News">
                    </div>
                    <div class="news-detail">
                        <span class="news-category">กิจกรรม</span>
                        <span class="news-date">8 เมษายน 2569</span>
                        <h3>SWU Internship Fair 2026: เปิดโลกอุตสาหกรรมสู่นิสิตสายอาชีพ</h3>
                        <p>เตรียมพบกับบริษัทชั้นนำกว่า 50 แห่ง ที่จะมารับสมัครนิสิตฝึกงานโดยตรง ณ อาคารนวัตกรรม ศาสตราจารย์ ดร.สาโรช บัวศรี ในวันศุกร์นี้...</p>
                        <a href="#" class="read-more">อ่านรายละเอียดเพิ่มเติม</a>
                    </div>
                </div>
            </div>

            <div class="news-row">
                <div class="news-card">
                    <div class="news-image">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=600&auto=format&fit=crop" alt="News">
                    </div>
                    <div class="news-detail">
                        <span class="news-category">ประกาศ</span>
                        <span class="news-date">5 เมษายน 2569</span>
                        <h3>ขยายเวลาส่งเล่มรายงานการฝึกงาน ภาคการศึกษา 2/2568</h3>
                        <p>ฝ่ายวิชาการแจ้งขยายเวลาให้นิสิตส่งเล่มรายงานการฝึกงานได้จนถึงวันที่ 20 เมษายนนี้ผ่านระบบออนไลน์...</p>
                        <a href="#" class="read-more">อ่านต่อ</a>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">
                        <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?q=80&w=600&auto=format&fit=crop" alt="News">
                    </div>
                    <div class="news-detail">
                        <span class="news-category">ข่าวสาร</span>
                        <span class="news-date">3 เมษายน 2569</span>
                        <h3>คู่มือการใช้ระบบจัดการฝึกงานฉบับปรับปรุงใหม่สำหรับนิสิต</h3>
                        <p>ดาวน์โหลดคู่มือการใช้งานระบบใหม่ เพื่อความสะดวกในการบันทึกไดอารี่การฝึกงานรายวัน...</p>
                        <a href="#" class="read-more">อ่านต่อ</a>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">
                        <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=600&auto=format&fit=crop" alt="News">
                    </div>
                    <div class="news-detail">
                        <span class="news-category">สิทธิประโยชน์</span>
                        <span class="news-date">1 เมษายน 2569</span>
                        <h3>เปิดรับสมัครทุนสนับสนุนการฝึกงานในต่างประเทศปี 2569</h3>
                        <p>สำหรับนิสิตที่ผ่านการคัดเลือกเข้าฝึกงานกับองค์กรพันธมิตรในอาเซียน สามารถขอรับทุนสนับสนุนการเดินทางได้แล้ววันนี้...</p>
                        <a href="#" class="read-more">อ่านต่อ</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>