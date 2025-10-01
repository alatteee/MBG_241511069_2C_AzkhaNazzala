<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanDetail extends Model
{
    
    protected $table = 'permintaan_detail';
    public $timestamps = false;

    public function bahan() {
        return $this->belongsTo(BahanBaku::class, 'bahan_id');
    }
}
