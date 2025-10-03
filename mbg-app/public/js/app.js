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

            emailError?.classList.add("hidden");
            passwordError?.classList.add("hidden");

            if (!emailInput.value.trim()) {
                emailError.textContent = "Email tidak boleh kosong";
                emailError.classList.remove("hidden");
                valid = false;
            }
            if (!passwordInput.value.trim()) {
                passwordError.textContent = "Password tidak boleh kosong";
                passwordError.classList.remove("hidden");
                valid = false;
            }
            if (!valid) e.preventDefault();
        });
    }

    // ===== Modal Logout =====
    const logoutForms = document.querySelectorAll("form[action*='logout']");
    logoutForms.forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            if (confirm("Yakin ingin logout?")) form.submit();
        });
    });

    // ===== Edit Modal Bahan =====
    const modal          = document.getElementById('editModal');
    const form           = document.getElementById('editForm');
    const editId         = document.getElementById('editId');
    const editNama       = document.getElementById('editNama');
    const editKategori   = document.getElementById('editKategori');
    const editJumlah     = document.getElementById('editJumlah');
    const editSatuan     = document.getElementById('editSatuan');
    const editMasuk      = document.getElementById('editMasuk');
    const editKadaluarsa = document.getElementById('editKadaluarsa');
    const editJumlahError= document.getElementById('editJumlahError');

    const toYMD = (v) => (v ?? '').toString().slice(0, 10);

    // attach listener ke semua tombol Edit
    document.querySelectorAll(".btn-edit").forEach(btn => {
        btn.addEventListener("click", () => {
            modal.classList.remove("hidden");
            modal.classList.add("flex");

            editId.value         = btn.dataset.id;
            editNama.value       = btn.dataset.nama;
            editKategori.value   = btn.dataset.kategori;
            editJumlah.value     = btn.dataset.jumlah;
            editSatuan.value     = btn.dataset.satuan;
            editMasuk.value      = toYMD(btn.dataset.masuk);
            editKadaluarsa.value = toYMD(btn.dataset.kadaluarsa);

            editJumlahError?.classList.add("hidden");
            editJumlah?.classList.remove("border-red-500");

            form.action = `/bahan/${btn.dataset.id}`;
        });
    });

    window.closeEditModal = function () {
        modal.classList.add("hidden");
    };

    // validasi stok negatif
    if (form) {
        form.addEventListener("submit", function (e) {
            editJumlahError.classList.add("hidden");
            editJumlah.classList.remove("border-red-500");

            if (+editJumlah.value < 0) {
                e.preventDefault();
                editJumlahError.textContent = "Jumlah stok tidak boleh negatif!";
                editJumlahError.classList.remove("hidden");
                editJumlah.classList.add("border-red-500");
            }
        });

        editJumlah?.addEventListener("input", function () {
            if (+editJumlah.value < 0) {
                editJumlahError.textContent = "Jumlah stok tidak boleh negatif!";
                editJumlahError.classList.remove("hidden");
                editJumlah.classList.add("border-red-500");
            } else {
                editJumlahError.classList.add("hidden");
                editJumlah.classList.remove("border-red-500");
            }
        });
    }
});
