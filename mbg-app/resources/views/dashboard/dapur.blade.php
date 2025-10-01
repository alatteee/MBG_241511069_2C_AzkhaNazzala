@extends('layouts.app')

@section('title', 'Dashboard Dapur')
@section('page-title', 'Dashboard Dapur')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6 rounded-2xl">
        <h2 class="text-xl font-semibold mb-4">Halo, {{ $user->name }} 👋</h2>

        <div class="bg-white rounded-xl p-6 shadow">
            <p class="text-gray-600">Anda login sebagai <b>Petugas Dapur</b>.</p>
            <a href="{{ route('permintaan.create') }}"
                class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Buat Permintaan Baru
            </a>
        </div>
    </div>
@endsection
