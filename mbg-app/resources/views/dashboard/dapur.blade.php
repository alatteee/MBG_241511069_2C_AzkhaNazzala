@extends('layouts.app')

@section('title', 'Dashboard Dapur')
@section('page-title', 'Dashboard Dapur')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6 rounded-2xl">
        <div class="max-w-6xl mx-auto">

            <h2 class="text-xl font-semibold mb-4">Halo, {{ auth()->user()->name }} 👋</h2>
            <p class="mb-6">Anda login sebagai <span class="font-semibold text-blue-600">Petugas Dapur</span>.</p>

            {{-- Ringkasan Permintaan --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500">Menunggu</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $permintaanMenunggu ?? 0 }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500">Disetujui</p>
                    <p class="text-2xl font-bold text-green-600">{{ $permintaanDisetujui ?? 0 }}</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500">Ditolak</p>
                    <p class="text-2xl font-bold text-red-600">{{ $permintaanDitolak ?? 0 }}</p>
                </div>
            </div>

            {{-- Tombol Buat Permintaan --}}
            <a href="{{ route('permintaan.create') }}"
                class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                + Buat Permintaan
            </a>
        </div>
    </div>
@endsection
