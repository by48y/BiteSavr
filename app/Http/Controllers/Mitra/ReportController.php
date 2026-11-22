<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    private function getMitra()
    {
        return Auth::user()->mitraProfile ?? abort(403);
    }

    public function index(Request $request)
    {
        $mitra = $this->getMitra();

        // Rentang waktu filter
        $period = $request->get('period', '30_hari');
        $now = Carbon::now();

        switch ($period) {
            case 'hari_ini':
                $startDate = $now->copy()->startOfDay();
                $endDate = $now->copy()->endOfDay();
                $periodLabel = 'Hari Ini (' . $now->translatedFormat('d F Y') . ')';
                break;
            case '7_hari':
                $startDate = $now->copy()->subDays(6)->startOfDay();
                $endDate = $now->copy()->endOfDay();
                $periodLabel = '7 Hari Terakhir';
                break;
            case 'bulan_ini':
                $startDate = $now->copy()->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                $periodLabel = 'Bulan Ini (' . $now->translatedFormat('F Y') . ')';
                break;
            case 'kustom':
                $startDate = $request->filled('start_date') ? Carbon::parse($request->start_date)->startOfDay() : $now->copy()->subDays(29)->startOfDay();
                $endDate = $request->filled('end_date') ? Carbon::parse($request->end_date)->endOfDay() : $now->copy()->endOfDay();
                $periodLabel = $startDate->format('d/m/Y') . ' - ' . $endDate->format('d/m/Y');
                break;
            case '30_hari':
            default:
                $startDate = $now->copy()->subDays(29)->startOfDay();
                $endDate = $now->copy()->endOfDay();
                $periodLabel = '30 Hari Terakhir';
                break;
        }

        // Query transaksi mitra dalam periode
        $txQuery = Transaction::with(['user', 'product'])
            ->whereHas('product', fn($q) => $q->where('mitra_profile_id', $mitra->id))
            ->whereBetween('created_at', [$startDate, $endDate]);

        // KPI Ringkasan
        $allTxInPeriod = (clone $txQuery)->get();
        $paidTxInPeriod = $allTxInPeriod->where('status_bayar', 'paid');

        $totalOmset = $paidTxInPeriod->sum('total_harga');
        $totalTransaksi = $allTxInPeriod->count();
        $transaksiLunas = $paidTxInPeriod->count();
        $porsiTerjual = $paidTxInPeriod->sum('jumlah');
        $aov = $transaksiLunas > 0 ? ($totalOmset / $transaksiLunas) : 0;
        $sudahDiambilCount = $paidTxInPeriod->where('status_pengambilan', 'sudah_diambil')->count();
        $belumDiambilCount = $paidTxInPeriod->where('status_pengambilan', 'belum_diambil')->count();

        // Produk Terlaris (Breakdown)
        $topProducts = Transaction::select(
                'product_id',
                DB::raw('SUM(jumlah) as total_qty'),
                DB::raw('SUM(total_harga) as total_revenue'),
                DB::raw('COUNT(id) as total_orders')
            )
            ->whereHas('product', fn($q) => $q->where('mitra_profile_id', $mitra->id))
            ->where('status_bayar', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('product_id')
            ->orderByDesc('total_revenue')
            ->with('product')
            ->take(5)
            ->get();

        // Rekapitulasi per Tanggal (untuk grafik & tabel tren)
        $dailyRecords = Transaction::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(id) as count'),
                DB::raw('SUM(CASE WHEN status_bayar = "paid" THEN total_harga ELSE 0 END) as revenue'),
                DB::raw('SUM(CASE WHEN status_bayar = "paid" THEN jumlah ELSE 0 END) as qty')
            )
            ->whereHas('product', fn($q) => $q->where('mitra_profile_id', $mitra->id))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        // Daftar Transaksi Terkini dalam rentang
        $transactions = (clone $txQuery)->latest()->paginate(15)->withQueryString();

        return view('mitra.reports.index', compact(
            'mitra',
            'period',
            'periodLabel',
            'startDate',
            'endDate',
            'totalOmset',
            'totalTransaksi',
            'transaksiLunas',
            'porsiTerjual',
            'aov',
            'sudahDiambilCount',
            'belumDiambilCount',
            'topProducts',
            'dailyRecords',
            'transactions'
        ));
    }
}
