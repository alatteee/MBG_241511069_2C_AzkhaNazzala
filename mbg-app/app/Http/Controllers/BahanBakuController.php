<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahan = BahanBaku::all();
        return view('bahan.index', compact('bahan'));
    }

    public function create()
    {
        return view('bahan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required|integer|min:0',
            'satuan' => 'required',
            'tanggal_masuk' => 'required|date',
            'tanggal_kadaluarsa' => 'required|date',
        ]);

        BahanBaku::create($request->all());

        return redirect()->route('bahan.index')->with('success', 'Bahan berhasil ditambahkan');
    }
}
