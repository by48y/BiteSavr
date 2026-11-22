<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $mitra = Auth::user()->mitraProfile ?? abort(403);

        $query = Transaction::with(['user', 'product'])
            ->whereHas('product', fn($q) => $q->where('mitra_profile_id', $mitra->id));

        if ($request->filled('search')) {
            $query->where('kode_transaksi', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status_bayar')) {
            $query->where('status_bayar', $request->status_bayar);
        }

        $transactions = $query->latest()->paginate(15)->withQueryString();

        return view('mitra.transactions.index', compact('transactions', 'mitra'));
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
        $mitra = Auth::user()->mitraProfile ?? abort(403);

        // Pastikan transaksi milik mitra ini
        if ($transaction->product->mitra_profile_id !== $mitra->id) {
            abort(403);
        }

        $data = $request->validate([
            'status_pengambilan' => ['required', 'in:belum_diambil,sudah_diambil,batal'],
        ]);

        $transaction->update($data);

        return back()->with('success', 'Status pengambilan diperbarui.');
    }
}
