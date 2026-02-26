import { getUser, isAdmin } from '../js/auth.js';

export const renderSidebar = () => {
    const user = getUser();
    const adminMenu = isAdmin() ? `
        <a href="/pages/users.html" class="flex items-center px-5 py-3 text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:border-l-4 hover:border-blue-600 transition-all duration-200">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            Kelola User
        </a>
    ` : '';

    return `
        <!-- Mobile Menu Button -->
        <button onclick="toggleSidebar()" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gradient-to-r from-blue-600 to-cyan-500 text-white rounded-lg shadow-lg hover:shadow-xl transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <!-- Sidebar -->
        <div id="sidebarMenu" class="fixed left-0 top-0 w-64 bg-white h-screen shadow-2xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-40 border-r border-gray-100 overflow-y-auto">
            <!-- Header Section -->
            <div class="sticky top-0 p-6 bg-gradient-to-br from-blue-600 to-cyan-500 text-white shadow-md">
                <div class="flex items-center justify-center w-12 h-12 bg-white/20 rounded-lg mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <h1 class="text-xl font-bold">Absensi SMP</h1>
                <p class="text-sm mt-2 text-blue-100">${user.nama}</p>
                <p class="text-xs text-blue-100/80">${user.role === 'admin' ? '👨‍💼 Administrator' : '👨‍🏫 Guru'}</p>
            </div>

            <!-- Navigation Menu -->
            <nav class="mt-2 px-1">
                <a href="/pages/dashboard.html" class="flex items-center px-5 py-3 mx-1 text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:border-l-4 hover:border-blue-600 rounded-lg transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="/pages/siswa.html" class="flex items-center px-5 py-3 mx-1 text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:border-l-4 hover:border-blue-600 rounded-lg transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="font-medium">Data Siswa</span>
                </a>
                <a href="/pages/absensi.html" class="flex items-center px-5 py-3 mx-1 text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:border-l-4 hover:border-blue-600 rounded-lg transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    <span class="font-medium">Absensi</span>
                </a>
                <a href="/pages/laporan.html" class="flex items-center px-5 py-3 mx-1 text-gray-600 hover:bg-blue-50 hover:text-blue-600 hover:border-l-4 hover:border-blue-600 rounded-lg transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="font-medium">Laporan</span>
                </a>

                <!-- Divider -->
                ${adminMenu ? '<div class="my-2 h-px bg-gray-200 mx-1"></div>' : ''}
                ${adminMenu}
            </nav>
        </div>

        <!-- Overlay -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>
    `;
};

window.toggleSidebar = () => {
    const sidebar = document.getElementById('sidebarMenu');
    const overlay = document.getElementById('sidebarOverlay');
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
};
