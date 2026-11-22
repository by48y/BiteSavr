<?php

namespace Database\Seeders;

use App\Models\MitraProfile;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun administrator
        $admin = User::firstOrCreate(
            ['email' => 'admin@bitesavr.id'],
            [
                'nama'     => 'Admin BiteSavr',
                'email'    => 'admin@bitesavr.id',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );

        // Akun pelanggan
        $pelanggan1 = User::firstOrCreate(
            ['email' => 'pelanggan@bitesavr.id'],
            [
                'nama'     => 'Budi Santoso',
                'email'    => 'pelanggan@bitesavr.id',
                'password' => Hash::make('password123'),
                'role'     => 'konsumen',
            ]
        );

        $pelanggan2 = User::firstOrCreate(
            ['email' => 'sofia.zhang@gmail.com'],
            [
                'nama'      => 'Sofia Zhang',
                'email'     => 'sofia.zhang@gmail.com',
                'google_id' => '10928374650192837465',
                'avatar'    => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150',
                'password'  => Hash::make(Str::random(16)),
                'role'      => 'konsumen',
            ]
        );

        // Data mitra dan produk
        $mitrasData = [
            [
                'nama_usaha'        => 'Resto Padang Sederhana',
                'alamat'            => 'Jl. Jenderal Sudirman No. 12, Pekanbaru',
                'koordinat'         => '0.5337,101.4475',
                'no_telepon'        => '081234567890',
                'email_usaha'       => 'padang.sederhana@email.com',
                'deskripsi'         => 'Restoran Padang autentik dengan cita rasa khas Minang, menyajikan lauk pauk berkualitas tinggi.',
                'kategori'          => 'Restoran',
                'jam_operasional'   => '08:00 - 21:00',
                'status_verifikasi' => 'verified',
                'manager'           => [
                    'nama'  => 'H. Buyung Padang',
                    'email' => 'mitra1@bitesavr.id',
                ],
                'products' => [
                    [
                        'nama_produk'          => 'Nasi Rendang Set',
                        'kategori'             => 'nasi',
                        'stok'                 => 5,
                        'harga_asli'           => 45000,
                        'harga_diskon'         => 15000,
                        'titik_penjemputan'    => 'Meja kasir lantai 1',
                        'deskripsi'            => 'Paket nasi lengkap dengan rendang sapi empuk, daun singkong, sambal ijo, dan gulai nangka.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(3),
                        'status'               => 'tersedia',
                    ],
                    [
                        'nama_produk'          => 'Nasi Ayam Gulai',
                        'kategori'             => 'nasi',
                        'stok'                 => 6,
                        'harga_asli'           => 38000,
                        'harga_diskon'         => 14000,
                        'titik_penjemputan'    => 'Meja kasir lantai 1',
                        'deskripsi'            => 'Ayam gulai bumbu rempah melimpah dengan kuah santan gurih khas Padang.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(4),
                        'status'               => 'tersedia',
                    ],
                    [
                        'nama_produk'          => 'Paket Lauk Hemat',
                        'kategori'             => 'nasi',
                        'stok'                 => 4,
                        'harga_asli'           => 55000,
                        'harga_diskon'         => 20000,
                        'titik_penjemputan'    => 'Meja kasir lantai 1',
                        'deskripsi'            => 'Aneka lauk pauk pilihan segar hari ini untuk santap siang atau malam.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(2),
                        'status'               => 'tersedia',
                    ],
                ],
            ],
            [
                'nama_usaha'        => 'Hotel Pekanbaru Bakery',
                'alamat'            => 'Jl. Jenderal Sudirman No. 45, Pekanbaru',
                'koordinat'         => '0.5291,101.4452',
                'no_telepon'        => '081298765432',
                'email_usaha'       => 'bakery@hotelpku.com',
                'deskripsi'         => 'Bakery hotel bintang 4 dengan standar pastry Eropa, dipanggang fresh setiap pagi.',
                'kategori'          => 'Bakery',
                'jam_operasional'   => '06:00 - 22:00',
                'status_verifikasi' => 'verified',
                'manager'           => [
                    'nama'  => 'Chef Robert Lim',
                    'email' => 'mitra2@bitesavr.id',
                ],
                'products' => [
                    [
                        'nama_produk'          => 'Paket Pastry 4 pcs',
                        'kategori'             => 'roti_kue',
                        'stok'                 => 5,
                        'harga_asli'           => 60000,
                        'harga_diskon'         => 24000,
                        'titik_penjemputan'    => 'Lobi hotel, counter bakery',
                        'deskripsi'            => 'Mix croissant butter, pain au chocolat, dan fruit Danish renyah lezat.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(3)->addMinutes(30),
                        'status'               => 'tersedia',
                    ],
                    [
                        'nama_produk'          => 'Roti Gandum Utuh',
                        'kategori'             => 'roti_kue',
                        'stok'                 => 8,
                        'harga_asli'           => 30000,
                        'harga_diskon'         => 12000,
                        'titik_penjemputan'    => 'Lobi hotel, counter bakery',
                        'deskripsi'            => 'Whole wheat sourdough kaya serat tanpa bahan pengawet.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(5),
                        'status'               => 'tersedia',
                    ],
                    [
                        'nama_produk'          => 'Cake Slice Assortment',
                        'kategori'             => 'roti_kue',
                        'stok'                 => 3,
                        'harga_asli'           => 70000,
                        'harga_diskon'         => 28000,
                        'titik_penjemputan'    => 'Lobi hotel, counter bakery',
                        'deskripsi'            => '3 potong cake premium: Black Forest, Red Velvet, dan Tiramisu.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(2),
                        'status'               => 'tersedia',
                    ],
                ],
            ],
            [
                'nama_usaha'        => 'Seafood Riau Bahari',
                'alamat'            => 'Jl. Tuanku Tambusai No. 8, Pekanbaru',
                'koordinat'         => '0.5059,101.4127',
                'no_telepon'        => '081377889900',
                'email_usaha'       => 'bahari@seafoodriau.com',
                'deskripsi'         => 'Olahan seafood segar harian dari perairan Riau dengan saus racikan istimewa.',
                'kategori'          => 'Seafood',
                'jam_operasional'   => '10:00 - 22:00',
                'status_verifikasi' => 'verified',
                'manager'           => [
                    'nama'  => 'Bambang Irawan',
                    'email' => 'mitra3@bitesavr.id',
                ],
                'products' => [
                    [
                        'nama_produk'          => 'Udang Saus Padang',
                        'kategori'             => 'seafood',
                        'stok'                 => 3,
                        'harga_asli'           => 80000,
                        'harga_diskon'         => 32000,
                        'titik_penjemputan'    => 'Kasir depan resto',
                        'deskripsi'            => 'Udang windu segar dengan baluran saus padang pedas manis kaya rempah.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(2)->addMinutes(15),
                        'status'               => 'tersedia',
                    ],
                    [
                        'nama_produk'          => 'Ikan Bakar Kecap',
                        'kategori'             => 'seafood',
                        'stok'                 => 4,
                        'harga_asli'           => 75000,
                        'harga_diskon'         => 30000,
                        'titik_penjemputan'    => 'Kasir depan resto',
                        'deskripsi'            => 'Ikan bawal bakar wangi aroma arang dengan bumbu olesan kecap pedas.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(4),
                        'status'               => 'tersedia',
                    ],
                    [
                        'nama_produk'          => 'Cumi Goreng Tepung',
                        'kategori'             => 'seafood',
                        'stok'                 => 3,
                        'harga_asli'           => 65000,
                        'harga_diskon'         => 26000,
                        'titik_penjemputan'    => 'Kasir depan resto',
                        'deskripsi'            => 'Ring cumi garing gurih disajikan dengan saus tartar atau saus sambal.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(3),
                        'status'               => 'tersedia',
                    ],
                ],
            ],
            [
                'nama_usaha'        => 'Kafe Senja Pekanbaru',
                'alamat'            => 'Jl. Arifin Ahmad No. 21, Pekanbaru',
                'koordinat'         => '0.4969,101.4486',
                'no_telepon'        => '081266554433',
                'email_usaha'       => 'senja@kafepku.id',
                'deskripsi'         => 'Coffee shop modern dengan variasi minuman kopi specialty dan makanan ringan.',
                'kategori'          => 'Kafe',
                'jam_operasional'   => '09:00 - 23:00',
                'status_verifikasi' => 'verified',
                'manager'           => [
                    'nama'  => 'Dimas Prasetyo',
                    'email' => 'mitra4@bitesavr.id',
                ],
                'products' => [
                    [
                        'nama_produk'          => 'Roti Bakar & Kopi Latte',
                        'kategori'             => 'minuman',
                        'stok'                 => 7,
                        'harga_asli'           => 35000,
                        'harga_diskon'         => 15000,
                        'titik_penjemputan'    => 'Bar barista utama',
                        'deskripsi'            => 'Paket combo roti bakar keju cokelat dan 1 cup iced caffe latte.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(4),
                        'status'               => 'tersedia',
                    ],
                    [
                        'nama_produk'          => 'Es Kopi Susu Aren (2 Cup)',
                        'kategori'             => 'minuman',
                        'stok'                 => 8,
                        'harga_asli'           => 40000,
                        'harga_diskon'         => 16000,
                        'titik_penjemputan'    => 'Bar barista utama',
                        'deskripsi'            => 'Signature kopi susu gula aren asli siap santap.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(5),
                        'status'               => 'tersedia',
                    ],
                    [
                        'nama_produk'          => 'Salad Buah Segar',
                        'kategori'             => 'lainnya',
                        'stok'                 => 5,
                        'harga_asli'           => 32000,
                        'harga_diskon'         => 13000,
                        'titik_penjemputan'    => 'Bar barista utama',
                        'deskripsi'            => 'Potongan melon, semangka, apel, nata de coco dengan dressing creamy.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(3),
                        'status'               => 'tersedia',
                    ],
                ],
            ],
            [
                'nama_usaha'        => 'Warung Ayam Kampung',
                'alamat'            => 'Jl. Soekarno-Hatta No. 77, Pekanbaru',
                'koordinat'         => '0.4764,101.4263',
                'no_telepon'        => '081311223344',
                'email_usaha'       => 'warung@ayamkampung.com',
                'deskripsi'         => 'Warung makan tradisional khas masakan nusantara dengan ayam kampung asli.',
                'kategori'          => 'Warung Makan',
                'jam_operasional'   => '07:00 - 20:00',
                'status_verifikasi' => 'verified',
                'manager'           => [
                    'nama'  => 'Siti Rohimah',
                    'email' => 'mitra5@bitesavr.id',
                ],
                'products' => [
                    [
                        'nama_produk'          => 'Mie Goreng Spesial',
                        'kategori'             => 'mie',
                        'stok'                 => 6,
                        'harga_asli'           => 28000,
                        'harga_diskon'         => 11000,
                        'titik_penjemputan'    => 'Kasir warung depan',
                        'deskripsi'            => 'Mie goreng kuning gurih dengan suwiran ayam kampung, telur, dan acar.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(3),
                        'status'               => 'tersedia',
                    ],
                    [
                        'nama_produk'          => 'Ayam Penyet Komplit',
                        'kategori'             => 'nasi',
                        'stok'                 => 4,
                        'harga_asli'           => 36000,
                        'harga_diskon'         => 14000,
                        'titik_penjemputan'    => 'Kasir warung depan',
                        'deskripsi'            => 'Ayam penyet goreng rempah, tahu tempe, lalapan dan sambal korek pedas.',
                        'batas_waktu_konsumsi' => Carbon::now()->addHours(2),
                        'status'               => 'tersedia',
                    ],
                ],
            ],
        ];

        $createdProducts = [];

        foreach ($mitrasData as $data) {
            $mitra = MitraProfile::updateOrCreate(
                ['nama_usaha' => $data['nama_usaha']],
                [
                    'alamat'            => $data['alamat'],
                    'koordinat'         => $data['koordinat'],
                    'no_telepon'        => $data['no_telepon'],
                    'email_usaha'       => $data['email_usaha'],
                    'deskripsi'         => $data['deskripsi'],
                    'kategori'          => $data['kategori'],
                    'jam_operasional'   => $data['jam_operasional'],
                    'status_verifikasi' => $data['status_verifikasi'],
                ]
            );

            // User Manager untuk Mitra
            User::updateOrCreate(
                ['email' => $data['manager']['email']],
                [
                    'nama'             => $data['manager']['nama'],
                    'password'         => Hash::make('password123'),
                    'role'             => 'mitra_manager',
                    'mitra_profile_id' => $mitra->id,
                ]
            );

            // Buat produk-produk
            foreach ($data['products'] as $prod) {
                $p = Product::updateOrCreate(
                    [
                        'mitra_profile_id' => $mitra->id,
                        'nama_produk'      => $prod['nama_produk'],
                    ],
                    [
                        'kategori'             => $prod['kategori'],
                        'stok'                 => $prod['stok'],
                        'harga_asli'           => $prod['harga_asli'],
                        'harga_diskon'         => $prod['harga_diskon'],
                        'titik_penjemputan'    => $prod['titik_penjemputan'],
                        'deskripsi'            => $prod['deskripsi'],
                        'batas_waktu_konsumsi' => $prod['batas_waktu_konsumsi'],
                        'status'               => $prod['status'],
                    ]
                );
                $createdProducts[] = $p;
            }
        }

        // Data transaksi
        $statuses = [
            ['paid', 'sudah_diambil', Carbon::now()->subDays(2)],
            ['paid', 'sudah_diambil', Carbon::now()->subDay()],
            ['paid', 'belum_diambil', Carbon::now()->subHours(2)],
            ['paid', 'belum_diambil', Carbon::now()->subMinutes(30)],
            ['pending', 'belum_diambil', Carbon::now()->subMinutes(10)],
        ];

        foreach ($statuses as $idx => [$statusBayar, $statusAmbil, $waktu]) {
            if (isset($createdProducts[$idx])) {
                $prod = $createdProducts[$idx];
                $jumlah = rand(1, 2);
                Transaction::firstOrCreate(
                    ['kode_transaksi' => 'BS-' . $waktu->format('Ymd') . '-' . sprintf('%04d', $idx + 101)],
                    [
                        'user_id'            => ($idx % 2 === 0) ? $pelanggan1->id : $pelanggan2->id,
                        'product_id'         => $prod->id,
                        'jumlah'             => $jumlah,
                        'total_harga'        => $prod->harga_diskon * $jumlah,
                        'status_bayar'       => $statusBayar,
                        'status_pengambilan' => $statusAmbil,
                        'catatan'            => 'Ambil sebelum jam tutup',
                        'created_at'         => $waktu,
                        'updated_at'         => $waktu,
                    ]
                );
            }
        }
    }
}
