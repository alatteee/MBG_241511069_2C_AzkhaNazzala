@extends('layouts.app')

@section('title', 'Buat Permintaan Bahan')
@section('page-title', 'Buat Permintaan Baru')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6 rounded-2xl">
        <h1 class="text-2xl font-bold mb-4">Form Permintaan Bahan</h1>
        <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow text-sm">

            {{-- pesan sukses/error --}}
            @if (session('success'))
                <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- tampilkan error validasi --}}
            @if ($errors->any())
                <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-700">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="permintaanForm" action="{{ route('permintaan.store') }}" method="POST">
                @csrf

                {{-- input utama --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium">Tanggal Masak</label>
                        <input type="date" name="tgl_masak"
                            class="w-full border rounded px-3 py-2 @error('tgl_masak') border-red-500 @enderror"
                            value="{{ old('tgl_masak') }}" required>
                        @error('tgl_masak')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium">Menu Masakan</label>
                        <input type="text" name="menu_makan"
                            class="w-full border rounded px-3 py-2 @error('menu_makan') border-red-500 @enderror"
                            value="{{ old('menu_makan') }}" required>
                        @error('menu_makan')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Jumlah Porsi</label>
                        <input type="number" name="jumlah_porsi" min="1"
                            class="w-full border rounded px-3 py-2 @error('jumlah_porsi') border-red-500 @enderror"
                            value="{{ old('jumlah_porsi') }}" required>
                        @error('jumlah_porsi')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- daftar bahan baku --}}
                <h2 class="text-lg font-semibold mb-2">Daftar Bahan Baku</h2>
                <table class="w-full border mb-4" id="bahanTable">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">Nama Bahan</th>
                            <th class="px-4 py-2">Jumlah</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border px-4 py-2">
                                <select name="bahan_id[]" class="w-full border rounded px-2 py-1" required>
                                    <option value="">-- Pilih Bahan --</option>
                                    @foreach ($bahan as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->nama }} (stok: {{ $item->jumlah }} {{ $item->satuan }})
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="border px-4 py-2">
                                <input type="number" name="jumlah_diminta[]" min="1"
                                    class="w-full border rounded px-2 py-1" required>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <button type="button" onclick="removeRow(this)"
                                    class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" onclick="addRow()" class="px-4 py-2 bg-[#176B87] text-white rounded mb-4">+ Tambah
                    Bahan</button>

                <div class="flex justify-end">
                    <button type="button" onclick="openConfirmModal()"
                        class="px-6 py-2 bg-[#176B87] text-white rounded hover:bg-[#86B6F6]">Simpan Permintaan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Konfirmasi --}}
    <div id="confirmModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-lg font-bold mb-4">Konfirmasi Permintaan</h2>
            <p class="mb-6">Apakah Anda yakin ingin menyimpan permintaan bahan ini?</p>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeConfirmModal()" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="button" onclick="submitPermintaan()" class="px-4 py-2 bg-green-600 text-white rounded">Ya,
                    Simpan</button>
            </div>
        </div>
    </div>

    <script>
        // tambah row baru
        function addRow() {
            let table = document.getElementById("bahanTable").getElementsByTagName("tbody")[0];
            let newRow = table.rows[0].cloneNode(true);

            newRow.querySelectorAll("input, select").forEach(el => el.value = "");
            table.appendChild(newRow);
        }

        // hapus row
        function removeRow(button) {
            let row = button.closest("tr");
            let table = document.getElementById("bahanTable").getElementsByTagName("tbody")[0];
            if (table.rows.length > 1) row.remove();
        }

        // modal konfirmasi
        const modal = document.getElementById("confirmModal");
        const form = document.getElementById("permintaanForm");

        function openConfirmModal() {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        }

        function closeConfirmModal() {
            modal.classList.add("hidden");
        }

        function submitPermintaan() {
            form.submit();
        }
    </script>
@endsection
