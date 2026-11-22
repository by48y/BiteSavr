@extends('layouts.mitra')
@section('title', 'Tambah Produk | Mitra BiteSavr')
@section('content')

<div class="ph">
    <div><h1>Tambah Produk Surplus</h1><p>Daftarkan makanan surplus yang ingin Anda jual.</p></div>
    <a href="{{ route('mitra.products.index') }}" class="btn" style="height:38px;line-height:38px;padding:0 18px">← Kembali</a>
</div>

@if($errors->any())
<div style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:14px 18px;border-radius:12px;margin-bottom:16px;font-size:14px">
    <ul style="margin:0 0 0 18px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="card" style="max-width:680px">
    <form method="POST" action="{{ route('mitra.products.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="g g2" style="gap:16px;margin-bottom:16px">
            <div>
                <label class="lbl-f">Nama Produk *</label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required class="inp-f" placeholder="Contoh: Nasi Rendang Set">
            </div>
            <div>
                <label class="lbl-f">Kategori *</label>
                <select name="kategori" required class="inp-f">
                    <option value="nasi" @selected(old('kategori')=='nasi')>🍛 Nasi & Lauk</option>
                    <option value="roti_kue" @selected(old('kategori')=='roti_kue')>🥐 Roti & Kue</option>
                    <option value="seafood" @selected(old('kategori')=='seafood')>🍤 Seafood</option>
                    <option value="minuman" @selected(old('kategori')=='minuman')>☕ Minuman</option>
                    <option value="mie" @selected(old('kategori')=='mie')>🍜 Mie & Pasta</option>
                    <option value="lainnya" @selected(old('kategori','lainnya')=='lainnya')>🍱 Lainnya</option>
                </select>
            </div>
        </div>
        <div style="margin-bottom:16px">
            <label class="lbl-f">Deskripsi Produk <small style="color:var(--muted);font-weight:400">(opsional)</small></label>
            <textarea name="deskripsi" class="inp-f" rows="2" placeholder="Jelaskan kondisi atau rincian makanan surplus ini">{{ old('deskripsi') }}</textarea>
        </div>
        <div class="g g2" style="gap:16px;margin-bottom:16px">
            <div>
                <label class="lbl-f">Harga Normal (Rp) *</label>
                <input type="number" name="harga_asli" value="{{ old('harga_asli') }}" required min="0" class="inp-f" placeholder="45000">
            </div>
            <div>
                <label class="lbl-f">Harga Jual / Diskon (Rp) *</label>
                <input type="number" name="harga_diskon" value="{{ old('harga_diskon') }}" required min="0" class="inp-f" placeholder="15000">
            </div>
        </div>
        <div class="g g2" style="gap:16px;margin-bottom:16px">
            <div>
                <label class="lbl-f">Stok Tersedia *</label>
                <input type="number" name="stok" value="{{ old('stok', 1) }}" required min="1" class="inp-f">
            </div>
            <div>
                <label class="lbl-f">Status *</label>
                <select name="status" class="inp-f">
                    <option value="tersedia" @selected(old('status','tersedia')=='tersedia')>Tersedia</option>
                    <option value="habis" @selected(old('status')=='habis')>Stok Habis</option>
                    <option value="nonaktif" @selected(old('status')=='nonaktif')>Nonaktif</option>
                </select>
            </div>
        </div>
        <div style="margin-bottom:16px">
            <label class="lbl-f">Titik Penjemputan *</label>
            <input type="text" name="titik_penjemputan" value="{{ old('titik_penjemputan') }}" required class="inp-f" placeholder="Contoh: Meja kasir lantai 1">
        </div>
        <div style="margin-bottom:16px">
            <label class="lbl-f">Batas Waktu Konsumsi *</label>
            <input type="datetime-local" name="batas_waktu_konsumsi" value="{{ old('batas_waktu_konsumsi') }}" required class="inp-f">
        </div>
        <div style="margin-bottom:16px">
            <label class="lbl-f">Foto Produk <small style="color:var(--muted);font-weight:400">(opsional, JPG/PNG max 2MB)</small></label>
            <input type="file" name="foto" accept="image/*" class="inp-f" style="padding:7px">
        </div>
        <div style="display:flex;gap:10px;margin-top:4px">
            <button type="submit" class="btn pri">Simpan Produk</button>
            <a href="{{ route('mitra.products.index') }}" class="btn">Batal</a>
        </div>
    </form>
</div>

<style>
.lbl-f{display:block;font-size:13px;font-weight:600;margin-bottom:5px;color:var(--tx)}
.inp-f{width:100%;padding:10px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px;font-family:inherit}
.inp-f:focus{outline:none;border-color:var(--acc)}
</style>

@endsection
