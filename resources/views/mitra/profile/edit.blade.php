@extends('layouts.mitra')
@section('title', 'Profil Usaha | Mitra BiteSavr')
@section('content')

<div class="ph">
    <div><h1>Profil Usaha</h1><p>Kelola identitas dan informasi usaha Anda di platform BiteSavr.</p></div>
</div>

@if($errors->any())
<div style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:14px 18px;border-radius:12px;margin-bottom:16px;font-size:14px">
    <ul style="margin:0 0 0 18px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="g g12">
    <div class="card">
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:22px">
            @if($mitra->foto_usaha)
                <img src="{{ Storage::url($mitra->foto_usaha) }}" alt="Foto usaha"
                    style="width:72px;height:72px;border-radius:14px;object-fit:cover;border:2px solid var(--line)">
            @else
                <div style="width:72px;height:72px;border-radius:14px;background:linear-gradient(135deg,#2E9E5B,#1B5E3A);display:grid;place-items:center;font:700 28px Archivo,sans-serif;color:#fff">
                    {{ strtoupper(substr($mitra->nama_usaha, 0, 2)) }}
                </div>
            @endif
            <div>
                <h2 style="margin:0">{{ $mitra->nama_usaha }}</h2>
                <span class="pill {{ $mitra->status_class }}">{{ $mitra->status_label }}</span>
            </div>
        </div>

        <form method="POST" action="{{ route('mitra.profile.update') }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="g g2" style="gap:16px;margin-bottom:16px">
                <div>
                    <label class="lbl-f">Nama Usaha *</label>
                    <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $mitra->nama_usaha) }}" required class="inp-f">
                </div>
                <div>
                    <label class="lbl-f">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori', $mitra->kategori) }}" class="inp-f" placeholder="Restoran, Bakery, Hotel...">
                </div>
            </div>
            <div style="margin-bottom:16px">
                <label class="lbl-f">Alamat Lengkap *</label>
                <textarea name="alamat" required class="inp-f" rows="2">{{ old('alamat', $mitra->alamat) }}</textarea>
            </div>
            <div class="g g2" style="gap:16px;margin-bottom:16px">
                <div>
                    <label class="lbl-f">No. Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon', $mitra->no_telepon) }}" class="inp-f" placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label class="lbl-f">Email Usaha</label>
                    <input type="email" name="email_usaha" value="{{ old('email_usaha', $mitra->email_usaha) }}" class="inp-f" placeholder="usaha@email.com">
                </div>
            </div>
            <div class="g g2" style="gap:16px;margin-bottom:16px">
                <div>
                    <label class="lbl-f">Jam Operasional</label>
                    <input type="text" name="jam_operasional" value="{{ old('jam_operasional', $mitra->jam_operasional) }}" class="inp-f" placeholder="08:00 - 21:00">
                </div>
                <div>
                    <label class="lbl-f">Koordinat (lat,lng)</label>
                    <input type="text" name="koordinat" value="{{ old('koordinat', $mitra->koordinat) }}" class="inp-f" placeholder="0.5337,101.4475">
                </div>
            </div>
            <div style="margin-bottom:16px">
                <label class="lbl-f">Deskripsi Usaha</label>
                <textarea name="deskripsi" class="inp-f" rows="3" placeholder="Ceritakan singkat tentang usaha Anda...">{{ old('deskripsi', $mitra->deskripsi) }}</textarea>
            </div>
            <div style="margin-bottom:16px">
                <label class="lbl-f">Foto Usaha <small style="color:var(--muted);font-weight:400">(opsional, JPG/PNG max 2MB)</small></label>
                <input type="file" name="foto_usaha" accept="image/*" class="inp-f" style="padding:7px">
            </div>
            <button type="submit" class="btn pri">Simpan Profil</button>
        </form>
    </div>

    <div class="card">
        <h2 style="margin-bottom:14px">Info Akun</h2>
        <ul class="list">
            <li>
                <span class="av" style="background:#2E9E5B">{{ auth()->user()->initials }}</span>
                <div class="grow">
                    <b>{{ auth()->user()->display_name }}</b>
                    <span>{{ auth()->user()->email }}</span>
                </div>
                <span class="pill p-info">{{ auth()->user()->role === 'mitra_manager' ? 'Manager' : 'Staff' }}</span>
            </li>
        </ul>
        <p style="font-size:13px;color:var(--muted);margin-top:12px">Untuk mengubah password atau data akun, hubungi admin.</p>
    </div>
</div>

<style>
.lbl-f{display:block;font-size:13px;font-weight:600;margin-bottom:5px;color:var(--tx)}
.inp-f{width:100%;padding:10px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px;font-family:inherit}
.inp-f:focus{outline:none;border-color:var(--acc)}
</style>

@endsection
