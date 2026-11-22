<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Pesanan Saya | BiteSavr</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{--g:#2E9E5B;--gd:#1B5E3A;--o:#FF8A1F;--bg:#F4FAF5;--card:#fff;--tx:#12301F;--mu:#4d6a58;--bd:#d5e6da}
*{box-sizing:border-box;margin:0}
body{background:var(--bg);color:var(--tx);font:400 15px/1.6 Inter,sans-serif}
.wrap{max-width:840px;margin:auto;padding:24px 20px}
.nav{display:flex;align-items:center;justify-content:space-between;padding:16px 0;margin-bottom:24px;border-bottom:1px solid var(--bd)}
.logo{font:800 22px Poppins,sans-serif;color:var(--g);text-decoration:none}
.logo b{color:var(--o)}
.links{display:flex;gap:10px;align-items:center}
.btn{display:inline-block;background:var(--g);color:#fff;font:600 14px Poppins;padding:9px 18px;border-radius:99px;text-decoration:none}
.btn.ghost{background:transparent;border:1px solid var(--bd);color:var(--tx)}
.card{background:#fff;border:1px solid var(--bd);border-radius:18px;padding:20px;margin-bottom:16px;box-shadow:0 4px 12px #0001;display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap}
.tag{display:inline-block;padding:4px 12px;border-radius:99px;font:700 12px Poppins}
.tag-wait{background:#fef3c7;color:#92400e}
.tag-done{background:#dcfce7;color:#166534}
.empty{text-align:center;padding:60px 20px;background:#fff;border:1px dashed var(--bd);border-radius:20px}
</style>
</head>
<body>

<div class="wrap">
    <header class="nav">
        <a href="{{ route('home') }}" class="logo">Bite<b>Savr</b></a>
        <div class="links">
            <a href="{{ route('katalog') }}" class="btn ghost">Katalog</a>
            <span style="font-size:14px;color:var(--mu)">Halo, <b>{{ auth()->user()->display_name }}</b></span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" style="background:none;border:none;color:var(--mu);cursor:pointer;font-size:13px;padding:6px">Keluar</button>
            </form>
        </div>
    </header>

    <h1 style="font:800 28px Poppins;margin-bottom:6px">Pesanan Saya</h1>
    <p style="color:var(--mu);margin-bottom:24px">Daftar makanan surplus yang telah Anda selamatkan dan status pengambilannya.</p>

    @if(session('success'))
        <div style="background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;padding:12px 18px;border-radius:12px;margin-bottom:18px;font-size:14px">
            {{ session('success') }}
        </div>
    @endif

    @forelse($transactions as $t)
    <div class="card">
        <div>
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:6px">
                <code style="font-weight:700;font-size:13px">{{ $t->kode_transaksi }}</code>
                @if($t->status_pengambilan === 'sudah_diambil')
                    <span class="tag tag-done">✓ Sudah Diambil</span>
                @else
                    <span class="tag tag-wait">⏱ Belum Diambil</span>
                @endif
            </div>
            <h2 style="font:700 18px Poppins;margin-bottom:4px">{{ $t->product?->nama_produk }}</h2>
            <p style="color:var(--mu);font-size:14px">
                Mitra: <b>{{ $t->product?->mitraProfile?->nama_usaha }}</b> · {{ $t->jumlah }} porsi
            </p>
            <p style="font-size:13px;color:var(--mu);margin-top:4px">
                📍 Ambil di: {{ $t->product?->titik_penjemputan }} ({{ $t->product?->mitraProfile?->alamat }})
            </p>
            <p style="font-size:12px;color:#d4380d;margin-top:2px">
                Batas waktu: {{ $t->product?->batas_waktu_konsumsi?->translatedFormat('d M Y, H:i') }}
            </p>
        </div>

        <div style="text-align:right">
            <div style="font:700 20px Poppins;color:var(--g);margin-bottom:10px">
                Rp{{ number_format($t->total_harga, 0, ',', '.') }}
            </div>
            <a href="{{ route('pesanan.show', $t->kode_transaksi) }}" class="btn" style="font-size:13px">
                Lihat Struk QR →
            </a>
        </div>
    </div>
    @empty
    <div class="empty">
        <div style="font-size:52px;margin-bottom:12px">🍽️</div>
        <h2 style="font:700 20px Poppins;margin-bottom:8px">Belum Ada Pesanan</h2>
        <p style="color:var(--mu);margin-bottom:20px">Anda belum menyelamatkan makanan surplus hari ini. Yuk lihat deal hemat terdekat!</p>
        <a href="{{ route('katalog') }}" class="btn">Lihat Katalog Makanan Surplus</a>
    </div>
    @endforelse

    <div style="margin-top:20px">{{ $transactions->links() }}</div>
</div>

</body>
</html>
