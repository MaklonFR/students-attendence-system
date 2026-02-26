export const renderFooter = () => {
    const currentYear = new Date().getFullYear();
    return `
        <footer class="bg-gray-800 text-gray-300 py-8 px-4 lg:px-6 mt-12">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <div>
                        <h3 class="text-white font-bold mb-2">Absensi SMP</h3>
                        <p class="text-sm">Sistem manajemen kehadiran siswa yang komprehensif dan mudah digunakan.</p>
                    </div>
                    <div>
                        <h3 class="text-white font-bold mb-2">Informasi</h3>
                        <ul class="text-sm space-y-1">
                            <li><a href="#" class="hover:text-white transition">Tentang</a></li>
                            <li><a href="#" class="hover:text-white transition">Bantuan</a></li>
                            <li><a href="#" class="hover:text-white transition">Kontak</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white font-bold mb-2">Hubungi Kami</h3>
                        <p class="text-sm">Email: info@smp.sch.id</p>
                        <p class="text-sm">Telp: (021) 123-4567</p>
                    </div>
                </div>
                <div class="border-t border-gray-700 pt-6 text-center text-sm">
                    <p>&copy; ${currentYear} Sistem Absensi SMP. Semua hak dilindungi.</p>
                </div>
            </div>
        </footer>
    `;
};
