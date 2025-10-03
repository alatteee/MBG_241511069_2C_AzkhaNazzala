@extends('layouts.app')

@section('title', 'Kelola Permintaan')
@section('page-title', 'Daftar Permintaan Dapur')

@section('content')
    <div class="bg-gray-100 min-h-screen p-6 rounded-2xl">
        <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">Permintaan Bahan dari Dapur</h1>

            @if (session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">Tanggal Masak</th>
                        <th class="px-4 py-2">Menu</th>
                        <th class="px-4 py-2">Porsi</th>
                        <th class="px-4 py-2">Pemohon</th>
                        <th class="px-4 py-2">Detail</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permintaan as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->tgl_masak }}</td>
                            <td class="border px-4 py-2">{{ $item->menu_makan }}</td>
                            <td class="border px-4 py-2">{{ $item->jumlah_porsi }}</td>
                            <td class="border px-4 py-2">{{ $item->pemohon->name }}</td>
                            <td class="border px-4 py-2">
                                <ul class="list-disc ml-4">
                                    @foreach ($item->details as $detail)
                                        <li>{{ $detail->bahan->nama }}: {{ $detail->jumlah_diminta }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                @if ($item->status == 'menunggu')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded">Menunggu</span>
                                @elseif ($item->status == 'disetujui')
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded">Disetujui</span>
                                @elseif ($item->status == 'ditolak')
                                    <div class="flex flex-col items-center">
                                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded mb-1">Ditolak</span>
                                        <small class="text-xs text-gray-600">
                                            <strong>Alasan:</strong> {{ $item->alasan ?? '-' }}
                                        </small>
                                    </div>
                                @endif
                            </td>
                            <td class="border px-4 py-2 text-center">
                                @if ($item->status == 'menunggu')
                                    <form action="{{ route('admin.permintaan.approve', $item->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        <button type="button" onclick="openApproveModal({{ $item->id }})"
                                            class="px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                            Setujui
                                        </button>
                                    </form>

                                    <button onclick="openRejectModal({{ $item->id }})"
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Tolak</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Tolak --}}
    <div id="rejectModal" class="fixed inset-0 hidden items-center justify-center bg-black/50 z-50">
        <div class="bg-white p-6 rounded shadow w-96">
            <h2 class="text-lg font-semibold mb-4">Tolak Permintaan</h2>
            <form id="rejectForm" method="POST">
                @csrf
                <label class="block text-sm font-medium">Alasan Penolakan</label>
                <textarea name="alasan" class="w-full border rounded px-3 py-2 mb-4" required></textarea>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeRejectModal()"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Tolak</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Konfirmasi Setujui -->
    <div id="approveModal" tabindex="-1"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                    Konfirmasi Persetujuan
                </h3>
                <p class="text-gray-600 mb-6">
                    Apakah Anda yakin ingin <strong class="text-green-600">menyetujui</strong> permintaan ini?
                </p>
                <div class="flex justify-end space-x-3">
                    <form id="approveForm" method="POST">
                        @csrf
                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeApproveModal()"
                                class="px-5 py-2 bg-gray-200 text-gray-800 rounded">Batal</button>
                            <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded">Setujui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openRejectModal(id) {
            let modal = document.getElementById('rejectModal');
            let form = document.getElementById('rejectForm');
            form.action = `/admin/permintaan/${id}/reject`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
@endsection
