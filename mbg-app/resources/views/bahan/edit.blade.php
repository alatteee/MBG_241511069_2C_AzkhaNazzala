<!-- Modal Edit Bahan -->
<div id="editModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-[500px]">
        <h2 class="text-lg font-semibold mb-4">Edit Bahan Baku</h2>

        <form id="editForm" method="POST" novalidate>
            @csrf
            @method('PUT')

            <input type="hidden" name="id" id="editId">

            <div class="mb-4">
                <label class="block text-sm font-medium">Nama Bahan</label>
                <input type="text" name="nama" id="editNama" class="w-full border rounded px-3 py-2">
                <span id="editNamaError" class="text-red-500 text-sm mt-1 hidden"></span>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Kategori</label>
                <input type="text" name="kategori" id="editKategori" class="w-full border rounded px-3 py-2">
                <span id="editKategoriError" class="text-red-500 text-sm mt-1 hidden"></span>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Jumlah Stok</label>
                <input type="number" name="jumlah" id="editJumlah" class="w-full border rounded px-3 py-2">
                <span id="editJumlahError" class="text-red-500 text-sm mt-1 hidden"></span>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Satuan</label>
                <input type="text" name="satuan" id="editSatuan" class="w-full border rounded px-3 py-2">
                <span id="editSatuanError" class="text-red-500 text-sm mt-1 hidden"></span>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" id="editTanggalMasuk"
                    class="w-full border rounded px-3 py-2">
                <span id="editMasukError" class="text-red-500 text-sm mt-1 hidden"></span>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Tanggal Kadaluarsa</label>
                <input type="date" name="tanggal_kadaluarsa" id="editTanggalKadaluarsa"
                    class="w-full border rounded px-3 py-2">
                <span id="editKadaluarsaError" class="text-red-500 text-sm mt-1 hidden"></span>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
