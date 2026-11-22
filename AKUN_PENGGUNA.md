# Daftar Akun dan Kredensial Pengguna BiteSavr

Dokumen ini memuat daftar akun, peran (*role*), kredensial akses, hak akses dashboard, dan URL login untuk sistem **BiteSavr**.

---

## Ringkasan Hak Akses Berdasarkan Role

| Peran (*Role*) | Scope Akses | Rute / Halaman Utama | Metode Login |
| :--- | :--- | :--- | :--- |
| **Admin** | Pengelolaan penuh sistem (Mitra, Pengguna, Monitoring Produk & Transaksi) | `/admin` | Email & Password |
| **Mitra (Manager / Staff)** | Pengelolaan produk surplus, pesanan masuk, laporan penjualan, profil usaha | `/mitra-dashboard` | Email & Password |
| **Pelanggan (Konsumen)** | Jelajah penawaran surplus, checkout pesanan, melihat struk digital & QR Code | `/` & `/katalog` | Google OAuth / Email & Password |

---

## 1. Akun Administrator (Super User)

Digunakan untuk mengontrol keseluruhan operasional sistem platform BiteSavr.

- **URL Login**: `http://localhost:8000/login`
- **Dashboard**: `http://localhost:8000/admin`
- **Nama**: Admin BiteSavr
- **Email**: `admin@bitesavr.id`
- **Password**: `password123`
- **Hak Akses**:
  - Ringkasan statistik & metrik platform (omzet, produk aktif, total transaksi)
  - Kelola Mitra (verifikasi status, tambah mitra baru, edit profil usaha)
  - Kelola Pengguna (manajemen admin, manager mitra, staff, dan konsumen)
  - Monitoring seluruh produk surplus dan riwayat transaksi

---

## 2. Akun Mitra (Penjual Makanan Surplus)

Setiap mitra memiliki unit usaha kuliner tersendiri dan dashboard berbasis template Tabletop. Akun manager mitra dibuat dan diotorisasi oleh Admin.

- **URL Login**: `http://localhost:8000/login`
- **Dashboard**: `http://localhost:8000/mitra-dashboard`
- **Password Default Seluruh Mitra**: `password123`

### Rincian Akun Mitra:

| No | Unit Usaha Kuliner | Kategori Usaha | Nama Manager | Email Login | Password |
| :---: | :--- | :--- | :--- | :--- | :--- |
| 1 | **Resto Padang Sederhana** | Restoran | H. Buyung Padang | `mitra1@bitesavr.id` | `password123` |
| 2 | **Hotel Pekanbaru Bakery** | Bakery & Pastry | Chef Robert Lim | `mitra2@bitesavr.id` | `password123` |
| 3 | **Seafood Riau Bahari** | Seafood | Bambang Irawan | `mitra3@bitesavr.id` | `password123` |
| 4 | **Kafe Senja Pekanbaru** | Kafe / Minuman | Dimas Prasetyo | `mitra4@bitesavr.id` | `password123` |
| 5 | **Warung Ayam Kampung** | Warung Makan | Siti Rohimah | `mitra5@bitesavr.id` | `password123` |

### Fitur Dashboard Mitra:
- **Ringkasan**: Analisis grafik penjualan, pendapatan hari ini, dan pesanan pending.
- **Produk Surplus**: Input produk makanan surplus (kategori, harga asli, harga diskon otomatis, stok, batas waktu kelayakan konsumsi, titik penjemputan, dan foto).
- **Transaksi**: Konfirmasi pesanan pelanggan saat penukaran struk QR Code.
- **Laporan**: Unduh dan cetak rekapitulasi penjualan per rentang tanggal.
- **Profil Usaha**: Pembaruan jam operasional, koordinat peta, kontak, dan deskripsi restoran.

---

## 3. Akun Pelanggan (Konsumen)

Digunakan untuk menjelajah katalog deal, mengklaim/membeli makanan surplus, dan menerima struk digital QR Code.

### Opsi A: Login Akun Google (Rekomendasi Pelanggan)
- **Akses Login**: Klik tombol **"Masuk dengan Google"** di halaman login (`/login`) atau modal pembelian katalog (`/katalog`).
- **Akun Tersedia**:
  - **Nama**: Sofia Zhang
  - **Email**: `sofia.zhang@gmail.com`
  - **Metode**: Google Socialite OAuth

### Opsi B: Login Email & Password Langsung
- **URL Login**: `http://localhost:8000/login`
- **Nama**: Budi Santoso
- **Email**: `pelanggan@bitesavr.id`
- **Password**: `password123`
- **Hak Akses**:
  - Beranda (`/`) & Katalog Deal (`/katalog`)
  - Riwayat Pesanan & Struk Digital QR Code (`/pesanan`, `/pesanan/{kode}`)

---

## Catatan Penggunaan

1. Jika database di-*refresh* (`php artisan migrate:fresh --seed`), seluruh data akun di atas akan secara otomatis terisi kembali dengan password default `password123`.
2. Admin dapat menambahkan mitra baru kapan saja melalui menu **Admin > Kelola Mitra > Tambah Mitra**, yang secara otomatis membuatkan akun Manager untuk mitra tersebut.
