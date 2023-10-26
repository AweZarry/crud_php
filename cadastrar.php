<?php
session_start();

require_once('classes/Usuario.php');
require_once('database/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$cada = new registro($db);

if (isset($_POST['cadastrar'])) {
    $nome_usuario = $_POST['nome_usuario'];
    $email_usuario = $_POST['email_usuario'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];

    try {
        if ($cada->cadastrar($nome_usuario, $email_usuario, $senha, $confSenha)) {
            header("Location: index.php");
        } else {
            $_SESSION['error_message'] = "Erro ao cadastrar. Por favor, verifique suas informações.";
            header("Location: cadastro.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            background-image: url(img/carro.gif);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .card-header {
            background-color: #9400d3;
            color: black;
            font-size: 24px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #entrar,
        #azin {
            background-color: #9400d3;
            border: none;
            margin-top: 10px;
        }

        .logo-text {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .img-fluid {
            background-color: #9400d3;
            border-radius: 200px;
            margin-bottom: 30px;
        }

        .card-body {
            background-color: #f2f2f2;
        }

        .form-group label {
            color: #333;
            border-bottom: 1px solid #ccc;
        }

        .form-group input {
            margin-bottom: 10px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"],
        .form-group input[type="email"] {
            background-color: transparent;
            border: none;
            border-bottom: 2px solid #9400d3;
            transition: border-bottom 0.3s ease;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="password"]:focus,
        .form-group input[type="email"]:focus {
            border-bottom: 2px solid #ff69b4;
        }

        .card {
            background-color: black;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-danger mt-3">', $_SESSION['error_message'], '</div>';
            unset($_SESSION['error_message']); // Limpa a mensagem de erro da sessão
        }
        ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="img/logo.png" alt="Logo da Empresa" class="img-fluid">
                                <p class="logo-text">Seja bem-vindo ao nosso Sistema de Registro e Gerenciamento de Carros.</p>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header text-center">
                                        Cadastro
                                    </div>
                                    <div class="card-body">
                                        <form method="post" action="">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="nome_usuario">Nome</label>
                                                    <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" placeholder="Digite seu nome">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email_usuario">Email</label>
                                                    <input type="email" class="form-control" id="email_usuario" name="email_usuario" placeholder="Digite seu email">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="senha">Senha</label>
                                                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="confSenha">Confirmar Senha</label>
                                                    <input type="password" class="form-control" id="confSenha" name="confSenha" placeholder="Confirme sua senha">
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <input type="submit" name="cadastrar" value="Cadastrar" id="entrar" class="btn btn-primary btn-block mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <a href="login.php" class="btn btn-primary" id="azin">Já tenho conta</a>
                                                    <a href="index.php" class="btn btn-primary" id="azin">Voltar</a>
                                                </div>
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