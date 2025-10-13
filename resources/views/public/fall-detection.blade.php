<x-public-layout>
    @section('title', 'Dự án Phát hiện người ngã - HMI Lab')

    <main>
        <section class="bg-white pt-32 pb-16 md:pt-40 md:pb-20 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-base font-semibold text-sky-600 tracking-wider uppercase animated-element">
                    Dự án Nghiên cứu Ứng dụng
                </p>
                <h1 class="mt-2 text-3xl md:text-5xl font-extrabold text-gray-900 tracking-tight animated-element" style="transition-delay: 100ms;">
                    Hệ thống Phát hiện người ngã Tự động qua Camera Giám sát
                </h1>
                <p class="mt-4 max-w-3xl text-lg text-gray-600 animated-element" style="transition-delay: 200ms;">
                    Ứng dụng Thị giác máy tính và Trí tuệ nhân tạo để bảo vệ sức khỏe người cao tuổi một cách kín đáo, hiệu quả và không cần thiết bị đeo chuyên dụng.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3 text-gray-500 animated-element" style="transition-delay: 300ms;">
                    <div class="flex items-center space-x-2">
                        <i data-lucide="building" class="w-5 h-5"></i>
                        <span>Chủ trì: <strong>Phòng thí nghiệm Tương tác Người-Máy, ĐHCN</strong></span>
                    </div>
                    <span class="hidden md:block">|</span>
                    <div class="flex items-center space-x-2">
                         <i data-lucide="check-badge" class="w-5 h-5"></i>
                         <span>Tình trạng: Đã hoàn thành & Sẵn sàng chuyển giao</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-12">

                <div class="lg:col-span-2 space-y-12 animated-element">
                    <figure>
                        <img src="{{ asset('storage/image/fall-detection-system.jpg') }}" alt="Sơ đồ hệ thống phát hiện người ngã" class="rounded-lg shadow-lg">
                        <figcaption class="mt-3 text-sm text-center text-gray-500">Hình 1: Hệ thống phân tích luồng video từ camera để xác định các tư thế và chuyển động bất thường.</figcaption>
                    </figure>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Vấn đề Cấp thiết trong Chăm sóc Sức khỏe</h2>
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            <p>
                                Ngã là một trong những tai nạn phổ biến và nguy hiểm nhất đối với người cao tuổi, thường dẫn đến các chấn thương nghiêm trọng và ảnh hưởng lâu dài đến sức khỏe. Việc phát hiện sớm và can thiệp kịp thời trong "giờ vàng" sau khi ngã là yếu tố sống còn. Tuy nhiên, các giải pháp truyền thống như nút bấm khẩn cấp hay thiết bị đeo tay thông minh có những hạn chế: người dùng có thể quên đeo, hết pin, hoặc không thể nhấn nút khi bất tỉnh. Dự án này ra đời nhằm giải quyết triệt để những vấn đề đó bằng một giải pháp giám sát tự động, thông minh và không xâm lấn.
                            </p>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Phương pháp Tiếp cận và Công nghệ Cốt lõi</h2>
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            <p>
                                Hệ thống hoạt động dựa trên việc phân tích luồng video theo thời gian thực từ các camera IP thông thường. Công nghệ lõi của dự án bao gồm:
                            </p>
                            <ul>
                                <li><strong>Phát hiện và Ước lượng Tư thế (Pose Estimation):</strong> Sử dụng các mô hình học sâu tiên tiến để xác định vị trí các khớp xương chính của con người trong mỗi khung hình, tạo ra một bộ khung xương ảo (skeleton).</li>
                                <li><strong>Phân tích Chuỗi Chuyển động:</strong> Hệ thống không chỉ phân tích một khung hình đơn lẻ mà theo dõi sự thay đổi của bộ khung xương ảo qua nhiều khung hình liên tiếp. Các đặc trưng quan trọng như vận tốc trọng tâm cơ thể, thay đổi chiều cao đột ngột, và hướng của vector chuyển động được trích xuất.</li>
                                <li><strong>Mô hình Phân loại Hành vi:</strong> Một mô hình AI (sử dụng kiến trúc kết hợp CNN và Mạng hồi quy LSTM) được huấn luyện trên một tập dữ liệu lớn bao gồm các video về hành vi ngã và các hoạt động thường ngày (đi, đứng, ngồi, nằm). Mô hình này học cách phân biệt chính xác giữa một cú ngã thực sự và các hành động tương tự để giảm thiểu báo động giả.</li>
                                <li><strong>Hệ thống Cảnh báo Tức thì:</strong> Khi một hành vi được xác định là ngã, hệ thống sẽ ngay lập tức gửi cảnh báo đến người thân hoặc nhân viên y tế qua ứng dụng di động, email hoặc tin nhắn SMS, kèm theo một đoạn video ngắn về khoảnh khắc xảy ra sự việc.</li>
                            </ul>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Kết quả, Hiệu quả và Tiềm năng Ứng dụng</h2>
                        <ul class="space-y-6">
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-7 h-7 text-green-500 mr-4 mt-1 flex-shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Độ chính xác cao và Tin cậy</h3>
                                    <p class="text-gray-700">Qua các thử nghiệm trong môi trường thực tế, hệ thống đạt độ chính xác phát hiện ngã trên 95% và giữ tỷ lệ báo động giả ở mức thấp, đảm bảo tính tin cậy khi vận hành.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-7 h-7 text-green-500 mr-4 mt-1 flex-shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Hoàn toàn Tự động và Không Xâm lấn</h3>
                                    <p class="text-gray-700">Người dùng không cần đeo bất kỳ thiết bị nào, loại bỏ sự bất tiện và đảm bảo giám sát 24/7. Hệ thống tôn trọng sự riêng tư bằng cách chỉ lưu trữ và gửi đi dữ liệu khi phát hiện sự cố.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-7 h-7 text-green-500 mr-4 mt-1 flex-shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Khả năng Tích hợp và Mở rộng</h3>
                                    <p class="text-gray-700">Giải pháp có thể dễ dàng tích hợp vào các hệ thống camera giám sát (CCTV) hiện có tại các gia đình, bệnh viện, viện dưỡng lão, mở ra tiềm năng ứng dụng rộng rãi với chi phí hợp lý.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <aside class="space-y-8 animated-element" style="transition-delay: 150ms;">
                    <div class="bg-white p-6 rounded-lg shadow-lg border">
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-3 mb-4">Thông tin Dự án</h3>
                        <div class="space-y-4 text-gray-700">
                             <div class="flex items-start space-x-3">
                                <i data-lucide="lightbulb" class="w-5 h-5 text-sky-600 flex-shrink-0 mt-1"></i>
                                <div>
                                    <strong>Lĩnh vực:</strong> Thị giác Máy tính, AI trong Y tế
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i data-lucide="target" class="w-5 h-5 text-sky-600 flex-shrink-0 mt-1"></i>
                                <div>
                                    <strong>Ứng dụng:</strong> Gia đình, Bệnh viện, Viện dưỡng lão, Trung tâm phục hồi chức năng
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 space-y-3">
                           <a href="#" class="w-full flex items-center justify-center bg-sky-600 text-white font-semibold px-5 py-3 rounded-lg hover:bg-sky-700 transition-all duration-300">
                               <i data-lucide="play-circle" class="w-5 h-5 mr-2"></i> Xem Demo Kỹ thuật
                           </a>
                           <a href="#" class="w-full flex items-center justify-center bg-gray-800 text-white font-semibold px-5 py-3 rounded-lg hover:bg-gray-900 transition-all duration-300">
                               <i data-lucide="send" class="w-5 h-5 mr-2"></i> Liên hệ Chuyển giao
                           </a>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-lg border">
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-3 mb-4">Lĩnh vực và Từ khóa</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Phát hiện ngã</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Thị giác Máy tính</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Xử lý ảnh</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Học sâu</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Chăm sóc sức khỏe</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Người cao tuổi</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Giám sát thông minh</span>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>
</x-public-layout>
