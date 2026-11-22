@extends('layouts.mitra')
@section('title', 'Laporan Penjualan | Mitra BiteSavr')
@section('content')

<div class="ph">
    <div>
        <h1>Laporan Penjualan</h1>
        <p>Analisis pendapatan, pesanan, dan performa produk surplus Anda — {{ $mitra->nama_usaha }}.</p>
    </div>
    <div class="row">
        <button onclick="window.print()" class="btn" style="height:38px;display:inline-flex;align-items:center;gap:6px">
            <span>🖨️</span> Cetak / Simpan PDF
        </button>
    </div>
</div>

{{-- Filter Periode Waktu --}}
<div class="card" style="margin-bottom:0">
    <form method="GET" action="{{ route('mitra.reports.index') }}" id="filterForm" style="display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end">
        <div>
            <label style="font-size:13px;font-weight:600;display:block;margin-bottom:4px">Rentang Periode</label>
            <select name="period" id="periodSelect" onchange="toggleCustomDate()" style="padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
                <option value="hari_ini" @selected($period == 'hari_ini')>Hari Ini</option>
                <option value="7_hari" @selected($period == '7_hari')>7 Hari Terakhir</option>
                <option value="30_hari" @selected($period == '30_hari')>30 Hari Terakhir</option>
                <option value="bulan_ini" @selected($period == 'bulan_ini')>Bulan Ini</option>
                <option value="kustom" @selected($period == 'kustom')>Kustom Tanggal</option>
            </select>
        </div>

        <div id="customDateRange" style="display: {{ $period == 'kustom' ? 'flex' : 'none' }}; gap: 10px; align-items: flex-end;">
            <div>
                <label style="font-size:13px;font-weight:600;display:block;margin-bottom:4px">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date', $startDate->format('Y-m-d')) }}" style="padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
            </div>
            <div>
                <label style="font-size:13px;font-weight:600;display:block;margin-bottom:4px">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date', $endDate->format('Y-m-d')) }}" style="padding:9px 14px;border:1px solid var(--line);border-radius:8px;background:var(--bg);color:var(--tx);font-size:14px">
            </div>
        </div>

        <button type="submit" class="btn pri" style="height:38px">Terapkan Filter</button>
        <span style="font-size:13px;color:var(--muted);align-self:center">Menampilkan data: <b>{{ $periodLabel }}</b></span>
    </form>
</div>

{{-- KPI Ringkasan Omset --}}
<div class="card">
    <div class="g g4" style="gap:0">
        <div class="kpi" style="padding:4px 18px 4px 0">
            <span class="l">Total Omset Penjualan</span>
            <span class="v" style="color:#2E9E5B">Rp{{ number_format($totalOmset, 0, ',', '.') }}</span>
            <span class="d up">{{ $transaksiLunas }} transaksi berhasil</span>
        </div>
        <div class="kpi" style="padding:4px 18px;border-left:1px solid var(--line)">
            <span class="l">Porsi Terselamatkan</span>
            <span class="v">{{ $porsiTerjual }} <small style="font-size:14px;color:var(--muted)">porsi</small></span>
            <span class="d">Makanan tidak terbuang</span>
        </div>
        <div class="kpi" style="padding:4px 18px;border-left:1px solid var(--line)">
            <span class="l">Rata-rata Order (AOV)</span>
            <span class="v">Rp{{ number_format($aov, 0, ',', '.') }}</span>
            <span class="d">Nilai per transaksi</span>
        </div>
        <div class="kpi" style="padding:4px 18px;border-left:1px solid var(--line)">
            <span class="l">Pengambilan Makanan</span>
            <span class="v">{{ $sudahDiambilCount }} / {{ $transaksiLunas }}</span>
            <span class="d">{{ $belumDiambilCount }} menunggu diambil</span>
        </div>
    </div>
</div>

<div class="g g12">
    {{-- Produk Terlaris --}}
    <div class="card">
        <h2 style="margin-bottom:14px">⭐ Produk Surplus Terlaris</h2>
        <ul class="list">
            @forelse($topProducts as $idx => $tp)
            <li>
                <span class="av" style="background:#2E9E5B;color:#fff;font-weight:700">#{{ $idx + 1 }}</span>
                <div class="grow">
                    <b>{{ $tp->product?->nama_produk ?? 'Produk dihapus' }}</b>
                    <span style="font-size:13px;color:var(--muted)">
                        Terjual: <b>{{ $tp->total_qty }} porsi</b> ({{ $tp->total_orders }} pesanan)
                    </span>
                </div>
                <div style="text-align:right">
                    <b style="color:#2E9E5B">Rp{{ number_format($tp->total_revenue, 0, ',', '.') }}</b>
                    <div style="font-size:12px;color:var(--muted)">Total omset</div>
                </div>
            </li>
            @empty
            <li style="color:var(--muted);font-size:14px;text-align:center;padding:24px">Belum ada data penjualan pada periode ini.</li>
            @endforelse
        </ul>
    </div>

    {{-- Rekapitulasi Harian --}}
    <div class="card">
        <h2 style="margin-bottom:14px">📅 Rekap Penjualan Harian</h2>
        <div class="tw">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Transaksi</th>
                        <th>Porsi Terjual</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dailyRecords as $rec)
                    <tr>
                        <td><b>{{ \Carbon\Carbon::parse($rec->date)->translatedFormat('d M Y') }}</b></td>
                        <td>{{ $rec->count }} order</td>
                        <td class="num">{{ $rec->qty }} porsi</td>
                        <td class="num" style="color:#2E9E5B;font-weight:700">Rp{{ number_format($rec->revenue, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;color:var(--muted);padding:24px">Tidak ada data transaksi harian.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Detail Transaksi dalam Rentang Periode --}}
<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
        <h2>Rincian Transaksi ({{ $periodLabel }})</h2>
        <span style="font-size:13px;color:var(--muted)">Total: {{ $transactions->total() }} transaksi</span>
    </div>
    <div class="tw">
        <table>
            <thead>
                <tr>
                    <th>Kode Struk</th>
                    <th>Pelanggan</th>
                    <th>Menu Surplus</th>
                    <th>Porsi</th>
                    <th>Total</th>
                    <th>Status Pembayaran</th>
                    <th>Status Pengambilan</th>
                    <th>Waktu Pesan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                <tr>
                    <td><code>{{ $t->kode_transaksi }}</code></td>
                    <td><b>{{ $t->user?->display_name ?? '-' }}</b></td>
                    <td>{{ $t->product?->nama_produk ?? '-' }}</td>
                    <td class="num">{{ $t->jumlah }}</td>
                    <td class="num" style="color:#2E9E5B;font-weight:700">Rp{{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td><span class="pill {{ $t->status_bayar_class }}">{{ $t->status_bayar_label }}</span></td>
                    <td>
                        <span class="pill {{ $t->status_pengambilan == 'sudah_diambil' ? 'p-good' : 'p-info' }}">
                            {{ $t->status_pengambilan_label }}
                        </span>
                    </td>
                    <td style="font-size:13px;color:var(--muted)">{{ $t->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:var(--muted);padding:30px">Tidak ada transaksi dalam rentang periode ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:16px">{{ $transactions->links() }}</div>
</div>

<script>
function toggleCustomDate() {
    const sel = document.getElementById('periodSelect').value;
    document.getElementById('customDateRange').style.display = (sel === 'kustom') ? 'flex' : 'none';
    if (sel !== 'kustom') {
        document.getElementById('filterForm').submit();
    }
}
</script>

<style>
@media print {
    .sb, .tb, .ph .row, #filterForm, .tw form { display: none !important; }
    .main { margin-left: 0 !important; width: 100% !important; }
    .card { box-shadow: none !important; border: 1px solid #ccc !important; }
}
</style>

@endsection
