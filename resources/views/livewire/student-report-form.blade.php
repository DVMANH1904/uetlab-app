<div>
    {{-- PHẦN HIỂN THỊ THÔNG BÁO THÀNH CÔNG --}}
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- CỘT BÊN TRÁI: FORM NỘP BÁO CÁO --}}
        <div>
            <h3 class="text-lg font-semibold mb-4">Nộp báo cáo tuần mới</h3>
            <form wire:submit.prevent="saveReport" class="bg-white p-6 rounded-lg border shadow-sm">
                <div class="space-y-4">
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Tiêu đề báo cáo</label>
                        <input type="text" id="title" wire:model.defer="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Ví dụ: Hoàn thành chức năng XYZ">
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="report_date" class="block text-sm font-medium text-gray-700">Ngày báo cáo</label>
                        <input type="date" id="report_date" wire:model.defer="report_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('report_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="report_content" class="block text-sm font-medium text-gray-700">Nội dung chi tiết</label>
                        <textarea id="report_content" wire:model.defer="report_content" rows="8" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                        @error('report_content') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="report_file" class="block text-sm font-medium text-gray-700">File đính kèm (PDF, Word...)</label>
                        <input type="file" id="report_file" wire:model.defer="report_file" class="mt-1 block w-full text-sm">
                        <div wire:loading wire:target="report_file" class="text-sm text-gray-500 mt-1">Đang tải lên...</div>
                        @error('report_file') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition">
                        Nộp Báo cáo
                    </button>
                </div>
            </form>
        </div>

        {{-- CỘT BÊN PHẢI: LỊCH SỬ BÁO CÁO --}}
        <div>
            <h3 class="text-lg font-semibold mb-4">Lịch sử báo cáo của bạn</h3>
            <div class="space-y-3 max-h-[60vh] overflow-y-auto p-2">
                @forelse($weeklyReports as $report)
                    <a href="{{ route('reports.show', $report->id) }}" class="block border p-4 rounded-lg bg-white hover:bg-gray-50 hover:border-blue-400 shadow-sm transition duration-150 ease-in-out">
                        <div class="flex justify-between items-start">
                            <div class="pr-4">
                                <p class="font-semibold text-gray-800">{{ $report->title }}</p>
                                <p class="text-sm text-gray-500 mt-1">Nộp ngày: {{ \Carbon\Carbon::parse($report->report_date)->format('d/m/Y') }}</p>

                            </div>
                            <span class="text-xs text-gray-400 whitespace-nowrap ml-2">Xem chi tiết &rarr;</span>
                        </div>
                    </a>
                @empty
                    <div class="border-2 border-dashed rounded-lg p-8 text-center text-gray-500">
                        <p>Bạn chưa có báo cáo nào.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

