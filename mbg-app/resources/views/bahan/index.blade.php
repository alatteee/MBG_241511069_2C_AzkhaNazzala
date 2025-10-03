@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6 rounded-2xl">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">Daftar Bahan Baku</h1>

            <a href="{{ route('bahan.create') }}" class="px-4 py-2 bg-[#176B87] text-white rounded">Tambah Bahan</a>

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
                        <th class="px-4 py-2">Action</th>
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
                            <td class="border px-4 py-2 text-center">
                                <button class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600"
                                    onclick="openEditModal({{ $item->id }}, '{{ $item->nama }}', {{ $item->jumlah }})">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Modal Edit Stok -->
            <div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
                <div class="bg-white rounded-lg p-6 w-96">
                    <h2 class="text-lg font-semibold mb-4">Update Stok Bahan</h2>

                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="editId">

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Nama Bahan</label>
                            <input type="text" id="editNama" class="w-full border rounded px-3 py-2 bg-gray-100"
                                readonly>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Jumlah Stok</label>
                            <input type="number" name="jumlah" id="editJumlah" min="0"
                                class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeEditModal()"
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <script src="{{ asset('js/app.js') }}"></script>
        </div>

    </div>
@endsection
