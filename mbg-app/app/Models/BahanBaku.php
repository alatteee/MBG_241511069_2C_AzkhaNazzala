<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'kategori',
        'jumlah',
        'satuan',
        'tanggal_masuk',
        'tanggal_kadaluarsa',
        'status',
    ];

    public function updateStatus()
    {
        $today = now()->startOfDay();

        if ($this->jumlah == 0) {
            $this->status = 'habis';
        } elseif ($today->greaterThanOrEqualTo($this->tanggal_kadaluarsa)) {
            $this->status = 'kadaluarsa';
        } elseif ($today->diffInDays($this->tanggal_kadaluarsa, false) <= 3 && $this->jumlah > 0) {
            $this->status = 'segera_kadaluarsa';
        } else {
            $this->status = 'tersedia';
        }

        $this->save();
    }
}
