# 🏫 Aplikasi Absensi Online Siswa SMP

Aplikasi absensi berbasis web dengan arsitektur REST API terpisah (Frontend & Backend).

## 📋 Teknologi

**Backend:**
- PHP Native (tanpa framework)
- MySQL Database
- JWT Authentication
- REST API Architecture

**Frontend:**
- HTML5
- TailwindCSS
- Vanilla JavaScript (ES6 Modules)
- SPA (Single Page Application)

## 🚀 Cara Instalasi

### 1. Setup Database

```bash
# Import database schema
mysql -u root -p < database/schema.sql
```

Atau buka phpMyAdmin dan import file `database/schema.sql`

### 2. Konfigurasi Backend

Edit file `backend/config/database.php` sesuai dengan konfigurasi MySQL Anda:

```php
private $host = 'localhost';
private $db_name = 'db_absensi_smp';
private $username = 'root';
private $password = '';
```

### 3. Jalankan Backend Server

Buka terminal/command prompt di folder `backend/public/`:

```bash
cd backend/public
php -S localhost:8000
```

Backend API akan berjalan di: `http://localhost:8000`

### 4. Jalankan Frontend Server

Buka terminal/command prompt baru di folder `frontend/`:

```bash
cd frontend
php -S localhost:3000
```

Frontend akan berjalan di: `http://localhost:3000`

### 5. Akses Aplikasi

- Frontend: `http://localhost:3000`
- Backend API: `http://localhost:8000/api/`

## 👤 Login Default

**Admin:**
- Email: `admin@smp.sch.id`
- Password: `password`

**Guru:**
- Email: `guru@smp.sch.id`
- Password: `password`

## 🔌 Testing API dengan Postman

### 1. Login

```
POST http://localhost:8000/api/login
Content-Type: application/json

{
    "email": "admin@smp.sch.id",
    "password": "password"
}
```

Response:
```json
{
    "success": true,
    "message": "Login berhasil",
    "data": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
        "user": {
            "id": 1,
            "nama": "Administrator",
            "email": "admin@smp.sch.id",
            "role": "admin"
        }
    }
}
```

### 2. Get Siswa (dengan token)

```
GET http://localhost:8000/api/siswa
Authorization: Bearer {token}
```

### 3. Create Siswa

```
POST http://localhost:8000/api/siswa
Authorization: Bearer {token}
Content-Type: application/json

{
    "nis": "2024006",
    "nama_lengkap": "Test Siswa",
    "kelas": "7A",
    "jenis_kelamin": "L",
    "alamat": "Jl. Test",
    "status": "aktif"
}
```

### 4. Create Absensi

```
POST http://localhost:8000/api/absensi
Authorization: Bearer {token}
Content-Type: application/json

{
    "siswa_id": 1,
    "tanggal": "2024-01-15",
    "status": "hadir",
    "keterangan": ""
}
```

### 5. Get Laporan Harian

```
GET http://localhost:8000/api/laporan/harian?tanggal=2024-01-15&kelas=7A
Authorization: Bearer {token}
```

## 📁 Struktur Folder

```
absen-app/
├── backend/
│   ├── config/          # Konfigurasi database & CORS
│   ├── core/            # Router, Response, JWT, Middleware
│   ├── models/          # Model User, Siswa, Absensi
│   ├── controllers/     # Controller untuk setiap endpoint
│   ├── routes/          # Definisi routing API
│   └── public/          # Entry point (index.php)
│
├── frontend/
│   ├── assets/
│   │   ├── css/         # Style CSS
│   │   ├── js/          # JavaScript modules
│   │   └── components/  # Komponen UI (sidebar, navbar, toast)
│   ├── pages/           # Halaman HTML
│   ├── index.html       # Redirect ke login/dashboard
│   └── login.html       # Halaman login
│
└── database/
    └── schema.sql       # Database schema
```

## 🔒 Fitur Keamanan

- ✅ JWT Authentication
- ✅ Password Hashing (bcrypt)
- ✅ Prepared Statements (PDO)
- ✅ Role-based Access Control
- ✅ CORS Configuration
- ✅ Input Validation

## 📱 Fitur Aplikasi

### Admin:
- ✅ Dashboard statistik
- ✅ CRUD User (guru/admin)
- ✅ CRUD Siswa
- ✅ CRUD Absensi
- ✅ Laporan harian & bulanan

### Guru:
- ✅ Dashboard statistik
- ✅ CRUD Siswa
- ✅ CRUD Absensi
- ✅ Laporan harian & bulanan

## 🐛 Troubleshooting

**Error: Token tidak valid**
- Pastikan token disertakan di header Authorization
- Format: `Bearer {token}`

**Error: CORS**
- Pastikan file `backend/config/cors.php` sudah di-include
- Backend dan Frontend harus berjalan di port berbeda

**Error: 404 Not Found**
- Pastikan backend server berjalan di port 8000
- Pastikan frontend server berjalan di port 3000

**Error: Database connection**
- Cek konfigurasi di `backend/config/database.php`
- Pastikan MySQL service running
- Pastikan database sudah di-import

## 📞 Support

Jika ada pertanyaan atau issue, silakan buat issue di repository ini.

## 📄 License

MIT License - Free to use for educational purposes.
