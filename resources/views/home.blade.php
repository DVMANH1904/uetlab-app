@php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
@endphp
<script src="//unpkg.com/alpinejs" defer></script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8"
             x-data="{
                 postModalOpen: false,
                 content: '',
                 mediaFiles: [],
                 mediaPreviews: [],
                 handleFiles(event) {
                     this.mediaFiles = Array.from(event.target.files);
                     this.mediaPreviews = [];
                     for (const file of this.mediaFiles) {
                         let reader = new FileReader();
                         reader.onload = (e) => {
                             this.mediaPreviews.push(e.target.result);
                         };
                         reader.readAsDataURL(file);
                     }
                 },
                 removeMedia(index) {
                     this.mediaFiles.splice(index, 1);
                     this.mediaPreviews.splice(index, 1);
                     const dataTransfer = new DataTransfer();
                     this.mediaFiles.forEach(file => dataTransfer.items.add(file));
                     this.$refs.mediaInput.files = dataTransfer.files;
                 },
                 resetForm() {
                     this.content = '';
                     this.mediaFiles = [];
                     this.mediaPreviews = [];
                     if (this.$refs.mediaInput) {
                         this.$refs.mediaInput.value = '';
                     }
                 }
             }"
             x-init="$watch('postModalOpen', value => { if (value) { $nextTick(() => $refs.postContent.focus()) } else { resetForm() } })">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <div class="flex items-center space-x-4">
                   <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                    </div>
                    <div @click="postModalOpen = true" class="cursor-pointer w-full bg-gray-100 hover:bg-gray-200 transition rounded-full py-3 px-5 text-gray-500">
                        Bạn đang nghĩ gì, {{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'bạn' }}?
                    </div>
                </div>
                 <div class="flex justify-around mt-4 pt-4 border-t">
                    <button @click="postModalOpen = true" class="flex items-center space-x-2 text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="font-semibold">Ảnh/video</span>
                    </button>
                    <button @click="postModalOpen = true" class="flex items-center space-x-2 text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-semibold">Cảm xúc/Hoạt động</span>
                    </button>
                </div>
            </div>

            <div x-show="postModalOpen" @keydown.escape.window="postModalOpen = false" style="display: none;" class="fixed z-50 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="postModalOpen" @click="postModalOpen = false" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                    <div @click.stop class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-xl leading-6 font-bold text-gray-900 text-center relative pb-4">
                                Tạo bài viết
                                <button @click="postModalOpen = false" class="absolute right-0 top-0 bg-gray-200 rounded-full p-2 text-gray-500 hover:bg-gray-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </h3>
                            <hr/>
                            <div class="mt-4">
                                <div class="flex items-center space-x-3">
                                    <img class="h-12 w-12 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                                    <div><p class="font-semibold">{{ Auth::user()->name }}</p></div>
                                </div>
                                <form action="{{ route('posts.store') }}" method="POST" id="post-form" class="mt-4" enctype="multipart/form-data">
                                    @csrf
                                    <div class="overflow-y-auto max-h-60 p-1">
                                        <textarea x-ref="postContent" x-model="content" name="content" rows="2" class="w-full border-none focus:ring-0 text-xl resize-none" placeholder="Bạn đang nghĩ gì?"></textarea>
                                        <div x-show="mediaPreviews.length > 0" class="mt-4 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-2">
                                            <template x-for="(preview, index) in mediaPreviews" :key="index">
                                                <div class="relative">
                                                    <img :src="preview" class="w-full h-24 object-cover rounded-lg">
                                                    <button @click.prevent="removeMedia(index)" class="absolute -top-2 -right-2 bg-gray-800 text-white rounded-full h-6 w-6 flex items-center justify-center text-xs">&times;</button>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                    <input type="file" name="media[]" x-ref="mediaInput" @change="handleFiles" multiple accept="image/*,video/*" class="hidden">
                                </form>
                            </div>
                        </div>
                        <div class="px-6 pb-4">
                            <div class="border rounded-lg p-3 flex justify-between items-center">
                                <span class="font-semibold text-gray-700">Thêm vào bài viết</span>
                                <div class="flex items-center space-x-2">
                                      <button @click="$refs.mediaInput.click()" class="p-2 rounded-full hover:bg-gray-100"><svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></button>
                                      <button class="p-2 rounded-full hover:bg-gray-100"><svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></button>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 pb-4">
                            <button type="submit" form="post-form" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none sm:text-sm" :class="(content.trim() === '' && mediaFiles.length === 0) ? 'bg-gray-300 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700'" :disabled="content.trim() === '' && mediaFiles.length === 0">Đăng</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 space-y-6">
                @foreach ($posts as $post)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg" x-data="{ showComments: false, liked: {{ $post->liked_by_user ? 'true' : 'false' }}, likesCount: {{ $post->likes_count }}, async toggleLike() { const response = await fetch('{{ route('posts.like', $post) }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'Accept': 'application/json' } }); const data = await response.json(); if (response.ok) { this.liked = data.liked; this.likesCount = data.likes_count; } } }">
                        <div class="p-4">
                            <div class="flex items-center space-x-4">
                                <img class="h-12 w-12 rounded-full object-cover" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $post->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            @if($post->content)
                            <div class="mt-4 text-gray-800"><p class="whitespace-pre-wrap">{{ $post->content }}</p></div>
                            @endif
                        </div>

                        @if($post->media && $post->media->isNotEmpty())
                            @php $mediaCount = $post->media->count(); @endphp
                            <div class="mt-2 grid gap-0.5">
                                @if($mediaCount === 1)
                                    <a href="{{ asset('storage/' . $post->media->first()->media_path) }}" data-fancybox="gallery-{{ $post->id }}" data-details-id="post-details-{{ $post->id }}">
                                        <img src="{{ asset('storage/' . $post->media->first()->media_path) }}" class="w-full object-cover" style="max-height: 500px;">
                                    </a>
                                @elseif($mediaCount === 2)
                                    <div class="grid grid-cols-2 gap-0.5">
                                        @foreach($post->media as $media_item)
                                            <a href="{{ asset('storage/' . $media_item->media_path) }}" data-fancybox="gallery-{{ $post->id }}" data-details-id="post-details-{{ $post->id }}">
                                                <img src="{{ asset('storage/' . $media_item->media_path) }}" class="object-cover w-full h-full aspect-[4/3]">
                                            </a>
                                        @endforeach
                                    </div>
                                @elseif($mediaCount === 3)
                                    <div class="grid grid-cols-2 gap-0.5">
                                        <a href="{{ asset('storage/' . $post->media[0]->media_path) }}" data-fancybox="gallery-{{ $post->id }}" data-details-id="post-details-{{ $post->id }}" class="row-span-2">
                                            <img src="{{ asset('storage/' . $post->media[0]->media_path) }}" class="object-cover w-full h-full aspect-[2/3]">
                                        </a>
                                        <a href="{{ asset('storage/' . $post->media[1]->media_path) }}" data-fancybox="gallery-{{ $post->id }}" data-details-id="post-details-{{ $post->id }}">
                                            <img src="{{ asset('storage/' . $post->media[1]->media_path) }}" class="object-cover w-full h-full aspect-square">
                                        </a>
                                        <a href="{{ asset('storage/' . $post->media[2]->media_path) }}" data-fancybox="gallery-{{ $post->id }}" data-details-id="post-details-{{ $post->id }}">
                                            <img src="{{ asset('storage/' . $post->media[2]->media_path) }}" class="object-cover w-full h-full aspect-square">
                                        </a>
                                    </div>
                                @elseif($mediaCount === 4)
                                    <div class="grid grid-cols-2 grid-rows-2 gap-0.5">
                                        @foreach($post->media as $media_item)
                                            <a href="{{ asset('storage/' . $media_item->media_path) }}" data-fancybox="gallery-{{ $post->id }}" data-details-id="post-details-{{ $post->id }}">
                                                <img src="{{ asset('storage/' . $media_item->media_path) }}" class="object-cover w-full h-full aspect-square">
                                            </a>
                                        @endforeach
                                    </div>
                                @else {{-- 5 or more images --}}
                                    <div class="grid grid-cols-2 gap-0.5">
                                        @foreach($post->media->take(3) as $media_item)
                                            <a href="{{ asset('storage/' . $media_item->media_path) }}" data-fancybox="gallery-{{ $post->id }}" data-details-id="post-details-{{ $post->id }}">
                                                <img src="{{ asset('storage/' . $media_item->media_path) }}" class="object-cover w-full h-full aspect-square">
                                            </a>
                                        @endforeach

                                        <a href="{{ asset('storage/' . $post->media[3]->media_path) }}" data-fancybox="gallery-{{ $post->id }}" data-details-id="post-details-{{ $post->id }}" class="relative">
                                            <img src="{{ asset('storage/' . $post->media[3]->media_path) }}" class="object-cover w-full h-full aspect-square">
                                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center cursor-pointer">
                                                <span class="text-white text-3xl font-bold">+{{ $mediaCount - 4 }}</span>
                                            </div>
                                        </a>
                                    </div>
                                    @foreach($post->media->slice(4) as $hidden_media)
                                        <a href="{{ asset('storage/' . $hidden_media->media_path) }}" data-fancybox="gallery-{{ $post->id }}" data-details-id="post-details-{{ $post->id }}" style="display: none;"></a>
                                    @endforeach
                                @endif
                            </div>
                        @endif

                        <div class="p-4">
                            <div class="flex justify-between items-center text-gray-500">
                                <div><span x-text="likesCount"></span> Likes</div>
                                <div>{{ $post->comments->count() }} Comments</div>
                            </div>
                            <div class="mt-2 py-2 border-t border-b flex justify-around items-center">
                                <button @click="toggleLike" class="flex w-full justify-center items-center space-x-2 p-2 rounded-lg transition" :class="liked ? 'text-blue-600 font-semibold' : 'text-gray-600 hover:bg-gray-100'">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.562 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path></svg>
                                    <span>Thích</span>
                                </button>
                                 <button @click="showComments = !showComments" class="flex w-full justify-center items-center space-x-2 text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    <span>Bình luận</span>
                                </button>
                            </div>
                            <div x-show="showComments" class="mt-4 space-y-4" style="display: none;">
                                <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="flex items-center space-x-3">
                                    @csrf
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                                    <input type="text" name="content" class="w-full border-gray-300 rounded-full focus:border-blue-500 focus:ring-blue-500" placeholder="Viết bình luận...">
                                    <button type="submit" class="bg-blue-600 text-white rounded-full px-4 py-1.5 hover:bg-blue-700">Gửi</button>
                                </form>
                                 @foreach($post->comments as $comment)
                                    <div class="flex items-start space-x-3">
                                        <img class="h-8 w-8 rounded-full object-cover" src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}">
                                        <div>
                                            <div class="bg-gray-100 rounded-xl p-3">
                                                <p class="font-semibold text-sm">{{ $comment->user->name }}</p>
                                                <p class="text-sm">{{ $comment->content }}</p>
                                            </div>
                                            <p class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div id="post-details-{{ $post->id }}" style="display: none;">
                        <div class="author-info">
                            <img src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $post->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        @if($post->content)
                            <div class="my-4 text-gray-800"><p class="whitespace-pre-wrap">{{ $post->content }}</p></div>
                        @endif

                        <hr class="my-4">

                        <div class="flex justify-between items-center text-gray-500 text-sm">
                            <div>{{ $post->likes_count }} Likes</div>
                            <div>{{ $post->comments->count() }} Comments</div>
                        </div>

                        <hr class="my-4">

                        <div class="space-y-4">
                             @foreach($post->comments as $comment)
                                <div class="flex items-start space-x-3">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}">
                                    <div>
                                        <div class="bg-gray-100 rounded-xl p-3">
                                            <p class="font-semibold text-sm">{{ $comment->user->name }}</p>
                                            <p class="text-sm">{{ $comment->content }}</p>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
