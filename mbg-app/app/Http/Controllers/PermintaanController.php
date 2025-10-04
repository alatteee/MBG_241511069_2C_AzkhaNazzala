<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;
use App\Models\PermintaanDetail;
use App\Models\BahanBaku;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    // tampilkan daftar permintaan milik user (role dapur)
    public function index()
    {
        $permintaan = Permintaan::with('details.bahan')
    
            ->where('pemohon_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10); // tampil 10 per halaman

        return view('permintaan.index', compact('permintaan'));
    }

    // form create permintaan
    public function create()
    {
        $bahan = BahanBaku::where('jumlah', '>', 0)
            ->where('status', '!=', 'kadaluarsa')
            ->get();

        return view('permintaan.create', compact('bahan'));
    }

    // simpan permintaan
    public function store(Request $request)
    {
        $request->validate([
            'tgl_masak' => 'required|date',
            'menu_makan' => 'required|string',
            'jumlah_porsi' => 'required|integer|min:1',
            'bahan_id.*' => 'required|exists:bahan_baku,id',
            'jumlah_diminta.*' => 'required|integer|min:1',
        ]);

        $permintaan = Permintaan::create([
            'pemohon_id' => Auth::id(),
            'tgl_masak' => $request->tgl_masak,
            'menu_makan' => $request->menu_makan,
            'jumlah_porsi' => $request->jumlah_porsi,
            'status' => 'menunggu',
        ]);

        foreach ($request->bahan_id as $i => $bahanId) {
            PermintaanDetail::create([
                'permintaan_id' => $permintaan->id,
                'bahan_id' => $bahanId,
                'jumlah_diminta' => $request->jumlah_diminta[$i],
            ]);
        }

        return redirect()->route('permintaan.index')
            ->with('success', 'Permintaan berhasil dibuat dan menunggu persetujuan.');
    }

    public function indexAdmin()
    {
        $permintaan = Permintaan::with('details.bahan', 'pemohon')
            ->orderBy('created_at', 'desc')
            ->paginate(10); // tampil 10 data per halaman

        return view('admin.permintaan.index', compact('permintaan'));
    }


    public function approve($id)
    {
        $permintaan = Permintaan::with('details.bahan')->findOrFail($id);

        foreach ($permintaan->details as $detail) {
            $bahan = $detail->bahan;
            $bahan->jumlah -= $detail->jumlah_diminta;

            if ($bahan->jumlah <= 0) {
                $bahan->jumlah = 0;
                $bahan->status = 'habis';
            }
            $bahan->save();
        }

        $permintaan->status = 'disetujui';
        $permintaan->save();

        return redirect()->back()->with('success', 'Permintaan disetujui dan stok diperbarui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan' => 'required|string|max:255'
        ]);

        $permintaan = Permintaan::findOrFail($id);
        $permintaan->status = 'ditolak';
        $permintaan->alasan = $request->alasan;
        $permintaan->save();

        return redirect()->back()->with('success', 'Permintaan ditolak dengan alasan.');
    }

}
