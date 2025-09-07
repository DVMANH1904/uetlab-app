<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Báo cáo Hàng tuần') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if($labStudent)
                    @livewire('student-report-form', ['student' => $labStudent])
                @else
                    <p>Tài khoản của bạn chưa được liên kết với hồ sơ sinh viên trong lab. Vui lòng liên hệ người quản lý.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
