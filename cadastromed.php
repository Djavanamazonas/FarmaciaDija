<?php
include 'conexao.php';

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $validade = $_POST['validade'];

    $query = "INSERT INTO medicamentos (nome, preco, quantidade, categoria, validade) VALUES ('$nome', '$preco', '$quantidade', '$categoria', '$validade')";
    $conn->query($query);

    header('Location: tbremedios.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Medicamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #d1e8ff, #c6e3f3);
        }
    </style>
</head>

<body>
<header>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="tbremedios.php">Tabela de Remédios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vendas.php">Vendas</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-outline-dark btn-login" href="index.php">SAIR</a>
                </li>
            </ul>
        </div>
    </div>

    <nav class="navbar navbar-light fixed-top">
        <div class="container-fluid">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                Menu
            </button>
        </div>
    </nav>
</header>
    <br>
    <br>
    <br>
    <div class="container mt-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 600px; background-color: #e7f3fe;">
        <h2 class="text-center mb-4 text-primary">Registro de Produtos Farmacêuticos</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Insira o nome do produto" required>
            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Valor</label>
                <input type="number" id="preco" name="preco" class="form-control" placeholder="Insira o valor" required>
            </div>
            <div class="mb-3">
                <label for="quantidade" class="form-label">Estoque</label>
                <input type="number" id="quantidade" name="quantidade" class="form-control" placeholder="Informe a quantidade disponível" required>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Tipo de Produto</label>
                <select id="categoria" name="categoria" class="form-select" required>
                    <option value="" disabled selected>Escolha o tipo</option>
                    <option value="Analgésico">Analgésico</option>
                    <option value="Antibiótico">Antibiótico</option>
                    <option value="Anti-inflamatório">Anti-inflamatório</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="validade" class="form-label">Data de Expiração</label>
                <input type="date" id="validade" name="validade" class="form-control" required>
            </div>
            <div class="d-grid">
                <input type="submit" value="Registrar" name="registrar" class="btn btn-success">
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
