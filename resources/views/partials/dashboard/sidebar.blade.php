<aside class="sb" aria-label="Navigasi utama">
    <a class="brand" href="{{ url('/') }}">
        <span class="mk">B</span>
        <span>BiteSavr<small>Surplus food marketplace</small></span>
    </a>

    <nav class="nav">
        <div class="lbl">Utama</div>
        <a href="{{ url('/') }}" @if (request()->is('/')) aria-current="page" @endif>
            <span class="i">⌂</span>
            <span>Ringkasan</span>
        </a>
        <a href="#transactions">
            <span class="i">↗</span>
            <span>Transaksi</span>
        </a>
        <a href="{{ route('mitra.index') }}" @if (request()->routeIs('mitra.*')) aria-current="page" @endif>
            <span class="i">▦</span>
            <span>Mitra</span>
        </a>
        <a href="#products">
            <span class="i">☷</span>
            <span>Produk surplus</span>
        </a>
        <a href="#users">
            <span class="i">♙</span>
            <span>Pengguna</span>
        </a>

        <div class="lbl">Laporan</div>
        <a href="#reports">
            <span class="i">▥</span>
            <span>Laporan penjualan</span>
        </a>
        <a href="#settings">
            <span class="i">⚙</span>
            <span>Pengaturan</span>
        </a>
    </nav>

    <div class="foot">
        BiteSavr dashboard<br>
        <a href="{{ url('/') }}">Kembali ke beranda</a>
    </div>
</aside>
