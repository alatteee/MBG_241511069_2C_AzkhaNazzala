document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");

    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            let valid = true;

            const emailInput = loginForm.querySelector("input[name='email']");
            const passwordInput = loginForm.querySelector("input[name='password']");
            const emailError = document.getElementById("emailError");
            const passwordError = document.getElementById("passwordError");

            // reset error
            emailError.classList.add("hidden");
            passwordError.classList.add("hidden");

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
                e.preventDefault(); // stop submit kalau ada error
            }
        });
    }

    // Modal logout
    const logoutForms = document.querySelectorAll("form[action*='logout']");
    logoutForms.forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            if (confirm("Yakin ingin logout?")) {
                form.submit();
            }
        });
    });
});
