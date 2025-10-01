<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';  

    public $timestamps = false;  

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',   // tambahin ini biar bisa mass assign role
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

    //Relasi: 1 user (dapur) bisa punya banyak permintaan
    public function permintaan()
    {
        return $this->hasMany(Permintaan::class, 'pemohon_id');
    }
}
