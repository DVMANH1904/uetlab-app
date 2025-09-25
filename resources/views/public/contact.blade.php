<x-public-layout>
    <main>
        <!-- Hero Section for Contact Page -->
        <section class="bg-slate-100 pt-32 pb-16 md:pt-40 md:pb-24 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center hero-content">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight tracking-tight animated-element">
                    Kết nối với Chúng tôi
                </h1>
                <p class="mt-6 max-w-2xl mx-auto text-lg md:text-xl text-gray-600 animated-element" style="transition-delay: 150ms;">
                    Chúng tôi luôn sẵn lòng lắng nghe các ý tưởng, đề xuất hợp tác hoặc bất kỳ câu hỏi nào từ bạn.
                </p>
            </div>
        </section>

        <!-- Contact Details and Form Section -->
        <section class="py-20 bg-white section">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                    <!-- Cột bên trái: Thông tin và Bản đồ -->
                    <div class="animated-element">
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Thông tin Lab</h2>
                        <div class="space-y-6 text-gray-700">
                            <div class="flex items-start">
                                <i data-lucide="map-pin" class="w-6 h-6 text-sky-600 mt-1 mr-4 flex-shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold">Địa chỉ</h3>
                                    <p>Phòng 307 - Tòa nhà E3, 144 Xuân Thủy, Cầu Giấy, Hà Nội</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i data-lucide="phone" class="w-6 h-6 text-sky-600 mt-1 mr-4 flex-shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold">Hotline</h3>
                                    <p>(024) 3 754 7064</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i data-lucide="mail" class="w-6 h-6 text-sky-600 mt-1 mr-4 flex-shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold">Email</h3>
                                    <p>contact@vnu.edu.vn</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 rounded-lg overflow-hidden shadow-lg">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.926558422119!2d105.7800092759744!3d21.03561958843841!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab3453a29b3d%3A0x861a7a02251d149c!2zMTQ0IMSQLiBYdcOibiBUaOG7p3ksIEThu4tjaCBW4buNbmcgSOG6tdXMsIEPhuqd1IEdp4bqleSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1727251268671!5m2!1svi!2s" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <!-- Cột bên phải: Form Liên hệ -->
                    <div class="animated-element" style="transition-delay: 150ms;">
                         <h2 class="text-3xl font-bold text-gray-900 mb-6">Gửi tin nhắn</h2>
                         <form action="#" method="POST" class="space-y-6 p-8 bg-slate-50 rounded-lg border">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Họ và tên</label>
                                <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Nội dung</label>
                                <textarea id="message" name="message" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500"></textarea>
                            </div>
                            <div>
                                <button type="submit" class="w-full px-6 py-3 bg-sky-600 text-white font-semibold rounded-lg hover:bg-sky-700 transition-colors shadow-lg shadow-sky-500/20">
                                    Gửi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-public-layout>
