<?php
session_start();

require_once('classes/Usuario.php');
require_once('database/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$projeto = new registro($db);

if (isset($_POST['logar'])) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    if ($projeto->logar($login, $senha)) {
        if ($projeto->logar($login, $senha)) {
            $_SESSION['nome'] = $login;
            $_SESSION['email'] = $login;
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['nome'] = $login;
            $_SESSION['email'] = $login;
            header("Location: index.php");
            exit();
        }
    } else {

        echo '<script>alert("Preencha todos os campos!");</script>';
        header("Location: login.php");
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url(img/carro.gif);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .card-header {
            background-color: #9400d3;
            color: black;
            font-size: 24px;
        }

        #entrar,
        #azin {
            background-color: #9400d3;
            border: none;
            margin-bottom: 10px;
        }

        .logo-text {
            font-size: 24px;
            text-align: center;
            color: #333;
        }

        .img-fluid {
            background-color: #9400d3;
            border-radius: 200px;
            margin-bottom: 40px;
        }

        .card-body {
            background-color: #f2f2f2;
        }

        .custom-label {
            color: #333;
            padding: 10px 15px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        .card {
            background-color: black;
            margin-top: 10px;
        }

        .custom-label {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .form-group-inline {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-group-inline .custom-label {
            margin-right: 10px;
            width: 170px;
            /* Ajuste a largura conforme necessário */
        }

        .form-group-inline .form-control {
            flex: 1;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            background-color: transparent;
            border: none;
            border-bottom: 2px solid #9400d3;
            transition: border-bottom 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="password"]:focus {
            border-bottom: 2px solid #ff69b4;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="img/logo.png" alt="Logo da Empresa" class="img-fluid">
                                <p class="logo-text">Seja bem-vindo novamente ao nosso Sistema de Registro e Gerenciamento de Carros.</p>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">Login</div>
                                    <div class="card-body">
                                        <form method="post" action="">
                                            <div class="form-group form-group-inline">
                                                <label for="login" class="custom-label">Email ou Usuário</label>
                                                <input type="text" class="form-control custom-input" id="login" name="login" placeholder="Digite seu email/usuário">
                                            </div>
                                            <div class="form-group form-group-inline">
                                                <label for="senha" class="custom-label">Senha</label>
                                                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha">
                                            </div>
                                            <div class="d-flex flex-column">
                                                <input type="submit" value="Logar" name="logar" id="entrar" class="btn btn-primary btn-block">
                                                <a href="cadastrar.php" class="btn btn-primary btn-block mt-2" id="azin">Não tenho conta</a>
                                                <a href="index.php" class="btn btn-primary btn-block mt-2" id="azin">Voltar</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>