<x-users.layout :title="$title">

    <div class="container mx-auto px-4 py-8 md:px-8 lg:px-16">
        <!-- Search Bar dan Filter -->
        <div class="bg-white p-6 rounded-xl shadow-md mb-8">

            <div class="flex flex-col md:flex-row md:justify-between gap-4">
                <form method="GET" action="{{ route('explore.search') }}">
                    <!-- Search Bar -->
                    <div class="flex relative gap-4">
                        <input type="text" id="search" name="search" placeholder="Cari laporan..."
                            value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>

                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                            Search
                        </button>
                    </div>
                </form>

                <form id="filter-form" action="{{ route('explore.filter') }}" method="GET"
                    class="w-full md:w-auto flex flex-col md:flex-row gap-2">
                    <!-- Dropdown Filter (Instansi) -->
                    <select id="instansi" name="instansi"
                        class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" class="text-xs md:text-base">Semua Instansi</option>
                        <option value="Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi"
                            {{ request('instansi') === 'Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi' ? 'selected' : '' }}
                            class="text-xs md:text-base">
                            Kementerian Pendidikan
                        </option>
                        <option value="Kementerian Kesehatan"
                            {{ request('instansi') === 'Kementerian Kesehatan' ? 'selected' : '' }}
                            class="text-xs md:text-base">
                            Kementerian Kesehatan
                        </option>
                        <option value="Kementerian Lingkungan Hidup dan Kehutanan"
                            {{ request('instansi') === 'Kementerian Lingkungan Hidup dan Kehutanan' ? 'selected' : '' }}
                            class="text-xs md:text-base">
                            Kementerian Lingkungan Hidup
                        </option>
                        <option value="Kementerian Perhubungan"
                            {{ request('instansi') === 'Kementerian Perhubungan' ? 'selected' : '' }}
                            class="text-xs md:text-base">
                            Kementerian Perhubungan
                        </option>
                        <option value="Kementerian Sosial"
                            {{ request('instansi') === 'Kementerian Sosial' ? 'selected' : '' }}
                            class="text-xs md:text-base">
                            Kementerian Sosial
                        </option>
                    </select>

                    <select id="sort" name="sort"
                        class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="terbaru" {{ request('sort') === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('sort') === 'terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>

                </form>
            </div>

        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <i class="fas fa-clipboard-list text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm">Total Aspirasi</h3>
                        <p class="text-2xl font-semibold">1,234</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 rounded-full">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm">Aspirasi Selesai</h3>
                        <p class="text-2xl font-semibold">789</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-100 rounded-full">
                        <i class="fas fa-clock text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-gray-500 text-sm">Dalam Proses</h3>
                        <p class="text-2xl font-semibold">445</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aspirations Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($aspirations as $aspiration)
                <!-- Aspiration Card -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <img src="{{ $aspiration->attachment ? asset('storage/' . $aspiration->attachment) : asset('img/banner/aspirasi.jpg') }}"
                        alt="Laporan" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-sm text-gray-500 mb-1">#{{ $aspiration->id }}</p>
                                <h3 class="text-xl font-semibold mb-2">{{ $aspiration->title }}</h3>
                                <p class="text-sm text-gray-500 mb-4">
                                    {{ \Carbon\Carbon::parse($aspiration->date_occurred)->format('d M Y') }}</p>
                            </div>
                            <button class="text-gray-400 hover:text-blue-500">
                                <i class="far fa-bookmark text-xl"></i>
                            </button>
                        </div>
                        <p class="text-gray-600 mb-4 line-clamp-3">{{ $aspiration->aspiration }}</p>
                        <div class="flex justify-between items-center">
                            @if ($aspiration->status == 'selesai')
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Selesai</span>
                            @elseif($aspiration->status == 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">Dalam
                                    Proses</span>
                            @else
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">Pending</span>
                            @endif

                            <button class="text-blue-500 hover:text-blue-600">
                                Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 capitalize col-span-full">Aspirasi berdasarkan
                    "{{ request('search') }}" tidak ditemukan</p>
            @endforelse
        </div>


        <!-- Pagination -->
        <div class="flex justify-center mt-8">
            <nav class="flex gap-2">
                <button class="px-3 py-1 border rounded-lg hover:bg-gray-50">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="px-3 py-1 border rounded-lg bg-blue-500 text-white">1</button>
                <button class="px-3 py-1 border rounded-lg hover:bg-gray-50">2</button>
                <button class="px-3 py-1 border rounded-lg hover:bg-gray-50">3</button>
                <button class="px-3 py-1 border rounded-lg hover:bg-gray-50">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </nav>
        </div>
    </div>

    <script>
        // Toggle bookmark
        document.querySelectorAll('.fa-bookmark').forEach(icon => {
            icon.addEventListener('click', function() {
                this.classList.toggle('fas');
                this.classList.toggle('far');
            });
        });

        document.getElementById('instansi').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });

        document.getElementById('sort').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });
    </script>


</x-users.layout>
