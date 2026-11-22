<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Struk Pengambilan #{{ $transaction->kode_transaksi }} | BiteSavr</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600&family=Space+Mono:wght@700&display=swap" rel="stylesheet">
<style>
:root{--g:#2E9E5B;--gd:#1B5E3A;--o:#FF8A1F;--bg:#F4FAF5;--card:#fff;--tx:#12301F;--mu:#4d6a58;--bd:#d5e6da}
*{box-sizing:border-box;margin:0}
body{background:linear-gradient(160deg,var(--gd),var(--g));min-height:100vh;display:flex;align-items:center;justify-content:center;font:400 15px/1.5 Inter,sans-serif;padding:20px}
.struk{background:#fff;width:100%;max-width:440px;border-radius:24px;box-shadow:0 24px 60px #0004;overflow:hidden;position:relative}
.struk-top{background:var(--bg);padding:24px 28px 18px;border-bottom:2px dashed var(--bd);text-align:center}
.logo{font:800 22px Poppins,sans-serif;color:var(--g)}
.logo b{color:var(--o)}
.badge-status{display:inline-block;padding:6px 14px;border-radius:99px;font:700 13px Poppins;margin-top:10px}
.status-wait{background:#fef3c7;color:#92400e}
.status-done{background:#dcfce7;color:#166534}
.struk-body{padding:24px 28px}
.qr-wrap{background:var(--bg);border:2px solid var(--bd);border-radius:18px;padding:16px;text-align:center;margin:16px 0}
.qr-box{display:inline-block;padding:12px;background:#fff;border-radius:12px;box-shadow:0 4px 12px #0001}
.code-tx{font:700 16px/1 'Space Mono',monospace;letter-spacing:1.5px;color:var(--tx);margin-top:10px}
.dl-info{display:grid;gap:10px;margin:20px 0;font-size:14px}
.dl-row{display:flex;justify-content:space-between;gap:12px;border-bottom:1px solid #f1f5f9;padding-bottom:8px}
.dl-row dt{color:var(--mu)}
.dl-row dd{font-weight:600;text-align:right;color:var(--tx)}
.instruksi{background:#f0fdf4;border:1px solid #bbf7d0;border-radius:12px;padding:12px 14px;font-size:13px;color:#166534;margin:16px 0}
.btn-act{display:flex;gap:10px}
.btn{flex:1;text-align:center;background:var(--g);color:#fff;font:700 14px Poppins;padding:12px;border-radius:99px;text-decoration:none}
.btn.ghost{background:transparent;border:1.5px solid var(--bd);color:var(--tx)}
@media print{
    body{background:#fff;padding:0}
    .struk{box-shadow:none;border:1px solid #000;max-width:100%}
    .btn-act{display:none}
}
</style>
</head>
<body>

<div class="struk">
    <div class="struk-top">
        <div class="logo">Bite<b>Savr</b></div>
        <p style="font-size:13px;color:var(--mu);margin-top:2px">Struk Pengambilan Makanan Surplus</p>
        @if($transaction->status_pengambilan === 'sudah_diambil')
            <span class="badge-status status-done">✓ Sudah Diambil</span>
        @else
            <span class="badge-status status-wait">⏱ Menunggu Pengambilan</span>
        @endif
    </div>

    <div class="struk-body">
        <div class="qr-wrap">
            <div class="qr-box">
                {{-- SVG QR Code Representation --}}
                <svg width="150" height="150" viewBox="0 0 100 100" style="display:block">
                    <rect width="100" height="100" fill="#ffffff"/>
                    <!-- QR Corners -->
                    <rect x="5" y="5" width="28" height="28" fill="#12301F" rx="3"/>
                    <rect x="9" y="9" width="20" height="20" fill="#ffffff" rx="2"/>
                    <rect x="13" y="13" width="12" height="12" fill="#12301F" rx="1"/>

                    <rect x="67" y="5" width="28" height="28" fill="#12301F" rx="3"/>
                    <rect x="71" y="9" width="20" height="20" fill="#ffffff" rx="2"/>
                    <rect x="75" y="13" width="12" height="12" fill="#12301F" rx="1"/>

                    <rect x="5" y="67" width="28" height="28" fill="#12301F" rx="3"/>
                    <rect x="9" y="71" width="20" height="20" fill="#ffffff" rx="2"/>
                    <rect x="13" y="75" width="12" height="12" fill="#12301F" rx="1"/>

                    <!-- QR Matrix Pattern based on unique code -->
                    <rect x="38" y="10" width="8" height="8" fill="#2E9E5B"/>
                    <rect x="50" y="10" width="8" height="8" fill="#12301F"/>
                    <rect x="38" y="24" width="8" height="8" fill="#12301F"/>
                    <rect x="50" y="24" width="8" height="8" fill="#2E9E5B"/>
                    <rect x="10" y="38" width="8" height="8" fill="#12301F"/>
                    <rect x="24" y="38" width="8" height="8" fill="#2E9E5B"/>
                    <rect x="38" y="38" width="8" height="8" fill="#12301F"/>
                    <rect x="52" y="38" width="8" height="8" fill="#12301F"/>
                    <rect x="66" y="38" width="8" height="8" fill="#2E9E5B"/>
                    <rect x="80" y="38" width="8" height="8" fill="#12301F"/>

                    <rect x="38" y="52" width="8" height="8" fill="#2E9E5B"/>
                    <rect x="52" y="52" width="8" height="8" fill="#12301F"/>
                    <rect x="66" y="52" width="8" height="8" fill="#12301F"/>
                    <rect x="80" y="52" width="8" height="8" fill="#2E9E5B"/>

                    <rect x="38" y="66" width="8" height="8" fill="#12301F"/>
                    <rect x="52" y="66" width="8" height="8" fill="#2E9E5B"/>
                    <rect x="66" y="66" width="8" height="8" fill="#12301F"/>
                    <rect x="80" y="66" width="8" height="8" fill="#12301F"/>

                    <rect x="38" y="80" width="8" height="8" fill="#2E9E5B"/>
                    <rect x="52" y="80" width="8" height="8" fill="#12301F"/>
                    <rect x="66" y="80" width="8" height="8" fill="#2E9E5B"/>
                    <rect x="80" y="80" width="8" height="8" fill="#12301F"/>
                </svg>
            </div>
            <div class="code-tx">{{ $transaction->kode_transaksi }}</div>
            <small style="color:var(--mu);font-size:12px">Tunjukkan kode atau QR ini ke kasir</small>
        </div>

        <div class="dl-info">
            <div class="dl-row">
                <dt>Menu Surplus</dt>
                <dd>{{ $transaction->product?->nama_produk }} ({{ $transaction->jumlah }}x)</dd>
            </div>
            <div class="dl-row">
                <dt>Mitra Penjual</dt>
                <dd>{{ $transaction->product?->mitraProfile?->nama_usaha }}</dd>
            </div>
            <div class="dl-row">
                <dt>Titik Penjemputan</dt>
                <dd>{{ $transaction->product?->titik_penjemputan }}</dd>
            </div>
            <div class="dl-row">
                <dt>Alamat Lengkap</dt>
                <dd style="font-size:13px">{{ $transaction->product?->mitraProfile?->alamat }}</dd>
            </div>
            <div class="dl-row">
                <dt>Batas Waktu Ambil</dt>
                <dd style="color:#d4380d">{{ $transaction->product?->batas_waktu_konsumsi?->translatedFormat('d M Y, H:i') }} WIB</dd>
            </div>
            <div class="dl-row" style="border-bottom:0">
                <dt>Total Pembayaran</dt>
                <dd style="color:var(--g);font-size:17px;font-family:Poppins">Rp{{ number_format($transaction->total_harga, 0, ',', '.') }}</dd>
            </div>
        </div>

        <div class="instruksi">
            💡 <b>Tips Penjemputan:</b> Datang langsung ke lokasi kasir sebelum batas waktu habis dan perlihatkan struk ini.
        </div>

        <div class="btn-act">
            <a href="{{ route('pesanan.index') }}" class="btn ghost">Pesanan Saya</a>
            <a href="{{ route('katalog') }}" class="btn">Deal Lainnya</a>
        </div>
    </div>
</div>

</body>
</html>
