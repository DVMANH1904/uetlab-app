@extends('layouts.app')
@section('title', 'Giới thiệu')
@section('content')
<div class="overview-box">
    <div class="path">
        <a href="">GIỚI THIỆU</a>
        <div>></div>
        <a href="">TỔNG QUAN</a>
    </div>
    <div class="overview-title">
        <h1>Phòng thí nghiệm Tương tác Người–Máy (HMI Lab)</h1>
        {{-- <h2>Tổng quan</h2> --}}
    </div>
    <div class="overview-main">
        <div class="overview-img">
            <img src="https://www.fit.uet.vnu.edu.vn/wp-content/uploads/2019/12/HMI_05.png" alt="HMI Lab" />
        </div>
        <div class="overview-desc">
            <p>
                Phòng thí nghiệm Tương tác Người–Máy (HMI Lab), trực thuộc Khoa Công nghệ Thông tin, Trường Đại học Công nghệ – ĐHQGHN, thành lập từ năm 2008. HMI Lab tập trung nghiên cứu các lĩnh vực: tương tác người–máy, xử lý ngôn ngữ tự nhiên, xử lý ảnh/video, đồ họa máy tính, thị giác máy, ảnh viễn thám, và phân tích dữ liệu không gian–thời gian.
            </p>
            <p>
                Nhiệm vụ chính của phòng là nghiên cứu, ứng dụng, đào tạo đại học và sau đại học; đồng thời hỗ trợ chiến lược giáo dục phân luồng, chất lượng cao và chuẩn quốc tế. Đội ngũ cán bộ gồm các Phó Giáo sư, Tiến sĩ, Thạc sĩ và kỹ sư có trình độ cao, nhiều người từng tu nghiệp tại nước ngoài.
            </p>
        </div>
    </div>

    {{-- Thêm phần cán bộ nghiên cứu --}}
    <div class="overview-researchers" style="max-width:900px;margin:40px auto 0;display:flex;gap:32px;align-items:flex-start;">
        <div class="overview-desc" style="margin:0;flex:1;">
            <h3 style="color:#253b80;">Cán bộ nghiên cứu</h3>
            <ul>
                <li>PGS.TS. Lê Thanh Hà – Trưởng phòng</li>
                <li>PGS.TS. Phạm Bảo Sơn – Phó trưởng phòng</li>
                <li>PGS.TS. Nguyễn Thị Nhật Thanh</li>
                <li>TS. Ma Thị Châu</li>
                <li>TS. Ngô Thị Duyên</li>
                <li>TS. Tạ Việt Cường</li>
                <li>ThS. Phạm Tuấn Dũng</li>
                <li>ThS. Kiều Hải Đăng</li>
                <li>ThS. Lê Công Thương</li>
                <li>ThS. Hoàng Thị Linh</li>
            </ul>
        </div>
        <div class="overview-researchers-img">
            <img src="https://www.fit.uet.vnu.edu.vn/wp-content/uploads/2019/12/HMI_04.png" alt="Nhóm cán bộ HMI Lab" style="width:400px;height:auto;object-fit:cover;max-width:100%;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.08);" />
        </div>
    </div>
    <div class="overview-desc" style="max-width:900px;margin:40px auto 0;">
        <h3 style="color:#253b80;">Mảng nghiên cứu chính</h3>
        <ul>
            <li>Xử lý ngôn ngữ tự nhiên (Natural Language Processing)</li>
            <li>Đồ họa máy tính (Computer Graphics)</li>
            <li>Xử lý ảnh/video &amp; thị giác máy (Image/Video Processing &amp; Machine Vision)</li>
            <li>Xử lý ảnh viễn thám (Remote Sensing Image Processing)</li>
            <li>Phân tích dữ liệu không gian–thời gian (Spatio‑temporal Data Analysis)</li>
        </ul>
        <h3 style="color:#253b80;">Hoạt động &amp; Đóng góp</h3>
        <ul>
            <li>Tham gia tổ chức đào tạo học thuật tiên tiến, chương trình cao học và nghiên cứu sinh.</li>
            <li>Tích cực triển khai các seminar, hội thảo chuyên đề (ví dụ: seminar “Advances in Robotics” tổ chức cùng FuRo – Viện Công nghệ Chiba, Nhật Bản)</li>
            <li>Nghiên cứu và công bố chất lượng quốc tế (Neurocomputing, IJCAI, AAAI, EMNLP…) như Mi‑CGA: Cross‑modal Graph Attention Network phát hiện cảm xúc đa phương thức</li>
        </ul>
    </div>
    <div class="overview-stats">
        <div class="stat-item">
            <div class="stat-number">2008</div>
            <div class="stat-label">Năm thành lập</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">~2 / 4–5 / ~2</div>
            <div class="stat-label">PGS / TS / ThS</div>
        </div>

        <div class="stat-item">
            <div class="stat-number">7+</div>
            <div class="stat-label">Mảng nghiên cứu</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">5–10%</div>
            <div class="stat-label">Công bố quốc tế top ngành</div>
        </div>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4262.075264325052!2d105.7801040757113!3d21.038243387451953!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab354920c233%3A0x5d0313a3bfdc4f37!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4csIMSQ4bqhaSBo4buNYyBRdeG7kWMgZ2lhIEjDoCBO4buZaQ!5e1!3m2!1svi!2s!4v1749107757745!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

</div>
{{-- style --}}
<style>
    .overview-box {
        background: #fff;
        padding: 30px 0;
        position: absolute;
        top: 140px;
        width: 100%;
    }
    .path , .title {
        width: 100%;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        font-weight: bold;
        font-size: 1.3rem;
    }
    .path div, .title {
        margin: 0 10px;
        color: #253b80;
    }
    .path a {
        text-decoration: none;
        padding: 0 10px;
        color: #253b80;
    }
    .overview-title {
        text-align: center;
        margin: 30px 0 10px 0;
    }
    .overview-title h1 {
        font-size: 1.8rem;
        color: #253b80;
        margin-bottom: 10px;
    }
    .overview-title h2 {
        font-size: 1.3rem;
        color: #666;
        font-weight: 400;
    }
    .overview-main {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: center;
        margin: 30px 0;
        gap: 40px;
    }
    .overview-img img {
        width: 350px;
        max-width: 100%;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .overview-desc {
        max-width: 500px;
        font-size: 1.1rem;
        color: #222;
        line-height: 1.7;
        text-align: justify;

    }
    .overview-desc h3 {
        margin-bottom: 0;
    }
    .overview-desc ul li {
        color: #222;
        text-align: justify;
        justify-content: left;
    }
    .overview-desc ul {
        margin-top: 5px;
    }
    .overview-stats {
        display: flex;
        justify-content: center;

        gap: 40px;
        margin: 40px 0 20px 0;
        flex-wrap: wrap;
    }
    .stat-item {
        background: #f5f8fa;
        border-radius: 10px;
        padding: 30px 40px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        min-width: 160px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .stat-number {
        font-size: 2rem;
        color: #253b80;
        font-weight: bold;
        margin-bottom: 8px;
    }
    .stat-label {
        font-size: 1.1rem;
        color: #444;
    }
    @media (max-width: 900px) {
        .overview-main {
            flex-direction: column;
            align-items: center;
        }
        .overview-img, .overview-desc {
            max-width: 100%;
        }
        .overview-stats {
            gap: 20px;
        }
        .stat-item {
            padding: 20px 15px;
            min-width: 120px;
        }
        .overview-researchers-img {
            display: none;
        }
    }
</style>
@endsection
