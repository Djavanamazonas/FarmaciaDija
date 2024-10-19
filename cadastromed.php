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
            background-color: #f4f6f7;
        }

        .btn-menu {
            background-color: #004d40;
            color: white;
        }

        .btn-menu:hover {
            background-color: #26a69a;
        }

        .offcanvas-header {
            background-color: #004d40;
            color: white;
        }

        .offcanvas-body {
            background-color: #e0f2f1;
        }

        .offcanvas a {
            color: #004d40;
            text-decoration: none;
            font-size: 1.1rem;
            padding: 10px 0;
        }

        .offcanvas a:hover {
            color: #26a69a;
        }

        .btn-login {
            background-color: #004d40;
            color: white;
        }

        .btn-login:hover {
            background-color: #26a69a;
        }

        .custom-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .custom-header {
            background-color: #004d40;
            color: white;
            text-align: center;
            padding: 20px;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .custom-form {
            padding: 20px;
        }

        .form-control, .form-select {
            border: 2px solid #26a69a;
            border-radius: 10px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #1e7e34;
            box-shadow: none;
        }

        .custom-btn {
            background-color: #004d40;
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            border: none;
        }

        .custom-btn:hover {
            background-color: #26a69a;
            color: white;
        }

        .btn-back {
            margin-top: 20px;
            color: #fff;
            background-color: #004d40;
            border-radius: 50px;
            border: none;
        }

        .btn-back:hover {
            background-color: #1e7e34;
        }
    </style>
</head>

<body>

    <button class="btn btn-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
        Menu
    </button>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasMenuLabel">Opções de Navegação</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
                <li><a href="tbremedios.php">Tabela de Remédios</a></li>
                <li><a href="vendas.php">Vendas</a></li>
                <li><a class="btn btn-login-light mt-4" href="index.php">Sair</a></li>
            </ul>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card custom-card shadow-lg p-4 mx-auto" style="max-width: 600px;">
            <div class="custom-header">
                <h2 class="text-center mb-4">Cadastro de Produtos</h2>
            </div>
            <div class="custom-form">
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
                        <input type="submit" value="Registrar" name="cadastrar" class="btn custom-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
