<!-- Modal Delete -->
<div id="deleteModal" class="fixed inset-0 hidden items-center justify-center bg-black/50 z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-bold mb-4 text-red-600">Konfirmasi Hapus</h2>
        <p id="deleteMessage" class="text-gray-700 mb-6">
            Apakah Anda yakin ingin menghapus bahan ini?
        </p>
        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeDeleteModal()"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
            </form>
        </div>
    </div>
</div>
