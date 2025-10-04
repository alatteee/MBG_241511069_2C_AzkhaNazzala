<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;
use Illuminate\Support\Facades\Auth;

class DashboardDapurController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $menunggu = Permintaan::where('pemohon_id', $userId)
            ->where('status', 'menunggu')
            ->count();

        $disetujui = Permintaan::where('pemohon_id', $userId)
            ->where('status', 'disetujui')
            ->count();

        $ditolak = Permintaan::where('pemohon_id', $userId)
            ->where('status', 'ditolak')
            ->count();

        return view('dashboard.dapur', compact('menunggu', 'disetujui', 'ditolak'));
    }
}
