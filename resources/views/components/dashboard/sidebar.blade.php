<aside class="bg-slate-800 w-64 min-h-screen flex flex-col">
    <!-- Logo Section -->
    <div class="p-6 border-b border-slate-700">
        <h1 class="text-2xl font-semibold text-center">
            <span class="italic text-white">Layanan</span>
            <strong class="text-red-500 italic">Aspirasi</strong>
        </h1>
    </div>

    <!-- Main Menu Section -->
    <div class="flex-1 overflow-y-auto py-8">
        <div class="px-4">
            <h3 class="uppercase text-xs font-semibold text-slate-400 tracking-wider mb-4">Main Menu</h3>
            
            <nav class="space-y-2">
                <!-- Dashboard -->
                <a href="/dashboard" class="group flex items-center px-4 py-3 text-gray-400 hover:text-white rounded-lg hover:bg-white/10 transition-all duration-200">
                    <i class="fa-solid fa-gauge-high w-5 h-5"></i>
                    <span class="ml-3">Dashboard</span>
                    <i class="fa-solid fa-chevron-right ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>

                <!-- Laporan -->
                <a href="/dashboard/reports" class="group flex items-center px-4 py-3 text-gray-400 hover:text-white rounded-lg hover:bg-white/10 transition-all duration-200">
                    <i class="fa-solid fa-file-lines w-5 h-5"></i>
                    <span class="ml-3">Laporan</span>
                    <i class="fa-solid fa-chevron-right ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>

                <!-- Users -->
                <a href="/dashboard/users" class="group flex items-center px-4 py-3 text-gray-400 hover:text-white rounded-lg hover:bg-white/10 transition-all duration-200">
                    <i class="fa-solid fa-users w-5 h-5"></i>
                    <span class="ml-3">Users</span>
                    <i class="fa-solid fa-chevron-right ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>
            </nav>
        </div>

        <!-- Help & Support Section -->
        <div class="px-4 mt-8 border-t border-slate-700 pt-8">
            <h3 class="uppercase text-xs font-semibold text-slate-400 tracking-wider mb-4">Help & Support</h3>
            
            <nav class="space-y-2">
                <!-- Help -->
                <a href="#" class="group flex items-center px-4 py-3 text-gray-400 hover:text-white rounded-lg hover:bg-white/10 transition-all duration-200">
                    <i class="fa-solid fa-circle-question w-5 h-5"></i>
                    <span class="ml-3">Help & Support</span>
                    <i class="fa-solid fa-chevron-right ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>

                <!-- Settings -->
                <a href="#" class="group flex items-center px-4 py-3 text-gray-400 hover:text-white rounded-lg hover:bg-white/10 transition-all duration-200">
                    <i class="fa-solid fa-gear w-5 h-5"></i>
                    <span class="ml-3">Settings</span>
                    <i class="fa-solid fa-chevron-right ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
                </a>
            </nav>
        </div>
    </div>

    <!-- Logout Section -->
    <div class="border-t border-slate-700 p-4">
        <button class="group flex items-center w-full px-4 py-3 text-gray-400 hover:text-white rounded-lg hover:bg-white/10 transition-all duration-200">
            <i class="fa-solid fa-right-from-bracket w-5 h-5"></i>
            <span class="ml-3">Logout</span>
            <i class="fa-solid fa-chevron-right ml-auto opacity-0 group-hover:opacity-100 transition-opacity"></i>
        </button>
    </div>
</aside>