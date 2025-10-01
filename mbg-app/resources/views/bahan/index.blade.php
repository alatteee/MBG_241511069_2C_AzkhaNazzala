@extends('layouts.app')

@section('content')
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
                        <td class="border px-4 py-2">{{ $item->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
