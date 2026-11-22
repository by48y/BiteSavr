@extends('layouts.admin')
@section('title', 'Dashboard Admin | BiteSavr')
@section('content')

<div class="ph">
    <div>
        <h1>Selamat datang, {{ auth()->user()->display_name }}</h1>
        <p>Panel administrasi BiteSavr — kelola mitra, pengguna, produk, dan transaksi.</p>
    </div>
    <div class="row">
        <a class="btn pri" href="{{ route('admin.mitra.create') }}">+ Tambah Mitra</a>
    </div>
</div>

{{-- KPI Cards --}}
<div class="card">
    <div class="g g4" style="gap:0">
        <div class="kpi" style="padding:4px 18px 4px 0">
            <span class="l">Total Mitra</span>
            <span class="v">{{ $stats['total_mitra'] }}</span>
            <span class="d up">{{ $stats['mitra_verified'] }} terverifikasi</span>
        </div>
        <div class="kpi" style="padding:4px 18px;border-left:1px solid var(--line)">
            <span class="l">Total Pengguna</span>
            <span class="v">{{ number_format($stats['total_user']) }}</span>
            <span class="d">Pelanggan terdaftar</span>
        </div>
        <div class="kpi" style="padding:4px 18px;border-left:1px solid var(--line)">
            <span class="l">Produk Tersedia</span>
            <span class="v">{{ $stats['total_produk'] }}</span>
            <span class="d">Aktif di katalog</span>
        </div>
        <div class="kpi" style="padding:4px 18px;border-left:1px solid var(--line)">
            <span class="l">Total Pendapatan</span>
            <span class="v">Rp{{ number_format($stats['total_pendapatan'], 0, ',', '.') }}</span>
            <span class="d up">{{ $stats['transaksi_hari_ini'] }} transaksi hari ini</span>
        </div>
    </div>
</div>

<div class="g g12">
    {{-- Mitra Terbaru --}}
    <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
            <h2>Mitra Terbaru</h2>
            <a href="{{ route('admin.mitra.index') }}" style="font-size:13px;color:var(--acc)">Lihat semua →</a>
        </div>
        <ul class="list">
            @forelse($recentMitra as $m)
            <li>
                <span class="av">{{ strtoupper(substr($m->nama_usaha, 0, 2)) }}</span>
                <div class="grow">
                    <b>{{ $m->nama_usaha }}</b>
                    <span>{{ $m->kategori ?? 'Mitra' }} · {{ $m->products_count ?? 0 }} produk</span>
                </div>
                <span class="pill {{ $m->status_class }}">{{ $m->status_label }}</span>
            </li>
            @empty
            <li style="color:var(--muted);font-size:14px">Belum ada mitra.</li>
            @endforelse
        </ul>
    </div>

    {{-- Transaksi Terbaru --}}
    <div class="card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
            <h2>Transaksi Terbaru</h2>
            <a href="{{ route('admin.transactions.index') }}" style="font-size:13px;color:var(--acc)">Lihat semua →</a>
        </div>
        <div class="tw">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Pelanggan</th>
                        <th>Produk</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTransactions as $t)
                    <tr>
                        <td><code>{{ $t->kode_transaksi }}</code></td>
                        <td>{{ $t->user?->display_name ?? '-' }}</td>
                        <td>{{ $t->product?->nama_produk ?? '-' }}</td>
                        <td class="num">Rp{{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td><span class="pill {{ $t->status_bayar_class }}">{{ $t->status_bayar_label }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="color:var(--muted);font-size:14px;text-align:center">Belum ada transaksi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
