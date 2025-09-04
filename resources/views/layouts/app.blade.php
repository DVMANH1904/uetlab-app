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
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

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
                Fancybox.destroy();
                Fancybox.bind('[data-fancybox]', {
                    on: {
                        'done': (fancybox, slide) => {
                            const contentEl = slide.el.querySelector('.fancybox__content');
                            const imageWrapEl = slide.el.querySelector('.fancybox__image-wrap');
                            if (contentEl && imageWrapEl && !contentEl.querySelector('.custom-fancybox-layout')) {
                                const layoutWrapper = document.createElement('div');
                                layoutWrapper.classList.add('custom-fancybox-layout');
                                layoutWrapper.appendChild(imageWrapEl);
                                const sidebar = document.createElement('div');
                                sidebar.classList.add('post-details-sidebar');
                                layoutWrapper.appendChild(sidebar);
                                contentEl.appendChild(layoutWrapper);
                            }
                            const sidebarEl = slide.el.querySelector('.post-details-sidebar');
                            if (sidebarEl) {
                                const detailsId = slide.triggerEl.dataset.detailsId;
                                const detailsContent = document.getElementById(detailsId)?.innerHTML || '';
                                sidebarEl.innerHTML = detailsContent;
                            }
                        }
                    }
                });
            }
            document.addEventListener('DOMContentLoaded', initializeFancybox);
            document.addEventListener('livewire:navigated', initializeFancybox);
        </script>
    </body>
</html>
