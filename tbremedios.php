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
    <title>Tabela de Medicamentos</title>
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

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            background-color: #004d40;
            color: white;
            padding: 40px;
            border-radius: 15px;
        }

        .card-body h2 {
            margin-bottom: 30px;
            font-weight: bold;
        }

        .input-group .form-control {
            border-radius: 20px;
            padding: 10px;
            border: 2px solid #26a69a;
        }

        .btn-warning {
            background-color: #004d40;
            color: white;
            border: none;
            border-radius: 20px;
        }

        .btn-warning:hover {
            background-color: #26a69a;
        }

        .form-select {
            border-radius: 20px;
            border: 2px solid #26a69a;
            padding: 10px;
        }

        .table {
            background-color: white;
            border-radius: 15px;
            margin-top: 20px;
        }

        .table thead {
            background-color: #26a69a;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #e0f2f1;
        }

        .table th, .table td {
            padding: 15px;
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
                <li><a href="cadastromed.php">Registrar Produto</a></li>
                <li><a href="vendas.php">Realizar Venda</a></li>
                <li><a class="btn btn-login-white mt-4" href="index.php">Sair</a></li>
            </ul>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Consulta de Medicamentos</h2>
                <form method="post" class="mb-4">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="searchTerm" placeholder="Pesquisar pelo nome do medicamento" value="<?php echo htmlspecialchars($searchTerm); ?>">
                        <button class="btn btn-warning" type="submit" name="search">Procurar</button>
                    </div>

                    <div class="mb-3">
                        <label for="orderBy" class="form-label">Ordenar por:</label>
                        <select id="orderBy" name="orderBy" class="form-select" onchange="this.form.submit()">
                            <option value="nome" <?php echo ($orderBy === 'nome') ? 'selected' : ''; ?>>Nome</option>
                            <option value="preco" <?php echo ($orderBy === 'preco') ? 'selected' : ''; ?>>Preço</option>
                            <option value="quantidade" <?php echo ($orderBy === 'quantidade') ? 'selected' : ''; ?>>Estoque</option>
                            <option value="categoria" <?php echo ($orderBy === 'categoria') ? 'selected' : ''; ?>>Classe</option>
                        </select>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                                <th>Classe</th>
                                <th>Validade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                                        <td><?php echo 'R$ ' . number_format($row['preco'], 2, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($row['quantidade']); ?></td>
                                        <td><?php echo htmlspecialchars($row['categoria']); ?></td>
                                        <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($row['validade']))); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Nenhum medicamento encontrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
