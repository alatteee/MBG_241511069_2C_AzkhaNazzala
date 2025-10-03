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

    // ===== Edit Modal Bahan =====
    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    const editId = document.getElementById('editId');
    const editNama = document.getElementById('editNama');
    const editKategori = document.getElementById('editKategori');
    const editJumlah = document.getElementById('editJumlah');
    const editSatuan = document.getElementById('editSatuan');
    const editMasuk = document.getElementById('editTanggalMasuk');
    const editKadaluarsa = document.getElementById('editTanggalKadaluarsa');
    const editJumlahError = document.getElementById('editJumlahError');

    // buka modal edit
    window.openEditModal = function(data) {
        editModal.classList.remove('hidden');
        editModal.classList.add('flex');

        editId.value = data.id;
        editNama.value = data.nama;
        editKategori.value = data.kategori;
        editJumlah.value = data.jumlah;
        editSatuan.value = data.satuan;
        editMasuk.value = data.tanggal_masuk;
        editKadaluarsa.value = data.tanggal_kadaluarsa;

        editForm.action = `/bahan/${data.id}`;
    }

    // tutup modal edit
    window.closeEditModal = function() {
        editModal.classList.add('hidden');
    }

    // validasi stok di modal edit
    if (editForm) {
        editForm.addEventListener("submit", function(e) {
            editJumlahError?.classList.add('hidden');
            editJumlah.classList.remove('border-red-500');

            if (editJumlah.value < 0) {
                e.preventDefault();
                editJumlahError.textContent = "Jumlah stok tidak boleh negatif!";
                editJumlahError.classList.remove("hidden");
                editJumlah.classList.add("border-red-500");
            }
        });

        editJumlah.addEventListener("input", function() {
            if (editJumlah.value < 0) {
                editJumlahError.textContent = "Jumlah stok tidak boleh negatif!";
                editJumlahError.classList.remove("hidden");
                editJumlah.classList.add("border-red-500");
            } else {
                editJumlahError.classList.add("hidden");
                editJumlah.classList.remove("border-red-500");
            }
        });
    }

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
});
