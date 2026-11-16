@extends('layouts.dashboard')

@section('title', 'Mitra | BiteSavr')

@section('content')
    <div class="ph">
        <div>
            <div class="crumb">Data utama / Mitra</div>
            <h1>Mitra</h1>
            <p>Kelola restoran dan hotel yang menjual makanan surplus.</p>
        </div>
        <a class="btn pri" href="{{ route('mitra.create') }}">+ Tambah mitra</a>
    </div>

    @if (session('success'))
        <div class="card" style="border-color: var(--good); color: var(--good)">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <h2>Daftar mitra <small>{{ $mitras->total() }} mitra</small></h2>
        <div class="tw">
            <table>
                <thead>
                    <tr>
                        <th>Nama usaha</th>
                        <th>Alamat</th>
                        <th>Koordinat</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mitras as $mitra)
                        <tr>
                            <td>
                                <a class="t" href="{{ route('mitra.edit', $mitra) }}">
                                    {{ $mitra->nama_usaha }}
                                </a>
                            </td>
                            <td>{{ $mitra->alamat }}</td>
                            <td>{{ $mitra->koordinat ?: '-' }}</td>
                            <td>
                                <span
                                    class="pill {{ $mitra->status_verifikasi === 'verified' ? 'p-good' : ($mitra->status_verifikasi === 'rejected' ? 'p-bad' : 'p-warn') }}"
                                >
                                    {{ ucfirst($mitra->status_verifikasi) }}
                                </span>
                            </td>
                            <td>
                                <div class="row">
                                    <a class="btn ghost" href="{{ route('mitra.edit', $mitra) }}">
                                        Edit
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('mitra.destroy', $mitra) }}"
                                        onsubmit="return confirm('Hapus mitra ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn ghost" type="submit">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Belum ada data mitra.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($mitras->hasPages())
            <div class="pager">
                <span>
                    Menampilkan {{ $mitras->firstItem() }}-{{ $mitras->lastItem() }} dari {{ $mitras->total() }}
                </span>
                <div class="pg">
                    @if ($mitras->onFirstPage())
                        <span>←</span>
                    @else
                        <a href="{{ $mitras->previousPageUrl() }}">←</a>
                    @endif
                    <span>{{ $mitras->currentPage() }}</span>
                    @if ($mitras->hasMorePages())
                        <a href="{{ $mitras->nextPageUrl() }}">→</a>
                    @else
                        <span>→</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection
