document.getElementById("mostrarSenha").addEventListener("click", function () {
    var senha = document.getElementById("senha");
    var mostrarSenhaIcon = document.getElementById("mostrarSenha").querySelector("i");
    if (senha.type === "password") {
        senha.type = "text";
        mostrarSenhaIcon.classList.remove("bi-eye-fill");
        mostrarSenhaIcon.classList.add("bi-eye-slash-fill");
    } else {
        senha.type = "password";
        mostrarSenhaIcon.classList.remove("bi-eye-slash-fill");
        mostrarSenhaIcon.classList.add("bi-eye-fill");
    }
});