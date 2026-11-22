<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'jumlah',
        'total_harga',
        'status_bayar',
        'kode_transaksi',
        'status_pengambilan',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'total_harga' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getStatusBayarLabelAttribute(): string
    {
        return match ($this->status_bayar) {
            'paid'    => 'Lunas',
            'failed'  => 'Gagal',
            'expired' => 'Kadaluarsa',
            default   => 'Menunggu',
        };
    }

    public function getStatusBayarClassAttribute(): string
    {
        return match ($this->status_bayar) {
            'paid'    => 'p-good',
            'failed'  => 'p-bad',
            'expired' => 'p-bad',
            default   => 'p-info',
        };
    }

    public function getStatusPengambilanLabelAttribute(): string
    {
        return match ($this->status_pengambilan) {
            'sudah_diambil' => 'Sudah Diambil',
            'batal'         => 'Dibatalkan',
            default         => 'Belum Diambil',
        };
    }
}
