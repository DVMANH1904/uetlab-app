@php use Illuminate\Support\Facades\Auth; @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Administrator Manager')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { margin: 0; font-family: 'Segoe UI', Arial, sans-serif; background: #f7f8fa; }
        .admin-header { display: flex; align-items: center; justify-content: space-between; background: #fff; padding: 0 32px; height: 64px; border-bottom: 1px solid #eee; }
        .admin-header .logo { display: flex; align-items: center; font-weight: bold; font-size: 1.5rem; color: #2a7de1; }
        .admin-header .logo i { font-size: 2rem; margin-right: 8px; }
        .admin-header .logo a { text-decoration: none; color: #2a7de1; font-weight: 700; }
        .admin-header .header-actions { display: flex; align-items: center; gap: 24px; color: #000}
        .admin-header .avatar { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; }
        .admin-sidebar { position: fixed; top: 0; left: 0; width: 220px; height: 100vh; border-right: 1px solid #eee; padding-top: 64px; }
        .admin-sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }
        .admin-sidebar li {
            width: 100%
        }
        .admin-sidebar a {
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
            padding: 5px 16px;
            color: #333;
            text-decoration: none;
            font-size: 1rem;
            transition: background 0.2s;
            min-height: 44px;

        }
        .admin-sidebar a.active, .admin-sidebar a:hover { background: #f0f6ff; color: #2a7de1; }
        .admin-sidebar i { margin-right: 12px; font-size: 1.2rem; }
        .admin-content { margin-left: 220px; padding: 32px; min-height: calc(100vh - 64px); }
        /* Dropdown hover effect */
        #user-dropdown a:hover,
        #user-dropdown button:hover {
            background: #f0f6ff;
            color: #2a7de1;
        }
        @media (max-width: 900px) {
            .admin-sidebar { width: 60px; }
            .admin-content { margin-left: 60px; }
            .admin-sidebar a span { display: none; }
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="logo">
            <i class="bi bi-activity"></i>
            <a href="{{ route('admin')}}">LAB ADMIN</a>
        </div>
        <div class="header-actions" style="position:relative;">
            <i class="bi bi-bell" style="font-size:1.3rem;cursor:pointer;"></i>
            <i class="bi bi-envelope" style="font-size:1.3rem;cursor:pointer;"></i>
            <div id="user-dropdown-toggle" style="display:flex;align-items:center;cursor:pointer;">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="avatar" alt="User">
                <span style=" font-weight:500; margin-left:6px; ">Xin chào, {{ session('name') }}</span>
                <i class="bi bi-caret-down-fill" style="margin-left:4px;font-size:0.9rem;"></i>
            </div>
            <div id="user-dropdown" style="display:none;position:absolute;right:0;top:48px;min-width:160px;background:#fff;border:1px solid #eee;box-shadow:0 2px 8px rgba(0,0,0,0.07);border-radius:6px;z-index:100;">
                <a href="#" style="display:block;padding:10px 18px;color:#333;text-decoration:none;">Quản lý tài khoản</a>
                <form method="POST" action="/custom-logout" style="margin:0;">
                    @csrf
                    <button type="submit" style="width:100%;padding:10px 18px;text-align:left;border:none;background:none;color:#333;cursor:pointer;">Đăng xuất</button>
                </form>
            </div>
        </div>
    </div>
    <nav class="admin-sidebar">
        <ul>
            <li>
                <a href="{{ route('admin') }}" class="{{ request()->routeIs('admin') ? 'active' : '' }}">
                    <i class="bi bi-house"></i><span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('email*') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i><span>Email</span>
                </a>
            </li>
            <li>
                <a href="{{ route('shedule') }}" class="{{ request()->routeIs('shedule') ? 'active' : '' }}">
                    <i class="bi bi-calendar"></i><span>Work schedule</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adminmedia') }}" class="{{ request()->is('compose*') ? 'active' : '' }}">
                    <i class="bi bi-pencil-square"></i><span>Media</span>
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('chat*') ? 'active' : '' }}">
                    <i class="bi bi-chat-dots"></i><span>Chat</span>
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('charts*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart"></i><span>Charts</span>
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('forms*') ? 'active' : '' }}">
                    <i class="bi bi-ui-checks"></i><span>Forms</span>
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('tables*') ? 'active' : '' }}">
                    <i class="bi bi-table"></i><span>Tables</span>
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('maps*') ? 'active' : '' }}">
                    <i class="bi bi-map"></i><span>Maps</span>
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('pages*') ? 'active' : '' }}">
                    <i class="bi bi-files"></i><span>Pages</span>
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('multiple-levels*') ? 'active' : '' }}">
                    <i class="bi bi-list-nested"></i><span>Multiple Levels</span>
                </a>
            </li>
        </ul>
    </nav>
    <main class="admin-content">
        @yield('content')
    </main>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        // Toggle dropdown on click
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('user-dropdown-toggle');
            const dropdown = document.getElementById('user-dropdown');
            document.addEventListener('click', function(e) {
                if (toggle.contains(e.target)) {
                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                } else {
                    dropdown.style.display = 'none';
                }
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
