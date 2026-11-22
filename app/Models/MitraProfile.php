<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MitraProfile extends Model
{
    protected $fillable = [
        'nama_usaha',
        'alamat',
        'koordinat',
        'no_telepon',
        'email_usaha',
        'deskripsi',
        'foto_usaha',
        'kategori',
        'jam_operasional',
        'status_verifikasi',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status_verifikasi) {
            'verified'  => 'Terverifikasi',
            'rejected'  => 'Ditolak',
            default     => 'Menunggu',
        };
    }

    public function getStatusClassAttribute(): string
    {
        return match ($this->status_verifikasi) {
            'verified'  => 'p-good',
            'rejected'  => 'p-bad',
            default     => 'p-info',
        };
    }
}
