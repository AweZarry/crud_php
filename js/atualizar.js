function showAlert(message) {
    var alertDiv = document.getElementById("alertDiv");
    alertDiv.textContent = message;
    alertDiv.style.display = "block";
}

function validateForm() {
    var numeroDePortas = parseInt(document.getElementsByName("n_de_portas")[0].value);
    var anoDeFabricacao = parseInt(document.getElementsByName("ano_de_fabricacao")[0].value);

    if (numeroDePortas < 2 || numeroDePortas > 5) {
        showAlert("O número de portas deve estar entre 2 e 5.");
        return false;
    }

    if (anoDeFabricacao < 1885 || anoDeFabricacao > 2024) {
        showAlert("O ano de fabricação deve estar entre 1885 e 2024.");
        return false;
    }

    // Se os valores estiverem dentro dos limites, esconde o alertDiv (caso já esteja visível)
    var alertDiv = document.getElementById("alertDiv");
    alertDiv.style.display = "none";

    return true;
}
