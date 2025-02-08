<x-dashboard.layout>

    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Manajemen User</h1>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <input type="text" placeholder="Cari user..."
                        class="w-full md:w-64 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                </div>
                <select class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Filter Status</option>
                    <option>Semua</option>
                    <option>Terverifikasi</option>
                    <option>Belum Terverifikasi</option>
                </select>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Total User</p>
                        <p class="text-2xl font-bold">{{ $users->count() }}</p>
                    </div>
                    <i class="fas fa-users text-3xl text-blue-500"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Terverifikasi</p>
                        <p class="text-2xl font-bold">{{ $users->whereNotNull('email_verified_at')->count() }}</p>
                    </div>
                    <i class="fas fa-check-circle text-3xl text-green-500"></i>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Belum Terverifikasi</p>
                        <p class="text-2xl font-bold">{{ $users->whereNull('email_verified_at', false)->count() }}</p>
                    </div>
                    <i class="fas fa-times-circle text-3xl text-red-500"></i>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah Laporan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Sample Data -->
                        @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->aspirations_count }}</td>
                            <td class="px-6 py-4">{{ $user->role }}</td>
                            <td class="px-6 py-4">
                                @if ($user->email_verified_at)
                                <span
                                    class="px-2 py-1 text-sm rounded-full bg-green-100 text-green-800">Terverifikasi</span>
                                @else
                                <span
                                    class="px-2 py-1 text-sm rounded-full bg-red-100 text-red-800">Belum Terverifikasi</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 relative">
                                <button class="action-btn">
                                    <i class="fas fa-ellipsis-v text-gray-500 hover:text-blue-500"></i>
                                </button>
                                <div
                                    class="action-menu hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg z-10">
                                    <a href="{{ route('users.show', $user) }}" class="w-full block px-4 py-2 text-left hover:bg-gray-100">
                                        <i class="fas fa-eye mr-2 text-blue-500"></i>Lihat Laporan
                                    </a>
                                    <button class="w-full px-4 py-2 text-left hover:bg-gray-100">
                                        <i class="fas fa-edit mr-2 text-yellow-500"></i>Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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
