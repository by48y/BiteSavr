@extends('layouts.admin')
@section('title', 'Edit Mitra | Admin BiteSavr')
@section('content')

<div class="ph">
    <div>
        <h1>Edit Mitra: {{ $mitra->nama_usaha }}</h1>
        <p>Perbarui data dan status verifikasi mitra.</p>
    </div>
    <a href="{{ route('admin.mitra.index') }}" class="btn" style="height:38px;line-height:38px;padding:0 18px">← Kembali</a>
</div>

@if($errors->any())
<div style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:14px 18px;border-radius:12px;margin-bottom:16px;font-size:14px">
    <b>Mohon perbaiki kesalahan berikut:</b>
    <ul style="margin:8px 0 0 18px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforelse</ul>
</div>
@endif

<div class="g g12">
    <div class="card">
        <h2 style="margin-bottom:20px">Informasi Usaha</h2>
        <form method="POST" action="{{ route('admin.mitra.update', $mitra) }}">
            @csrf @method('PUT')
            <div class="g g2" style="gap:16px">
                <div>
                    <label class="lbl-f">Nama Usaha *</label>
                    <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $mitra->nama_usaha) }}" required class="inp-f">
                </div>
                <div>
                    <label class="lbl-f">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori', $mitra->kategori) }}" class="inp-f">
                </div>
            </div>
            <div style="margin-top:14px">
                <label class="lbl-f">Alamat *</label>
                <textarea name="alamat" required class="inp-f" rows="2">{{ old('alamat', $mitra->alamat) }}</textarea>
            </div>
            <div class="g g2" style="gap:16px;margin-top:14px">
                <div>
                    <label class="lbl-f">No. Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon', $mitra->no_telepon) }}" class="inp-f">
                </div>
                <div>
                    <label class="lbl-f">Email Usaha</label>
                    <input type="email" name="email_usaha" value="{{ old('email_usaha', $mitra->email_usaha) }}" class="inp-f">
                </div>
            </div>
            <div class="g g2" style="gap:16px;margin-top:14px">
                <div>
                    <label class="lbl-f">Jam Operasional</label>
                    <input type="text" name="jam_operasional" value="{{ old('jam_operasional', $mitra->jam_operasional) }}" class="inp-f">
                </div>
                <div>
                    <label class="lbl-f">Koordinat</label>
                    <input type="text" name="koordinat" value="{{ old('koordinat', $mitra->koordinat) }}" class="inp-f">
                </div>
            </div>
            <div style="margin-top:14px">
                <label class="lbl-f">Deskripsi</label>
                <textarea name="deskripsi" class="inp-f" rows="3">{{ old('deskripsi', $mitra->deskripsi) }}</textarea>
            </div>
            <div style="margin-top:14px">
                <label class="lbl-f">Status Verifikasi *</label>
                <select name="status_verifikasi" class="inp-f">
                    <option value="pending" @selected(old('status_verifikasi',$mitra->status_verifikasi)=='pending')>Menunggu</option>
                    <option value="verified" @selected(old('status_verifikasi',$mitra->status_verifikasi)=='verified')>Terverifikasi</option>
                    <option value="rejected" @selected(old('status_verifikasi',$mitra->status_verifikasi)=='rejected')>Ditolak</option>
                </select>
            </div>

            <div style="display:flex;gap:10px;margin-top:24px">
                <button type="submit" class="btn pri">Simpan Perubahan</button>
                <a href="{{ route('admin.mitra.index') }}" class="btn">Batal</a>
            </div>
        </form>
    </div>

    {{-- Daftar user mitra --}}
    <div class="card">
        <h2 style="margin-bottom:14px">Pengguna Mitra</h2>
        <ul class="list">
            @forelse($mitra->users as $u)
            <li>
                <span class="av">{{ $u->initials }}</span>
                <div class="grow">
                    <b>{{ $u->display_name }}</b>
                    <span>{{ $u->email }} · {{ $u->role === 'mitra_manager' ? 'Manager' : 'Staff' }}</span>
                </div>
                <a href="{{ route('admin.users.edit', $u) }}" class="btn" style="padding:5px 12px;font-size:13px">Edit</a>
            </li>
            @empty
            <li style="color:var(--muted);font-size:14px">Belum ada pengguna untuk mitra ini.</li>
            @endforelse
        </ul>
        <div style="margin-top:14px">
            <a href="{{ route('admin.users.create') }}?mitra={{ $mitra->id }}" class="btn pri" style="font-size:13px">+ Tambah User Mitra</a>
        </div>
    </div>
</div>

<style>
.lbl-f{display:block;font-size:13px;font-weight:600;margin-bottom:5px;color:var(--tx)}
.inp-f{width:100%;padding:10px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px;font-family:inherit}
.inp-f:focus{outline:none;border-color:var(--acc)}
</style>

@endsection
