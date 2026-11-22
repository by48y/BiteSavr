@extends('layouts.mitra')
@section('title', 'Dashboard Mitra | BiteSavr')
@section('content')

<div class="ph">
    <div>
        <h1>Selamat datang, {{ auth()->user()->display_name }}</h1>
        <p>{{ $mitra->nama_usaha }} · <span class="pill {{ $mitra->status_class }}" style="font-size:12px">{{ $mitra->status_label }}</span></p>
    </div>
    <a class="btn pri" href="{{ route('mitra.products.create') }}">+ Produk Baru</a>
</div>

{{-- KPI --}}
<div class="card">
    <div class="g g4" style="gap:0">
        <div class="kpi" style="padding:4px 18px 4px 0">
            <span class="l">Produk Aktif</span>
            <span class="v">{{ $stats['produk_tersedia'] }}</span>
            <span class="d">dari {{ $stats['total_produk'] }} produk</span>
        </div>
        <div class="kpi" style="padding:4px 18px;border-left:1px solid var(--line)">
            <span class="l">Transaksi Hari Ini</span>
            <span class="v">{{ $stats['transaksi_hari_ini'] }}</span>
            <span class="d">{{ $stats['total_transaksi'] }} total</span>
        </div>
        <div class="kpi" style="padding:4px 18px;border-left:1px solid var(--line)">
            <span class="l">Pendapatan Hari Ini</span>
            <span class="v">Rp{{ number_format($stats['pendapatan_hari_ini'],0,',','.') }}</span>
            <span class="d">Transaksi lunas</span>
        </div>
        <div class="kpi" style="padding:4px 18px;border-left:1px solid var(--line)">
            <span class="l">Total Pendapatan</span>
            <span class="v">Rp{{ number_format($stats['total_pendapatan'],0,',','.') }}</span>
            <span class="d up">Kumulatif</span>
        </div>
    </div>
</div>

<div class="g g12">
    {{-- Produk Terbaru --}}
    <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
            <h2>Produk Surplus</h2>
            <a href="{{ route('mitra.products.index') }}" style="font-size:13px;color:var(--acc)">Kelola semua →</a>
        </div>
        <ul class="list">
            @forelse($products as $p)
            <li>
                <span class="av">{{ strtoupper(substr($p->nama_produk, 0, 2)) }}</span>
                <div class="grow">
                    <b>{{ $p->nama_produk }}</b>
                    <span>Stok: {{ $p->stok }} · Diskon: -{{ $p->diskon_persen }}% · Rp{{ number_format($p->harga_diskon,0,',','.') }}</span>
                </div>
                <span class="pill {{ $p->status_class }}">{{ $p->status_label }}</span>
            </li>
            @empty
            <li style="color:var(--muted);font-size:14px">Belum ada produk.
                <a href="{{ route('mitra.products.create') }}">Tambah produk pertama →</a>
            </li>
            @endforelse
        </ul>
    </div>

    {{-- Transaksi Terbaru --}}
    <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
            <h2>Transaksi Terbaru</h2>
            <a href="{{ route('mitra.transactions.index') }}" style="font-size:13px;color:var(--acc)">Lihat semua →</a>
        </div>
        <div class="tw">
            <table>
                <thead>
                    <tr><th>Kode</th><th>Pelanggan</th><th>Produk</th><th>Total</th><th>Status</th></tr>
                </thead>
                <tbody>
                    @forelse($recentTransactions as $t)
                    <tr>
                        <td class="mono">{{ $t->kode_transaksi }}</td>
                        <td>{{ $t->user?->display_name ?? '-' }}</td>
                        <td>{{ $t->product?->nama_produk ?? '-' }}</td>
                        <td class="num">Rp{{ number_format($t->total_harga,0,',','.') }}</td>
                        <td><span class="pill {{ $t->status_bayar_class }}">{{ $t->status_bayar_label }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:20px">Belum ada transaksi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
