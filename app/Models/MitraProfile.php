<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitraProfile extends Model
{
    protected $fillable = [
        'nama_usaha',
        'alamat',
        'koordinat',
        'status_verifikasi',
    ];
}
