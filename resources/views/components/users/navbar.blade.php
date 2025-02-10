<header
    class="bg-white w-full flex items-center justify-between border-b border-gray-200 shadow-sm py-4 px-4 md:px-16 relative">
    {{-- Logo --}}
    <div class="flex items-center z-20">
        <a href="/" class="flex items-center gap-2 hover:opacity-80 transition">
            <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="w-8 h-8">
            <h1 class="text-lg text-gray-600 font-semibold italic">Layanan<strong class="text-red-500">Aspirasi</strong>
            </h1>
        </a>
    </div>

    {{-- Mobile Menu Button --}}
    <button id="mobile-menu-button" class="md:hidden z-30 text-red-500 hover:text-red-600 transition">
        <i class="fas fa-bars text-xl"></i>
    </button>

    {{-- Overlay --}}
    <div id="menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden transition-opacity duration-300">
    </div>

    {{-- Menu --}}
    <nav id="nav-menu"
        class="fixed top-0 right-0 w-72 h-full bg-white shadow-lg transform translate-x-full md:transform-none md:relative md:w-auto md:shadow-none transition-transform duration-300 ease-in-out z-50">
        {{-- Close button for mobile --}}
        <button id="close-menu" class="md:hidden absolute top-4 right-4 text-gray-500 hover:text-red-500 transition">
            <i class="fas fa-times text-xl"></i>
        </button>

        {{-- Mobile Header --}}
        <div class="md:hidden p-4 pt-16 bg-red-50 border-b border-gray-100">
            @if (Auth::check())
                <div class="flex items-center gap-4">
                    <img src="/img/user/default.jpg" alt="" class="w-8 h-8 rounded-full">
                    <div class="flex flex-col">
                        <h1 class="text-base font-semibold text-gray-700">{{ Auth::user()->name }}</h1>
                        <span class="text-sm text-gray-600">{{ Auth::user()->email }}</span>
                    </div>
                </div>
            @endif
        </div>

        <ul class="flex flex-col md:flex-row items-start md:items-center gap-1 md:gap-2 p-4 md:p-0">
            <li class="w-full md:w-auto">
                <a href="/"
                    class="group flex items-center gap-3 px-4 py-3 md:py-2 rounded-lg hover:bg-red-50 md:hover:bg-red-500 transition-all duration-300">
                    <i class="fas fa-home text-red-500 group-hover:md:text-white transition-colors"></i>
                    <span
                        class="font-medium text-gray-700 group-hover:text-red-500 md:text-red-500 md:group-hover:text-white transition-colors">Beranda</span>
                </a>
            </li>
            <li class="w-full md:w-auto">
                <a href="/jelajah"
                    class="group flex items-center gap-3 px-4 py-3 md:py-2 rounded-lg hover:bg-red-50 md:hover:bg-red-500 transition-all duration-300">
                    <i class="fas fa-search text-red-500 group-hover:md:text-white transition-colors"></i>
                    <span
                        class="font-medium text-gray-700 group-hover:text-red-500 md:text-red-500 md:group-hover:text-white transition-colors">Jelajah
                        Aduan</span>
                </a>
            </li>
            <li class="w-full md:w-auto">
                <a href="/tentang-kami"
                    class="group flex items-center gap-3 px-4 py-3 md:py-2 rounded-lg hover:bg-red-50 md:hover:bg-red-500 transition-all duration-300">
                    <i class="fas fa-info-circle text-red-500 group-hover:md:text-white transition-colors"></i>
                    <span
                        class="font-medium text-gray-700 group-hover:text-red-500 md:text-red-500 md:group-hover:text-white transition-colors">Tentang
                        Kami</span>
                </a>
            </li>
            @if (Auth::check())
            <li class="w-full md:w-auto">
                <a href="/laporan-saya"
                    class="group flex items-center gap-3 px-4 py-3 md:py-2 rounded-lg hover:bg-red-50 md:hover:bg-red-500 transition-all duration-300">
                    <i class="fas fa-file-alt text-red-500 group-hover:md:text-white transition-colors"></i>
                    <span
                        class="font-medium text-gray-700 group-hover:text-red-500 md:text-red-500 md:group-hover:text-white transition-colors">Laporan
                        Saya</span>
                </a>
            </li>
            @endif
        </ul>

        {{-- Mobile Login Button --}}
        <div class="md:hidden fixed bottom-0 left-0 right-0 p-4 bg-white border-t border-gray-100">
            @if (Auth::check())
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        class="w-full px-4 py-3 bg-gray-500 hover:bg-gray-600 rounded-lg transition duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-sign-in-alt text-white"></i>
                        <a href="/login" class="text-white font-medium">Logout</a>
                    </button>
                </form>
            @else
                <button
                    class="w-full px-4 py-3 bg-red-500 hover:bg-red-600 rounded-lg transition duration-300 flex items-center justify-center gap-2">
                    <i class="fas fa-sign-in-alt text-white"></i>
                    <a href="/login" class="text-white font-medium">Login</a>
                </button>
            @endif
        </div>
    </nav>

    {{-- Desktop Login Button --}}
    <div class="hidden md:flex items-center z-20">
        @if (Auth::check())
            <div class="relative flex items-center gap-2 cursor-pointer" id="user-menu-button">
                <img src="{{ Auth::user()->profile_image ?? '/img/user/default.jpg' }}" alt="Profile Image"
                    class="w-8 h-8 rounded-full">
                <div class="flex flex-col">
                    <h3 class="text-sm font-semibold text-slate-700">{{ Auth::user()->name }}</h3>
                    <span class="text-xs text-gray-600">{{ Auth::user()->email }}</span>
                </div>
                <i class="fas fa-chevron-down text-gray-600"></i>

                <!-- Dropdown -->
                <div id="dropdown"
                    class="absolute top-10 right-0 mt-2 w-40 bg-white border border-gray-200 rounded-md shadow-lg hidden z-10">
                    <ul class="py-1 text-sm text-gray-700">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        @else
            <button
                class="px-4 py-2 bg-red-500 rounded-md hover:bg-red-600 transition duration-300 flex items-center gap-2">
                <i class="fas fa-sign-in-alt text-white"></i>
                <a href="/login" class="text-white font-medium">Login</a>
            </button>
        @endif

    </div>
</header>

<script>
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const closeMenuButton = document.getElementById("close-menu");
    const navMenu = document.getElementById("nav-menu");
    const menuOverlay = document.getElementById("menu-overlay");
    let isMenuOpen = false;

    function toggleMenu() {
        isMenuOpen = !isMenuOpen;

        // Toggle menu visibility and transform
        navMenu.classList.toggle("translate-x-full");

        // Toggle overlay
        menuOverlay.classList.toggle("hidden");
        setTimeout(() => {
            menuOverlay.classList.toggle("opacity-50");
        }, 0);

        // Toggle body scroll
        document.body.style.overflow = isMenuOpen ? "hidden" : "auto";
    }

    // Open menu
    mobileMenuButton.addEventListener("click", toggleMenu);

    // Close menu when clicking close button
    closeMenuButton.addEventListener("click", toggleMenu);

    // Close menu when clicking overlay
    menuOverlay.addEventListener("click", toggleMenu);

    // Close menu on escape key
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && isMenuOpen) {
            toggleMenu();
        }
    });

    // Dropdown logout button
    const userMenuButton = document.getElementById('user-menu-button');
    const dropdown = document.getElementById('dropdown');
    userMenuButton.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });
</script>
