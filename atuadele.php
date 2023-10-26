<?php
require_once('classes/crud.php');
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
        case 'read':
            $rows = $crud->read();
            break;
        case 'update':
            if (isset($_POST['id_carro'])) {
                $crud->update($_POST);
            }
            $rows = $crud->read();
            break;
        case 'delete':
            $crud->delete($_GET['id_carro']);
            $rows = $crud->read();
            break;

        default:
            $rows = $crud->read();
            break;
    }
} else {
    $rows = $crud->read();
}

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $rows = $crud->search($searchTerm);
} else {
    $rows = $crud->read();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url(img/carro.gif);
        }

        .table-container {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 15px;
            overflow: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            white-space: nowrap;
            color: #333;
            padding: 10px 15px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        .table th {
            background-color: #666;
            color: #fff;
        }

        .table td {
            background-color: #fff;
        }

        .table-container::-webkit-scrollbar {
            width: 8px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background-color: #666;
        }

        #entrar {
            background-color: #9400d3;
            color: white;
            border: none;
            margin-left: 10px;
        }

        .table {
            background-color: purple;
        }

        .custom-form {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
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

        .input-group-append:hover {
            background-color: #9400d3;
        }

        .input-group-append:focus {
            background-color: #9400d3;
        }
    </style>
</head>

<body class="container mt-5">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Logo">
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <form class="form-inline my-2 my-lg-0" method="post" action="">
                            <div class="input-group">
                                <input class="form-control" type="search" placeholder="Pesquisar" aria-label="Pesquisar" name="search">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit">Pesquisar</button>
                                </div>
                            </div>
                        </form>
                    </li>
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


    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id_carro'])) {
        $id_carro = $_GET['id_carro'];
        $result = $crud->readOne($id_carro);

        if (!$result) {
            echo "Registro não encontrado.";
            exit();
        }
        $marca = $result['marca'];
        $modelo = $result['modelo'];
        $ano_de_fabricacao = $result['ano_de_fabricacao'];
        $cor = $result['cor'];
        $tipo_de_combustivel = $result['tipo_de_combustivel'];
        $n_de_portas = $result['n_de_portas'];
        $quilometragem = $result['quilometragem'];
        $preco = $result['preco']

    ?>

        <div class="custom-form mb-5 p-4">
            <form action="?action=update" method="POST" class="mb-5 p-4 border rounded shadow-sm" onsubmit="return validateForm()">
                <input type="hidden" name="id_carro" value="<?php echo $id_carro ?>">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca:</label>
                            <input type="text" class="form-control" name="marca" value="<?php echo $marca ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="modelo" class="form-label">Modelo:</label>
                            <input type="text" class="form-control" name="modelo" value="<?php echo $modelo ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="ano_de_fabricacao" class="form-label">Ano de Fabricação:</label>
                            <input type="number" class="form-control" name="ano_de_fabricacao" value="<?php echo $ano_de_fabricacao ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="cor" class="form-label">Cor:</label>
                            <input type="text" class="form-control" name="cor" value="<?php echo $cor ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tipo_de_combustivel" class="form-label">Tipo de Combustível:</label>
                            <select class="form-control" name="tipo_de_combustivel" required>
                                <option value="Gasolina" <?php if ($tipo_de_combustivel == 'Gasolina') echo 'selected' ?>>Gasolina</option>
                                <option value="Diesel" <?php if ($tipo_de_combustivel == 'Diesel') echo 'selected' ?>>Diesel</option>
                                <option value="Etanol" <?php if ($tipo_de_combustivel == 'Etanol') echo 'selected' ?>>Etanol</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="n_de_portas" class="form-label">Número de Portas:</label>
                            <input type="number" class="form-control" name="n_de_portas" value="<?php echo $n_de_portas ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="quilometragem" class="form-label">Quilometragem:</label>
                            <input type="number" class="form-control" name="quilometragem" value="<?php echo $quilometragem ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço:</label>
                            <input type="number" class="form-control" name="preco" value="<?php echo $preco ?>" required>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
            <div id="alertDiv" class="alert alert-danger" style="display: none;"></div>
        </div>

    <?php
    }
    ?>

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Ano de Fabricação</th>
                    <th scope="col">Cor</th>
                    <th scope="col">Tipo de Combustivel</th>
                    <th scope="col">Número de Portas</th>
                    <th scope="col">Quilometragem</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php
                /* Mostra as informações de cada usuario na tabela acima os <a> são as açoes update e delete */
                if ($rows->rowCount() == 0) {
                    echo "<tr>";
                    echo "<td colspan='9'>Nenhum dado encontrado</td>";
                    echo "</tr>";
                } else {
                    while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['id_carro'] . "</td>";
                        echo "<td>" . $row['marca'] . "</td>";
                        echo "<td>" . $row['modelo'] . "</td>";
                        echo "<td>" . $row['ano_de_fabricacao'] . "</td>";
                        echo "<td>" . $row['cor'] . "</td>";
                        echo "<td>" . $row['tipo_de_combustivel'] . "</td>";
                        echo "<td>" . $row['n_de_portas'] . "</td>";
                        echo "<td>" . $row['quilometragem'] . "</td>";
                        echo "<td>" . $row['preco'] . "</td>";
                        echo "<td>";
                        echo "<div class='btn-group'>";
                        echo "<a href='?action=update&id_carro=" . $row['id_carro'] . "' class='btn btn-primary btn-sm' id='entrar'>Editar</a>";
                        echo "<a href='?action=delete&id_carro=" . $row['id_carro'] . "' onclick='return confirm(\"Tem certeza que quer apagar esse registro?\")' class='btn btn-danger btn-sm' id='entrar'>Excluir</a>";
                        echo "</div>";
                        echo "</td>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="js/atualizar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>