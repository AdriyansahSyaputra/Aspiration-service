<x-dashboard.layout>

    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Manajemen Laporan</h1>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <input type="text" placeholder="Cari laporan..."
                        class="w-full md:w-64 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                </div>
                <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Filter Status</option>
                    <option>Semua</option>
                    <option>Selesai</option>
                    <option>Pending</option>
                    <option>Proses</option>
                </select>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Total Laporan</p>
                        <p class="text-2xl font-bold">124</p>
                    </div>
                    <i class="fas fa-file-alt text-3xl text-blue-500"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Selesai</p>
                        <p class="text-2xl font-bold">89</p>
                    </div>
                    <i class="fas fa-check-circle text-3xl text-green-500"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Proses</p>
                        <p class="text-2xl font-bold">77</p>
                    </div>
                    <i class="fas fa-arrows-spin text-3xl text-green-500"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Pending</p>
                        <p class="text-2xl font-bold">15</p>
                    </div>
                    <i class="fas fa-clock text-3xl text-yellow-500"></i>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode Laporan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Instansi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Sample Data -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm">1</td>
                            <td class="px-6 py-4 font-medium text-sm">LP-001</td>
                            <td class="px-6 py-4 text-sm">John Doe</td>
                            <td class="px-6 py-4 text-sm">Permasalahan jaringan</td>
                            <td class="px-6 py-4 uppercase text-sm">Komdigi</td>
                            <td class="px-6 py-4 text-sm">2023-08-15</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-sm rounded-full bg-green-100 text-green-800">Selesai</span>
                            </td>
                            <td class="px-6 py-4 relative">
                                <button class="action-btn">
                                    <i class="fas fa-ellipsis-v text-gray-500 hover:text-blue-500"></i>
                                </button>
                                <div
                                    class="action-menu hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-20">
                                    <button class="w-full px-4 py-2 text-left hover:bg-gray-100">
                                        <i class="fas fa-eye mr-2 text-blue-500"></i>Lihat Detail
                                    </button>
                                    <button class="w-full px-4 py-2 text-left hover:bg-gray-100">
                                        <i class="fas fa-trash mr-2 text-red-500"></i>Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Dropdown Handling
        document.querySelectorAll('.action-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const menu = button.nextElementSibling;
                document.querySelectorAll('.action-menu').forEach(otherMenu => {
                    if (otherMenu !== menu) otherMenu.classList.add('hidden');
                });
                menu.classList.toggle('hidden');
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.action-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
        });

        // Sample Search Functionality
        document.querySelector('input[type="text"]').addEventListener('input', (e) => {
            console.log('Search:', e.target.value);
            // Implement search logic here
        });

        // Sample Filter Functionality
        document.querySelector('select').addEventListener('change', (e) => {
            console.log('Filter:', e.target.value);
            // Implement filter logic here
        });
    </script>

    <style>
        /* Additional Custom Styles */
        .action-menu {
            transition: all 0.3s ease;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }
    </style>

</x-dashboard.layout>
