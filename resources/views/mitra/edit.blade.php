@extends('layouts.dashboard')

@section('title', 'Edit Mitra | BiteSavr')

@section('content')
    <div class="ph">
        <div>
            <div class="crumb"><a href="{{ route('mitra.index') }}">Mitra</a> / Edit</div>
            <h1>Edit mitra</h1>
            <p>Perbarui informasi {{ $mitraProfile->nama_usaha }}.</p>
        </div>
    </div>

    <div class="card">
        @include('mitra.form', [
            'action' => route('mitra.update', $mitraProfile),
            'method' => 'PUT',
        ])
    </div>
@endsection
