@extends('layouts.admin')
@section('title', 'Kelola Mitra | Admin BiteSavr')
@section('content')

<div class="ph">
    <div>
        <h1>Kelola Mitra</h1>
        <p>Tambah, edit, dan kelola status verifikasi mitra BiteSavr.</p>
    </div>
    <div class="row">
        <a class="btn pri" href="{{ route('admin.mitra.create') }}">+ Tambah Mitra</a>
    </div>
</div>

{{-- Filter --}}
<div class="card" style="margin-bottom:0">
    <form method="GET" style="display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end">
        <div style="flex:1;min-width:200px">
            <label style="font-size:13px;font-weight:600;display:block;margin-bottom:4px">Cari</label>
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Nama usaha…"
                style="width:100%;padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
        </div>
        <div>
            <label style="font-size:13px;font-weight:600;display:block;margin-bottom:4px">Status</label>
            <select name="status" style="padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
                <option value="">Semua</option>
                <option value="pending" @selected(request('status')=='pending')>Menunggu</option>
                <option value="verified" @selected(request('status')=='verified')>Terverifikasi</option>
                <option value="rejected" @selected(request('status')=='rejected')>Ditolak</option>
            </select>
        </div>
        <button type="submit" class="btn pri" style="height:38px">Cari</button>
        @if(request()->anyFilled(['search','status']))
            <a href="{{ route('admin.mitra.index') }}" class="btn" style="height:38px;line-height:38px;padding:0 16px">Reset</a>
        @endif
    </form>
</div>

<div class="card">
    <div class="tw">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Usaha</th>
                    <th>Kategori</th>
                    <th>Kontak</th>
                    <th>Status</th>
                    <th>Produk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mitras as $m)
                <tr>
                    <td class="mono">{{ $m->id }}</td>
                    <td>
                        <b>{{ $m->nama_usaha }}</b><br>
                        <small style="color:var(--muted)">{{ Str::limit($m->alamat, 40) }}</small>
                    </td>
                    <td>{{ $m->kategori ?? '-' }}</td>
                    <td>
                        {{ $m->no_telepon ?? '-' }}<br>
                        <small style="color:var(--muted)">{{ $m->email_usaha ?? '' }}</small>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.mitra.updateStatus', $m) }}" style="display:inline">
                            @csrf @method('PATCH')
                            <select name="status_verifikasi" onchange="this.form.submit()"
                                style="padding:4px 8px;border-radius:99px;font-size:12px;font-weight:600;border:1px solid var(--line);background:var(--bg);color:var(--tx);cursor:pointer">
                                <option value="pending" @selected($m->status_verifikasi=='pending')>⏳ Menunggu</option>
                                <option value="verified" @selected($m->status_verifikasi=='verified')>✓ Terverifikasi</option>
                                <option value="rejected" @selected($m->status_verifikasi=='rejected')>✕ Ditolak</option>
                            </select>
                        </form>
                    </td>
                    <td class="num">{{ $m->products_count ?? 0 }}</td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <a href="{{ route('admin.mitra.edit', $m) }}" class="btn" style="padding:6px 12px;font-size:13px">Edit</a>
                            <form method="POST" action="{{ route('admin.mitra.destroy', $m) }}" onsubmit="return confirm('Hapus mitra {{ addslashes($m->nama_usaha) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn" style="padding:6px 12px;font-size:13px;background:var(--red,#dc2626);color:#fff;border:none;cursor:pointer;border-radius:8px">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:30px">Belum ada mitra.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px">{{ $mitras->links() }}</div>
</div>

@endsection
