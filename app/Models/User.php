<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'google_id',
        'avatar',
        'nama',
        'email',
        'password',
        'role',
        'mitra_profile_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Role helpers
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMitra(): bool
    {
        return in_array($this->role, ['mitra_manager', 'mitra_staff']);
    }

    public function isMitraManager(): bool
    {
        return $this->role === 'mitra_manager';
    }

    public function isKonsumen(): bool
    {
        return $this->role === 'konsumen';
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->nama ?? $this->name ?? 'Pengguna';
    }

    public function getInitialsAttribute(): string
    {
        $name = $this->display_name;
        $words = explode(' ', trim($name));
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($name, 0, 2));
    }

    // Relations
    public function mitraProfile(): BelongsTo
    {
        return $this->belongsTo(MitraProfile::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
