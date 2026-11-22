# BiteSavr — Surplus Food Marketplace Pekanbaru

> **BiteSavr** adalah platform marketplace makanan surplus berdiskon dan penyelamatan pangan dari hotel, restoran, kafe, dan bakery di Kota Pekanbaru guna mewujudkan ekosistem *Zero Food Waste*.

---

## 📋 Daftar Isi
1. [Tentang Platform](#tentang-platform)
2. [Fitur Unggulan](#fitur-unggulan)
3. [Arsitektur & Matriks Hak Akses (Multi-Role)](#arsitektur--matriks-hak-akses-multi-role)
4. [Teknologi yang Digunakan](#teknologi-yang-digunakan)
5. [Struktur Direktori Utama](#struktur-direktori-utama)
6. [Panduan Instalasi & Menjalankan Aplikasi](#panduan-instalasi--menjalankan-aplikasi)
7. [Konfigurasi Google OAuth](#konfigurasi-google-oauth)
8. [Daftar Akun Pengguna & Kredensial](#daftar-akun-pengguna--kredensial)
9. [Pengujian Otomatis (Automated Testing)](#pengujian-otomatis-automated-testing)

---

## 🌟 Tentang Platform

Setiap hari, hotel, restoran, dan toko roti berkualitas memproduksi makanan layak konsumsi berlebih yang berisiko terbuang saat jam operasional berakhir. BiteSavr hadir sebagai jembatan antara **Mitra Kuliner** dan **Pelanggan**:
- **Mitra** dapat menjual makanan surplus berkualitas dengan diskon hingga 70% sebelum waktu kelayakan konsumsi habis, mengubah potensi kerugian menjadi pendapatan tambahan.
- **Pelanggan** mendapatkan makanan berkualitas hotel/restoran dengan harga terjangkau.
- **Admin** memfasilitasi verifikasi mitra, pemantauan transaksi, dan memastikan ekosistem berjalan aman dan terpercaya.

---

## 🚀 Fitur Unggulan

### 1. Pelanggan (Konsumen)
- **Halaman Beranda Interaktif**: Animasi *scrollytelling* interaktif, visualisasi kantong penyelamat, dampak lingkungan real-time (porsi terselamatkan, kg makanan, estimasi rupiah dihemat), serta peta sebaran mitra kuliner Pekanbaru.
- **Katalog Deal Real-Time**:
  - Filter kategori makanan (Nasi & Lauk, Roti & Kue, Seafood, Minuman, Mie & Pasta, Lainnya).
  - Pencarian makanan atau restoran.
  - Urutkan berdasarkan waktu segera berakhir, harga termurah, diskon terbesar, atau jarak terdekat.
  - Fitur **"Dekat saya"** yang mengkalkulasi jarak GPS penjemputan dari lokasi pengguna di Pekanbaru.
  - Bilah indikator waktu visual (*meter countdown timer*) dan deteksi stok menipis.
- **Otentikasi Google OAuth & Email**: Login 1-klik menggunakan akun Google resmi pelanggan.
- **Pemesanan & Struk Digital**: Riwayat pesanan dilengkapi struk digital dan **QR Code dinamis** untuk diverifikasi langsung di kasir mitra saat penjemputan makanan.

### 2. Mitra (Penjual Makanan Surplus / Seller Dashboard)
- **Dashboard Khusus Mitra**: Dibangun dengan template *Tabletop* berdesain modern, elegan, responsif, dan mendukung mode gelap (*dark mode*).
- **Manajemen Produk Surplus**:
  - Tambah, edit, dan hapus menu surplus.
  - Kalkulasi otomatis persentase diskon saat menginput harga normal dan harga promo.
  - Penentuan batas waktu kelayakan konsumsi (*countdown*) dan titik penjemputan (misal: "Meja kasir lantai 1").
  - Unggah foto produk surplus.
- **Manajemen Transaksi Penjemputan**:
  - Melihat daftar pesanan pelanggan yang masuk.
  - Validasi penukaran kode pesanan / QR Code kasir dan pembaruan status pesanan (*diambil* / *selesai*).
- **Laporan Penjualan**: Rekapitulasi omzet dan kuantitas produk terselamatkan berdasarkan rentang tanggal.
- **Pengaturan Profil Toko**: Kelola nama usaha, alamat fisik, titik koordinat GPS, kontak, jam operasional, dan deskripsi restoran.

### 3. Administrator (Super User Control Panel)
- **Panel Admin Terpusat**:
  - Ringkasan metrik platform (total omzet mitra, total porsi terselamatkan, total mitra aktif, dan transaksi).
  - **Kelola Mitra**: Pendaftaran mitra baru (yang otomatis membuatkan akun Manager untuk mitra tersebut), edit profil mitra, dan fitur verifikasi status 1-klik (*verified* / *pending*).
  - **Kelola Pengguna**: CRUD akun admin, manager mitra, staff, dan konsumen.
  - **Monitoring Produk & Transaksi**: Pengawasan katalog produk aktif dan lalu lintas transaksi seluruh mitra di Kota Pekanbaru.

---

## 🔐 Arsitektur & Matriks Hak Akses (Multi-Role)

Sistem otentikasi menerapkan **Role-Based Access Control (RBAC)** dengan middleware kustom `RoleMiddleware` (`role:admin` dan `role:mitra_manager,mitra_staff`).

| Halaman / Fitur | Tamu (Guest) | Pelanggan (`konsumen`) | Mitra (`mitra_manager`, `mitra_staff`) | Admin (`admin`) |
| :--- | :---: | :---: | :---: | :---: |
| Beranda (`/`) | ✅ | ✅ | ✅ | ✅ |
| Katalog Deal (`/katalog`) | ✅ | ✅ | ✅ | ✅ |
| Checkout & Beli Makanan | ❌ (Diwajibkan Login) | ✅ | ❌ | ❌ |
| Riwayat Pesanan & Struk QR (`/pesanan`) | ❌ | ✅ | ❌ | ❌ |
| Dashboard Mitra (`/mitra-dashboard/*`) | ❌ (403) | ❌ (403) | ✅ | ❌ (403) |
| Dashboard Admin (`/admin/*`) | ❌ (403) | ❌ (403) | ❌ (403) | ✅ |

---

## 🛠 Teknologi yang Digunakan

- **Backend Framework**: [Laravel 12.x](https://laravel.com) (PHP 8.2+)
- **Database**: MySQL / MariaDB (Didukung SQLite untuk Automated Test Suite in-memory)
- **Otentikasi & OAuth**: `laravel/socialite` (Google OAuth 2.0) & Session Authentication
- **Frontend & Styling**: Blade Templating, Vanilla CSS Custom Properties, Google Fonts (Poppins, Inter, Archivo)
- **Dashboard UI**: Tabletop Dashboard Theme (Sidebar modular, Dark/Light theme toggle)
- **Local Dev Stack**: Laragon / Apache / Composer

---

## 📁 Struktur Direktori Utama

```text
bitesavr/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/             # Controller Dashboard Admin (Mitra, User, Product, Transaction)
│   │   │   ├── Auth/              # LoginController & GoogleController (OAuth)
│   │   │   ├── Mitra/             # Controller Dashboard Mitra (Product, Transaction, Report, Profile)
│   │   │   ├── HomeController.php # Beranda & Katalog deal real-time
│   │   │   └── OrderController.php# Pemesanan pelanggan & Struk QR
│   │   └── Middleware/
│   │       └── RoleMiddleware.php # Middleware RBAC multi-role
│   └── Models/
│       ├── MitraProfile.php       # Profil unit usaha kuliner mitra
│       ├── Product.php            # Produk makanan surplus
│       ├── Transaction.php        # Transaksi pemesanan & struk
│       └── User.php               # Model pengguna multi-role
├── database/
│   ├── migrations/                # Skema tabel users, mitras, products, transactions
│   └── seeders/DatabaseSeeder.php # Seeder akun admin, 5 mitra kuliner, 14 produk deal, & pelanggan
├── resources/views/
│   ├── admin/                     # View dashboard panel admin
│   ├── auth/                      # Form login modern
│   ├── errors/                    # Halaman 403 & 404 bertema BiteSavr
│   ├── layouts/                   # Layout dashboard admin & mitra
│   ├── mitra/                     # View dashboard mitra (produk, pesanan, profil, laporan)
│   └── public/                    # Halaman beranda, katalog, pesanan, dan struk digital
├── routes/
│   └── web.php                    # Definisi seluruh rute aplikasi terproteksi role
└── tests/Feature/
    └── MultiRoleSystemTest.php    # Automated feature test alur multi-role
```

---

## 💻 Panduan Instalasi & Menjalankan Aplikasi

### 1. Kloning Repositori & Masuk ke Direktori
```powershell
cd D:\PENYIMPANAN1\PCR\Sem3\BPF\laragon\www\bitesavr
```

### 2. Salin Berkas `.env` & Buat Database
Pastikan database MySQL bernama `bitesavr_db` telah dibuat di phpMyAdmin / HeidiSQL Laragon.

Konfigurasi database di file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bitesavr_db
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Migrasi & Seed Database
Jalankan migrasi dan seeder untuk membuat tabel dan data awal:
```powershell
php artisan migrate:fresh --seed
```

### 4. Buat Symlink Storage
Agar foto produk mitra dapat diakses oleh publik:
```powershell
php artisan storage:link
```

### 5. Jalankan Server Aplikasi
```powershell
php artisan serve
```
Akses aplikasi melalui browser: **`http://localhost:8000`**

---

## 🔑 Konfigurasi Google OAuth

Untuk mengaktifkan login Google:
1. Buka [Google Cloud Console Credentials](https://console.cloud.google.com/apis/credentials).
2. Buat **OAuth client ID** bertipe **Web application**.
3. Daftarkan **Authorized redirect URIs**:
   ```text
   http://localhost:8000/auth/google/callback
   ```
4. Tambahkan kredensial ke file `.env`:
   ```env
   GOOGLE_CLIENT_ID=your-google-client-id
   GOOGLE_CLIENT_SECRET=your-google-client-secret
   GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
   ```
5. Bersihkan cache:
   ```powershell
   php artisan config:clear
   ```

*Catatan: Jika dijalankan di lingkungan lokal tanpa konfigurasi Google OAuth, sistem memiliki fallback otomatis yang langsung memasukkan pengguna sebagai Pelanggan tanpa hambatan error 401.*

---

## 👥 Daftar Akun Pengguna & Kredensial

*Password default untuk seluruh akun email di bawah ini adalah: **`password123`***

| Role | Nama Pengguna | Email | Target Dashboard |
| :--- | :--- | :--- | :--- |
| **Admin** | Admin BiteSavr | `admin@bitesavr.id` | `/admin` |
| **Mitra 1** | H. Buyung (Resto Padang Sederhana) | `mitra1@bitesavr.id` | `/mitra-dashboard` |
| **Mitra 2** | Chef Robert Lim (Hotel Pekanbaru Bakery) | `mitra2@bitesavr.id` | `/mitra-dashboard` |
| **Mitra 3** | Bambang Irawan (Seafood Riau Bahari) | `mitra3@bitesavr.id` | `/mitra-dashboard` |
| **Mitra 4** | Dimas Prasetyo (Kafe Senja) | `mitra4@bitesavr.id` | `/mitra-dashboard` |
| **Mitra 5** | Siti Rohimah (Warung Ayam Kampung) | `mitra5@bitesavr.id` | `/mitra-dashboard` |
| **Pelanggan** | Budi Santoso | `pelanggan@bitesavr.id` | `/katalog` |
| **Pelanggan (Google)** | Akun Google Pengguna | *(OAuth Google)* | `/katalog` |

*(Rincian lengkap kredensial dapat dibaca di berkas `AKUN_PENGGUNA.md`)*

---

## 🧪 Pengujian Otomatis (Automated Testing)

Proyek ini dilengkapi dengan Automated Feature Test suite yang memvalidasi integritas autentikasi, isolasi hak akses role, serta alur pemesanan makanan:

```powershell
php artisan test
```

### Hasil Uji:
```text
PASS Tests\Unit\ExampleTest
✓ that true is true

PASS Tests\Feature\ExampleTest
✓ the application returns a successful response

PASS Tests\Feature\MultiRoleSystemTest
✓ guest can access home and katalog
✓ konsumen cannot access admin or mitra dashboard
✓ mitra can access mitra dashboard and reports but not admin
✓ admin can access admin dashboard and mitra management
✓ pelanggan can order food and stock is reduced

Tests: 7 passed (17 assertions)
```

---

## 📄 Lisensi
Hak Cipta © 2026 **BiteSavr**. Seluruh hak cipta dilindungi undang-undang.
