<header class="bg-white w-full flex items-center justify-between py-4 px-8 border-b">

    <div>
        <h1 class="text-xl font-semibold text-slate-700">Welcome Back, Admin!</h1>
    </div>

    <div class="flex items-center space-x-8">
        {{-- Search Input --}}
        <form action="">
            <div class="relative max-w-sm w-full">
                <input type="search" placeholder="Search..."
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-1 focus:ring-gray-600">
                <button type="submit" class="absolute right-2 top-2">
                    <i class="fa-solid fa-magnifying-glass text-gray-600"></i>
                </button>
            </div>
        </form>

        {{-- Divider vertikal --}}
        <div class="w-px h-8 bg-gray-300"></div>

        {{-- Notification --}}
        <a href="#" class="text-gray-600 hover:text-gray-800 transition">
            <i class="fa-regular fa-bell text-xl"></i>
        </a>

        {{-- User section --}}
        <div class="flex items-center">
            <img src="/img/user/default.jpg" alt="User Image" class="w-8 h-8 rounded-full">
            <div class="ml-2">
                <p class="text-sm font-semibold text-gray-700">Admin</p>
            </div>
        </div>

    </div>

</header>
