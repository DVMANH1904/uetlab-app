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
        <div class="mt-8 p-6 bg-gray-100 rounded-lg shadow-inner">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Phản hồi báo cáo</h3>
            <form action="{{ route('reports.responses.store', $report) }}" method="POST">
                @csrf
                <div>
                    <label for="response_content" class="block text-sm font-medium text-gray-700">Nội dung phản hồi:</label>
                    <textarea name="response_content" id="response_content" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                </div>
                <div class="mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                        Gửi phản hồi
                    </button>
                </div>
            </form>
        </div>

        @if($report->responses->isNotEmpty())
            <div class="mt-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Lịch sử phản hồi</h3>
                @foreach ($report->responses as $response)
                    <div class="bg-white p-4 mb-4 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex items-center justify-between text-sm text-gray-600">
                            <p>
                                <strong>{{ $response->user->name }}</strong>
                                <span class="text-xs text-gray-400 ml-2">({{ $response->created_at->format('d/m/Y H:i') }})</span>
                            </p>
                        </div>
                        <div class="mt-2 text-gray-800">
                            <p>{{ $response->content }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
