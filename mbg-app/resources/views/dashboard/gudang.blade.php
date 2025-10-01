@extends('layouts.app')

@section('title', 'Dashboard Gudang')
@section('page-title', 'Dashboard Gudang')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6 rounded-2xl">
        <h2 class="text-xl font-semibold mb-4">Welcome back, {{ $user->name }} 👋</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl p-6 shadow">
                <p class="text-gray-500">Total Bahan Baku</p>
                <p class="text-2xl font-bold text-indigo-600">{{ $totalBahan ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-xl p-6 shadow">
                <p class="text-gray-500">Permintaan Pending</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $permintaanPending ?? 0 }}</p>
            </div>
        </div>
    </div>
@endsection
