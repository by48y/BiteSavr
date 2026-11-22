<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>@yield('title', 'Dashboard Admin | BiteSavr')</title>
<meta name="robots" content="noindex, follow">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Black:wght@400;500;600;700&family=Archivo:wght@400;500;600;700&family=Space+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('tabletop/assets/css/app.css') }}">
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'><rect width='64' height='64' rx='14' fill='%23dc2626'/><text x='32' y='42' font-family='Arial' font-size='30' font-weight='700' text-anchor='middle' fill='white'>B</text></svg>">
</head>
<body data-app="bitesavr">
<div class="app">
    {{-- SIDEBAR ADMIN --}}
    <aside class="sb" aria-label="Navigasi admin">
        <a class="brand" href="{{ route('admin.dashboard') }}">
            <span class="mk">B</span>
            <span>BiteSavr<small>Panel Admin</small></span>
        </a>
        <nav class="nav">
            <div class="lbl">Utama</div>
            <a href="{{ route('admin.dashboard') }}" @if(request()->routeIs('admin.dashboard')) aria-current="page" @endif>
                <span class="i">⌂</span><span>Ringkasan</span>
            </a>
            <a href="{{ route('admin.mitra.index') }}" @if(request()->routeIs('admin.mitra.*')) aria-current="page" @endif>
                <span class="i">◦</span><span>Kelola Mitra</span>
            </a>
            <a href="{{ route('admin.users.index') }}" @if(request()->routeIs('admin.users.*')) aria-current="page" @endif>
                <span class="i">♙</span><span>Kelola Pengguna</span>
            </a>
            <a href="{{ route('admin.products.index') }}" @if(request()->routeIs('admin.products.*')) aria-current="page" @endif>
                <span class="i">☷</span><span>Semua Produk</span>
            </a>
            <a href="{{ route('admin.transactions.index') }}" @if(request()->routeIs('admin.transactions.*')) aria-current="page" @endif>
                <span class="i">↗</span><span>Semua Transaksi</span>
            </a>
        </nav>
        <div class="foot">
            <strong>{{ auth()->user()->display_name }}</strong><br>
            <span style="font-size:12px;opacity:.7">Administrator</span><br>
            <form method="POST" action="{{ route('logout') }}" style="margin-top:8px">
                @csrf
                <button type="submit" style="background:none;border:none;color:inherit;cursor:pointer;font-size:13px;opacity:.7;padding:0">↩ Keluar</button>
            </form>
        </div>
    </aside>

    <div class="main">
        {{-- HEADER --}}
        <header class="tb">
            <button class="ib burger" data-burger aria-label="Buka menu"><span class="i">☰</span></button>
            <span class="sp"></span>
            @if(session('success'))
                <span style="font-size:13px;color:#166534;background:#f0fdf4;padding:6px 14px;border-radius:99px;border:1px solid #bbf7d0">✓ {{ session('success') }}</span>
            @endif
            @if(session('error'))
                <span style="font-size:13px;color:#dc2626;background:#fef2f2;padding:6px 14px;border-radius:99px;border:1px solid #fecaca">✕ {{ session('error') }}</span>
            @endif
            <span class="sp"></span>
            <button class="ib" data-theme-toggle aria-label="Ubah tema"><span class="i">◐</span></button>
            <span class="av">{{ auth()->user()->initials }}</span>
        </header>

        <main class="ct" id="main">
            @yield('content')
        </main>
    </div>
</div>
<script src="{{ asset('tabletop/assets/js/app.js') }}"></script>
</body>
</html>
