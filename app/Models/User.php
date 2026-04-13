<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Field yang digunakan untuk login (bukan email).
     */
    protected $table = 'users';

    protected $fillable = [
        'id',
        'nama',
        'nip_nis',
        'password',
        'role',
        'kelas',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Override field username untuk Auth::attempt
    public function getAuthPassword()
    {
        return $this->password;
    }

    // Relasi: satu user bisa punya banyak aspirasi
    public function aspirasis()
    {
        return $this->hasMany(Aspirasi::class, 'id_user');
    }

    // Relasi: satu user bisa punya banyak umpan_balik
    public function umpanBaliks()
    {
        return $this->hasMany(UmpanBalik::class, 'id_user');
    }
}
