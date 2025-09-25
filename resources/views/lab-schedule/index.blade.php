<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lịch Cố định Lên Lab') }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4 text-sm text-gray-600 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p><strong>Hướng dẫn:</strong> Click vào một ngày trong tuần (ví dụ: cột Thứ Hai) để đăng ký lịch cố định. Click vào một lịch đã có để hủy.</p>
                </div>
                <div id='calendar' class="w-full h-[80vh]"></div>
            </div>
        </div>
    </div>

    <!-- Modal Đặt Lịch -->
    <div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">Đăng ký lịch cố định</h2>
            <form id="bookingForm">
                <input type="hidden" id="day_of_week">
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Mục đích</label>
                        <input type="text" id="title" class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="start_time" class="block text-sm font-medium text-gray-700">Giờ bắt đầu</label>
                            <select id="start_time" class="mt-1 block w-full rounded-md border-gray-300" required>
                                @for ($hour = 7; $hour <= 20; $hour++)
                                    <option value="{{ sprintf('%02d', $hour) }}:00">{{ sprintf('%02d', $hour) }}:00</option>
                                    @if($hour < 20)
                                        <option value="{{ sprintf('%02d', $hour) }}:30">{{ sprintf('%02d', $hour) }}:30</option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label for="end_time" class="block text-sm font-medium text-gray-700">Giờ kết thúc</label>
                            <select id="end_time" class="mt-1 block w-full rounded-md border-gray-300" required>
                                @for ($hour = 7; $hour <= 20; $hour++)
                                    <option value="{{ sprintf('%02d', $hour) }}:00">{{ sprintf('%02d', $hour) }}:00</option>
                                    <option value="{{ sprintf('%02d', $hour) }}:30">{{ sprintf('%02d', $hour) }}:30</option>
                                @endfor
                                <option value="21:00">21:00</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Lặp lại đến ngày</label>
                        <input type="date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300" required>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="button" id="cancelButton" class="px-4 py-2 bg-gray-300 rounded-md mr-4">Hủy</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Xác nhận</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const modal = document.getElementById('bookingModal');
            const form = document.getElementById('bookingForm');
            const cancelButton = document.getElementById('cancelButton');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                initialView: 'timeGridWeek',
                locale: 'vi',
                events: '/lab-schedule/events',
                allDaySlot: false,
                slotMinTime: '07:00:00',
                slotMaxTime: '21:00:00',
                
                dateClick: function(info) {
                    const selectedDate = new Date(info.dateStr);
                    form.reset();
                    document.getElementById('day_of_week').value = selectedDate.getDay();
                    modal.classList.remove('hidden');
                },
                
                eventClick: function(info) {
                    const purpose = info.event.extendedProps.purpose;
                    const studentName = info.event.extendedProps.student_name;
                    
                    let confirmMessage = `Bạn có muốn xóa lịch cố định này không?\n\nMục đích: ${purpose}`;
                    
                    if (@json(auth()->user()->can('isAdmin'))) {
                        confirmMessage += `\nNgười đặt: ${studentName}`;
                    }

                    if (confirm(confirmMessage)) {
                        fetch(`/lab-schedule/${info.event.id}`, {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': csrfToken }
                        })
                        .then(response => response.json().then(data => ({ status: response.status, body: data })))
                        .then(({ status, body }) => {
                            if (status !== 200) throw new Error(body.message);
                            calendar.refetchEvents();
                            alert(body.message);
                        })
                        .catch(error => alert('Lỗi: ' + error.message));
                    }
                }
            });

            calendar.render();

            cancelButton.addEventListener('click', () => modal.classList.add('hidden'));

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = {
                    title: document.getElementById('title').value,
                    day_of_week: document.getElementById('day_of_week').value,
                    start_time: document.getElementById('start_time').value,
                    end_time: document.getElementById('end_time').value,
                    end_date: document.getElementById('end_date').value,
                };
                
                fetch('/lab-schedule', {
                    method: 'POST',
                    headers: {
                        // === SỬA LỖI TẠI ĐÂY ===
                        'Content-Type': 'application/json', // Sửa từ 'json' thành 'application/json'
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json().then(data => ({ status: response.status, body: data })))
                .then(({ status, body }) => {
                    if (status !== 200) throw new Error(body.message);
                    calendar.refetchEvents();
                    modal.classList.add('hidden');
                    alert('Đăng ký lịch cố định thành công!');
                })
                .catch(error => alert('Lỗi: ' + error.message));
            });
        });
    </script>
    @endpush
</x-app-layout>

