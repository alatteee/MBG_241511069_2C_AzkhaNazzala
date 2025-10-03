@extends('layouts.app')

@section('title', 'Daftar Permintaan')
@section('page-title', 'Permintaan Saya')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6 rounded-2xl">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">Daftar Permintaan Bahan</h1>

            <a href="{{ route('permintaan.create') }}" class="px-4 py-2 bg-green-600 text-white rounded mb-4 inline-block">
                + Buat Permintaan Baru
            </a>

            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Tanggal Masak</th>
                        <th class="px-4 py-2">Menu</th>
                        <th class="px-4 py-2">Porsi</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permintaan as $p)
                        <tr>
                            <td class="border px-4 py-2">{{ $p->tgl_masak }}</td>
                            <td class="border px-4 py-2">{{ $p->menu_makan }}</td>
                            <td class="border px-4 py-2">{{ $p->jumlah_porsi }}</td>
                            <td class="border px-4 py-2">
                                @if ($p->status == 'menunggu')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded">Menunggu</span>
                                @elseif($p->status == 'disetujui')
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded">Disetujui</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded">Ditolak</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <ul class="list-disc ml-4 text-sm text-gray-700">
                                    @foreach ($p->details as $d)
                                        <li>{{ $d->bahan->nama }}: {{ $d->jumlah_diminta }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
