<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UmpanBalik extends Model
{
    protected $table = 'umpan_baliks';

    protected $fillable = [
        'id_aspirasi',
        'id_user',
        'keterangan',
    ];

    // Relasi ke Aspirasi
    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class, 'id_aspirasi');
    }

    // Relasi ke User (admin yang memberi feedback)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
