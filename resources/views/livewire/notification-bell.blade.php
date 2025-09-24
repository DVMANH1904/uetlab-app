<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" class="relative text-gray-500 hover:text-gray-700 focus:outline-none">
        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <div x-show="open" @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="absolute right-0 w-80 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
         style="display: none;">
        <div class="py-1">
            <div class="px-4 py-2 flex justify-between items-center border-b">
                <span class="font-semibold">Thông báo</span>
                @if($unreadCount > 0)
                    <button wire:click="markAsRead" class="text-xs text-blue-500 hover:underline">Đánh dấu đã đọc</button>
                @endif
            </div>
            <div class="max-h-96 overflow-y-auto">
                @forelse ($notifications as $notification)
                    @php $data = json_decode($notification->data); @endphp
                    <a href="{{ route('reports.show', $data->report_id) }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 @if(is_null($notification->read_at)) bg-blue-50 @endif">
                        @if($notification->type === 'new_report')
                            <p><strong>{{ $data->student_name }}</strong> vừa nộp báo cáo mới:</p>
                            <p class="truncate font-normal">{{ $data->report_title }}</p>
                        @elseif($notification->type === 'new_response')
                             <p><strong>{{ $data->responder_name }}</strong> vừa phản hồi báo cáo:</p>
                             <p class="truncate font-normal">{{ $data->report_title }}</p>
                        @elseif($notification->type === 'new_student_response')
                             <p><strong>{{ $data->student_name }}</strong> vừa trả lời phản hồi cho báo cáo:</p>
                             <p class="truncate font-normal">{{ $data->report_title }}</p>
                        @endif
                        <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                    </a>
                @empty
                    <p class="px-4 py-3 text-sm text-gray-500">Bạn không có thông báo nào.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>