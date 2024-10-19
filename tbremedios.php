<?php
include 'conexao.php';

$searchTerm = '';
$orderBy = 'nome';

if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
}

if (isset($_POST['orderBy'])) {
    $orderBy = $_POST['orderBy'];
}

$query = "SELECT * FROM medicamentos WHERE nome LIKE ? ORDER BY $orderBy";
$stmt = $conn->prepare($query);
$searchTermParam = '%' . $searchTerm . '%';
$stmt->bind_param("s", $searchTermParam);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f4f8;
        }

        .custom-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .custom-header {
            background-color: #5d99c6;
            color: #fff;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .custom-input {
            border-radius: 20px;
            border: 1px solid #5d99c6;
        }

        .custom-button {
            border-radius: 20px;
            background-color: #5d99c6;
            color: white;
        }

        .custom-select {
            border-radius: 20px;
        }

        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }

        .table-header {
            background-color: #ffc107;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="cadastromed.php">Registrar Produto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vendas.php">Operações de Venda</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-outline-danger btn-logout" href="index.php">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <div class="custom-card">
            <div class="custom-header text-center">
                <h3>Pesquisa de Medicamentos</h3>
            </div>
            <div class="card-body p-4">
                <form method="post" class="mb-4">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control custom-input" name="searchTerm" placeholder="Pesquisar por nome do produto"
                               value="<?php echo htmlspecialchars($searchTerm); ?>">
                        <button class="btn custom-button" type="submit" name="search">Buscar</button>
                    </div>

                    <div class="mb-3">
                        <label for="orderBy" class="form-label">Ordenar por:</label>
                        <select id="orderBy" name="orderBy" class="form-select custom-sele
