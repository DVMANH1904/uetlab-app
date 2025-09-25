<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMI Lab - Định Hình Tương Lai Tương Tác Người-Máy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
        #hero-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }

        /* Preloader Styles */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #0c1a3e;
            z-index: 10000;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease-out;
        }
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid rgba(14, 165, 233, 0.3);
            border-top: 5px solid #0ea5e9;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Header Scroll Effect */
        #header.scrolled {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }
        #header.scrolled .nav-link, #header.scrolled .logo-text, #header.scrolled .mobile-btn {
            color: #4b5563; /* text-gray-600 */
        }
         #header.scrolled .nav-link:hover, #header.scrolled .mobile-btn:hover {
             color: #0ea5e9; /* text-sky-600 */
         }

        /* Active Nav Link Style */
        .nav-link.active {
            color: #0ea5e9 !important;
            font-weight: 600;
        }
        
        /* Dropdown Menu */
        .dropdown {
            position: relative;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.1);
            z-index: 1;
            border-radius: 0.5rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .dropdown:hover .dropdown-content {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
        .dropdown-link {
            color: #4b5563;
            padding: 0.75rem 1.25rem;
            text-decoration: none;
            display: block;
        }
        .dropdown-link:hover {
            background-color: #f3f4f6;
            color: #0ea5e9;
        }

        /* Scroll Animation */
        .animated-element {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .animated-element.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Back to top button */
        #back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            background-color: #0ea5e9;
            color: white;
            padding: 0.75rem;
            border-radius: 9999px;
            box-shadow: 0 4px 14px 0 rgba(14, 165, 233, 0.39);
            transition: opacity 0.3s, transform 0.3s;
            opacity: 0;
            transform: translateY(100px);
        }
         #back-to-top.show {
             display: block;
             opacity: 1;
             transform: translateY(0);
         }
    </style>
</head>
<body class="bg-slate-50 text-gray-800">
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Header -->
    <header id="header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center space-x-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-brain-circuit"><path d="M12 5a3 3 0 1 0-5.993.142"/><path d="M18 5a3 3 0 1 0-5.993.142"/><path d="M5 8.142A3 3 0 1 0 5 14"/><path d="M19 8.142A3 3 0 1 0 19 14"/><path d="M12 13a3 3 0 1 0-5.993.142"/><path d="M18 13a3 3 0 1 0-5.993.142"/><path d="M5 19a3 3 0 1 0 0-5.858"/><path d="M19 19a3 3 0 1 0 0-5.858"/><path d="M12 1a3 3 0 1 0 0 6"/><path d="M12 9a3 3 0 1 0 0 6"/><path d="M12 17a3 3 0 1 0 0 6"/></svg>
                        <span class="font-bold text-2xl text-sky-600 logo-text">HMI Lab</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex md:items-center md:space-x-4 lg:space-x-6 text-white">
                    <a href="#about" class="nav-link font-medium transition-colors" data-target="about">Giới thiệu</a>
                    <div class="dropdown">
                        <a href="#research" class="nav-link font-medium transition-colors flex items-center" data-target="research">
                            Nghiên cứu <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                        </a>
                        <div class="dropdown-content">
                            <a href="#" class="dropdown-link">Thực tế ảo & Tăng cường</a>
                            <a href="#" class="dropdown-link">AI Sáng tạo & Ngôn ngữ</a>
                            <a href="#" class="dropdown-link">Giao diện Não-Máy (BCI)</a>
                        </div>
                    </div>
                    <a href="#team" class="nav-link font-medium transition-colors" data-target="team">Đội ngũ</a>
                    <a href="#publications" class="nav-link font-medium transition-colors" data-target="publications">Công bố</a>
                    <!-- <a href="#" class="nav-link font-medium transition-colors">Cơ hội</a> -->
                    <div class="dropdown">
                        <a href="#" class="nav-link font-medium transition-colors flex items-center">
                            Thêm <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                        </a>
                        <div class="dropdown-content">
                            <a href="{{ route('contact') }}" class="dropdown-link">Liên hệ</a>
                            <a href="{{ route('hci-lab') }}" class="dropdown-link">Blog</a>
                            <a href="{{ route('hci-lab') }}" class="dropdown-link">Về chúng tôi</a>
                        </div>
                    </div>
                </nav>

                <div class="flex items-center space-x-4">
                     <a href="{{ route('login') }}" class="hidden sm:inline-block bg-sky-600 text-white font-semibold px-5 py-3 rounded-lg hover:bg-sky-700 transition-all duration-300 shadow-lg shadow-sky-500/20">
                        Đăng nhập
                    </a>
                    <!-- Mobile Menu Button -->
                    <div class="md:hidden">
                        <button id="mobile-menu-button" class="text-white mobile-btn">
                            <i data-lucide="menu" class="w-7 h-7"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-lg">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t border-gray-200">
                <a href="#about" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-sky-600 hover:bg-gray-50">Giới thiệu</a>
                <a href="#research" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-sky-600 hover:bg-gray-50">Nghiên cứu</a>
                <a href="#team" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-sky-600 hover:bg-gray-50">Đội ngũ</a>
                <a href="#publications" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-sky-600 hover:bg-gray-50">Công bố</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-sky-600 hover:bg-gray-50">Cơ hội</a>
                <a href="{{ route('contact') }}"  class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-sky-600 hover:bg-gray-50">Liên hệ</a>
                <a href="{{ route('login') }}" class="block w-full text-left mt-4 bg-sky-600 text-white font-semibold px-4 py-3 rounded-lg hover:bg-sky-700 transition-colors">
                    Đăng nhập
                </a>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section id="home" class="bg-[#0c1a3e] pt-32 pb-20 md:pt-48 md:pb-32 relative overflow-hidden">
            <canvas id="hero-canvas"></canvas>
            <div class="hero-content max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight tracking-tight animated-element">
                    Phòng Thí Nghiệm <span class="text-sky-400">Tương Tác Người-Máy</span>
                </h1>
                <p class="mt-6 max-w-3xl mx-auto text-lg md:text-xl text-gray-300 animated-element" style="transition-delay: 150ms;">
                    Chúng tôi nghiên cứu, thiết kế và phát triển những công nghệ đột phá, giúp sự tương tác giữa con người và máy móc trở nên tự nhiên, hiệu quả và ý nghĩa hơn.
                </p>
                <div class="mt-10 animated-element" style="transition-delay: 300ms;">
                    <a href="#research" class="bg-sky-600 text-white font-semibold px-8 py-4 rounded-lg hover:bg-sky-700 transition-all duration-300 transform hover:scale-105 shadow-2xl shadow-sky-500/30">
                        Khám phá nghiên cứu
                    </a>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section id="about" class="py-16 bg-white section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="animated-element">
                        <p class="text-4xl lg:text-5xl font-bold text-sky-600">10+</p>
                        <p class="mt-2 text-sm lg:text-base font-medium text-gray-500">Năm hoạt động</p>
                    </div>
                    <div class="animated-element" style="transition-delay: 100ms;">
                        <p class="text-4xl lg:text-5xl font-bold text-sky-600">50+</p>
                        <p class="mt-2 text-sm lg:text-base font-medium text-gray-500">Dự án đã thực hiện</p>
                    </div>
                    <div class="animated-element" style="transition-delay: 200ms;">
                        <p class="text-4xl lg:text-5xl font-bold text-sky-600">20+</p>
                        <p class="mt-2 text-sm lg:text-base font-medium text-gray-500">Nhà nghiên cứu</p>
                    </div>
                    <div class="animated-element" style="transition-delay: 300ms;">
                        <p class="text-4xl lg:text-5xl font-bold text-sky-600">100+</p>
                        <p class="mt-2 text-sm lg:text-base font-medium text-gray-500">Bài báo khoa học</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Research Areas Section -->
        <section id="research" class="py-20 bg-slate-50 section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center animated-element">
                    <h2 class="text-base font-semibold text-sky-600 tracking-wider uppercase">Lĩnh vực nghiên cứu</h2>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                        Các Hướng Nghiên Cứu Tiên Phong
                    </p>
                    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                        Chúng tôi tập trung vào những lĩnh vực cốt lõi định hình tương lai của công nghệ tương tác.
                    </p>
                </div>
                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 flex flex-col items-center text-center animated-element hover:-translate-y-2">
                        <div class="bg-sky-100 p-4 rounded-full">
                            <i data-lucide="glasses" class="w-8 h-8 text-sky-600"></i>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-gray-900">Thực tế ảo & Tăng cường (VR/AR)</h3>
                        <p class="mt-4 text-gray-500">Xây dựng các ứng dụng VR/AR, tạo ra trải nghiệm mới trong giáo dục, y tế và giải trí.</p>
                        <a href="#" class="mt-6 font-semibold text-sky-600 hover:text-sky-700">Tìm hiểu thêm &rarr;</a>
                    </div>
                     <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 flex flex-col items-center text-center animated-element hover:-translate-y-2" style="transition-delay: 150ms;">
                        <div class="bg-sky-100 p-4 rounded-full">
                            <i data-lucide="sparkles" class="w-8 h-8 text-sky-600"></i>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-gray-900">AI Sáng tạo & Ngôn ngữ</h3>
                        <p class="mt-4 text-gray-500">Phát triển các hệ thống AI có khả năng sáng tạo và đối thoại tự nhiên, hỗ trợ con người.</p>
                        <a href="#" class="mt-6 font-semibold text-sky-600 hover:text-sky-700">Tìm hiểu thêm &rarr;</a>
                    </div>
                     <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 flex flex-col items-center text-center animated-element hover:-translate-y-2" style="transition-delay: 300ms;">
                        <div class="bg-sky-100 p-4 rounded-full">
                            <i data-lucide="activity" class="w-8 h-8 text-sky-600"></i>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-gray-900">Giao diện Não-Máy (BCI)</h3>
                        <p class="mt-4 text-gray-500">Nghiên cứu công nghệ điều khiển thiết bị bằng suy nghĩ, mở ra tiềm năng cho y tế và người khuyết tật.</p>
                        <a href="#" class="mt-6 font-semibold text-sky-600 hover:text-sky-700">Tìm hiểu thêm &rarr;</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section id="team" class="py-20 bg-white section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center animated-element">
                    <h2 class="text-base font-semibold text-sky-600 tracking-wider uppercase">Đội ngũ</h2>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                        Các Nhà Nghiên Cứu Tâm Huyết
                    </p>
                    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                       Gặp gỡ những bộ óc tài năng đang dẫn dắt các dự án đột phá tại HMI Lab.
                    </p>
                </div>
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Team Member 1 -->
                    <div class="text-center animated-element">
                        <img class="mx-auto h-40 w-40 rounded-full object-cover" src="{{ asset('storage/image/PGS_TS_PhamBaoSon.jpg') }}" alt="PGS. TS. Phạm Bảo Sơn">
                        <h3 class="mt-6 text-lg font-medium text-gray-900">PGS. TS. Phạm Bảo Sơn</h3>
                        <p class="text-sky-600">Phó giám đốc ĐHQGHN</p>
                    </div>
                    <!-- Team Member 2 -->
                    <div class="text-center animated-element" style="transition-delay: 150ms;">
                        <img class="mx-auto h-40 w-40 rounded-full object-cover" src="{{ asset('storage/image/PGD_TS_LeThanhHa.jpg') }}" alt="PGD. TS. Lê Thanh Hà">
                        <h3 class="mt-6 text-lg font-medium text-gray-900">PGD. TS. Lê Thanh Hà</h3>
                        <p class="text-sky-600">Trưởng phòng</p>
                    </div>
                    <!-- Team Member 3 -->
                    <div class="text-center animated-element" style="transition-delay: 300ms;">
                        <img class="mx-auto h-40 w-40 rounded-full object-cover" src="{{ asset('storage/image/TS_MaThiChau.jpg') }}" alt="TS. Ma Thị Châu">
                        <h3 class="mt-6 text-lg font-medium text-gray-900">TS. Ma Thị Châu</h3>
                        <p class="text-sky-600">Giảng viên</p>
                    </div>
                    <!-- Team Member 4 -->
                    <div class="text-center animated-element" style="transition-delay: 450ms;">
                        <img class="mx-auto h-40 w-40 rounded-full object-cover" src="{{ asset('storage/image/PGS_TSNguyenThiNhatThanh.jpg') }}" alt="PGS.TS. Nguyễn Thị Nhật Thanh">
                        <h3 class="mt-6 text-lg font-medium text-gray-900">PGS.TS. Nguyễn Thị Nhật Thanh</h3>
                        <p class="text-sky-600">Giảng viên</p>
                    </div>
                    <div class="text-center animated-element" style="transition-delay: 450ms;">
                        <img class="mx-auto h-40 w-40 rounded-full object-cover" src="https://placehold.co/400x400/a0aec0/ffffff?text=KS.+D" alt="Engineer D">
                        <h3 class="mt-6 text-lg font-medium text-gray-900">ThS. Ngô Thị Duyên</h3>
                        <p class="text-sky-600">Giảng viên</p>
                    </div>
                    <div class="text-center animated-element" style="transition-delay: 450ms;">
                        <img class="mx-auto h-40 w-40 rounded-full object-cover" src="https://placehold.co/400x400/a0aec0/ffffff?text=KS.+D" alt="Engineer D">
                        <h3 class="mt-6 text-lg font-medium text-gray-900">TS. Nguyễn Duy Khương</h3>
                        <p class="text-sky-600">Giảng viên</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Publications Section -->
        <section id="publications" class="py-20 bg-slate-50 section">
             <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center animated-element">
                    <h2 class="text-base font-semibold text-sky-600 tracking-wider uppercase">Công bố & Tin tức</h2>
                    <p class="mt-2 text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                        Kết quả nghiên cứu mới nhất
                    </p>
                </div>

                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2 animated-element">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="https://placehold.co/600x400/3498db/ffffff?text=Hoi+thao+CHI" alt="">
                        </div>
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-sky-600">
                                    <a href="#" class="hover:underline">Hội thảo quốc tế</a>
                                </p>
                                <a href="#" class="block mt-2">
                                    <p class="text-xl font-semibold text-gray-900">Trình bày về Giao diện người dùng thích ứng tại hội thảo CHI 2025</p>
                                    <p class="mt-3 text-base text-gray-500">Nghiên cứu của chúng tôi về hệ thống UI tự động điều chỉnh theo ngữ cảnh người dùng đã được chấp nhận tại hội thảo đầu ngành về HMI...</p>
                                </a>
                            </div>
                        </div>
                    </div>
                     <div class="flex flex-col rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2 animated-element" style="transition-delay: 150ms;">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="https://placehold.co/600x400/2ecc71/ffffff?text=Du+an+VR" alt="">
                        </div>
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-sky-600">
                                    <a href="#" class="hover:underline">Dự án mới</a>
                                </p>
                                <a href="#" class="block mt-2">
                                    <p class="text-xl font-semibold text-gray-900">Khởi động dự án VR hỗ trợ phục hồi chức năng cho bệnh nhân đột quỵ</p>
                                    <p class="mt-3 text-base text-gray-500">Dự án kết hợp với bệnh viện trung ương nhằm ứng dụng công nghệ thực tế ảo để đẩy nhanh quá trình hồi phục cho bệnh nhân.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                     <div class="flex flex-col rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2 animated-element" style="transition-delay: 300ms;">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover" src="https://placehold.co/600x400/e74c3c/ffffff?text=Bai+bao+IEEE" alt="">
                        </div>
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-sky-600">
                                    <a href="#" class="hover:underline">Bài báo khoa học</a>
                                </p>
                                <a href="#" class="block mt-2">
                                    <p class="text-xl font-semibold text-gray-900">Công bố mô hình AI nhận dạng cảm xúc qua giọng nói</p>
                                    <p class="mt-3 text-base text-gray-500">Bài báo của chúng tôi được xuất bản trên tạp chí IEEE Transactions on Affective Computing, giới thiệu một kiến trúc mới cho...</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-sky-700">
            <div class="max-w-4xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl animated-element">
                    <span class="block">Quan tâm đến việc hợp tác?</span>
                </h2>
                <p class="mt-4 text-lg leading-6 text-sky-100 animated-element">Chúng tôi luôn tìm kiếm các nhà nghiên cứu tài năng và các đối tác cùng chí hướng để định hình tương lai công nghệ.</p>
                <a href="#" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-sky-600 bg-white hover:bg-sky-50 sm:w-auto animated-element">
                    Gửi đề xuất
                </a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8 xl:col-span-1">
                     <a href="#" class="flex items-center space-x-2">
                         <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-brain-circuit"><path d="M12 5a3 3 0 1 0-5.993.142"/><path d="M18 5a3 3 0 1 0-5.993.142"/><path d="M5 8.142A3 3 0 1 0 5 14"/><path d="M19 8.142A3 3 0 1 0 19 14"/><path d="M12 13a3 3 0 1 0-5.993.142"/><path d="M18 13a3 3 0 1 0-5.993.142"/><path d="M5 19a3 3 0 1 0 0-5.858"/><path d="M19 19a3 3 0 1 0 0-5.858"/><path d="M12 1a3 3 0 1 0 0 6"/><path d="M12 9a3 3 0 1 0 0 6"/><path d="M12 17a3 3 0 1 0 0 6"/></svg>
                        <span class="font-bold text-2xl text-sky-500">HMI Lab</span>
                    </a>
                    <p class="text-gray-400 text-base">Phòng Thí Nghiệm Tương Tác Người-Máy<br>Trường Đại học Công nghệ - ĐHQGHN</p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white"><i data-lucide="twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i data-lucide="youtube"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i data-lucide="linkedin"></i></a>
                    </div>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Nghiên cứu</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Dự án</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Công bố</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Thành viên</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                             <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Lab</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Về chúng tôi</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Tin tức</a></li>
                                <li><a href="#" class="text-base text-gray-400 hover:text-white">Cơ hội</a></li>
                            </ul>
                        </div>
                    </div>
                     <div class="md:grid md:grid-cols-1 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-300 tracking-wider uppercase">Liên hệ</h3>
                            <ul class="mt-4 space-y-4 text-base text-gray-400">
                                <li>Địa chỉ: Phòng 307 - Tòa nhà E3, 144 Xuân Thủy, Cầu Giấy, Hà Nội</li>
                                <li>Hotline: (024) 3 754 7064</li>
                                <li>Email: contact@vnu.edu.vn</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-700 pt-8">
                <p class="text-base text-gray-400 xl:text-center">&copy; 2025 HMI Lab. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Back to top button -->
    <a href="#home" id="back-to-top">
        <i data-lucide="arrow-up" class="w-6 h-6"></i>
    </a>


    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Preloader
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        });

        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Header scroll effect
        const header = document.getElementById('header');
        const backToTopButton = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
                backToTopButton.classList.add('show');
            } else {
                header.classList.remove('scrolled');
                backToTopButton.classList.remove('show');
            }
        });
        
        // Scroll Spy for active navigation link
        const sections = document.querySelectorAll('.section');
        const navLinks = document.querySelectorAll('.nav-link');
        const scrollSpyObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.dataset.target === entry.target.id) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }, { rootMargin: "-50% 0px -50% 0px" });

        sections.forEach(section => scrollSpyObserver.observe(section));


        // Scroll Animations
        const animatedElements = document.querySelectorAll('.animated-element');
        const animationObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });
        animatedElements.forEach(el => animationObserver.observe(el));
        
        // Hero Canvas Animation
        const canvas = document.getElementById('hero-canvas');
        const ctx = canvas.getContext('2d');
        let particles = [];
        
        function resizeCanvas() {
            canvas.width = window.innerWidth;
            canvas.height = canvas.parentElement.offsetHeight;
        }

        class Particle {
            constructor(x, y) {
                this.x = x;
                this.y = y;
                this.size = Math.random() * 1.5 + 1;
                this.speedX = Math.random() * 0.4 - 0.2;
                this.speedY = Math.random() * 0.4 - 0.2;
                this.color = 'rgba(14, 165, 233, 0.5)';
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                 if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
            }
            draw() {
                ctx.fillStyle = this.color;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function initParticles() {
            particles = [];
            let numberOfParticles = (canvas.width * canvas.height) / 12000;
            for (let i = 0; i < numberOfParticles; i++) {
                let x = Math.random() * canvas.width;
                let y = Math.random() * canvas.height;
                particles.push(new Particle(x, y));
            }
        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let i = 0; i < particles.length; i++) {
                particles[i].update();
                particles[i].draw();

                for (let j = i; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);

                    if (distance < 120) {
                        ctx.beginPath();
                        ctx.strokeStyle = `rgba(14, 165, 233, ${0.8 - distance / 120})`;
                        ctx.lineWidth = 0.3;
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.stroke();
                    }
                }
            }
            requestAnimationFrame(animateParticles);
        }
        
        // Debounce resize to avoid performance issues
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                resizeCanvas();
                initParticles();
            }, 250);
        });

        // Initial setup
        resizeCanvas();
        initParticles();
        animateParticles();

    </script>
</body>
</html>

