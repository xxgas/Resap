<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasis';

    protected $fillable = [
        'id_user',
        'id_kategori',
        'deskripsi',
        'lokasi',
        'status',
        'foto',
    ];

    // Relasi ke User (pelapor)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // Relasi ke UmpanBalik
    public function umpanBaliks()
    {
        return $this->hasMany(UmpanBalik::class, 'id_aspirasi');
    }
}
