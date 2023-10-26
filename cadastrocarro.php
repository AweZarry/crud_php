<?php
require_once('classes/Crud.php');
require_once('database/conexao.php');
session_start();

if (!isset($_SESSION['nome']) || empty($_SESSION['nome'])) {
    header("Location: index.php");
    exit();
}

$database = new Conexao();
$db = $database->getConnection();
$crud = new Crud($db);

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            $crud->create($_POST);
            $rows = $crud->read();
            break;
        case 'read':
            $rows = $crud->read();
            break;
        default:
            $rows = $crud->read();
            break;
    }
} else {
    $rows = $crud->read();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url(img/carro.gif);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .center-div {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .custom-input {
            margin-bottom: 5px;
        }

        .custom-table {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            color: #333;
            padding: 10px 15px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        #azin {
            background-color: #9400d3;
            color: white;
            border: none;
            margin-top: 10px;
            margin-left: 10px;
        }

        #entrar {
            background-color: #9400d3;
            color: white;
            border: none;
            margin-bottom: 10px;
            margin-left: 10px;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select {
            background-color: transparent;
            border: none;
            border-bottom: 2px solid #9400d3;
            transition: border-bottom 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="number"]:focus,
        .form-group select:focus {
            border-bottom: 2px solid #ff69b4;
        }

        .navbar-brand img {
            background-color: gray;
            width: 90px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo">
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="cadastrocarro.php">Cadastrar Carro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="atuadele.php">Atualizar Carro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="custom-table">
            <form method="POST" action="?action=create" onsubmit="return validateForm()">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="marca">Marca:</label>
                            <input type="text" class="form-control custom-input" id="marca" name="marca" placeholder="Digite a marca">
                        </div>
                        <div class="form-group">
                            <label for="modelo">Modelo:</label>
                            <input type="text" class="form-control custom-input" id="modelo" name="modelo" placeholder="Digite o modelo">
                        </div>
                        <div class="form-group">
                            <label for="ano_de_fabricacao">Ano de Fabricação:</label>
                            <input type="number" class="form-control custom-input" id="ano_de_fabricacao" name="ano_de_fabricacao" placeholder="Digite o ano de fabricação (Aceitamos carros acima dos anos 2000)">
                        </div>
                        <div class="form-group">
                            <label for="cor">Cor:</label>
                            <input type="text" class="form-control custom-input" id="cor" name="cor" placeholder="Digite a cor">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_de_combustivel">Tipo de Combustível:</label>
                            <select class="form-control custom-input" id="tipo_de_combustivel" name="tipo_de_combustivel">
                                <option value="Gasolina">Gasolina</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Etanol">Etanol</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="n_de_portas">Número de Portas:</label>
                            <input type="number" class="form-control custom-input" id="n_de_portas" name="n_de_portas" placeholder="Digite o número de portas">
                        </div>
                        <div class="form-group">
                            <label for="quilometragem">Quilometragem:</label>
                            <input type="number" class="form-control custom-input" id="quilometragem" name="quilometragem" placeholder="Digite a quilometragem">
                        </div>
                        <div class="form-group">
                            <label for="preco">Preço:</label>
                            <input type="number" class="form-control custom-input" id="preco" name="preco" placeholder="Digite o preço">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <input type="submit" class="btn btn-primary custom-btn" value="Cadastrar" id="entrar">

                    <div class="d-flex">
                        <a href="index.php" class="btn btn-primary custom-btn" id="azin">Voltar</a>
                    </div>
                </div>
            </form>
            <div id="alertDiv"></div>
        </div>
    </div>

    <script src="js/validar.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>