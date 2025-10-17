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
                            <p class="text-green-600">Sinh viên</p>
                        </div>
                        <div class="text-green-500 text-4xl">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>

                    <div class="bg-blue-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-blue-800">{{ $taskCount ?? 0 }}</p>
                            <p class="text-blue-600">Nhiệm vụ</p>
                        </div>
                        <div class="text-blue-500 text-4xl">
                            <i class="fas fa-tasks"></i>
                        </div>
                    </div>

                    <div class="bg-gray-200 p-6 rounded-lg shadow-md flex items-center justify-between">
                        <div>
                            <p class="text-3xl font-bold text-gray-800">{{ $weeklyReportCount ?? 0 }}</p>
                            <p class="text-gray-600">Báo cáo</p>
                        </div>
                        <div class="text-gray-500 text-4xl">
                            <i class="fas fa-book-open"></i>
                        </div>
                    </div>

                </div>

                <div class="mt-8 bg-gray-50 p-6 rounded-lg shadow-inner">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Thống kê báo cáo</h3>
                    <div id="reportsChart"></div>
                </div>

            </div>
        </div>
    </div>

    {{-- Nhúng thư viện ApexCharts --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                chart: {
                    type: 'line', // Loại biểu đồ
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Số báo cáo',
                    data: {!! $chartData !!}
                }],
                xaxis: {
                    categories: {!! $chartLabels !!}
                },
                stroke: {
                    curve: 'smooth',
                },
                title: {
                    text: 'Number of reports',
                    align: 'left'
                },
                markers: {
                    size: 5
                },
                dataLabels: {
                    enabled: false
                }
            };

            var chart = new ApexCharts(document.querySelector("#reportsChart"), options);
            chart.render();
        });
    </script>
</x-app-layout>
