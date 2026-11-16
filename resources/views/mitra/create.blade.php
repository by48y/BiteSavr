@extends('layouts.dashboard')

@section('title', 'Tambah Mitra | BiteSavr')

@section('content')
    <div class="ph">
        <div>
            <div class="crumb"><a href="{{ route('mitra.index') }}">Mitra</a> / Tambah</div>
            <h1>Tambah mitra</h1>
            <p>Tambahkan restoran atau hotel baru ke BiteSavr.</p>
        </div>
    </div>

    <div class="card">
        @include('mitra.form', [
            'mitraProfile' => null,
            'action' => route('mitra.store'),
            'method' => 'POST',
        ])
    </div>
@endsection
