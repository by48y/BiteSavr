@extends('layouts.admin')
@section('title', 'Tambah Mitra Baru | Admin BiteSavr')
@section('content')

<div class="ph">
    <div>
        <h1>Tambah Mitra Baru</h1>
        <p>Daftarkan restoran, hotel, atau warung sebagai mitra BiteSavr.</p>
    </div>
    <a href="{{ route('admin.mitra.index') }}" class="btn" style="height:38px;line-height:38px;padding:0 18px">← Kembali</a>
</div>

@if($errors->any())
<div style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:14px 18px;border-radius:12px;margin-bottom:16px;font-size:14px">
    <b>Mohon perbaiki kesalahan berikut:</b>
    <ul style="margin:8px 0 0 18px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="g g12">
    <div class="card">
        <h2 style="margin-bottom:20px">Informasi Usaha</h2>
        <form method="POST" action="{{ route('admin.mitra.store') }}">
            @csrf
            <div class="g g2" style="gap:16px">
                <div>
                    <label class="lbl-f">Nama Usaha *</label>
                    <input type="text" name="nama_usaha" value="{{ old('nama_usaha') }}" required class="inp-f" placeholder="Contoh: Resto Padang Sederhana">
                </div>
                <div>
                    <label class="lbl-f">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori') }}" class="inp-f" placeholder="Contoh: Restoran, Bakery, Hotel">
                </div>
            </div>
            <div style="margin-top:14px">
                <label class="lbl-f">Alamat Lengkap *</label>
                <textarea name="alamat" required class="inp-f" rows="2" placeholder="Jl. Contoh No. 1, Pekanbaru">{{ old('alamat') }}</textarea>
            </div>
            <div class="g g2" style="gap:16px;margin-top:14px">
                <div>
                    <label class="lbl-f">No. Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" class="inp-f" placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label class="lbl-f">Email Usaha</label>
                    <input type="email" name="email_usaha" value="{{ old('email_usaha') }}" class="inp-f" placeholder="usaha@email.com">
                </div>
            </div>
            <div class="g g2" style="gap:16px;margin-top:14px">
                <div>
                    <label class="lbl-f">Jam Operasional</label>
                    <input type="text" name="jam_operasional" value="{{ old('jam_operasional') }}" class="inp-f" placeholder="08:00 - 21:00">
                </div>
                <div>
                    <label class="lbl-f">Koordinat (lat,lng)</label>
                    <input type="text" name="koordinat" value="{{ old('koordinat') }}" class="inp-f" placeholder="0.5337,101.4475">
                </div>
            </div>
            <div style="margin-top:14px">
                <label class="lbl-f">Deskripsi</label>
                <textarea name="deskripsi" class="inp-f" rows="3" placeholder="Ceritakan singkat tentang usaha ini">{{ old('deskripsi') }}</textarea>
            </div>
            <div style="margin-top:14px">
                <label class="lbl-f">Status Verifikasi *</label>
                <select name="status_verifikasi" class="inp-f">
                    <option value="pending" @selected(old('status_verifikasi','pending')=='pending')>Menunggu Verifikasi</option>
                    <option value="verified" @selected(old('status_verifikasi')=='verified')>Terverifikasi</option>
                    <option value="rejected" @selected(old('status_verifikasi')=='rejected')>Ditolak</option>
                </select>
            </div>

            <hr style="margin:28px 0;border:none;border-top:1px solid var(--line)">
            <h3 style="margin-bottom:16px;font-size:16px">Akun Manager Mitra</h3>
            <p style="font-size:13px;color:var(--muted);margin-bottom:14px">Akun ini akan digunakan oleh manager mitra untuk mengakses dashboard mitra.</p>

            <div class="g g2" style="gap:16px">
                <div>
                    <label class="lbl-f">Nama Manager *</label>
                    <input type="text" name="manager_nama" value="{{ old('manager_nama') }}" required class="inp-f" placeholder="Nama lengkap">
                </div>
                <div>
                    <label class="lbl-f">Email Manager *</label>
                    <input type="email" name="manager_email" value="{{ old('manager_email') }}" required class="inp-f" placeholder="manager@email.com">
                </div>
            </div>
            <div class="g g2" style="gap:16px;margin-top:14px">
                <div>
                    <label class="lbl-f">Password *</label>
                    <input type="password" name="manager_password" required class="inp-f" placeholder="Min. 8 karakter">
                </div>
                <div>
                    <label class="lbl-f">Konfirmasi Password *</label>
                    <input type="password" name="manager_password_confirmation" required class="inp-f" placeholder="Ulangi password">
                </div>
            </div>

            <div style="display:flex;gap:10px;margin-top:24px">
                <button type="submit" class="btn pri">Simpan Mitra</button>
                <a href="{{ route('admin.mitra.index') }}" class="btn">Batal</a>
            </div>
        </form>
    </div>
</div>

<style>
.lbl-f{display:block;font-size:13px;font-weight:600;margin-bottom:5px;color:var(--tx)}
.inp-f{width:100%;padding:10px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px;font-family:inherit}
.inp-f:focus{outline:none;border-color:var(--acc)}
</style>

@endsection
