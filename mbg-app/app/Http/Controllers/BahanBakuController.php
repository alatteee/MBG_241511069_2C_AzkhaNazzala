<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahan = BahanBaku::all();
        $bahan = BahanBaku::orderBy('created_at', 'desc')->paginate(10); // 10 data per halaman
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
    public function edit($id)
    {
        $bahan = BahanBaku::findOrFail($id);
        return view('bahan.edit', compact('bahan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:0',
        ]);

        $bahan = BahanBaku::findOrFail($id);
        $bahan->jumlah = $request->jumlah;
        $bahan->save();

        $bahan->updateStatus();

        return redirect()->route('bahan.index')->with('success', 'Stok bahan berhasil diperbarui!');
    }
    
    public function destroy($id)
    {
        $bahan = BahanBaku::findOrFail($id);

        if ($bahan->status !== 'kadaluarsa') {
            return redirect()->route('bahan.index')
                ->with('error', 'Bahan tidak bisa dihapus karena statusnya bukan Kadaluarsa.');
        }

        $bahan->delete();

        return redirect()->route('bahan.index')
            ->with('success', 'Bahan berhasil dihapus.');
    }



}
