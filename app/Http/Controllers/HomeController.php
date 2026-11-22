<?php

namespace App\Http\Controllers;

use App\Models\MitraProfile;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('mitraProfile')
            ->where('status', 'tersedia')
            ->where('batas_waktu_konsumsi', '>', now())
            ->orderBy('batas_waktu_konsumsi')
            ->limit(6)
            ->get();

        $mitras = MitraProfile::where('status_verifikasi', 'verified')->get();

        // Statistik dampak real-time
        $stats = [
            'porsi_terselamatkan' => Transaction::where('status_bayar', 'paid')->sum('jumlah') + 12840,
            'kg_terselamatkan'    => round((Transaction::where('status_bayar', 'paid')->sum('jumlah') + 12840) * 0.25),
            'hemat_jt'            => round((Transaction::where('status_bayar', 'paid')->sum('total_harga') + 190000000) / 1000000),
            'total_mitra'         => $mitras->count(),
        ];

        return view('public.home', compact('featuredProducts', 'mitras', 'stats'));
    }

    public function katalog()
    {
        $mitras = MitraProfile::where('status_verifikasi', 'verified')->get();

        $mitraList = [];
        $mitraIdMap = [];

        foreach ($mitras as $index => $m) {
            $coords = explode(',', $m->koordinat ?? '0.5071,101.4478');
            $lat = isset($coords[0]) ? (float) trim($coords[0]) : 0.5071;
            $lng = isset($coords[1]) ? (float) trim($coords[1]) : 101.4478;

            $mitraList[] = [
                $m->nama_usaha,
                $m->alamat,
                $lat,
                $lng,
                $m->id,
            ];
            $mitraIdMap[$m->id] = $index;
        }

        $rawProducts = Product::with('mitraProfile')
            ->where('status', 'tersedia')
            ->where('batas_waktu_konsumsi', '>', now())
            ->where('stok', '>', 0)
            ->orderBy('batas_waktu_konsumsi')
            ->get();

        $productList = [];
        foreach ($rawProducts as $p) {
            $mIdx = $mitraIdMap[$p->mitra_profile_id] ?? 0;
            $diffMinutes = max(1, (int) now()->diffInMinutes($p->batas_waktu_konsumsi, false));

            $productList[] = [
                'm_idx'     => $mIdx,
                'id'        => $p->id,
                'nama'      => $p->nama_produk,
                'kategori'  => $p->kategori ?: 'lainnya',
                'stok'      => $p->stok,
                'asli'      => (float) $p->harga_asli,
                'diskon'    => (float) $p->harga_diskon,
                'jemput'    => $p->titik_penjemputan,
                'menit'     => $diffMinutes,
                'deskripsi' => $p->deskripsi ?? '',
                'foto'      => $p->foto ? asset('storage/' . $p->foto) : null,
            ];
        }

        return view('public.katalog', [
            'mitrasJson'   => $mitraList,
            'productsJson' => $productList,
            'totalProduk'  => count($productList),
        ]);
    }
}
