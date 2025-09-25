<div>
    <div class="flex justify-between items-center mb-4">
        <div class="w-1/2">
            <input 
                wire:model.live.debounce.300ms="search"
                type="text" 
                placeholder="Tìm kiếm theo tên hoặc mã sinh viên..."
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            >
        </div>
        <div>
            <a href="{{ route('lab.schedule.index') }}" class="inline-flex items-center px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Xem Lịch
            </a>
        </div>
    </div>
    <!-- Kết thúc phần thêm mới -->

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Sinh viên
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Lịch Cố định Đã đăng ký
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($studentsWithSchedules as $student)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $student->name }}</div>
                            <div class="text-sm text-gray-500">{{ $student->student_id }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-2">
                                @foreach ($student->schedules as $schedule)
                                    @php
                                        $days = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
                                    @endphp
                                    <div class="p-2 bg-gray-100 rounded-md flex justify-between items-center">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800">
                                                {{ $days[$schedule->day_of_week] }}, {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
                                            </p>
                                            <p class="text-xs text-gray-600">Mục đích: {{ $schedule->title }}</p>
                                            <p class="text-xs text-gray-400">Kết thúc vào: {{ \Carbon\Carbon::parse($schedule->end_date)->format('d/m/Y') }}</p>
                                        </div>
                                        <button wire:click="deleteSchedule({{ $schedule->id }})" wire:confirm="Bạn có chắc chắn muốn xóa lịch này của sinh viên?" class="text-red-500 hover:text-red-700 ml-4 flex-shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-12 text-center text-gray-500">
                            Không tìm thấy sinh viên nào phù hợp.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
