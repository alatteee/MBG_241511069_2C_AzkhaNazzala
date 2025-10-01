@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6 rounded-2xl">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">Daftar Bahan Baku</h1>

            <a href="{{ route('bahan.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Tambah Bahan</a>

            <table class="w-full mt-4 border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Kategori</th>
                        <th class="px-4 py-2">Jumlah</th>
                        <th class="px-4 py-2">Satuan</th>
                        <th class="px-4 py-2">Tanggal Masuk</th>
                        <th class="px-4 py-2">Tanggal Kadaluarsa</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bahan as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->nama }}</td>
                            <td class="border px-4 py-2">{{ $item->kategori }}</td>
                            <td class="border px-4 py-2">{{ $item->jumlah }}</td>
                            <td class="border px-4 py-2">{{ $item->satuan }}</td>
                            <td class="border px-4 py-2">{{ $item->tanggal_masuk }}</td>
                            <td class="border px-4 py-2">{{ $item->tanggal_kadaluarsa }}</td>
                            <td class="border px-4 py-2">
                                @if ($item->status == 'segera_kadaluarsa')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded">Segera Kadaluarsa</span>
                                @elseif($item->status == 'kadaluarsa')
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded">Kadaluarsa</span>
                                @elseif($item->status == 'habis')
                                    <span class="px-2 py-1 bg-gray-200 text-gray-700 rounded">Habis</span>
                                @else
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded">Tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
