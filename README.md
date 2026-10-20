# Sistem Perpustakaan Laravel

Aplikasi manajemen perpustakaan sederhana, bersih, dan minimalis dibangun dengan Laravel 11.

## Fitur

- **Dashboard** - Ringkasan statistik perpustakaan (total buku, tersedia, dipinjam, total anggota)
- **Katalog Buku** - Daftar buku dengan pencarian, filter kategori & status, tampilan grid
- **Detail Buku** - Informasi lengkap buku, status ketersediaan, form peminjaman langsung
- **Data Anggota** - Manajemen anggota dengan pencarian & filter status
- **Peminjaman** - Buat peminjaman baru, daftar peminjaman aktif, aksi pengembalian
- **Pengembalian** - Kelola pengembalian buku, riwayat pengembalian, deteksi keterlambatan

## Tech Stack

- **Backend**: Laravel 11, PHP 8.2+
- **Database**: SQLite (default), MySQL, PostgreSQL
- **Frontend**: Blade Templates, Tailwind CSS (via CDN)
- **Icons**: SVG inline (Lucide-style)

## Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- Node.js & NPM (untuk asset building)

### Langkah-langkah

```bash
# 1. Masuk ke direktori project
cd perpustakaan-laravel

# 2. Install dependencies PHP
composer install

# 3. Install dependencies Node.js
npm install

# 4. Copy file environment
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Buat database SQLite
touch database/database.sqlite

# 7. Jalankan migrasi & seeder
php artisan migrate --seed

# 8. Build assets (opsional, untuk production)
npm run build

# 9. Jalankan server development
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Struktur Database

### Tabel `categories`
- `id` - Primary key
- `name` - Nama kategori (unique)
- `slug` - Slug URL (unique)
- `description` - Deskripsi kategori

### Tabel `books`
- `id` - Primary key
- `title` - Judul buku
- `author` - Penulis
- `publisher` - Penerbit
- `year` - Tahun terbit
- `isbn` - ISBN (unique, nullable)
- `category_id` - Foreign key ke categories
- `pages` - Jumlah halaman
- `stock` - Total stok
- `description` - Deskripsi buku
- `cover_url` - URL cover buku

### Tabel `members`
- `id` - Primary key
- `member_id` - ID anggota (unique)
- `name` - Nama lengkap
- `nim` - NIM/NIS
- `class_name` - Kelas/Jurusan
- `phone` - Nomor telepon
- `email` - Email (unique, nullable)
- `status` - Aktif/Nonaktif

### Tabel `loans`
- `id` - Primary key
- `loan_code` - Kode pinjam (unique, format: PJ-001)
- `book_id` - Foreign key ke books
- `member_id` - Foreign key ke members
- `loan_date` - Tanggal pinjam
- `due_date` - Tanggal jatuh tempo
- `return_date` - Tanggal kembali (nullable)
- `status` - Dipinjam/Dikembalikan
- `days_late` - Hari terlambat
- `fine` - Denda

## Konfigurasi Database

Default menggunakan SQLite. Untuk MySQL/PostgreSQL, edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

Lalu jalankan `php artisan migrate --seed` kembali.

## Desain

Mengikuti prinsip **Clean & Minimal (GOV.UK style)**:
- Warna netral dengan aksen biru (`primary-600`)
- Tipografi Inter, hierarki jelas
- Spacing konsisten, tanpa dekorasi berlebihan
- Responsif mobile-first
- Aksesibilitas: kontras memadai, navigasi keyboard, label form yang benar

## Lisensi

MIT License