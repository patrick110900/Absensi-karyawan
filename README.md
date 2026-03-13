# 🏢 Sistem Absensi Karyawan
**Laravel 10 · PHP 8.1+ · MySQL · Bootstrap 5**

---

## 📋 Persyaratan Sistem

| Kebutuhan | Versi Minimum |
|---|---|
| PHP | 8.1+ |
| Composer | 2.x |
| MySQL | 5.7+ / MariaDB 10.3+ |
| Web Server | Apache / Nginx / `php artisan serve` |

**PHP Extensions yang dibutuhkan:**
`pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`, `gd`

---

## 🚀 Instalasi Lengkap (Step by Step)

### Langkah 1 — Install PHP & Composer

**Windows:**
```
1. Download XAMPP dari https://www.apachefriends.org/
2. Install XAMPP (sudah include PHP + MySQL)
3. Download Composer dari https://getcomposer.org/download/
4. Install Composer-Setup.exe
5. Restart terminal/CMD
```

**Linux/Ubuntu:**
```bash
sudo apt update
sudo apt install php8.1 php8.1-cli php8.1-mbstring php8.1-xml \
     php8.1-curl php8.1-zip php8.1-mysql php8.1-bcmath php8.1-gd unzip

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

**Mac:**
```bash
brew install php composer
```

### Langkah 2 — Verifikasi Instalasi
```bash
php --version     # harus 8.1+
composer --version # harus 2.x
```

### Langkah 3 — Extract & Masuk ke Folder Project
```bash
# Extract ZIP, lalu:
cd absensi-karyawan
```

### Langkah 4 — Install Dependencies Laravel
```bash
composer install
```
> ⚠️ Proses ini membutuhkan koneksi internet dan sekitar 2-5 menit.
> Folder `vendor/` akan dibuat otomatis.

### Langkah 5 — Buat File Environment
```bash
cp .env.example .env
php artisan key:generate
```

### Langkah 6 — Konfigurasi Database

Buat database MySQL terlebih dahulu:
```sql
CREATE DATABASE absensi_karyawan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=absensi_karyawan
DB_USERNAME=root
DB_PASSWORD=          ← isi password MySQL Anda (kosong jika tidak ada)
```

### Langkah 7 — Jalankan Migration & Seeder
```bash
php artisan migrate
php artisan db:seed
```

### Langkah 8 — Buat Storage Link (untuk foto selfie)
```bash
php artisan storage:link
```

### Langkah 9 — Jalankan Aplikasi
```bash
php artisan serve
```

Buka browser: **http://localhost:8000**

---

## 🔑 Akun Default

| Role | Email | Password |
|---|---|---|
| Admin | admin@absensi.com | password |
| Karyawan | budi@absensi.com | password |
| Karyawan | siti@absensi.com | password |
| Karyawan | ahmad@absensi.com | password |
| Karyawan | dewi@absensi.com | password |
| Karyawan | riko@absensi.com | password |

---

## 🛠️ Artisan Commands

```bash
# Generate laporan absensi hari ini
php artisan attendance:generate-report

# Generate laporan tanggal tertentu
php artisan attendance:generate-report --date=2024-01-15

# Reset database & seed ulang
php artisan migrate:fresh --seed

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## 🗂️ Struktur Folder Lengkap

```
absensi-karyawan/
├── app/
│   ├── Console/
│   │   ├── Kernel.php
│   │   └── Commands/
│   │       └── GenerateAttendanceReport.php
│   ├── Exceptions/
│   │   └── Handler.php
│   ├── Http/
│   │   ├── Kernel.php
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── EmployeeController.php
│   │   │   ├── AttendanceController.php
│   │   │   └── ReportController.php
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php
│   │   │   ├── EncryptCookies.php
│   │   │   ├── RedirectIfAuthenticated.php
│   │   │   ├── RoleMiddleware.php
│   │   │   ├── TrimStrings.php
│   │   │   ├── ValidateSignature.php
│   │   │   └── VerifyCsrfToken.php
│   │   └── Requests/
│   │       └── StoreEmployeeRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Employee.php
│   │   └── Attendance.php
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   └── RouteServiceProvider.php
│   ├── Repositories/
│   │   ├── AttendanceRepository.php
│   │   └── EmployeeRepository.php
│   └── Services/
│       └── AttendanceService.php
├── bootstrap/
│   ├── app.php
│   └── cache/          ← auto-generated
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── cors.php
│   ├── database.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   └── session.php
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_users_table.php
│   │   ├── 2024_01_01_000002_create_employees_table.php
│   │   └── 2024_01_01_000003_create_attendances_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── AdminSeeder.php
│       └── EmployeeSeeder.php
├── public/
│   ├── index.php
│   ├── .htaccess
│   └── storage → ../storage/app/public  (symlink)
├── resources/
│   └── views/
│       ├── layouts/app.blade.php
│       ├── components/
│       │   ├── navbar.blade.php
│       │   ├── sidebar.blade.php
│       │   └── footer.blade.php
│       ├── auth/login.blade.php
│       ├── dashboard/index.blade.php
│       ├── employees/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── attendance/
│       │   ├── checkin.blade.php
│       │   ├── history.blade.php
│       │   └── admin-index.blade.php
│       └── reports/index.blade.php
├── routes/
│   ├── web.php
│   ├── api.php
│   └── console.php
├── storage/
│   ├── app/public/attendance/   ← foto selfie disimpan di sini
│   ├── framework/
│   └── logs/
├── vendor/              ← dibuat setelah `composer install`
├── .env                 ← dibuat dari .env.example
├── .env.example
├── artisan
├── composer.json
└── README.md
```

---

## 🌐 Deploy ke Production (cPanel / VPS)

### Nginx Config
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/absensi-karyawan/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### Apache (sudah include .htaccess)
Pastikan `mod_rewrite` aktif:
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### Perintah Production
```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

---

## ❓ Troubleshooting

| Masalah | Solusi |
|---|---|
| `Class not found` | Jalankan `composer install` |
| `No application key` | Jalankan `php artisan key:generate` |
| `SQLSTATE connection refused` | Cek config DB di `.env`, pastikan MySQL berjalan |
| Foto tidak tampil | Jalankan `php artisan storage:link` |
| Error 500 | Cek `storage/logs/laravel.log` |
| Permission denied | `chmod -R 775 storage bootstrap/cache` |
