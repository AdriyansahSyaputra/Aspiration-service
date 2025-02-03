<x-users.layout :title="$title">

    {{-- Hero Section --}}
    <section class="w-full py-20 md:py-20 md:h-[400px] relative flex items-center justify-center">
        <div class="absolute inset-0">
            <img src="/img/banner/about.jpg" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/50"></div>
        </div>
        <div class="max-w-2xl relative z-10 text-center text-white px-4">
            <h1 class="text-2xl md:text-4xl font-semibold">About Us</h1>
            <p class="mt-2 text-sm md:text-base">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum
                dignissimos magni libero unde voluptas earum delectus quae eaque excepturi perspiciatis asperiores, fuga
                ea nam dicta?</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 px-4 md:px-8 lg:px-16">
        <div class="container mx-auto">
            <div class="text-center">
                <h2 class="text-2xl md:text-4xl font-bold text-gray-800 mb-6">Tentang Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Kami hadir sebagai jembatan antara masyarakat dan pihak
                    terkait untuk memastikan setiap suara didengar dan setiap aspirasi mendapatkan perhatian yang
                    semestinya.</p>
            </div>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <i class="fas fa-users text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Untuk Masyarakat</h3>
                    <p class="text-gray-600">Platform ini dibuat untuk memudahkan masyarakat menyampaikan aspirasi
                        mereka.</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-handshake text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Kolaborasi</h3>
                    <p class="text-gray-600">Kami bekerja sama dengan berbagai pihak untuk memastikan aspirasi Anda
                        sampai.</p>
                </div>
                <div class="text-center">
                    <i class="fas fa-check-circle text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Transparan</h3>
                    <p class="text-gray-600">Proses yang transparan dan akuntabel untuk setiap aspirasi yang
                        disampaikan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="bg-gray-50 py-20 px-4 md:px-8 lg:px-16">
        <div class="container mx-auto">
            <div class="text-center">
                <h2 class="text-2xl md:text-4xl font-bold text-gray-800 mb-6">Cara Kerja</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Berikut adalah langkah-langkah mudah untuk menyampaikan
                    aspirasi Anda melalui platform kami.</p>
            </div>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="bg-white p-6 rounded-md shadow-md">
                        <i class="fas fa-edit text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Tulis Aspirasi</h3>
                        <p class="text-gray-600">Tulis aspirasi Anda dengan jelas dan detail.</p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="bg-white p-6 rounded-md shadow-md">
                        <i class="fas fa-paper-plane text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Kirim Aspirasi</h3>
                        <p class="text-gray-600">Kirim aspirasi Anda ke pihak terkait.</p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="bg-white p-6 rounded-md shadow-md">
                        <i class="fas fa-check text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Proses Verifikasi</h3>
                        <p class="text-gray-600">Aspirasi Anda akan diverifikasi oleh tim kami.</p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="bg-white p-6 rounded-md shadow-md">
                        <i class="fas fa-comments text-4xl text-blue-600 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Respon</h3>
                        <p class="text-gray-600">Pihak terkait akan memberikan respon atas aspirasi Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


</x-users.layout>
