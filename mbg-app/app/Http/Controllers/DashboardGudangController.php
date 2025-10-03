<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Permintaan;

class DashboardGudangController extends Controller
{
    public function index()
    {
        $totalBahan = BahanBaku::count();
        $permintaanPending = Permintaan::where('status', 'menunggu')->count();
        $bahanKadaluarsa = BahanBaku::where('status', 'kadaluarsa')->count();
        $bahanHampirKadaluarsa = BahanBaku::where('status', 'segera_kadaluarsa')->count();
        $bahanHabis = BahanBaku::where('status', 'habis')->count();

        return view('dashboard.gudang', compact(
            'totalBahan',
            'permintaanPending',
            'bahanKadaluarsa',
            'bahanHampirKadaluarsa',
            'bahanHabis'
        ));
    }
}

