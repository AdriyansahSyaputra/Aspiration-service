<x-users.layout :title="$title">

    {{-- Banner --}}
    <div
        class="w-full h-full md:h-[400px] bg-white flex flex-col md:flex-row items-center justify-center border-b border-gray-200 shadow-sm p-4 md:px-8 lg:px-16 gap-4">
        <div class="max-w-xl">
            <h1 class="mb-4 text-2xl md:text-4xl font-semibold text-gray-600">Selamat Datang di Layanan Aspirasi</h1>
            <p class="mb-8 text-slate-700 text-sm md:text-base">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Rerum dignissimos magni libero unde voluptas earum delectus quae eaque excepturi perspiciatis
                asperiores, fuga ea nam dicta?</p>
            <button class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-300">Buat
                Pernyataan</button>
        </div>

        <div class="w-full max-w-xl h-52 md:h-full overflow-hidden">
            <img src="/img/banner/interactions.png" alt="" class="w-full h-full object-contain">
        </div>
    </div>

    <!-- Fitur Section -->
    <section class="py-16 px-4 md:px-8 lg:px-16">
        <div class="container mx-auto">
            <h2 class="text-2xl md:text-4xl font-semibold text-center mb-10">Mengapa Memilih Platform Kami?</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white p-8 rounded-xl shadow-md text-center">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-bolt text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Respon Cepat</h3>
                    <p class="text-gray-600">Setiap aspirasi akan ditindaklanjuti dalam waktu maksimal 3 hari kerja
                        dengan update status secara real-time.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-md text-center">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-shield-alt text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Privasi Terjamin</h3>
                    <p class="text-gray-600">Data pribadi Anda dilindungi dengan sistem enkripsi terbaru dan tidak akan
                        disebarluaskan.</p>
                </div>
                <div class="bg-white p-8 rounded-xl shadow-md text-center">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-chart-line text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Transparansi</h3>
                    <p class="text-gray-600">Pantau progress penanganan aspirasi Anda secara transparan melalui
                        dashboard yang informatif.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Form Pengaduan -->
    <section class="py-20 px-4">
        <div class="container mx-auto">
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Form Pengaduan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Silakan isi form di bawah ini untuk menyampaikan pengaduan
                    Anda. Kami akan memastikan pengaduan Anda ditindaklanjuti oleh instansi terkait.</p>
            </div>
            <div class="mt-12 max-w-2xl mx-auto">
                <form id="complaintForm" class="bg-white p-8 rounded-lg shadow-lg">
                    <!-- Judul Pengaduan -->
                    <div class="mb-6">
                        <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul Pengaduan</label>
                        <input type="text" id="judul"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                            placeholder="Masukkan judul pengaduan" required>
                    </div>

                    <!-- Instansi Tujuan -->
                    <div class="mb-6">
                        <label for="instansi" class="block text-gray-700 font-semibold mb-2">Instansi Tujuan</label>
                        <select id="instansi"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                            required>
                            <option value="" disabled selected>Pilih Instansi</option>
                            <option value="Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi">Kementerian
                                Pendidikan, Kebudayaan, Riset, dan Teknologi</option>
                            <option value="Kementerian Kesehatan">Kementerian Kesehatan</option>
                            <option value="Kementerian Lingkungan Hidup dan Kehutanan">Kementerian Lingkungan Hidup dan
                                Kehutanan</option>
                            <option value="Kementerian Perhubungan">Kementerian Perhubungan</option>
                            <option value="Kementerian Sosial">Kementerian Sosial</option>
                        </select>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi
                            Pengaduan</label>
                        <textarea id="deskripsi" rows="5"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                            placeholder="Jelaskan pengaduan Anda secara detail" required></textarea>
                    </div>

                    <!-- Tanggal Kejadian -->
                    <div class="mb-6">
                        <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal Kejadian</label>
                        <input type="date" id="tanggal"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                            required>
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-6">
                        <label for="lokasi" class="block text-gray-700 font-semibold mb-2">Lokasi Kejadian</label>
                        <input type="text" id="lokasi"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                            placeholder="Masukkan lokasi kejadian" required>
                    </div>

                    <!-- Bukti Pengaduan -->
                    <div class="mb-6">
                        <label for="bukti" class="block text-gray-700 font-semibold mb-2">Bukti Pengaduan</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="bukti"
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-300">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-500">Unggah file (foto atau PDF)</p>
                                </div>
                                <input type="file" id="bukti" class="hidden" accept="image/*, application/pdf"
                                    required>
                            </label>
                        </div>
                    </div>

                    <!-- Tombol Kirim -->
                    <button type="submit"
                        class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Pengaduan
                    </button>
                </form>
                <div id="successMessage" class="hidden mt-6 p-4 bg-green-100 text-green-700 rounded-lg text-center">
                    Pengaduan Anda telah berhasil dikirim!
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Section -->
    <section class="py-16 bg-white px-4 md:px-8 lg:px-16">
        <div class="container mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <div class="text-blue-600 mb-2">
                        <i class="fas fa-users text-2xl md:text-4xl"></i>
                    </div>
                    <div class="text-2xl md:text-4xl font-bold mb-2 counter" data-target="15000">214</div>
                    <p class="text-gray-600 text-sm md:text-base">Pengguna Aktif</p>
                </div>
                <div>
                    <div class="text-blue-600 mb-2">
                        <i class="fas fa-paper-plane text-2xl md:text-4xl"></i>
                    </div>
                    <div class="text-2xl md:text-4xl font-bold mb-2 counter" data-target="25000">105</div>
                    <p class="text-gray-600 text-sm md:text-base">Aspirasi Tersampaikan</p>
                </div>
                <div>
                    <div class="text-blue-600 mb-2">
                        <i class="fas fa-check-circle text-2xl md:text-4xl"></i>
                    </div>
                    <div class="text-2xl md:text-4xl font-bold mb-2 counter" data-target="20000">109</div>
                    <p class="text-gray-600 text-sm md:text-base">Aspirasi Terselesaikan</p>
                </div>
                <div>
                    <div class="text-blue-600 mb-2">
                        <i class="fas fa-building text-2xl md:text-4xl"></i>
                    </div>
                    <div class="text-2xl md:text-4xl font-bold mb-2 counter" data-target="100">33</div>
                    <p class="text-gray-600 text-sm md:text-base">Instansi Terhubung</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-blue-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-8">Siap Menyampaikan Aspirasi Anda?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Bergabunglah dengan ribuan warga yang telah mempercayai platform
                kami untuk menyampaikan aspirasi mereka.</p>
            <button
                class="bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">Daftar
                Sekarang</button>
        </div>
    </section>

</x-users.layout>
