<!-- Make sure to include Alpine.js for this component to work -->
<!-- You can add this to your main layout file's <head> section -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ open: false }" x-init="$watch('open', value => { if (value) { $nextTick(() => $refs.postContent.focus()) } })">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Trigger for the Post Creation Modal (Facebook Style) -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="flex items-center space-x-4">
                     <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                    </div>
                    <div @click="open = true" class="cursor-pointer w-full bg-gray-100 hover:bg-gray-200 transition rounded-full py-3 px-5 text-gray-500">
                        Bạn đang nghĩ gì, {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'bạn' }}?
                    </div>
                </div>
                 <div class="flex justify-around mt-4 pt-4 border-t">
                    <button @click="open = true" class="flex items-center space-x-2 text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        <span class="font-semibold">Video trực tiếp</span>
                    </button>
                    <button @click="open = true" class="flex items-center space-x-2 text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition">
                       <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                       <span class="font-semibold">Ảnh/video</span>
                    </button>
                     <button @click="open = true" class="flex items-center space-x-2 text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition">
                       <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                       <span class="font-semibold">Cảm xúc/Hoạt động</span>
                    </button>
                </div>
            </div>

            <!-- Post Feed -->
            <div class="mt-8 space-y-6">
                @foreach ($posts as $post)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}">
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $post->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="mt-4 text-gray-800 whitespace-pre-wrap">
                            <p>{{ $post->content }}</p>
                        </div>
                        @if ($post->media_path)
                            <div class="mt-4">
                                @if (Str::startsWith($post->media_type, 'image'))
                                    <img src="{{ asset('storage/' . $post->media_path) }}" alt="Post image" class="max-w-full h-auto rounded-lg">
                                @elseif (Str::startsWith($post->media_type, 'video'))
                                    <video controls class="max-w-full h-auto rounded-lg">
                                        <source src="{{ asset('storage/' . $post->media_path) }}" type="{{ $post->media_type }}">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Post Creation Modal -->
            <div
                x-show="open"
                @keydown.escape.window="open = false"
                style="display: none;"
                class="fixed z-50 inset-0 overflow-y-auto"
                aria-labelledby="modal-title" role="dialog" aria-modal="true"
            >
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="open" @click="open = false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                        x-data="{ content: '', previewUrl: '', fileType: '' }"
                    >
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start w-full">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-xl leading-6 font-bold text-gray-900 text-center relative pb-4" id="modal-title">
                                        Tạo bài viết
                                        <button @click="open = false" class="absolute right-0 top-0 bg-gray-200 rounded-full p-2 text-gray-500 hover:bg-gray-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </h3>
                                    <hr/>
                                    <div class="mt-4">
                                        <div class="flex items-center space-x-3">
                                            <img class="h-12 w-12 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                                            <div>
                                                <p class="font-semibold">{{ Auth::user()->name }}</p>
                                            </div>
                                        </div>
                                        <form action="{{ route('posts.store') }}" method="POST" id="post-form" class="mt-4" enctype="multipart/form-data">
                                            @csrf
                                            <textarea
                                                x-ref="postContent"
                                                x-model="content"
                                                name="content"
                                                rows="5"
                                                class="w-full border-none focus:ring-0 text-2xl"
                                                placeholder="Bạn đang nghĩ gì, {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'bạn' }}?"
                                            ></textarea>
                                            <!-- Media Preview -->
                                            <div x-show="previewUrl" class="mt-4">
                                                <template x-if="fileType.startsWith('image')">
                                                    <img :src="previewUrl" class="max-w-full h-auto rounded-lg">
                                                </template>
                                                <template x-if="fileType.startsWith('video')">
                                                    <video :src="previewUrl" controls class="max-w-full h-auto rounded-lg"></video>
                                                </template>
                                            </div>
                                            <input type="file" name="media" x-ref="mediaInput" class="hidden" @change="
                                                const file = $event.target.files[0];
                                                if (file) {
                                                    previewUrl = URL.createObjectURL(file);
                                                    fileType = file.type;
                                                } else {
                                                    previewUrl = '';
                                                    fileType = '';
                                                }
                                            ">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add to Post Section -->
                        <div class="px-6 pb-4">
                            <div class="border rounded-lg p-3 flex justify-between items-center">
                                <span class="font-semibold text-gray-700">Thêm vào bài viết của bạn</span>
                                <div class="flex items-center space-x-2">
                                     <button @click="$refs.mediaInput.click()" class="p-2 rounded-full hover:bg-gray-100"><svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></button>
                                     <button class="p-2 rounded-full hover:bg-gray-100"><svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></button>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 pb-4">
                            <button
                                type="submit"
                                form="post-form"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-gray-800 focus:outline-none sm:text-sm bg-gray-200 hover:bg-gray-300 disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed"
                                :disabled="content.trim() === '' && !previewUrl"
                            >
                                Đăng
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
