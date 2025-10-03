@extends('layouts.app')

@section('title', 'Edit Stok Bahan')
@section('page-title', 'Edit Stok Bahan')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Update Stok: {{ $bahan->nama }}</h2>

    <form action="{{ route('bahan.update', $bahan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium">Jumlah Stok</label>
            <input type="number" name="jumlah" value="{{ $bahan->jumlah }}" min="0"
                   class="w-full border rounded px-3 py-2" required>
            @error('jumlah')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
