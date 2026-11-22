@extends('layouts.admin')
@section('title', 'Semua Produk | Admin BiteSavr')
@section('content')

<div class="ph">
    <div><h1>Semua Produk Surplus</h1><p>Pantau seluruh produk dari semua mitra.</p></div>
</div>

<div class="card" style="margin-bottom:0">
    <form method="GET" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end">
        <div style="flex:1;min-width:200px">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Nama produk…"
                style="width:100%;padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
        </div>
        <select name="mitra" style="padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
            <option value="">Semua Mitra</option>
            @foreach($mitras as $id => $name)
            <option value="{{ $id }}" @selected(request('mitra')==$id)>{{ $name }}</option>
            @endforeach
        </select>
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
                <tr>
                    <th>Produk</th>
                    <th>Mitra</th>
                    <th>Stok</th>
                    <th>Harga Asli</th>
                    <th>Harga Diskon</th>
                    <th>Diskon</th>
                    <th>Batas Waktu</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                <tr>
                    <td><b>{{ $p->nama_produk }}</b></td>
                    <td>{{ $p->mitraProfile?->nama_usaha ?? '-' }}</td>
                    <td class="num">{{ $p->stok }}</td>
                    <td class="num"><s>Rp{{ number_format($p->harga_asli,0,',','.') }}</s></td>
                    <td class="num" style="color:#2E9E5B;font-weight:700">Rp{{ number_format($p->harga_diskon,0,',','.') }}</td>
                    <td><span class="pill p-info">-{{ $p->diskon_persen }}%</span></td>
                    <td>{{ $p->batas_waktu_konsumsi?->format('d M Y H:i') }}</td>
                    <td><span class="pill {{ $p->status_class }}">{{ $p->status_label }}</span></td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:var(--muted);padding:30px">Belum ada produk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px">{{ $products->links() }}</div>
</div>

@endsection
