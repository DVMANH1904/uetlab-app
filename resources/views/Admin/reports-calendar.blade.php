<x-app-layout>
    {{-- Thêm CSS của FullCalendar vào header --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Theo dõi báo cáo sinh viên') }}
        </h2>
        {{-- Link CDN cho CSS của FullCalendar --}}
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                {{-- Đây là nơi lịch sẽ được hiển thị --}}
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    @push('scripts')
    {{-- Script của FullCalendar và khởi tạo --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route("admin.reports.data") }}',
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // Ngăn trình duyệt mở link mặc định
                    if (info.event.url) {
                        window.open(info.event.url, "_blank"); // Mở link chi tiết báo cáo trong tab mới
                    }
                }
            });
            calendar.render();
        });
    </script>
    @endpush
</x-app-layout>