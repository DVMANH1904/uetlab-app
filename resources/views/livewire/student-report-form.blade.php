<div>
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            <h3 class="text-lg font-semibold mb-4">Nộp báo cáo tuần mới</h3>
            <form wire:submit.prevent="saveReport" class="bg-gray-50 p-6 rounded-lg border">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">Ngày báo cáo</label>
                        <input type="date" wire:model="report_date" class="mt-1 block w-full rounded-md border-gray-300">
                        @error('report_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Nội dung</label>
                        <textarea wire:model="report_content" rows="8" class="mt-1 block w-full rounded-md border-gray-300"></textarea>
                        @error('report_content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">File đính kèm (PDF, Word...)</label>
                        <input type="file" wire:model="report_file" class="mt-1 block w-full text-sm">
                        @error('report_file') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        <div wire:loading wire:target="report_file" class="text-sm text-gray-500 mt-1">Đang tải lên...</div>
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Nộp Báo cáo</button>
                </div>
            </form>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-4">Lịch sử báo cáo của bạn</h3>
            <div class="space-y-4 max-h-[60vh] overflow-y-auto">
                @forelse($weeklyReports as $report)
                    <div class="border p-3 rounded-md">
                        <p class="font-semibold">{{ \Carbon\Carbon::parse($report->report_date)->format('d/m/Y') }}</p>
                        <p class="text-sm text-gray-700 mt-2 whitespace-pre-wrap">{{ $report->content }}</p>
                        @if($report->file_path)
                             <a href="{{ asset('storage/' . $report->file_path) }}" target="_blank" class="text-sm text-blue-600 hover:underline mt-2 inline-block">
                                <i class="fas fa-paperclip mr-1"></i> Xem file đính kèm
                            </a>
                        @endif
                    </div>
                @empty
                    <p class="text-gray-500">Bạn chưa có báo cáo nào.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
