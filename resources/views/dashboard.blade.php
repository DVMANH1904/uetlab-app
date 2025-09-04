<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                {{-- BẮT ĐẦU PHẦN THẺ THỐNG KÊ --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    <div class="bg-orange-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-orange-800">{{ $postCount ?? 0 }}</p>
                            <p class="text-orange-600">Bài viết</p>
                        </div>
                        <div class="text-orange-500 text-4xl">
                            <i class="fas fa-newspaper"></i>
                        </div>
                    </div>

                    <div class="bg-green-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-green-800">{{ $activeStudentCount ?? 0 }}</p>
                            <p class="text-green-600">Đang hoạt động</p>
                        </div>
                        <div class="text-green-500 text-4xl">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>

                    <div class="bg-blue-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-blue-800">{{ $graduatedStudentCount ?? 0 }}</p>
                            <p class="text-blue-600">Đã tốt nghiệp</p>
                        </div>
                        <div class="text-blue-500 text-4xl">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>

                    <div class="bg-gray-200 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-gray-800">{{ $inactiveStudentCount ?? 0 }}</p>
                            <p class="text-gray-600">Ngừng hoạt động</p>
                        </div>
                        <div class="text-gray-500 text-4xl">
                            <i class="fas fa-user-times"></i>
                        </div>
                    </div>

                </div>
                {{-- KẾT THÚC PHẦN THẺ THỐNG KÊ --}}

                <div class="mt-8 text-2xl">
                    Welcome to UET LAB
                </div>
                <div class="mt-4 text-gray-500">
                    Đây là khu vực quản trị của bạn.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
