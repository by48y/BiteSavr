@extends('layouts.mitra')
@section('title', 'Transaksi | Mitra BiteSavr')
@section('content')

<div class="ph">
    <div><h1>Transaksi</h1><p>Kelola dan pantau transaksi produk Anda.</p></div>
</div>

<div class="card" style="margin-bottom:0">
    <form method="GET" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end">
        <div style="flex:1;min-width:200px">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Kode transaksi…"
                style="width:100%;padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
        </div>
        <select name="status_bayar" style="padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
            <option value="">Semua</option>
            <option value="pending" @selected(request('status_bayar')=='pending')>Menunggu</option>
            <option value="paid" @selected(request('status_bayar')=='paid')>Lunas</option>
            <option value="failed" @selected(request('status_bayar')=='failed')>Gagal</option>
        </select>
        <button type="submit" class="btn pri" style="height:38px">Filter</button>
    </form>
</div>

<div class="card">
    <div class="tw">
        <table>
            <thead>
                <tr><th>Kode</th><th>Pelanggan</th><th>Produk</th><th>Jml</th><th>Total</th><th>Bayar</th><th>Pengambilan</th><th>Tanggal</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                <tr>
                    <td class="mono">{{ $t->kode_transaksi }}</td>
                    <td>{{ $t->user?->display_name ?? '-' }}</td>
                    <td>{{ $t->product?->nama_produk ?? '-' }}</td>
                    <td class="num">{{ $t->jumlah }}</td>
                    <td class="num">Rp{{ number_format($t->total_harga,0,',','.') }}</td>
                    <td><span class="pill {{ $t->status_bayar_class }}">{{ $t->status_bayar_label }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('mitra.transactions.updateStatus', $t) }}" style="display:inline">
                            @csrf @method('PATCH')
                            <select name="status_pengambilan" onchange="this.form.submit()"
                                style="padding:4px 8px;border:1px solid var(--line);border-radius:6px;background:var(--bg);color:var(--tx);font-size:13px">
                                <option value="belum_diambil" @selected($t->status_pengambilan=='belum_diambil')>Belum Diambil</option>
                                <option value="sudah_diambil" @selected($t->status_pengambilan=='sudah_diambil')>Sudah Diambil</option>
                                <option value="batal" @selected($t->status_pengambilan=='batal')>Dibatalkan</option>
                            </select>
                        </form>
                    </td>
                    <td>{{ $t->created_at->format('d M Y') }}</td>
                    <td></td>
                </tr>
                @empty
                <tr><td colspan="9" style="text-align:center;color:var(--muted);padding:30px">Belum ada transaksi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px">{{ $transactions->links() }}</div>
</div>

@endsection
