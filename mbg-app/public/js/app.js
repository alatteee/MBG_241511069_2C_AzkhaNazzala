document.addEventListener("DOMContentLoaded", function () {
    // ===== Validasi Login =====
    const loginForm = document.getElementById("loginForm");

    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            let valid = true;

            const emailInput = loginForm.querySelector("input[name='email']");
            const passwordInput = loginForm.querySelector("input[name='password']");
            const emailError = document.getElementById("emailError");
            const passwordError = document.getElementById("passwordError");

            // reset error
            emailError?.classList.add("hidden");
            passwordError?.classList.add("hidden");

            // cek email
            if (!emailInput.value.trim()) {
                emailError.textContent = "Email tidak boleh kosong";
                emailError.classList.remove("hidden");
                valid = false;
            }

            // cek password
            if (!passwordInput.value.trim()) {
                passwordError.textContent = "Password tidak boleh kosong";
                passwordError.classList.remove("hidden");
                valid = false;
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    }

    // ===== Modal Logout =====
    const logoutForms = document.querySelectorAll("form[action*='logout']");
    logoutForms.forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            if (confirm("Yakin ingin logout?")) {
                form.submit();
            }
        });
    });

    // ==== Modal Edit ====
    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    const editId = document.getElementById('editId');
    const editNama = document.getElementById('editNama');
    const editKategori = document.getElementById('editKategori');
    const editJumlah = document.getElementById('editJumlah');
    const editSatuan = document.getElementById('editSatuan');
    const editMasuk = document.getElementById('editTanggalMasuk');
    const editKadaluarsa = document.getElementById('editTanggalKadaluarsa');

    window.openEditModal = function (data) {
        editId.value = data.id;
        editNama.value = data.nama;
        editKategori.value = data.kategori;
        editJumlah.value = data.jumlah;
        editSatuan.value = data.satuan;
        editMasuk.value = data.masuk;
        editKadaluarsa.value = data.kadaluarsa;

        editForm.action = `/bahan/${data.id}`;
        editModal.classList.remove('hidden');
        editModal.classList.add('flex');
    }

    window.closeEditModal = function () {
        editModal.classList.add('hidden');
        editModal.classList.remove('flex');
    }

    // binding tombol edit
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function () {
            const data = {
                id: this.dataset.id,
                nama: this.dataset.nama,
                kategori: this.dataset.kategori,
                jumlah: this.dataset.jumlah,
                satuan: this.dataset.satuan,
                masuk: this.dataset.masuk,
                kadaluarsa: this.dataset.kadaluarsa,
            };
            openEditModal(data);
        });
    });

    // validasi stok di modal edit
    if (editForm) {
        editForm.addEventListener("submit", function (e) {
            let valid = true;

            // reset semua error dulu
            document.querySelectorAll("#editForm span").forEach(span => span.classList.add("hidden"));

            if (!editNama.value.trim()) {
                document.getElementById("editNamaError").textContent = "Nama bahan tidak boleh kosong";
                document.getElementById("editNamaError").classList.remove("hidden");
                valid = false;
            }

            if (!editKategori.value.trim()) {
                document.getElementById("editKategoriError").textContent = "Kategori wajib diisi";
                document.getElementById("editKategoriError").classList.remove("hidden");
                valid = false;
            }

            if (editJumlah.value === "" || editJumlah.value < 0) {
                document.getElementById("editJumlahError").textContent = "Jumlah stok harus ≥ 0";
                document.getElementById("editJumlahError").classList.remove("hidden");
                valid = false;
            }

            if (!editSatuan.value.trim()) {
                document.getElementById("editSatuanError").textContent = "Satuan wajib diisi";
                document.getElementById("editSatuanError").classList.remove("hidden");
                valid = false;
            }

            if (!editTanggalMasuk.value) {
                document.getElementById("editMasukError").textContent = "Tanggal masuk wajib diisi";
                document.getElementById("editMasukError").classList.remove("hidden");
                valid = false;
            }

            if (!editTanggalKadaluarsa.value) {
                document.getElementById("editKadaluarsaError").textContent = "Tanggal kadaluarsa wajib diisi";
                document.getElementById("editKadaluarsaError").classList.remove("hidden");
                valid = false;
            }

            if (!valid) {
                e.preventDefault(); // stop submit kalau ada error
            }
        });

        // validasi realtime untuk jumlah stok
        editJumlah.addEventListener("input", function () {
            if (editJumlah.value < 0) {
                document.getElementById("editJumlahError").textContent = "Jumlah stok harus ≥ 0";
                document.getElementById("editJumlahError").classList.remove("hidden");
                editJumlah.classList.add("border-red-500");
            } else {
                document.getElementById("editJumlahError").classList.add("hidden");
                editJumlah.classList.remove("border-red-500");
            }
        });
    }

    // ==== Modal Delete ====
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm = document.getElementById('deleteForm');
    const deleteMessage = document.getElementById('deleteMessage');

    window.openDeleteModal = function (id, nama) {
        deleteMessage.textContent = `Apakah Anda yakin ingin menghapus bahan "${nama}"?`;
        deleteForm.action = `/bahan/${id}`;
        deleteModal.classList.remove('hidden');
        deleteModal.classList.add('flex');
    }

    window.closeDeleteModal = function () {
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex');
    }

    // binding tombol delete
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            openDeleteModal(id, nama);
        });
    });


    // ===== Modal Konfirmasi Permintaan =====
    const formPermintaan = document.querySelector("form[action*='permintaan']");
    const confirmModal = document.getElementById("confirmModal");

    if (formPermintaan && confirmModal) {
        formPermintaan.addEventListener("submit", function(e) {
            e.preventDefault();
            confirmModal.classList.remove("hidden");
            confirmModal.classList.add("flex");
        });
    }

    window.closeConfirm = function () {
        confirmModal.classList.add("hidden");
    }

    window.submitForm = function () {
        formPermintaan.submit();
    }

    window.openApproveModal = function(id) {
        const modal = document.getElementById('approveModal');
        const form = document.getElementById('approveForm');

        if (!modal) {
            console.error("Modal approve tidak ditemukan di DOM");
            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
        form.action = `/admin/permintaan/${id}/approve`;
    };

    window.closeApproveModal = function() {
        const modal = document.getElementById('approveModal');
        if (!modal) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

});

