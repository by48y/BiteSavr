<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MitraProfile;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_mitra'       => MitraProfile::count(),
            'mitra_verified'    => MitraProfile::where('status_verifikasi', 'verified')->count(),
            'total_produk'      => Product::where('status', 'tersedia')->count(),
            'total_transaksi'   => Transaction::count(),
            'transaksi_hari_ini'=> Transaction::whereDate('created_at', today())->count(),
            'total_pendapatan'  => Transaction::where('status_bayar', 'paid')->sum('total_harga'),
            'total_user'        => User::where('role', 'konsumen')->count(),
        ];

        $recentTransactions = Transaction::with(['user', 'product.mitraProfile'])
            ->latest()
            ->limit(8)
            ->get();

        $recentMitra = MitraProfile::with('products')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentTransactions', 'recentMitra'));
    }
}
