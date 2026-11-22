@extends('layouts.mitra')
@section('title', 'Produk Surplus | Mitra BiteSavr')
@section('content')

<div class="ph">
    <div><h1>Produk Surplus</h1><p>Kelola produk yang akan dijual di platform BiteSavr.</p></div>
    <a class="btn pri" href="{{ route('mitra.products.create') }}">+ Tambah Produk</a>
</div>

<div class="card" style="margin-bottom:0">
    <form method="GET" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end">
        <div style="flex:1;min-width:200px">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Nama produk…"
                style="width:100%;padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
        </div>
        <select name="status" style="padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
            <option value="">Semua Status</option>
            <option value="tersedia" @selected(request('status')=='tersedia')>Tersedia</option>
            <option value="habis" @selected(request('status')=='habis')>Habis</option>
            <option value="kadaluarsa" @selected(request('status')=='kadaluarsa')>Kadaluarsa</option>
            <option value="nonaktif" @selected(request('status')=='nonaktif')>Nonaktif</option>
        </select>
        <button type="submit" class="btn pri" style="height:38px">Filter</button>
    </form>
</div>

<div class="card">
    <div class="tw">
        <table>
            <thead>
                <tr><th>Produk</th><th>Stok</th><th>Harga Asli</th><th>Harga Jual</th><th>Diskon</th><th>Batas Waktu</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                <tr>
                    <td><b>{{ $p->nama_produk }}</b><br><small style="color:var(--muted)">{{ $p->titik_penjemputan }}</small></td>
                    <td class="num">{{ $p->stok }}</td>
                    <td class="num"><s>Rp{{ number_format($p->harga_asli,0,',','.') }}</s></td>
                    <td class="num" style="color:#2E9E5B;font-weight:700">Rp{{ number_format($p->harga_diskon,0,',','.') }}</td>
                    <td><span class="pill p-info">-{{ $p->diskon_persen }}%</span></td>
                    <td>{{ $p->batas_waktu_konsumsi?->format('d M Y H:i') }}</td>
                    <td><span class="pill {{ $p->status_class }}">{{ $p->status_label }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('mitra.products.edit', $p) }}" class="btn" style="padding:5px 12px;font-size:13px">Edit</a>
                            <form method="POST" action="{{ route('mitra.products.destroy', $p) }}" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button class="btn" style="padding:5px 12px;font-size:13px;background:#dc2626;color:#fff;border:none;cursor:pointer;border-radius:8px">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:var(--muted);padding:30px">Belum ada produk. <a href="{{ route('mitra.products.create') }}">Tambah sekarang →</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px">{{ $products->links() }}</div>
</div>

@endsection
