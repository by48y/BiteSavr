<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transactions = Transaction::with(['product.mitraProfile'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('public.pesanan', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'jumlah'     => ['required', 'integer', 'min:1', 'max:10'],
            'catatan'    => ['nullable', 'string', 'max:255'],
        ]);

        $product = Product::with('mitraProfile')->findOrFail($request->product_id);

        // Validasi ketersediaan stok
        if ($product->status !== 'tersedia' || $product->stok < $request->jumlah) {
            return back()->with('error', 'Maaf, stok makanan surplus ini sudah habis atau tidak mencukupi.');
        }

        // Cek batas waktu konsumsi
        if ($product->batas_waktu_konsumsi && $product->batas_waktu_konsumsi->isPast()) {
            $product->update(['status' => 'kadaluarsa']);
            return back()->with('error', 'Maaf, waktu konsumsi produk ini sudah berakhir.');
        }

        $jumlah = (int) $request->jumlah;
        $totalHarga = $product->harga_diskon * $jumlah;
        $kodeTransaksi = 'BS-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        // Buat transaksi
        $transaction = Transaction::create([
            'user_id'            => Auth::id(),
            'product_id'         => $product->id,
            'jumlah'             => $jumlah,
            'total_harga'        => $totalHarga,
            'status_bayar'       => 'paid',
            'kode_transaksi'     => $kodeTransaksi,
            'status_pengambilan' => 'belum_diambil',
            'catatan'            => $request->catatan,
        ]);

        // Kurangi stok produk
        $product->decrement('stok', $jumlah);
        if ($product->stok <= 0) {
            $product->update(['status' => 'habis']);
        }

        return redirect()->route('pesanan.show', $transaction->kode_transaksi)
            ->with('success', 'Selamat! Pesanan makanan surplus berhasil dibuat. Tunjukkan struk QR ke kasir mitra.');
    }

    public function show($kode)
    {
        $transaction = Transaction::with(['product.mitraProfile', 'user'])
            ->where('kode_transaksi', $kode)
            ->firstOrFail();

        // Pastikan hanya pemilik atau mitra terkait atau admin yang bisa melihat
        $user = Auth::user();
        if ($user->role === 'konsumen' && $transaction->user_id !== $user->id) {
            abort(403);
        }

        return view('public.struk', compact('transaction'));
    }
}
