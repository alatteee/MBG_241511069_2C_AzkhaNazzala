<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahan = BahanBaku::all();
        // update status otomatis
        foreach ($bahan as $item) {
            $item->updateStatus();
        }
        return view('bahan.index', compact('bahan'));
    }

    public function create()
    {
        return view('bahan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:120',
            'kategori' => 'required|string|max:60',
            'jumlah' => 'required|integer|min:0',
            'satuan' => 'required|string|max:20',
            'tanggal_masuk' => 'required|date',
            'tanggal_kadaluarsa' => 'required|date|after_or_equal:tanggal_masuk',
        ]);

        BahanBaku::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_kadaluarsa' => $request->tanggal_kadaluarsa,
            'status' => 'tersedia', // default status awal
        ]);

        return redirect()->route('bahan.index')->with('success', 'Bahan baru berhasil ditambahkan!');
    }
}
