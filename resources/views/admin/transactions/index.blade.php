@extends('layouts.admin')
@section('title', 'Semua Transaksi | Admin BiteSavr')
@section('content')

<div class="ph">
    <div><h1>Semua Transaksi</h1><p>Pantau seluruh transaksi platform BiteSavr.</p></div>
</div>

<div class="card" style="margin-bottom:0">
    <form method="GET" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end">
        <div style="flex:1;min-width:200px">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Kode transaksi…"
                style="width:100%;padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
        </div>
        <select name="status_bayar" style="padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
            <option value="">Semua Status</option>
            <option value="pending" @selected(request('status_bayar')=='pending')>Menunggu</option>
            <option value="paid" @selected(request('status_bayar')=='paid')>Lunas</option>
            <option value="failed" @selected(request('status_bayar')=='failed')>Gagal</option>
            <option value="expired" @selected(request('status_bayar')=='expired')>Kadaluarsa</option>
        </select>
        <button type="submit" class="btn pri" style="height:38px">Filter</button>
    </form>
</div>

<div class="card">
    <div class="tw">
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Mitra</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Pengambilan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                <tr>
                    <td class="mono">{{ $t->kode_transaksi }}</td>
                    <td>{{ $t->user?->display_name ?? '-' }}</td>
                    <td>{{ $t->product?->nama_produk ?? '-' }}</td>
                    <td>{{ $t->product?->mitraProfile?->nama_usaha ?? '-' }}</td>
                    <td class="num">{{ $t->jumlah }}</td>
                    <td class="num">Rp{{ number_format($t->total_harga,0,',','.') }}</td>
                    <td><span class="pill {{ $t->status_bayar_class }}">{{ $t->status_bayar_label }}</span></td>
                    <td>{{ $t->status_pengambilan_label }}</td>
                    <td>{{ $t->created_at->format('d M Y') }}</td>
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
