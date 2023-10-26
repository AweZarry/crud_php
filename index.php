<?php
session_start();

require_once('classes/Usuario.php');
require_once('database/conexao.php');

$database = new Conexao();
$db = $database->getConnection();
$prova = new registro($db);

$geral = [];

$queryd = "SELECT * FROM carros ORDER BY id_carro DESC LIMIT 6";

$resultd = $db->query($queryd);


if ($resultd->rowCount() > 0) {
    while ($row = $resultd->fetch(PDO::FETCH_ASSOC)) {
        $geral[] = $row;
    }
}


$id_carro = isset($_GET['id_carro']) ? $_GET['id_carro'] : "";


$searchTerm = isset($_GET['search']) ? $_GET['search'] : "";

$queryd = "SELECT * FROM carros";
if (!empty($searchTerm)) {
    $searchTerm = '%' . $searchTerm . '%';
    $queryd .= " WHERE marca LIKE :searchTerm OR modelo LIKE :searchTerm";
}
$queryd .= " ORDER BY id_carro DESC LIMIT 6";

$stmt = $db->prepare($queryd);

if (!empty($searchTerm)) {
    $stmt->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
}

$stmt->execute();

$geral = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $geral[] = $row;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url(img/carro.gif);
        }

        .card {
            transition: 0.3s;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            color: #6c757d;
        }

        .navbar-brand img {
            background-color: gray;
            width: 90px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        #azin {
            background-color: #9400d3;
            border: none;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" width="90" height="90" class="d-inline-block align-top" alt="Logo">
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['nome'])) : ?>
                        <li class="nav-item">
                            <form class="form-inline my-2 my-lg-0" method="get" action="index.php">
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
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Logar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cadastrar.php">Cadastrar</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Carros Registrados</h2>

        <div class="row">
            <?php foreach ($geral as $row) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['marca'] . ' ' . $row['modelo']; ?></h5>
                            <p class="card-text">Ano: <?php echo $row['ano_de_fabricacao']; ?></p>
                            <p class="card-text">Preço: <?php echo $row['preco']; ?></p>
                            <?php if (isset($_SESSION['nome'])) : ?>
                                <a href="atuadele.php?id_carro=<?php echo $row['id_carro']; ?>" class="btn btn-primary btn-sm" id="azin">Checar Registros</a>
                            <?php else : ?>
                                <a href="login.php" class="btn btn-primary btn-sm" id="azin">Checar Registros</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>


</html>