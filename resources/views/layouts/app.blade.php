<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

        <style>
            .fancybox__slide .fancybox__content { padding: 0; }
            .custom-fancybox-layout { display: flex; width: 100%; height: 100%; }
            .fancybox__image-wrap { flex: 1; height: 100vh; background-color: #000; }
            .post-details-sidebar { width: 360px; height: 100vh; padding: 24px; overflow-y: auto; background-color: #fff; color: #000; flex-shrink: 0; }
            .post-details-sidebar .author-info { display: flex; align-items: center; margin-bottom: 1rem; }
            .post-details-sidebar .author-info img { width: 40px; height: 40px; border-radius: 50%; margin-right: 12px; }
        </style>
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        
        <!-- =================================================================== -->
        <!-- === BẮT ĐẦU PHẦN THÔNG BÁO CHUNG === -->
        <div x-data="{ show: @if(session('success') || session('error')) true @else false @endif }" 
             x-show="show" 
             x-init="setTimeout(() => { if (show) show = false }, 5000)"
             @if(session('success') || session('error'))
                x-transition:enter="transform ease-out duration-300 transition"
                x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
             @endif
             class="fixed top-5 right-5 z-50">
            
            @if (session('success'))
                <div class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium text-gray-900">Thành công!</p>
                                <p class="mt-1 text-sm text-gray-500">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-sm font-medium text-gray-900">Đã xảy ra lỗi!</p>
                                <p class="mt-1 text-sm text-gray-500">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- === KẾT THÚC PHẦN THÔNG BÁO CHUNG === -->
        <!-- =================================================================== -->
        
        <x-banner />
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @livewireScripts

        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

        <script>
            function initializeFancybox() {
                // ... (code Fancybox của bạn giữ nguyên) ...
            }
            document.addEventListener('DOMContentLoaded', initializeFancybox);
            document.addEventListener('livewire:navigated', initializeFancybox);
        </script>
        @stack('scripts')
    </body>
</html>