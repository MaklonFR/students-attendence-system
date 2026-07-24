Anda adalah seorang Senior Full Stack Developer dan UI/UX Designer yang ahli dalam HTML5, TailwindCSS, JavaScript ES6, dan PDF Generation.
Buatkan sebuah halaman web yang dapat menampilkan dan mencetak Laporan Rekap Absensi Siswa ke dalam format PDF dengan tampilan modern, profesional, responsif, dan siap digunakan di sekolah.
Teknologi yang digunakan
•	HTML5
•	TailwindCSS (via CDN)
•	JavaScript ES6
•	jsPDF
•	html2canvas
•	Tanpa Framework (No React/Vue)
•	Clean Code
•	Responsive
•	Print Friendly
________________________________________
Jenis Laporan
Buat empat jenis laporan:
1.	Rekap Harian
2.	Rekap Bulanan
3.	Rekap Semester 1 (Januari–Juni)
4.	Rekap Semester 2 (Juli–Desember)
User dapat memilih jenis laporan melalui dropdown.
________________________________________
Filter Data
Sediakan filter berikut:
•	Tahun Ajaran
•	Semester
•	Bulan
•	Tanggal
•	Kelas
•	Jurusan
•	Tingkat
•	Nama Wali Kelas
•	Nama Siswa (opsional)
Tombol:
•	Tampilkan Laporan
•	Reset Filter
•	Download PDF
•	Print
________________________________________
Header Laporan
Bagian atas laporan harus berisi:
Logo Sekolah (kiri)
Identitas Sekolah:
•	Nama Sekolah
•	NPSN
•	NSS
•	Alamat
•	Telepon
•	Email
•	Website
Judul sesuai jenis laporan:
Contoh:
REKAP ABSENSI SISWA HARIAN
atau
REKAP ABSENSI SISWA BULANAN
atau
REKAP ABSENSI SEMESTER 1
atau
REKAP ABSENSI SEMESTER 2
Di bawah judul tampilkan:
•	Tahun Ajaran
•	Semester
•	Kelas
•	Jurusan
•	Bulan
•	Periode
________________________________________
Tabel Laporan
Kolom tabel:
| No | NIS | Nama Siswa | L | P | Alpha | Izin | Sakit | Terlambat | Persentase Kehadiran |
Keterangan:
L = Hadir
P = Hadir (Perempuan) atau gunakan kolom "Hadir" sesuai kebutuhan
Hitung otomatis:
Jumlah Hadir
Jumlah Alpha
Jumlah Izin
Jumlah Sakit
Persentase Kehadiran
Contoh:
95%
________________________________________
Warna Status
Gunakan badge Tailwind.
Hadir
warna hijau
Izin
warna kuning
Sakit
warna biru
Alpha
warna merah
________________________________________
Ringkasan Statistik
Di bawah tabel tampilkan kartu statistik:
Total Siswa
Total Hadir
Total Alpha
Total Izin
Total Sakit
Rata-rata Kehadiran
Menggunakan Card Tailwind yang modern.
________________________________________
Grafik
Tambahkan grafik menggunakan Chart.js.
Grafik batang:
•	Hadir
•	Alpha
•	Izin
•	Sakit
Grafik Pie:
Distribusi Kehadiran.
________________________________________
Footer
Bagian bawah laporan:
Mengetahui,
Kepala Sekolah
.....................................
Wali Kelas
.....................................
Tanggal Cetak:
Diisi otomatis menggunakan JavaScript.
________________________________________
Format PDF
PDF menggunakan ukuran:
A4 Portrait
Jika tabel panjang:
Landscape otomatis.
Margin:
20 px
Header dan footer muncul pada setiap halaman.
Nomor halaman otomatis.
Nama file PDF:
Rekap_Absensi_Harian.pdf
Rekap_Absensi_Bulanan.pdf
Rekap_Absensi_Semester1.pdf
Rekap_Absensi_Semester2.pdf
________________________________________
Dummy Data
Buat minimal 30 data siswa.
Field:
{
    nis: "24001",
    nama: "Andi Saputra",
    jk: "L",
    hadir: 24,
    izin: 2,
    sakit: 1,
    alpha: 1,
}
Hitung otomatis:
Persentase =
(Hadir / Total Hari Efektif) × 100
Misal:
Total Hari Efektif = 28 hari.
________________________________________
Desain UI
Gunakan desain modern seperti Admin Dashboard.
Background abu-abu muda.
Card putih.
Rounded-xl
Shadow-lg
Hover effect
Table striping
Sticky Header
Responsive
Dark mode support.
Gunakan warna:
Primary
Blue-600
Success
Green-500
Danger
Red-500
Warning
Amber-500
Info
Sky-500
________________________________________
Fitur Tambahan
Tambahkan:
•	Search Nama Siswa
•	Sorting kolom
•	Pagination
•	Export PDF
•	Print Preview
•	Loading Spinner
•	Empty State
•	No Data Illustration
•	Tooltip
•	Toast Notification
•	Validasi Filter
•	Responsive Mobile
________________________________________
