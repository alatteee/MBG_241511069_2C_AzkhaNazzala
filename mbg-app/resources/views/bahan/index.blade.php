@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6 rounded-2xl">
        <h1 class="text-2xl font-bold mb-4">Daftar Bahan Baku</h1>
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow text-sm">
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
                            <td class="border px-4 py-2 text-xs">
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
                            <td class="border px-4 py-2 text-center space-x- text-xs">
                                {{-- Tombol Edit dan Delete --}}
                                <button type="button"
                                    class="btn-edit px-3 py-1 bg-[#176B87] text-white rounded hover:bg-yellow-600"
                                    data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                    data-kategori="{{ $item->kategori }}" data-jumlah="{{ $item->jumlah }}"
                                    data-satuan="{{ $item->satuan }}" data-masuk="{{ $item->tanggal_masuk }}"
                                    data-kadaluarsa="{{ $item->tanggal_kadaluarsa }}">
                                    <i class="fas fa-edit"></i>
                                </button>


                                <button type="button"
                                    class="btn-delete px-3 py-1 bg-[#176B87] text-white rounded hover:bg-red-700"
                                    data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                    data-status="{{ $item->status }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Pagination --}}
            <div class="flex justify-end mt-6 space-x-2">
                {{-- Tombol Previous --}}
                @if ($bahan->onFirstPage())
                    <span class="px-3 py-1 rounded bg-gray-200 text-gray-500">← Prev</span>
                @else
                    <a href="{{ $bahan->previousPageUrl() }}"
                        class="px-3 py-1 rounded bg-[#176B87] text-white hover:bg-blue-600">← Prev</a>
                @endif

                {{-- Nomor Halaman --}}
                @foreach ($bahan->getUrlRange(1, $bahan->lastPage()) as $page => $url)
                    @if ($page == $bahan->currentPage())
                        <span class="px-3 py-1 rounded bg-[#176B87] text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="px-3 py-1 rounded bg-gray-200 text-gray-700 hover:bg-[#176B87] hover:text-white">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if ($bahan->hasMorePages())
                    <a href="{{ $bahan->nextPageUrl() }}"
                        class="px-3 py-1 rounded bg-[#176B87] text-white hover:bg-blue-600">Next →</a>
                @else
                    <span class="px-3 py-1 rounded bg-gray-200 text-gray-500">Next →</span>
                @endif
            </div>
            {{-- Panggil modal dari file edit.blade --}}
            @include('bahan.delete')
            @include('bahan.edit')
            <script src="{{ asset('js/app.js') }}"></script>
        </div>

    </div>
@endsection
