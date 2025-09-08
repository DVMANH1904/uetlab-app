<div class="p-6">
    {{-- Thông báo thành công --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    @can('isAdmin')
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold">Quản lý Sinh viên Lab</h1>
            <button wire:click="create()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Thêm Sinh viên mới</button>
        </div>
    @else
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold mb-6">Danh sách Sinh viên Lab</h1>
        </div>
    @endcan
    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Tìm kiếm theo tên hoặc MSSV..." class="w-full mb-4 px-3 py-2 border rounded-md">

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-3 px-4 text-left">Họ và Tên</th>
                    <th class="py-3 px-4 text-left">MSSV</th>
                    <th class="py-3 px-4 text-left">Ngành học</th>
                    <th class="py-3 px-4 text-left">Đề tài</th>
                    <th class="py-3 px-4 text-left">Trạng thái</th>
                    <th class="py-3 px-4 text-left">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">
                            <button wire:click="showDetails({{ $student->id }})" class="text-blue-600 font-semibold hover:underline">
                                {{ $student->name }}
                            </button>
                        </td>
                        <td class="py-3 px-4">{{ $student->student_id }}</td>
                        <td class="py-3 px-4">{{ $student->major }}</td>
                        <td class="py-3 px-4">{{ Str::limit($student->project_topic, 30) }}</td>
                        <td class="py-3 px-4"><span class="px-2 py-1 text-xs font-semibold rounded-full {{ $student->status == 'active' ? 'bg-green-200 text-green-800' : ($student->status == 'graduated' ? 'bg-blue-200 text-blue-800' : 'bg-gray-200 text-gray-800') }}">{{ ucfirst($student->status) }}</span></td>

                        <td class="py-3 px-4">
                            {{-- Mọi vai trò đều có thể xem báo cáo --}}
                            {{-- <button wire:click="openReportModal({{ $student->id }})" class="text-green-600 hover:text-green-900">Báo cáo</button> --}}

                            {{-- Chỉ Admin mới có thể Sửa và Xóa --}}
                            @can('isAdmin')
                                <button wire:click="edit({{ $student->id }})" class="text-indigo-600 hover:text-indigo-900 ml-4">Sửa</button>
                                <button wire:click="confirmDelete({{ $student->id }})" class="text-red-600 hover:text-red-900 ml-4">Xóa</button>
                            @else
                                <span class="text-gray-400 italic">Không có quyền</span>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 px-4 text-center text-gray-500">Không có dữ liệu sinh viên.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $students->links() }}
    </div>

    @if($isModalOpen)
    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-2xl">
            <h2 class="text-2xl font-bold mb-6">{{ $studentId ? 'Cập nhật thông tin' : 'Thêm Sinh viên mới' }}</h2>
            <form wire:submit.prevent="store">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Các trường thông tin cơ bản --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Họ và Tên</label>
                        <input type="text" wire:model.defer="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mã số sinh viên</label>
                        <input type="text" wire:model.defer="student_code" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('student_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" wire:model.defer="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    {{-- Các trường thông tin khác --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ngành học</label>
                        <input type="text" wire:model.defer="major" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Ngày vào lab</label>
                        <input type="date" wire:model.defer="join_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('join_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Vai trò</label>
                        <select wire:model.defer="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            {{-- Vô hiệu hóa nếu admin đang sửa chính mình --}}
                            @if($studentId && optional(\App\Models\LabStudent::find($studentId)->user)->id == auth()->id()) disabled @endif>
                            <option value="student">Student</option>
                            <option value="lecturer">Lecturer</option>
                            <option value="admin">Admin</option>
                        </select>
                        @if($studentId && optional(\App\Models\LabStudent::find($studentId)->user)->id == auth()->id())
                            <p class="text-xs text-gray-500 mt-1">Bạn không thể thay đổi vai trò của chính mình.</p>
                        @endif
                    </div>
                    {{-- BẮT ĐẦU THÊM MỚI: Chỉ hiển thị khi tạo mới sinh viên --}}
                    @if(!$studentId)
                        <hr class="md:col-span-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                            <input type="password" wire:model.defer="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Xác nhận Mật khẩu</label>
                            <input type="password" wire:model.defer="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <hr class="md:col-span-2">
                    @endif
                    {{-- KẾT THÚC THÊM MỚI --}}

                </div>
                <div class="mt-8 flex justify-end">
                    <button type="button" wire:click="$set('isModalOpen', false)" class="px-4 py-2 bg-gray-300 rounded-md mr-4">Hủy</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">{{ $studentId ? 'Cập nhật' : 'Tạo tài khoản & Lưu' }}</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    @if($isDetailModalOpen && $selectedStudent)
    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center" x-data @keydown.escape.window="$wire.closeDetailModal()">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-2xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Chi tiết Sinh viên</h2>
                <button wire:click="closeDetailModal()" class="text-gray-500 hover:text-gray-800 text-3xl">&times;</button>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Họ và Tên</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $selectedStudent->name }}</dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Mã số sinh viên</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $selectedStudent->student_id }}</dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $selectedStudent->email }}</dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Ngành học</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $selectedStudent->major }}</dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Ngày vào lab</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ \Carbon\Carbon::parse($selectedStudent->join_date)->format('d/m/Y') }}</dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Trạng thái</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ ucfirst($selectedStudent->status) }}</dd>
                    </div>
                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Đề tài/Dự án</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-wrap">{{ $selectedStudent->project_topic }}</dd>
                    </div>

                    <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Ghi chú</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-wrap">{{ $selectedStudent->notes }}</dd>
                    </div>
                </dl>
            </div>
            <div class="mt-8 flex justify-end">
                <button type="button" wire:click="closeDetailModal()" class="px-4 py-2 bg-gray-300 rounded-md">Đóng</button>
            </div>
        </div>
    </div>
    @endif
</div>
