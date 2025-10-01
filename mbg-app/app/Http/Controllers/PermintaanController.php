<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;

class PermintaanController extends Controller
{
    public function index()
    {
        $permintaan = Permintaan::with('user')->get();
        return view('permintaan.index', compact('permintaan'));
    }

    public function create()
    {
        return view('permintaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tgl_masak' => 'required|date',
            'menu_makan' => 'required',
            'jumlah_porsi' => 'required|integer|min:1',
        ]);

        Permintaan::create([
            'pemohon_id' => auth()->id(),
            'tgl_masak' => $request->tgl_masak,
            'menu_makan' => $request->menu_makan,
            'jumlah_porsi' => $request->jumlah_porsi,
            'status' => 'menunggu',
        ]);

        return redirect()->route('permintaan.index')->with('success','Permintaan berhasil dibuat');
    }
}
