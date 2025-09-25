<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'HMI Lab') }}</title>
    
    <!-- Fonts and Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
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
            color: #4b5563; /* text-gray-600 */
            padding: 0.75rem 1.25rem;
            text-decoration: none;
            display: block;
            white-space: nowrap;
        }
        .dropdown-link:hover {
            background-color: #f3f4f6; /* bg-gray-100 */
            color: #0ea5e9; /* text-sky-500 */
        }
    </style>
</head>
<body class="bg-slate-50 text-gray-800 font-sans">
    <!-- Header Đơn giản -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('hci-lab') }}" class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-brain-circuit"><path d="M12 5a3 3 0 1 0-5.993.142"/><path d="M18 5a3 3 0 1 0-5.993.142"/><path d="M5 8.142A3 3 0 1 0 5 14"/><path d="M19 8.142A3 3 0 1 0 19 14"/><path d="M12 13a3 3 0 1 0-5.993.142"/><path d="M18 13a3 3 0 1 0-5.993.142"/><path d="M5 19a3 3 0 1 0 0-5.858"/><path d="M19 19a3 3 0 1 0 0-5.858"/><path d="M12 1a3 3 0 1 0 0 6"/><path d="M12 9a3 3 0 1 0 0 6"/><path d="M12 17a3 3 0 1 0 0 6"/></svg>
                        <span class="font-bold text-2xl text-sky-600">HMI Lab</span>
                    </a>
                </div>
                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('hci-lab') }}#about" class="text-gray-600 hover:text-sky-600 font-medium">Giới thiệu</a>
                    <div class="dropdown">
                        <a href="{{ route('hci-lab') }}#research" class="nav-link font-medium transition-colors flex items-center" data-target="research">
                            Nghiên cứu <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                        </a>
                        <div class="dropdown-content">
                            <a href="#" class="dropdown-link">Thực tế ảo & Tăng cường</a>
                            <a href="#" class="dropdown-link">AI Sáng tạo & Ngôn ngữ</a>
                            <a href="#" class="dropdown-link">Giao diện Não-Máy (BCI)</a>
                        </div>
                    </div>
                    <a href="{{ route('hci-lab') }}#team" class="text-gray-600 hover:text-sky-600 font-medium">Đội ngũ</a>
                    <a href="{{ route('hci-lab') }}#publications" class="text-gray-600 hover:text-sky-600 font-medium">Công bố</a>
                    <div class="dropdown">
                        <a href="#" class="nav-link font-medium transition-colors flex items-center">
                            Thêm <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                        </a>
                        <div class="dropdown-content">
                            <a href="{{ route('contact') }}" class="dropdown-link">Liên hệ</a>
                            <a href="{{ route('hci-lab') }}" class="dropdown-link">Blog</a>
                            <a href="{{ route('hci-lab') }}" class="dropdown-link">Về chúng tôi</a>
                    </div>
                </nav>
                <!-- Login/Dashboard Button -->
                <div class="hidden md:block">
                     @auth
                        @can('isAdmin')
                            <a href="{{ url('/dashboard') }}" class="bg-sky-600 text-white font-semibold px-5 py-3 rounded-lg hover:bg-sky-700 transition-colors">Dashboard</a>
                        @endcan
                    @else
                        <a href="{{ route('login') }}" class="bg-sky-600 text-white font-semibold px-5 py-3 rounded-lg hover:bg-sky-700 transition-colors">Đăng nhập</a>
                    @endauth
                </div>
                 <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-simple-button" class="text-gray-600">
                        <i data-lucide="menu" class="w-7 h-7"></i>
                    </button>
                </div>
            </div>
        </div>
         <!-- Mobile Menu -->
        <div id="mobile-menu-simple" class="hidden md:hidden bg-white border-t">
             <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('hci-lab') }}#about" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-sky-600 hover:bg-gray-50">Giới thiệu</a>
                <div class="dropdown">
                    <a href="{{ route('hci-lab') }}#research" class="nav-link font-medium transition-colors flex items-center" data-target="research">
                        Nghiên cứu <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="#" class="dropdown-link">Thực tế ảo & Tăng cường</a>
                        <a href="#" class="dropdown-link">AI Sáng tạo & Ngôn ngữ</a>
                        <a href="#" class="dropdown-link">Giao diện Não-Máy (BCI)</a>
                    </div>
                </div>
                <a href="{{ route('hci-lab') }}#team" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-sky-600 hover:bg-gray-50">Đội ngũ</a>
                <a href="{{ route('hci-lab') }}#publications" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-sky-600 hover:bg-gray-50">Công bố</a>
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
        </div>
    </header>

    <!-- Main Content Slot -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer Đơn giản -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-base text-gray-400">&copy; {{ date('Y') }} HMI Lab. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        lucide.createIcons();
        document.getElementById('mobile-menu-simple-button').addEventListener('click', () => {
            document.getElementById('mobile-menu-simple').classList.toggle('hidden');
        });
    </script>
</body>
</html>
