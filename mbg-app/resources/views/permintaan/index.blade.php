@extends('layouts.app')

@section('title', 'Daftar Permintaan')
@section('page-title', 'Permintaan Saya')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6 rounded-2xl">
        <h1 class="text-2xl font-bold mb-4">Daftar Permintaan Bahan</h1>
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow text-sm">
            <a href="{{ route('permintaan.create') }}" class="px-4 py-2 bg-[#176B87] text-white rounded mb-4 inline-block">
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
                            <td class="border px-4 py-2 text-center">
                                @if ($p->status == 'menunggu')
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                        Menunggu
                                    </span>
                                @elseif($p->status == 'disetujui')
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        Disetujui
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                        Ditolak
                                    </span>
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
            <div class="flex justify-end mt-4">
                <div class="flex items-center space-x-1">
                    {{-- Tombol Previous --}}
                    @if ($permintaan->onFirstPage())
                        <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">← Prev</span>
                    @else
                        <a href="{{ $permintaan->previousPageUrl() }}"
                            class="px-3 py-1 bg-[#176B87] text-white rounded hover:bg-[#86B6F6]">
                            ← Prev
                        </a>
                    @endif

                    {{-- Nomor Halaman --}}
                    @foreach ($permintaan->links()->elements[0] ?? [] as $page => $url)
                        @if ($page == $permintaan->currentPage())
                            <span class="px-3 py-1 bg-[#176B87] text-white rounded">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Tombol Next --}}
                    @if ($permintaan->hasMorePages())
                        <a href="{{ $permintaan->nextPageUrl() }}"
                            class="px-3 py-1 bg-[#176B87] text-white rounded hover:bg-[#86B6F6]">
                            Next →
                        </a>
                    @else
                        <span class="px-3 py-1 bg-gray-200 text-gray-500 rounded">Next →</span>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection
