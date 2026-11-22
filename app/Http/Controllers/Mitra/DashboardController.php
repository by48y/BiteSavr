<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $mitra = Auth::user()->mitraProfile;

        if (!$mitra) {
            abort(403, 'Akun Anda belum terhubung ke profil mitra.');
        }

        $stats = [
            'total_produk'       => $mitra->products()->count(),
            'produk_tersedia'    => $mitra->products()->where('status', 'tersedia')->count(),
            'total_transaksi'    => Transaction::whereHas('product', fn($q) => $q->where('mitra_profile_id', $mitra->id))->count(),
            'transaksi_hari_ini' => Transaction::whereHas('product', fn($q) => $q->where('mitra_profile_id', $mitra->id))
                ->whereDate('created_at', today())->count(),
            'pendapatan_hari_ini'=> Transaction::whereHas('product', fn($q) => $q->where('mitra_profile_id', $mitra->id))
                ->where('status_bayar', 'paid')->whereDate('created_at', today())->sum('total_harga'),
            'total_pendapatan'   => Transaction::whereHas('product', fn($q) => $q->where('mitra_profile_id', $mitra->id))
                ->where('status_bayar', 'paid')->sum('total_harga'),
        ];

        $recentTransactions = Transaction::with(['user', 'product'])
            ->whereHas('product', fn($q) => $q->where('mitra_profile_id', $mitra->id))
            ->latest()
            ->limit(8)
            ->get();

        $products = $mitra->products()->latest()->limit(5)->get();

        return view('mitra.dashboard', compact('mitra', 'stats', 'recentTransactions', 'products'));
    }
}
