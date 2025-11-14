# 🌙 Portal Islami - Modern Islamic Web Portal

Portal Islami adalah aplikasi web all-in-one berbasis CodeIgniter 4 dengan tampilan modern menggunakan AdminLTE. Aplikasi ini menyediakan berbagai fitur untuk membantu umat Islam dalam meningkatkan pemahaman dan pengamalan agama.

## ✨ Fitur Utama

### 📖 Konten Islami (dari API Eksternal)
- **Al-Quran Digital**: Baca 114 surah lengkap dengan terjemahan Indonesia
- **Quiz Al-Quran**: Uji pengetahuan Al-Quran dengan pertanyaan interaktif
- **Doa & Dzikir**: Kumpulan doa harian dengan teks Arab, latin, dan terjemahan
- **Jadwal Shalat**: Waktu shalat berdasarkan lokasi dan kalender Hijriyah
- **Hadits**: Koleksi hadits shahih dari berbagai kitab
- **Kisah Islami**: Kisah inspiratif para Nabi dan Sahabat

### 👤 Fitur Personal (Database Lokal)
- **Autentikasi User**: Register, login, dan manajemen session
- **Habit Tracker**: Pantau amalan harian Anda
- **Quiz History**: Simpan hasil quiz dan lihat statistik

## 🏗️ Arsitektur

```
Portal Islami
├── API Layer (External)
│   ├── Quran API (api.quran.com)
│   ├── Doa API (doa-doa-api)
│   ├── Prayer Times API (aladhan.com)
│   ├── Hadith API (hadith.gading.dev)
│   └── Stories (Custom/Mock)
│
├── Application Layer (CodeIgniter 4)
│   ├── Controllers
│   ├── Models
│   ├── Views (AdminLTE)
│   └── Libraries (API Services)
│
└── Database Layer (Local)
    ├── Users
    ├── Quiz Results
    ├── Habits
    └── Habit Logs
```

## 🚀 Instalasi

### Prerequisites
- PHP >= 7.4
- Composer
- MySQL / MariaDB
- Web Server (Apache/Nginx)

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone <repository-url>
cd portal-islami
```

2. **Install Dependencies**
```bash
composer install
```

3. **Konfigurasi Environment**
```bash
cp env .env
```

Edit file `.env`:
```env
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = portal_islami
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
```

4. **Buat Database**
```bash
mysql -u root -p
CREATE DATABASE portal_islami;
exit;
```

5. **Jalankan Migrasi**
```bash
php spark migrate
```

6. **Jalankan Seeder (Opsional)**
```bash
php spark db:seed MainSeeder
```

Seeder akan membuat:
- 8 habit default (Shalat Tahajud, Dhuha, Baca Quran, dll)
- 2 user demo:
  - Admin: `admin@portal-islami.com` / `admin123`
  - User: `user@portal-islami.com` / `user123`

7. **Jalankan Development Server**
```bash
php spark serve
```

Akses aplikasi di: `http://localhost:8080`

## 📁 Struktur Direktori

```
portal-islami/
├── app/
│   ├── Config/
│   │   ├── Routes.php         # Routing konfigurasi
│   │   └── Filters.php        # Filter konfigurasi
│   ├── Controllers/
│   │   ├── Home.php           # Beranda
│   │   ├── AuthController.php # Autentikasi
│   │   ├── QuranController.php
│   │   ├── QuranQuizController.php
│   │   ├── DoaDzikirController.php
│   │   ├── PrayerController.php
│   │   ├── HadithController.php
│   │   ├── StoryController.php
│   │   └── HabitController.php
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── QuranQuizResultModel.php
│   │   ├── HabitModel.php
│   │   └── HabitLogModel.php
│   ├── Libraries/
│   │   ├── QuranApiService.php
│   │   ├── DoaApiService.php
│   │   ├── PrayerApiService.php
│   │   ├── HadithApiService.php
│   │   └── StoryApiService.php
│   ├── Filters/
│   │   └── AuthFilter.php     # Auth middleware
│   ├── Views/
│   │   ├── layouts/
│   │   │   └── adminlte.php   # Layout utama
│   │   ├── home.php
│   │   ├── auth/
│   │   │   ├── login.php
│   │   │   └── register.php
│   │   ├── quran/
│   │   │   ├── index.php
│   │   │   └── surah.php
│   │   ├── quiz/
│   │   │   ├── index.php
│   │   │   ├── start.php
│   │   │   └── result.php
│   │   ├── doa/
│   │   ├── prayer/
│   │   ├── hadith/
│   │   ├── story/
│   │   └── habit/
│   └── Database/
│       ├── Migrations/        # Database migrations
│       └── Seeds/             # Database seeders
├── public/
│   └── index.php
└── writable/
```

## 🌐 API Eksternal yang Digunakan

1. **Quran API** - https://api.quran.com/api/v4
   - Daftar surah
   - Ayat-ayat Al-Quran
   - Terjemahan Indonesia

2. **Doa API** - https://doa-doa-api-ahmadramadhan.fly.dev
   - Koleksi doa harian
   - Teks Arab, latin, dan terjemahan

3. **Prayer Times API** - https://api.aladhan.com/v1
   - Jadwal waktu shalat
   - Konversi kalender Hijriyah

4. **Hadith API** - https://api.hadith.gading.dev
   - Koleksi hadits dari berbagai kitab
   - Bukhari, Muslim, Tirmidzi, Abu Dawud

## 🔐 Autentikasi

Aplikasi menggunakan session-based authentication:
- Register user baru
- Login dengan email & password
- Session management
- Protected routes untuk fitur personal (Quiz, Habit Tracker)

## 📊 Database Schema

### Users
- id, name, email, password_hash, role, created_at, updated_at

### Quran Quiz Results
- id, user_id, total_questions, correct_answers, score, quiz_type, created_at

### Habits
- id, name, description, icon, is_active, created_at, updated_at

### Habit Logs
- id, user_id, habit_id, log_date, status, created_at, updated_at

## 🎨 Tampilan UI

Aplikasi menggunakan **AdminLTE 3.2** dengan komponen:
- Responsive sidebar navigation
- Card components
- Tables & forms
- Alerts & notifications
- Custom Islamic styling (gradient purple theme)

## 🔧 Konfigurasi Tambahan

### Mengubah Lokasi Jadwal Shalat
Default lokasi: Jakarta, Indonesia

Ubah di `PrayerController`:
```php
$city = $this->request->getGet('city') ?? 'Jakarta';
$country = $this->request->getGet('country') ?? 'Indonesia';
```

### Menambah Habit Baru
1. Via database langsung, atau
2. Tambahkan di `HabitSeeder.php` dan jalankan ulang seeder

## 🚧 Troubleshooting

### Error: "Class 'App\Libraries\...' not found"
Pastikan autoload berjalan dengan benar:
```bash
composer dump-autoload
```

### Error API tidak merespon
Periksa koneksi internet dan pastikan API endpoints masih aktif.

### Error database
Pastikan konfigurasi `.env` sudah benar dan migrasi sudah dijalankan.

## 📝 Catatan Pengembangan

### Menambah API Baru
1. Buat service class di `app/Libraries/`
2. Implementasikan method untuk consume API
3. Gunakan `Services::curlrequest()` untuk HTTP calls
4. Parse JSON response dan return data

### Menambah Fitur Baru
1. Buat controller di `app/Controllers/`
2. Buat view di `app/Views/`
3. Tambahkan route di `app/Config/Routes.php`
4. Extend layout `layouts/adminlte.php`

## 🤝 Kontribusi

Contributions are welcome! Feel free to submit pull requests atau membuka issue untuk bug reports dan feature requests.

## 📄 Lisensi

Open source - bebas digunakan untuk keperluan pendidikan dan pengembangan.

## 🙏 Acknowledgments

- CodeIgniter 4 Framework
- AdminLTE Template
- Quran.com API
- Aladhan Prayer Times API
- Hadith Gading API

---

**Dibuat dengan ❤️ untuk umat Islam**
