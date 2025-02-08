<x-dashboard.layout>

    <main class="flex-1 p-4">
        <!-- Bagian 1: 4 Card Informasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card Jumlah User -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md">
                <h3 class="text-gray-500 text-sm font-semibold">Jumlah User</h3>
                <p class="text-2xl font-bold text-blue-600">1,234</p>
                <p class="text-gray-400 text-sm">+5.2% dari bulan lalu</p>
            </div>

            <!-- Card Total Pesan -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md">
                <h3 class="text-gray-500 text-sm font-semibold">Total Pesan</h3>
                <p class="text-2xl font-bold text-green-600">567</p>
                <p class="text-gray-400 text-sm">+12% dari bulan lalu</p>
            </div>

            <!-- Card Pesan Selesai -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md">
                <h3 class="text-gray-500 text-sm font-semibold">Pesan Selesai</h3>
                <p class="text-2xl font-bold text-purple-600">450</p>
                <p class="text-gray-400 text-sm">+8% dari bulan lalu</p>
            </div>

            <!-- Card Pesan Pending -->
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md">
                <h3 class="text-gray-500 text-sm font-semibold">Pesan Pending</h3>
                <p class="text-2xl font-bold text-red-600">117</p>
                <p class="text-gray-400 text-sm">-3% dari bulan lalu</p>
            </div>
        </div>

        <!-- Bagian 2: Dua Chart -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Chart Kiri: Statistik -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Statistik Status Laporan</h3>
                <div class="flex items-center justify-between">
                    <div class="w-48 h-48">
                        <canvas id="statusChart"></canvas>
                    </div>

                    <!-- Legenda -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <div>
                                <p class="text-gray-600 font-medium">Selesai</p>
                                <p class="text-xl font-bold text-gray-800">65%</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div>
                                <p class="text-gray-600 font-medium">Proses</p>
                                <p class="text-xl font-bold text-gray-800">25%</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div>
                                <p class="text-gray-600 font-medium">Pending</p>
                                <p class="text- xl font-bold text-gray-800">10%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Kanan: Analisis -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Analisis Bulanan</h3>
                <canvas id="analisisChart" class="w-full h-64"></canvas>
            </div>
        </div>

        <!-- Bagian 3: Tabel Laporan Terbaru -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Laporan Terbaru</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left text-sm text-gray-600">No</th>
                            <th class="py-2 px-4 border-b text-left text-sm text-gray-600">Kode Laporan</th>
                            <th class="py-2 px-4 border-b text-left text-sm text-gray-600">Nama User</th>
                            <th class="py-2 px-4 border-b text-left text-sm text-gray-600">Judul Laporan</th>
                            <th class="py-2 px-4 border-b text-left text-sm text-gray-600">Tanggal</th>
                            <th class="py-2 px-4 border-b text-left text-sm text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $report->id }}</td>
                            <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $report->user->name }}</td>
                            <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $report->title }}</td>
                            <td class="py-2 px-4 border-b text-sm text-gray-700">{{ $report->date_occurred }}</td>
                            <td class="py-2 px-4 border-b">
                                @if($report->status === 'selesai')
                                <span class="text-green-600 text-sm font-semibold">Selesai</span>
                                @elseif($report->status === 'proses')
                                <span class="text-yellow-600 text-sm font-semibold">Proses</span>
                                @else
                                <span class="text-red-600 text-sm font-semibold">Pending</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    </div>

    <!-- Script untuk Chart.js -->
    <script>
        // Chart Status (Doughnut)
        const statusChart = new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Proses', 'Pending'],
                datasets: [{
                    data: [65, 25, 10],
                    backgroundColor: ['#10B981', '#F59E0B', '#EF4444'],
                    borderWidth: 0,
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Chart Analisis (Bar)
        const analisisChart = new Chart(document.getElementById('analisisChart'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Laporan Masuk',
                    data: [45, 60, 75, 55, 80, 95],
                    backgroundColor: '#3B82F6',
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#E5E7EB'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>

</x-dashboard.layout>
