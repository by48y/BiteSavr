@extends('layouts.admin')
@section('title', 'Tambah Pengguna | Admin BiteSavr')
@section('content')

<div class="ph">
    <div><h1>Tambah Pengguna</h1><p>Buat akun baru untuk admin, manager mitra, atau staff.</p></div>
    <a href="{{ route('admin.users.index') }}" class="btn" style="height:38px;line-height:38px;padding:0 18px">← Kembali</a>
</div>

@if($errors->any())
<div style="background:#fef2f2;border:1px solid #fecaca;color:#dc2626;padding:14px 18px;border-radius:12px;margin-bottom:16px;font-size:14px">
    <ul style="margin:0 0 0 18px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div class="card" style="max-width:600px">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div style="margin-bottom:14px">
            <label class="lbl-f">Nama Lengkap *</label>
            <input type="text" name="nama" value="{{ old('nama') }}" required class="inp-f" placeholder="Nama lengkap">
        </div>
        <div style="margin-bottom:14px">
            <label class="lbl-f">Email *</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="inp-f" placeholder="email@contoh.com">
        </div>
        <div class="g g2" style="gap:16px;margin-bottom:14px">
            <div>
                <label class="lbl-f">Password *</label>
                <input type="password" name="password" required class="inp-f" placeholder="Min. 8 karakter">
            </div>
            <div>
                <label class="lbl-f">Konfirmasi Password *</label>
                <input type="password" name="password_confirmation" required class="inp-f">
            </div>
        </div>
        <div style="margin-bottom:14px">
            <label class="lbl-f">Role *</label>
            <select name="role" class="inp-f" id="roleSelect" onchange="toggleMitra()">
                <option value="konsumen" @selected(old('role','konsumen')=='konsumen')>Pelanggan</option>
                <option value="mitra_manager" @selected(old('role')=='mitra_manager')>Mitra Manager</option>
                <option value="mitra_staff" @selected(old('role')=='mitra_staff')>Mitra Staff</option>
                <option value="admin" @selected(old('role')=='admin')>Admin</option>
            </select>
        </div>
        <div style="margin-bottom:14px" id="mitraField">
            <label class="lbl-f">Mitra (jika role Mitra)</label>
            <select name="mitra_profile_id" class="inp-f">
                <option value="">— Pilih mitra —</option>
                @foreach($mitras as $m)
                <option value="{{ $m->id }}" @selected(old('mitra_profile_id', request('mitra'))==$m->id)>{{ $m->nama_usaha }}</option>
                @endforeach
            </select>
        </div>
        <div style="display:flex;gap:10px;margin-top:4px">
            <button type="submit" class="btn pri">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="btn">Batal</a>
        </div>
    </form>
</div>

<style>
.lbl-f{display:block;font-size:13px;font-weight:600;margin-bottom:5px;color:var(--tx)}
.inp-f{width:100%;padding:10px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px;font-family:inherit}
.inp-f:focus{outline:none;border-color:var(--acc)}
</style>
<script>
function toggleMitra(){
    const r=document.getElementById('roleSelect').value;
    document.getElementById('mitraField').style.display=r.startsWith('mitra')?'block':'none';
}
toggleMitra();
</script>

@endsection
