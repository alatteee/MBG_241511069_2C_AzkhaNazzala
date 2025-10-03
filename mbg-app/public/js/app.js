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

    // ===== Edit Modal Stok Bahan =====
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    const editId = document.getElementById('editId');
    const editNama = document.getElementById('editNama');
    const editJumlah = document.getElementById('editJumlah');

    // buka modal
    window.openEditModal = function(id, nama, jumlah) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        editId.value = id;
        editNama.value = nama;
        editJumlah.value = jumlah;

        form.action = `/bahan/${id}`;
    }

    // tutup modal
    window.closeEditModal = function() {
        modal.classList.add('hidden');
    }
});
