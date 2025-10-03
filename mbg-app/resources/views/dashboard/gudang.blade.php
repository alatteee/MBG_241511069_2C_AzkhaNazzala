@extends('layouts.app')

@section('title', 'Dashboard Gudang')
@section('page-title', 'Dashboard Gudang')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6 rounded-2xl">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-6">Dashboard Gudang</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                {{-- Total Bahan --}}
                <div class="p-4 bg-white rounded-lg shadow text-center">
                    <p class="text-gray-600">Total Bahan Baku</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalBahan }}</p>
                </div>

                {{-- Permintaan Pending --}}
                <div class="p-4 bg-white rounded-lg shadow text-center">
                    <p class="text-gray-600">Permintaan Pending</p>
                    <p class="text-3xl font-bold text-amber-600">{{ $permintaanPending }}</p>
                </div>

                {{-- Bahan Kadaluarsa --}}
                <div class="p-4 bg-white rounded-lg shadow text-center">
                    <p class="text-gray-600">Bahan Kadaluarsa</p>
                    <p class="text-3xl font-bold text-red-600">{{ $bahanKadaluarsa }}</p>
                </div>

                {{-- Bahan Hampir Kadaluarsa --}}
                <div class="p-4 bg-white rounded-lg shadow text-center">
                    <p class="text-gray-600">Hampir Kadaluarsa</p>
                    <p class="text-3xl font-bold text-yellow-500">{{ $bahanHampirKadaluarsa }}</p>
                </div>

                {{-- Bahan Habis --}}
                <div class="p-4 bg-white rounded-lg shadow text-center">
                    <p class="text-gray-600">Bahan Habis</p>
                    <p class="text-3xl font-bold text-gray-500">{{ $bahanHabis }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
