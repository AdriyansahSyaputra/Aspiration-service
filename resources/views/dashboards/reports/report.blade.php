<x-dashboard.layout>

    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Manajemen Laporan</h1>
            <div class="flex items-center gap-4">
                <form action="{{ route('reports.search') }}" method="GET">
                    <div class="relative">
                        <input type="text" placeholder="Cari laporan..." name="search"
                            class="w-full md:w-64 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <button type="submit" class="absolute right-3 top-2 text-gray-400">
                            <i class="fas fa-search "></i>
                        </button>
                    </div>
                </form>

                <form id="filter-form" action="{{ route('reports.status') }}" method="GET">
                    <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        name="status" id="status">
                        <option value="" class="text-xs md:text-base">Semua</option>
                        <option value="selesai" class="text-xs md:text-base"
                            {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="pending" class="text-xs md:text-base"
                            {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" class="text-xs md:text-base"
                            {{ request('status') === 'proses' ? 'selected' : '' }}>Proses</option>
                    </select>
                </form>

            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Total Laporan</p>
                        <p class="text-2xl font-bold">{{ $reports->count() }}</p>
                    </div>
                    <i class="fas fa-file-alt text-3xl text-blue-500"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Selesai</p>
                        <p class="text-2xl font-bold">{{ $reports->where('status', 'selesai')->count() }}</p>
                    </div>
                    <i class="fas fa-check-circle text-3xl text-green-500"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Proses</p>
                        <p class="text-2xl font-bold">{{ $reports->where('status', 'proses')->count() }}</p>
                    </div>
                    <i class="fas fa-arrows-spin text-3xl text-green-500"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Pending</p>
                        <p class="text-2xl font-bold">{{ $reports->where('status', 'pending')->count() }}</p>
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
                        @forelse ($reports as $report)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-sm">{{ $report->id }}</td>
                                <td class="px-6 py-4 text-sm">{{ $report->user->name }}</td>
                                <td class="px-6 py-4 text-sm">{{ $report->title }}</td>
                                <td class="px-6 py-4 uppercase text-sm">{{ $report->institution }}</td>
                                <td class="px-6 py-4 text-sm">{{ $report->date_occurred }}</td>
                                <td class="px-6 py-4">
                                    @if ($report->status === 'pending')
                                        <span
                                            class="px-2 py-1 text-sm rounded-full bg-red-100 text-red-800">Pending</span>
                                    @elseif($report->status === 'proses')
                                        <span
                                            class="px-2 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">Proses</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-sm rounded-full bg-green-100 text-green-800">Selesai</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 relative">
                                    <button class="action-btn">
                                        <i class="fas fa-ellipsis-v text-gray-500 hover:text-blue-500"></i>
                                    </button>
                                    <div
                                        class="action-menu hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-20">
                                        <a href="{{ route('reports.show', $report->slug) }}"
                                            class="w-full block px-4 py-2 text-left hover:bg-gray-100">
                                            <i class="fas fa-eye mr-2 text-blue-500"></i>Lihat Detail
                                        </a>

                                        <form action="{{ route('report.destroy', $report->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button class="w-full px-4 py-2 text-left hover:bg-gray-100">
                                                <i class="fas fa-trash mr-2 text-red-500"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500 capitalize">
                                    data laporan "{{ request('search') }}" tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
        <div class="mt-4">
            {{ $reports->links() }}
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

        document.getElementById('status').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
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
