<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'mitra_profile_id',
        'nama_produk',
        'kategori',
        'foto',
        'stok',
        'harga_asli',
        'harga_diskon',
        'titik_penjemputan',
        'deskripsi',
        'batas_waktu_konsumsi',
        'status',
    ];

    public function getKategoriLabelAttribute(): string
    {
        return match ($this->kategori) {
            'nasi'      => 'Nasi & Lauk',
            'roti_kue'  => 'Roti & Kue',
            'seafood'   => 'Seafood',
            'minuman'   => 'Minuman',
            'mie'       => 'Mie & Pasta',
            default     => 'Lainnya',
        };
    }

    public function getKategoriEmojiAttribute(): string
    {
        return match ($this->kategori) {
            'nasi'      => '🍛',
            'roti_kue'  => '🥐',
            'seafood'   => '🍤',
            'minuman'   => '☕',
            'mie'       => '🍜',
            default     => '🍱',
        };
    }

    protected function casts(): array
    {
        return [
            'batas_waktu_konsumsi' => 'datetime',
            'harga_asli'   => 'decimal:2',
            'harga_diskon' => 'decimal:2',
        ];
    }

    public function mitraProfile(): BelongsTo
    {
        return $this->belongsTo(MitraProfile::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function getDiskonPersenAttribute(): int
    {
        if ($this->harga_asli <= 0) return 0;
        return (int) round((1 - $this->harga_diskon / $this->harga_asli) * 100);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'tersedia'   => 'Tersedia',
            'habis'      => 'Stok Habis',
            'kadaluarsa' => 'Kadaluarsa',
            'nonaktif'   => 'Nonaktif',
            default      => ucfirst($this->status),
        };
    }

    public function getStatusClassAttribute(): string
    {
        return match ($this->status) {
            'tersedia'   => 'p-good',
            'habis'      => 'p-bad',
            'kadaluarsa' => 'p-bad',
            'nonaktif'   => 'p-muted',
            default      => 'p-info',
        };
    }
}
