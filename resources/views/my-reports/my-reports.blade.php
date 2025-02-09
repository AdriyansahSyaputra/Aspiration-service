<x-users.layout :title="$title">

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-900">Laporan Saya</h1>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <input type="text" placeholder="Cari laporan..."
                            class="pl-10 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Laporan</p>
                        <p class="text-2xl font-bold">{{ $reports->count() }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-file-alt text-blue-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Pending</p>
                        <p class="text-2xl font-bold">{{ $reports->where('status', 'pending')->count() }}</p>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Dalam Proses</p>
                        <p class="text-2xl font-bold">{{ $reports->where('status', 'proses')->count() }}</p>
                    </div>
                    <div class="bg-emerald-100 p-3 rounded-full">
                        <i class="fas fa-arrows-spin text-emerald-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Selesai</p>
                        <p class="text-2xl font-bold">
                            {{ $reports->where('status', 'selesai')->count() }}
                        </p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 mb-8">
            <div class="flex flex-wrap gap-4">
                <select class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" class="text-xs md:text-base">Semua Status</option>
                    <option value="pending" class="text-xs md:text-base">Pending</option>
                    <option value="process" class="text-xs md:text-base">Proses</option>
                    <option value="done" class="text-xs md:text-base">Selesai</option>
                </select>
                <select class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" class="text-xs md:text-base">Semua Instansi</option>
                    <option value="dinas-pendidikan" class="text-xs md:text-base">Dinas Pendidikan</option>
                    <option value="dinas-kesehatan" class="text-xs md:text-base">Dinas Kesehatan</option>
                    <option value="dinas-perhubungan" class="text-xs md:text-base">Dinas Perhubungan</option>
                </select>
                <input type="date"
                    class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode
                            Laporan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Instansi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lokasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal Dibuat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($reports as $report)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $report->id }}</td>
                            <td class="py-4 w-full whitespace-pre-wrap text-sm text-gray-500">{{ $report->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $report->institution }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $report->location }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $report->created_at->format('d M Y') }}</td>  
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($report->status == 'pending')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif ($report->status == 'proses')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Proses</span>
                                @elseif ($report->status == 'selesai')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <button class="text-blue-600 hover:text-blue-800 mr-3">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <button
                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</button>
                    <button
                        class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</button>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span
                                class="font-medium">24</span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                            <button
                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">1</button>
                            <button
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">2</button>
                            <button
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">3</button>
                            <button
                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-users.layout>
