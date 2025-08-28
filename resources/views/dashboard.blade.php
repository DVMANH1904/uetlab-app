<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-blue-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-blue-800">{{ $studentCount ?? 0 }}</p>
                            <p class="text-blue-600">Students</p>
                        </div>
                        <div class="text-blue-500 text-4xl">
                            <i class="fas fa-user-graduate"></i> </div>
                    </div>

                    <div class="bg-green-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-green-800">{{ $imageCount ?? 0 }}</p>
                            <p class="text-green-600">Images</p>
                        </div>
                        <div class="text-green-500 text-4xl">
                            <i class="fas fa-images"></i> </div>
                    </div>

                    <div class="bg-yellow-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-yellow-800">{{ $videoCount ?? 0 }}</p>
                            <p class="text-yellow-600">Videos</p>
                        </div>
                        <div class="text-yellow-500 text-4xl">
                            <i class="fas fa-video"></i> </div>
                    </div>

                    <div class="bg-purple-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-purple-800">{{ $documentCount ?? 0 }}</p>
                            <p class="text-purple-600">Documents</p>
                        </div>
                        <div class="text-purple-500 text-4xl">
                            <i class="fas fa-file-alt"></i> </div>
                    </div>
                </div>

                <div class="mt-8 text-2xl">
                    Welcome to UET LAB
                </div>
                <div class="mt-4 text-gray-500">
                    Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel ecosystem to be a breath of fresh air. We hope you love it.
                </div>
            </div>
        </div>
    </div>
</x-app-layout><x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-blue-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-blue-800">{{ $studentCount ?? 0 }}</p>
                            <p class="text-blue-600">Students</p>
                        </div>
                        <div class="text-blue-500 text-4xl">
                            <i class="fas fa-user-graduate"></i> </div>
                    </div>

                    <div class="bg-green-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-green-800">{{ $imageCount ?? 0 }}</p>
                            <p class="text-green-600">Images</p>
                        </div>
                        <div class="text-green-500 text-4xl">
                            <i class="fas fa-images"></i> </div>
                    </div>

                    <div class="bg-yellow-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-yellow-800">{{ $videoCount ?? 0 }}</p>
                            <p class="text-yellow-600">Videos</p>
                        </div>
                        <div class="text-yellow-500 text-4xl">
                            <i class="fas fa-video"></i> </div>
                    </div>

                    <div class="bg-purple-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-2xl font-bold text-purple-800">{{ $documentCount ?? 0 }}</p>
                            <p class="text-purple-600">Documents</p>
                        </div>
                        <div class="text-purple-500 text-4xl">
                            <i class="fas fa-file-alt"></i> </div>
                    </div>
                </div>

                <div class="mt-8 text-2xl">
                    Welcome to UET LAB
                </div>
                <div class="mt-4 text-gray-500">
                    Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed to help you build your application using a development environment that is simple, powerful, and enjoyable. We believe you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel ecosystem to be a breath of fresh air. We hope you love it.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
