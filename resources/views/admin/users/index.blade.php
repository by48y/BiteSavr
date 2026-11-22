@extends('layouts.admin')
@section('title', 'Kelola Pengguna | Admin BiteSavr')
@section('content')

<div class="ph">
    <div>
        <h1>Kelola Pengguna</h1>
        <p>Semua akun admin, mitra, dan pelanggan BiteSavr.</p>
    </div>
    <a class="btn pri" href="{{ route('admin.users.create') }}">+ Tambah Pengguna</a>
</div>

<div class="card" style="margin-bottom:0">
    <form method="GET" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end">
        <div style="flex:1;min-width:200px">
            <label style="font-size:13px;font-weight:600;display:block;margin-bottom:4px">Cari</label>
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Nama atau email…"
                style="width:100%;padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
        </div>
        <div>
            <label style="font-size:13px;font-weight:600;display:block;margin-bottom:4px">Role</label>
            <select name="role" style="padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
                <option value="">Semua Role</option>
                <option value="admin" @selected(request('role')=='admin')>Admin</option>
                <option value="mitra_manager" @selected(request('role')=='mitra_manager')>Mitra Manager</option>
                <option value="mitra_staff" @selected(request('role')=='mitra_staff')>Mitra Staff</option>
                <option value="konsumen" @selected(request('role')=='konsumen')>Pelanggan</option>
            </select>
        </div>
        <button type="submit" class="btn pri" style="height:38px">Cari</button>
        @if(request()->anyFilled(['search','role']))
        <a href="{{ route('admin.users.index') }}" class="btn" style="height:38px;line-height:38px;padding:0 16px">Reset</a>
        @endif
    </form>
</div>

<div class="card">
    <div class="tw">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Mitra</th>
                    <th>Login</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td class="mono">{{ $u->id }}</td>
                    <td>
                        @if($u->avatar)
                            <img src="{{ $u->avatar }}" width="28" height="28" style="border-radius:50%;vertical-align:middle;margin-right:6px">
                        @endif
                        {{ $u->display_name }}
                    </td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="pill @switch($u->role)
                            @case('admin') p-bad @break
                            @case('mitra_manager') p-info @break
                            @case('mitra_staff') p-info @break
                            @default p-muted
                        @endswitch">
                            {{ match($u->role) {
                                'admin' => 'Admin',
                                'mitra_manager' => 'Mitra Manager',
                                'mitra_staff' => 'Mitra Staff',
                                default => 'Pelanggan'
                            } }}
                        </span>
                    </td>
                    <td>{{ $u->mitraProfile?->nama_usaha ?? '-' }}</td>
                    <td>{{ $u->google_id ? '🔑 Google' : '🔐 Password' }}</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.users.edit', $u) }}" class="btn" style="padding:5px 12px;font-size:13px">Edit</a>
                            @if($u->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}" onsubmit="return confirm('Hapus pengguna {{ addslashes($u->display_name) }}?')">
                                @csrf @method('DELETE')
                                <button class="btn" style="padding:5px 12px;font-size:13px;background:#dc2626;color:#fff;border:none;cursor:pointer;border-radius:8px">Hapus</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:30px">Belum ada pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px">{{ $users->links() }}</div>
</div>

@endsection
