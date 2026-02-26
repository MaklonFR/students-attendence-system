import { logout } from '../js/auth.js';

export const renderNavbar = () => {
    return `
        <div class="lg:ml-64 bg-white/80 backdrop-blur-sm shadow-md px-4 lg:px-6 py-4 flex justify-between items-center border-b border-gray-100">
            <h2 class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent ml-12 lg:ml-0" id="pageTitle">Dashboard</h2>
            <button onclick="handleLogout()" class="px-4 py-2 lg:px-5 lg:py-2 text-sm lg:text-base bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:shadow-lg hover:shadow-red-500/30 transition-all duration-200 transform hover:scale-105 active:scale-95 font-medium">
                Keluar
            </button>
        </div>
    `;
};

window.handleLogout = () => {
    if (confirm('Apakah Anda yakin ingin logout?')) {
        logout();
    }
};
