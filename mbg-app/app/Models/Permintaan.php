<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table = 'permintaan';
    public $timestamps = false;

    public function details() {
        return $this->hasMany(PermintaanDetail::class, 'permintaan_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'pemohon_id');
    }
}
