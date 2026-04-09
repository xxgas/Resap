<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';

    protected $fillable = [
        'nama_kategori',
    ];

    // Relasi: satu kategori bisa punya banyak aspirasi
    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class, 'id_kategori');
    }
}
