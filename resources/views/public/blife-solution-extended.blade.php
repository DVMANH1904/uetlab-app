<x-public-layout>
    @section('title', 'Giải pháp BLife: Công nghệ và Y học - HMI Lab')

    <main>
        <section class="bg-white pt-32 pb-16 md:pt-40 md:pb-20 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-base font-semibold text-sky-600 tracking-wider uppercase animated-element">
                    Hội thảo Công nghệ & Y học
                </p>
                <h1 class="mt-2 text-3xl md:text-5xl font-extrabold text-gray-900 tracking-tight animated-element" style="transition-delay: 100ms;">
                    Giải pháp BLife: Phá vỡ rào cản giao tiếp cho người khuyết tật vận động
                </h1>
                <p class="mt-4 max-w-3xl text-lg text-gray-600 animated-element" style="transition-delay: 200ms;">
                    Một hệ sinh thái công nghệ hỗ trợ toàn diện, kết hợp tương tác mắt và giao diện não-máy, được công nhận bằng Bằng sáng chế độc quyền tại Việt Nam.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3 text-gray-500 animated-element" style="transition-delay: 300ms;">
                    <div class="flex items-center space-x-2">
                        <i data-lucide="user-check" class="w-5 h-5"></i>
                        <span>Trình bày bởi: <strong>PGS. TS. Lê Thanh Hà</strong></span>
                    </div>
                    <span class="hidden md:block">|</span>
                    <div class="flex items-center space-x-2">
                         <i data-lucide="book-open" class="w-5 h-5"></i>
                         <span>Nguồn tham khảo: Tạp chí KH&CN Việt Nam</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-12">

                <div class="lg:col-span-2 space-y-12 animated-element">
                    <figure>
                        <img src="{{ asset('storage/image/Blife.jpg') }}" alt="Kiến trúc hệ thống BLife" class="rounded-lg shadow-lg">
                        <figcaption class="mt-3 text-sm text-center text-gray-500">Hình 1: Kiến trúc tổng quan của hệ thống BLife, từ thu nhận tín hiệu đến điều khiển thiết bị.</figcaption>
                    </figure>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Bối cảnh và Thách thức</h2>
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            <p>
                                Tại Việt Nam và trên thế giới, hàng triệu người đang sống với những tổn thương nghiêm trọng về chức năng vận động do tai biến, bệnh lý thần kinh cơ (ALS), hoặc chấn thương cột sống. Họ đối mặt với thách thức khổng lồ trong việc giao tiếp với người thân và tương tác với thế giới xung quanh, dẫn đến sự cô lập và suy giảm chất lượng cuộc sống. Các giải pháp truyền thống thường đắt đỏ, khó tiếp cận và chưa đáp ứng được nhu cầu tương tác phức tạp. Nhận thấy khoảng trống này, Phòng thí nghiệm Tương tác Người-máy đã nghiên cứu và phát triển <strong>BLife</strong>, một giải pháp công nghệ toàn diện "Made in Vietnam".
                            </p>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Kiến trúc Hệ thống và Công nghệ Lõi</h2>
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            <p>
                                BLife được xây dựng trên một kiến trúc module linh hoạt, kết hợp nhiều công nghệ phần cứng và phần mềm tiên tiến:
                            </p>
                            <ul>
                                <li><strong>Module Thu nhận Tín hiệu:</strong> Sử dụng các thiết bị Eye-Tracker thương mại và bộ thu tín hiệu điện não (EEG) không xâm lấn để ghi lại dữ liệu đầu vào từ người dùng một cách chính xác.</li>
                                <li><strong>Module Xử lý và Giải mã:</strong> Đây là "bộ não" của hệ thống, nơi các thuật toán học máy và xử lý tín hiệu số hoạt động. Các tín hiệu mắt được chuyển thành tọa độ con trỏ, trong khi tín hiệu EEG (cụ thể là P300 Speller) được giải mã để nhận diện ký tự mà người dùng đang tập trung vào.</li>
                                <li><strong>Module Giao diện và Tương tác:</strong> Một giao diện đồ họa trực quan hiển thị bàn phím ảo, các biểu tượng điều khiển và văn bản soạn thảo. Giao diện được thiết kế với độ tương phản cao và bố cục tối ưu cho việc điều khiển bằng mắt.</li>
                                <li><strong>Module Điều khiển Ngoại vi:</strong> Giao tiếp với các thiết bị nhà thông minh qua các giao thức phổ biến như Wi-Fi, Zigbee để thực thi mệnh lệnh của người dùng.</li>
                            </ul>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Các Tính năng và Đóng góp Đột phá</h2>
                        <ul class="space-y-6">
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-7 h-7 text-green-500 mr-4 mt-1 flex-shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Tương tác bằng mắt chính xác (Eye-Gaze Interaction)</h3>
                                    <p class="text-gray-700">Cho phép người dùng điều khiển con trỏ chuột ảo trên màn hình với độ chính xác cao. Bằng cách tập trung ánh nhìn vào một phím hoặc một biểu tượng trong một khoảng thời gian ngắn (dwell time), người dùng có thể thực hiện thao tác "click", giúp họ soạn thảo văn bản, lướt web và sử dụng các ứng dụng cơ bản.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-7 h-7 text-green-500 mr-4 mt-1 flex-shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Hỗ trợ soạn thảo thông minh dựa trên ET-BCI</h3>
                                    <p class="text-gray-700">Đây là sự kết hợp độc đáo giữa theo dõi mắt (Eye-Tracking) và Giao diện Não-Máy (BCI). Trong khi người dùng dùng mắt để chọn ký tự, hệ thống BCI sẽ phân tích tín hiệu não để dự đoán từ mà họ đang định gõ. Một mô hình ngôn ngữ sẽ đưa ra các gợi ý phù hợp, giúp giảm số lần thao tác và tăng tốc độ gõ chữ lên tới 30-40% so với chỉ dùng mắt.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-7 h-7 text-green-500 mr-4 mt-1 flex-shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Điều khiển Hệ sinh thái Nhà thông minh (Smart Home Control)</h3>
                                    <p class="text-gray-700">BLife không chỉ là một công cụ giao tiếp mà còn là một trung tâm điều khiển. Người dùng có thể truy cập vào một giao diện chuyên biệt để bật/tắt đèn, quạt, TV, điều hòa... chỉ bằng ánh mắt. Điều này trao lại cho họ khả năng kiểm soát môi trường sống, một phần quan trọng của sự độc lập cá nhân.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="award" class="w-7 h-7 text-amber-500 mr-4 mt-1 flex-shrink-0"></i>
                                <div>
                                     <h3 class="font-semibold text-lg text-gray-800">Được cấp Bằng sáng chế Độc quyền tại Việt Nam</h3>
                                    <p class="text-gray-700">Thành tựu quan trọng nhất là việc giải pháp BLife đã được Cục Sở hữu trí tuệ Việt Nam cấp bằng sáng chế. Điều này không chỉ bảo hộ cho sản phẩm mà còn là sự công nhận chính thức về tính mới, tính sáng tạo và khả năng ứng dụng công nghiệp của công trình, khẳng định năng lực nghiên cứu đỉnh cao của phòng thí nghiệm.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Video Giới thiệu Giải pháp BLife</h2>
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe class="rounded-lg shadow-lg w-full" style="aspect-ratio: 16/9;"
                                src="https://www.youtube.com/embed/imUZvaAHeY8"
                                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                            </iframe>
                        </div>
                        <figcaption class="mt-3 text-sm text-center text-gray-500">Video: Giới thiệu về cách BLife hỗ trợ người khuyết tật vận động.</figcaption>
                    </div>

                </div>

                <aside class="space-y-8 animated-element" style="transition-delay: 150ms;">
                    <div class="bg-white p-6 rounded-lg shadow-lg border">
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-3 mb-4">Thông tin Công bố</h3>
                        <div class="space-y-4 text-gray-700">
                             <div class="flex items-start space-x-3">
                                <i data-lucide="presentation" class="w-5 h-5 text-sky-600 flex-shrink-0 mt-1"></i>
                                <div>
                                    <strong>Sự kiện:</strong> Hội thảo “Công nghệ và Y học: giải pháp nâng cao chất lượng sống”
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i data-lucide="award" class="w-5 h-5 text-sky-600 flex-shrink-0 mt-1"></i>
                                <div>
                                    <strong>Sở hữu trí tuệ:</strong> Bằng sáng chế độc quyền, Cục SHTT Việt Nam
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 space-y-3">
                           <a href="#" class="w-full flex items-center justify-center bg-sky-600 text-white font-semibold px-5 py-3 rounded-lg hover:bg-sky-700 transition-all duration-300">
                               <i data-lucide="file-text" class="w-5 h-5 mr-2"></i> Đọc bài báo liên quan
                           </a>
                           <a href="#" class="w-full flex items-center justify-center bg-gray-800 text-white font-semibold px-5 py-3 rounded-lg hover:bg-gray-900 transition-all duration-300">
                               <i data-lucide="info" class="w-5 h-5 mr-2"></i> Xem thông tin Sáng chế
                           </a>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-lg border">
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-3 mb-4">Lĩnh vực và Từ khóa</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Công nghệ Hỗ trợ</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Giao diện Não-Máy</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Tương tác bằng mắt</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Xử lý tín hiệu EEG</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Học máy</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Nhà thông minh</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Y tế số</span>
                        </div>
                    </div>
                </aside>

            </div>
        </section>
    </main>
</x-public-layout>
