<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quản lý Sinh viên Lab') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Dòng này sẽ gọi Livewire component của bạn vào trang --}}
                @livewire('lab-student-manager')
            </div>
        </div>
    </div>
</x-app-layout>
