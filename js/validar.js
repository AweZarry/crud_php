function validateForm() {
    var anoFabricacao = document.getElementById("ano_de_fabricacao").value;
    var NumPortas = document.getElementById("n_de_portas").value;
    var anoAtual = new Date().getFullYear();
    var alertDiv = document.getElementById("alertDiv");

    if (anoFabricacao < 1885 || anoFabricacao > 2024) {
        alertDiv.innerHTML = '<div class="alert alert-danger" role="alert">Ano de fabricação deve estar entre 2000 e 2024.</div>';
        return false;
    }

    if (NumPortas < 2 || NumPortas > 5) {
        alertDiv.innerHTML = '<div class="alert alert-danger" role="alert">Quantidade de Portas invalidas (Deve ser entre 2 a 5 portas).</div>';
        return false;
    }

    if (anoFabricacao > anoAtual) {
        alertDiv.innerHTML = '<div class="alert alert-danger" role="alert">Ano de fabricação não pode ser no futuro.</div>';
        return false;
    }
    

    alertDiv.innerHTML = ''; // Limpa o alerta se não houver erros
    return true;
}

