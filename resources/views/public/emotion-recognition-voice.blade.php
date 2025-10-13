<x-public-layout>
    @section('title', 'AI Nhận dạng Cảm xúc qua Giọng nói - HMI Lab')

    <main>
        <section class="bg-white pt-32 pb-16 md:pt-40 md:pb-20 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <p class="text-base font-semibold text-sky-600 tracking-wider uppercase animated-element">
                    Công bố trên Tạp chí Khoa học Quốc tế
                </p>
                <h1 class="mt-2 text-3xl md:text-5xl font-extrabold text-gray-900 tracking-tight animated-element" style="transition-delay: 100ms;">
                    Mô hình AI Nhận dạng Cảm xúc qua Giọng nói với Độ chính xác Vượt trội
                </h1>
                <p class="mt-4 max-w-3xl text-lg text-gray-600 animated-element" style="transition-delay: 200ms;">
                    Giới thiệu một kiến trúc học sâu kết hợp CNN và Transformer, có khả năng diễn giải các sắc thái cảm xúc tinh vi trong giọng nói, được công bố trên tạp chí đầu ngành IEEE Transactions on Affective Computing.
                </p>
                <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3 text-gray-500 animated-element" style="transition-delay: 300ms;">
                    <div class="flex items-center space-x-2">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span>Tác giả chính: <strong>Ma Thị Châu, và cộng sự</strong></span>
                    </div>
                    <span class="hidden md:block">|</span>
                    <div class="flex items-center space-x-2">
                         <i data-lucide-="book-open-check" class="w-5 h-5"></i>
                         <span>Tạp chí: IEEE Transactions on Affective Computing</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-12">

                <div class="lg:col-span-2 space-y-12 animated-element">
                    <figure>
                        <img src="{{ asset('storage/image/emotion-spectrogram.jpg') }}" alt="Phổ âm thanh của các cảm xúc khác nhau" class="rounded-lg shadow-lg">
                        <figcaption class="mt-3 text-sm text-center text-gray-500">Hình 1: Hệ thống chuyển đổi tín hiệu âm thanh thành ảnh phổ (spectrogram) để phân tích bằng các mô hình thị giác máy tính.</figcaption>
                    </figure>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">1. Thách thức trong việc "lắng nghe" cảm xúc</h2>
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            <p>
                                Giọng nói con người không chỉ chứa đựng thông tin ngữ nghĩa mà còn là một kênh biểu đạt cảm xúc vô cùng phong phú, từ tông điệu, tốc độ, đến cường độ. Việc máy móc có thể "thấu cảm", tức là nhận biết chính xác các trạng thái cảm xúc như vui, buồn, tức giận, hay ngạc nhiên, là chìa khóa để xây dựng các hệ thống tương tác người-máy thực sự thông minh và tự nhiên. Tuy nhiên, đây là một bài toán phức tạp do sự đa dạng trong cách biểu đạt của mỗi cá nhân và sự tinh vi của các tín hiệu âm thanh. Dự án này giải quyết thách thức đó bằng một phương pháp tiếp cận mới, hiệu quả hơn.
                            </p>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">2. Kiến trúc Mạng Nơ-ron kết hợp CNN và Transformer</h2>
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                            <p>
                                Phương pháp của chúng tôi không xử lý trực tiếp sóng âm mà chuyển đổi các đoạn âm thanh thành ảnh phổ (spectrogram) - một dạng biểu diễn 2D cho thấy sự thay đổi tần số theo thời gian. Cách tiếp cận này cho phép chúng tôi tận dụng sức mạnh của các mô hình thị giác máy tính. Kiến trúc lõi của mô hình bao gồm:
                            </p>
                            <ul>
                                <li><strong>Mạng Nơ-ron Tích chập (CNN):</strong> Lớp CNN hoạt động như một bộ trích xuất đặc trưng mạnh mẽ, có khả năng nhận diện các "họa tiết" cục bộ trên ảnh phổ, tương ứng với các đặc điểm âm học quan trọng như formant, pitch contour, và năng lượng.</li>
                                <li><strong>Kiến trúc Transformer (Encoder):</strong> Sau khi trích xuất các đặc trưng cục bộ, chúng tôi sử dụng cơ chế tự chú ý (self-attention) của Transformer để nắm bắt các mối quan hệ ngữ cảnh và phụ thuộc dài hạn trong chuỗi lời nói. Điều này giúp mô hình hiểu được cách các đặc trưng âm học kết hợp với nhau theo thời gian để tạo nên một biểu cảm hoàn chỉnh.</li>
                            </ul>
                            <p>Sự kết hợp này cho phép mô hình vừa "nhìn" thấy các chi tiết âm thanh tinh vi, vừa "hiểu" được ngữ cảnh của toàn bộ câu nói, mang lại độ chính xác vượt trội.</p>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">3. Kết quả Thực nghiệm và Ứng dụng Tiềm năng</h2>
                        <ul class="space-y-6">
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-7 h-7 text-green-500 mr-4 mt-1 flex-shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Hiệu năng hàng đầu trên các bộ dữ liệu chuẩn</h3>
                                    <p class="text-gray-700">Mô hình đạt độ chính xác 85.3% trên bộ dữ liệu IEMOCAP và 92.1% trên RAVDESS, vượt qua nhiều phương pháp hiện đại khác và thiết lập một chuẩn mực mới trong lĩnh vực.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-7 h-7 text-green-500 mr-4 mt-1 flex-shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Khả năng khái quát hóa đa ngôn ngữ</h3>
                                    <p class="text-gray-700">Do tập trung vào các đặc trưng âm học cơ bản thay vì ngữ nghĩa, mô hình cho thấy khả năng hoạt động tốt trên nhiều ngôn ngữ khác nhau mà không cần huấn luyện lại từ đầu.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i data-lucide="check-circle-2" class="w-7 h-7 text-green-500 mr-4 mt-1 flex-shrink-0"></i>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Tiềm năng ứng dụng rộng rãi</h3>
                                    <p class="text-gray-700">Công nghệ này có thể được ứng dụng để cải thiện trợ lý ảo, phân tích phản hồi khách hàng trong tổng đài, hỗ trợ chẩn đoán sớm các bệnh về tâm lý, hoặc tạo ra các nhân vật game có khả năng tương tác cảm xúc thông minh hơn.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <aside class="space-y-8 animated-element" style="transition-delay: 150ms;">
                    <div class="bg-white p-6 rounded-lg shadow-lg border">
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-3 mb-4">Thông tin Công bố</h3>
                        <div class="space-y-4 text-gray-700">
                             <div class="flex items-start space-x-3">
                                <i data-lucide="book-open-check" class="w-5 h-5 text-sky-600 flex-shrink-0 mt-1"></i>
                                <div>
                                    <strong>Tạp chí:</strong> IEEE Transactions on Affective Computing (Q1, Impact Factor: 13.99)
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i data-lucide="calendar" class="w-5 h-5 text-sky-600 flex-shrink-0 mt-1"></i>
                                <div>
                                    <strong>Ngày xuất bản:</strong> Quý 4, 2025
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 space-y-3">
                           <a href="https://ieeexplore.ieee.org/document/8898595" target="_blank" rel="noopener noreferrer" class="w-full flex items-center justify-center bg-sky-600 text-white font-semibold px-5 py-3 rounded-lg hover:bg-sky-700 transition-all duration-300">
                               <i data-lucide="file-text" class="w-5 h-5 mr-2"></i> Đọc Toàn văn (Preprint)
                           </a>
                           <a href="#" class="w-full flex items-center justify-center bg-gray-800 text-white font-semibold px-5 py-3 rounded-lg hover:bg-gray-900 transition-all duration-300">
                               <i data-lucide="github" class="w-5 h-5 mr-2"></i> Xem Mã nguồn
                           </a>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-lg border">
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-3 mb-4">Lĩnh vực và Từ khóa</h3>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Nhận dạng Cảm xúc</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Xử lý Tiếng nói</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Học sâu</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Affective Computing</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Transformer</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Spectrogram</span>
                            <span class="bg-sky-100 text-sky-800 text-sm font-medium px-3 py-1 rounded-full">Trí tuệ Nhân tạo</span>
                        </div>
                    </div>
                </aside>
            </div>
        </section>
    </main>
</x-public-layout>
