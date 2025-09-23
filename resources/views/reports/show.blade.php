<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chi tiết Báo cáo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    
                    {{-- Tiêu đề báo cáo --}}
                    <h1 class="text-2xl font-bold text-gray-900">
                        {{ $report->title }}
                    </h1>

                    {{-- Thông tin người nộp và ngày nộp --}}
                    <div class="mt-2 text-sm text-gray-600 border-b pb-4">
                        <p>
                            <strong>Sinh viên:</strong> {{ $report->labstudent->name }}
                        </p>
                        <p>
                            <strong>Ngày nộp:</strong> {{ $report->created_at }}
                        </p>
                    </div>

                    {{-- Nội dung báo cáo --}}
                    <div class="mt-6 prose">
                        <div class="font-semibold mt-6 prose">Nội dung báo cáo:</div>
                        {!! $report->content !!}
                    </div>
                    <!-- file đính kèm -->
                    <div class="mt-6">
                        <h2 class="font-semibold mt-6 prose">Tệp đính kèm:</h2>
                        @if($report->file_path)
                            <a href="{{ asset('storage/' . $report->file_path) }}" 
                            target="_blank" 
                            class="text-blue-600 hover:underline">
                                Xem file đính kèm
                            </a>
                        @else
                            <p class="text-gray-500">Không có tệp đính kèm.</p>
                        @endif
                    </div>

            </div>
        </div>
    </div>
</x-app-layout>