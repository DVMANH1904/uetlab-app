<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <link rel="stylesheet" href="../../css/style.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Đại học Công Nghệ')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/logo.ico') }}">
</head>
<body>
    <div class="layout-box">
        <div class="menu-2" id="menu-0">
            <div class="logo">
                <img src="{{ asset('image/logo.png') }}" alt="logo" title="logo UET" sizes="60px" width="60px" height="60px">
                <div class="text-site">
                    <h1>ĐẠI HỌC CÔNG NGHỆ</h1>
                    <p>PHÒNG THÍ NGHIỆM TƯƠNG TÁC NGƯỜI MÁY</p>
                </div>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="">Tuyển dụng</a></li>
                    <li><a href="https://courses.uet.vnu.edu.vn/?redirect=0" target="_blank">Email</a></li>
                    <li><a href="{{ route('calendar') }}">Lịch công tác</a></li>
                    <li><a href="">Phòng thí nghiệm</a></li>
                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                    <li><a href=""><ion-icon name="search-outline"></ion-icon></a></li>
                </ul>
            </div>
        </div>
        <div class="menu-icon" onclick="toggleMenu()">☰</div>
    </div>

    <div class="gradient-fix">
        <div class="wraper">
            <ul class="menu-2" id="menu-1">
                <li>
                    <a href="">GIỚI THIỆU</a>
                    <div class="tooltip">
                        <ul>
                            <li><a href="{{ route('introduces') }}">Tổng quan</a></li>
                            <li><a href="{{ route('media') }}">Media</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="">TIN TỨC</a>
                    <div class="tooltip">
                        <ul>
                            <li><a href="">Hoạt động chung</a></li>
                            <li><a href="">Tuyển sinh - Đào tạo</a></li>
                            <li><a href="">Hợp tác - Đối ngoại - Truyền thông</a></li>
                            <li><a href="">Nghiên cứu khoa học</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="">SỰ KIỆN NỔI BẬT</a>
                    <div class="tooltip">
                        <ul>
                            <li><a href="">Thông báo chung</a></li>
                            <li><a href="">Tuyển sinh - Đào tạo</a></li>
                            <li><a href="">Hợp tác - Đối ngoại - Truyền thông</a></li>
                            <li><a href="">Sự kiện sắp diễn ra</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="">TUYỂN SINH</a>
                    <div class="tooltip">
                        <ul>
                            <li><a href="">Thông báo tuyển sinh</a></li>
                            <li><a href="">Thực tập sinh</a></li>
                            <li><a href="">Nghiên cứu sinh</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="">SINH VIÊN</a>
                    <div class="tooltip">
                        <ul>
                            <li><a href="">Thời khóa biểu</a></li>
                            <li><a href="">Lịch thi</a></li>
                            <li><a href="">Đào tạo</a></li>
                            <li><a href="">Học bổng</a></li>
                            <li><a href="">Câu lạc bộ</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="">NGHIÊN CỨU SINH</a>
                    <div class="tooltip">
                        <ul>
                            <li><a href="">Thông báo</a></li>
                            <li><a href="">Hướng dẫn</a></li>
                            <li><a href="">Đề tài nghiên cứu</a></li>
                        </ul>
                </li>
                <li><a href="{{ asset('Login/index.php') }}">eUET</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        function toggleMenu() {
            document.getElementById('menu-1').classList.toggle('show');
        }
    </script>
</body>
</html>
