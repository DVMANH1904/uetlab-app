<div x-data="{ isModalOpen: false }">
    {{-- PHẦN HEADER CỦA TRANG --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kho Tài liệu Lab</h2>
            <p class="mt-1 text-gray-500">Nơi lưu trữ và chia sẻ các tài nguyên quan trọng.</p>
        </div>
        <button @click="isModalOpen = true" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-sky-600 text-white font-semibold rounded-lg hover:bg-sky-700 transition shadow-lg shadow-sky-500/20">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="M12 12v9"/><path d="m16 16-4-4-4 4"/></svg>
            Tải lên tài liệu mới
        </button>
    </div>

    {{-- THANH TÌM KIẾM --}}
    <div class="mb-6">
        <input 
            wire:model.live.debounce.300ms="search"
            type="text" 
            placeholder="Tìm kiếm theo tiêu đề tài liệu..."
            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500"
        >
    </div>

    {{-- DANH SÁCH TÀI LIỆU DẠNG THẺ (CARD) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($documents as $document)
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-transform hover:-translate-y-1">
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-shrink-0">
                            <div class="p-3 bg-slate-100 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-600"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><line x1="10" y1="9" x2="8" y2="9"/></svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <h3 class="font-bold text-gray-800 truncate">{{ $document->title }}</h3>
                            <p class="text-sm text-gray-500 mt-1 truncate">{{ $document->description }}</p>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-200 text-xs text-gray-500 space-y-2">
                        <p><strong>Người tải lên:</strong> {{ $document->user->name }}</p>
                        <p><strong>Ngày tải:</strong> {{ $document->created_at->format('d/m/Y') }}</p>
                        <p><strong>Kích thước:</strong> {{ $document->file_size }} KB</p>
                    </div>
                    <div class="mt-4 flex items-center justify-end space-x-3">
                        @if(auth()->user()->can('isAdmin') || auth()->id() === $document->user_id)
                        <button wire:click="deleteDocument({{ $document->id }})" wire:confirm="Bạn có chắc chắn muốn xóa tài liệu này không?" class="text-gray-400 hover:text-red-600 p-2 rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                        </button>
                        @endif
                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition text-sm">
                            Tải xuống
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="md:col-span-2 lg:col-span-3 text-center py-16 px-6 bg-white rounded-xl shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="mx-auto text-gray-400"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                <h3 class="mt-4 text-lg font-semibold text-gray-800">Chưa có tài liệu nào</h3>
                <p class="mt-1 text-gray-500">Hãy là người đầu tiên tải lên một tài liệu hữu ích cho lab!</p>
            </div>
        @endforelse
    </div>

    {{-- MODAL TẢI LÊN TÀI LIỆU --}}
    <div x-show="isModalOpen" 
         @keydown.escape.window="isModalOpen = false"
         class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
         style="display: none;">
        <div @click.away="isModalOpen = false" class="bg-white p-8 md:p-10 rounded-2xl shadow-xl w-full max-w-2xl">
            <div class="text-center mb-8">
                <div class="inline-block p-4 bg-sky-100 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-sky-600"><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="M12 12v9"/><path d="m16 16-4-4-4 4"/></svg>
                </div>
                <h2 class="mt-4 text-2xl font-bold text-gray-800">Tải lên Tài liệu mới</h2>
                <p class="mt-1 text-gray-500">Chia sẻ tài nguyên quan trọng với các thành viên khác.</p>
            </div>

            <form wire:submit.prevent="saveDocument">
                <div class="space-y-6">
                    <div x-data="{ isUploading: false, progress: 0, isDragging: false }"
                         x-on:livewire-upload-start="isUploading = true"
                         x-on:livewire-upload-finish="isUploading = false"
                         x-on:livewire-upload-error="isUploading = false"
                         x-on:livewire-upload-progress="progress = $event.detail.progress">

                        <label for="file" @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false" @drop.prevent="isDragging = false" :class="{ 'border-sky-500 bg-sky-50': isDragging }" class="relative flex flex-col items-center justify-center w-full h-48 border-2 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 border-gray-300 hover:border-sky-400 transition-colors">
                            <div class="flex flex-col items-center justify-center text-center">
                                <svg class="w-10 h-10 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-4-4V7a4 4 0 014-4h5l4 4v1.172a4 4 0 01-1.172 2.828L12 15H7z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16h6l-3.293-3.293a1 1 0 00-1.414 0L11 16z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4a2 2 0 012 2v4a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4a2 2 0 012-2z"></path></svg>
                                @if ($file)
                                    <p class="mb-2 text-sm text-green-600"><span class="font-semibold">{{ $file->getClientOriginalName() }}</span> đã được chọn.</p>
                                @else
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Nhấp để tải lên</span> hoặc kéo và thả</p>
                                @endif
                            </div>
                            <input id="file" wire:model="file" type="file" class="hidden">
                        </label>
                        @error('file') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        <div x-show="isUploading" class="w-full bg-gray-200 rounded-full h-2.5 mt-3"><div class="bg-sky-600 h-2.5 rounded-full" :style="`width: ${progress}%`"></div></div>
                    </div>
                    <div>
                        <label for="title_modal" class="block text-sm font-medium text-gray-700">Tiêu đề tài liệu</label>
                        <input type="text" id="title_modal" wire:model.defer="title" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                        @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="description_modal" class="block text-sm font-medium text-gray-700">Mô tả (không bắt buộc)</label>
                        <input type="text" id="description_modal" wire:model.defer="description" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    </div>
                    <div class="flex justify-end pt-4 space-x-3">
                         <button type="button" @click="isModalOpen = false" class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">Hủy</button>
                        <button type="submit" wire:loading.attr="disabled" class="inline-flex items-center px-6 py-3 bg-sky-600 text-white font-semibold rounded-lg hover:bg-sky-700 transition disabled:opacity-75">
                            <svg wire:loading wire:target="saveDocument" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <span wire:loading.remove wire:target="saveDocument">Lưu tài liệu</span>
                            <span wire:loading wire:target="saveDocument">Đang lưu...</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

