<x-dashboard.layout>

    <div class="container mx-auto p-4 md:p-8 max-w-4xl">
        <!-- Card Utama -->

        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Detail Laporan</h1>
                    <p class="text-gray-500 mt-1">Informasi lengkap laporan pengaduan</p>
                </div>
                <button onclick="window.history.back()" class="flex items-center gap-2 text-gray-600 hover:text-gray-800">
                    <i class="fas fa-arrow-left"></i>
                    <span class="hidden md:inline">Kembali</span>
                </button>
            </div>

            <!-- Grid Informasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Judul</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $report->title }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Kode Laporan</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $report->id }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $report->date_occurred }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Nama Pelapor</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $report->user->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Instansi</label>
                    <p class="text-lg font-semibold text-gray-800">{{ $report->institution }}</p>
                </div>

                <!-- Status Section -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-500 mb-2">Status Laporan</label>
                    <div class="relative inline-block">
                        <button id="statusButton" onclick="toggleStatusDropdown()"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors">
                            <span class="status-dot animate-pulse"></span>
                            <span id="statusText" class="font-semibold">{{ $report->status }}</span>
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>

                        <!-- Dropdown Status -->
                        <div id="statusDropdown"
                            class="hidden absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 z-10">
                            <!-- Options akan diisi oleh JavaScript -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-500 mb-2">Deskripsi Laporan</label>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-800 leading-relaxed">
                        {{ $report->aspiration }}
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col md:flex-row gap-4 border-t pt-6">
                <button onclick="openReplyModal()"
                    class="flex-1 flex items-center justify-center gap-2 bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-colors">
                    <i class="fas fa-reply"></i>
                    <span>Kirim Balasan</span>
                </button>
                <form action="{{ route('report.destroy', $report->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')"
                        class="w-full flex items-center justify-center gap-2 bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash"></i>
                        <span>Hapus Laporan</span>
                    </button>

                </form>


                <form action="{{ route('report.update', $report->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="statusInput" name="status" value="{{ $report->status }}">

                    <button
                        class="w-full flex items-center justify-center gap-2 bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-colors">
                        <i class="fa-regular fa-floppy-disk"></i>
                        <span>Simpan</span>
                    </button>
                </form>

            </div>
        </div>

    </div>

    <!-- Modal Balasan -->
    <div id="replyModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Form Balasan</h2>
                <button onclick="closeReplyModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="replyForm" onsubmit="submitReply(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Subjek</label>
                        <input type="text" required
                            class="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Pesan</label>
                        <textarea required rows="4"
                            class="w-full px-4 py-2 rounded-lg border focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600 mb-1">Lampiran</label>
                        <input type="file" class="w-full px-4 py-2 rounded-lg border">
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeReplyModal()"
                        class="px-6 py-2 text-gray-600 hover:text-gray-800">Batal</button>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">Kirim
                        Balasan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const statusOptions = {
            pending: {
                color: 'bg-red-500',
                text: 'Pending'
            },
            proses: {
                color: 'bg-yellow-500',
                text: 'Proses'
            },
            selesai: {
                color: 'bg-green-500',
                text: 'Selesai'
            }
        };

        let currentStatus = '{{ $report->status }}';

        function toggleStatusDropdown() {
            const dropdown = document.getElementById('statusDropdown');
            dropdown.classList.toggle('hidden');

            // Reset dropdown options
            dropdown.innerHTML = '';
            const options = Object.entries(statusOptions)
                .filter(([key]) => key !== currentStatus)
                .map(([key, value]) => `
        <button onclick="changeStatus('${key}')" class="w-full px-4 py-2 text-left hover:bg-gray-100 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full ${value.color}"></span>
            ${value.text}
        </button>
    `).join('');
            dropdown.innerHTML = options;
        }

        function changeStatus(newStatus) {
            currentStatus = newStatus;
            document.getElementById('statusInput').value = newStatus;

            const statusText = document.getElementById('statusText');
            statusText.textContent = statusOptions[newStatus].text;

            // Close dropdown
            document.getElementById('statusDropdown').classList.add('hidden');
        }


        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const button = document.getElementById('statusButton');
            const dropdown = document.getElementById('statusDropdown');
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });


        // Reply Modal
        function openReplyModal() {
            document.getElementById('replyModal').classList.remove('hidden');
        }

        function closeReplyModal() {
            document.getElementById('replyModal').classList.add('hidden');
        }

        function submitReply(e) {
            e.preventDefault();
            // Add your submission logic here
            alert('Balasan berhasil dikirim!');
            closeReplyModal();
            e.target.reset();
        }
    </script>

    <style>
        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: currentColor;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>

</x-dashboard.layout>
