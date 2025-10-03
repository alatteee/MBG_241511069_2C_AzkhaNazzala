<!-- Modal Hapus -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-[400px]">
        <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>
        <p id="deleteInfo" class="text-gray-700 mb-4"></p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
            </div>
        </form>
    </div>
</div>
