<?php
include 'conexao.php';

if (isset($_POST['vender'])) {
    $medicamentoId = $_POST['medicamento_id'];
    $quantidadeVendida = $_POST['quantidade_vendida'];

    $stmt = $conn->prepare("SELECT quantidade FROM medicamentos WHERE id = ?");
    $stmt->bind_param("i", $medicamentoId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $quantidadeAtual = $row['quantidade'];

        if ($quantidadeAtual >= $quantidadeVendida) {
            $novaQuantidade = $quantidadeAtual - $quantidadeVendida;
            $updateStmt = $conn->prepare("UPDATE medicamentos SET quantidade = ? WHERE id = ?");
            $updateStmt->bind_param("ii", $novaQuantidade, $medicamentoId);
            $updateStmt->execute();

            $mensagem = "Venda realizada com sucesso!";
            $alertClass = "alert-success";
        } else {
            $mensagem = "Quantidade em estoque insuficiente!";
            $alertClass = "alert-danger";
        }
    } else {
        $mensagem = "Medicamento não encontrado!";
        $alertClass = "alert-danger";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venda de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #e9f5f9;
        }

        .custom-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .custom-header {
            background: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .custom-form {
            padding: 20px;
        }

        .custom-btn {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
        }

        .custom-btn:hover {
            background-color: #0056b3;
        }

        .btn-back {
            margin-top: 20px;
            color: #fff;
            background-color: #f44336;
            border-radius: 50px;
        }

        .btn-back:hover {
            background-color: #c0392b;
        }

        .custom-alert {
            border-radius: 50px;
            padding: 10px 20px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="tbremedios.php">Tabela de Remédios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cadastromed.php">Cadastro</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-outline-danger" href="index.php">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-5 pt-5">
        <div class="custom-card mx-auto mt-5">
            <div class="custom-header">
                <h2>Venda de Produtos</h2>
            </div>
            <div class="custom-form">
                <?php if (isset($mensagem)): ?>
                    <div class="alert <?php echo $alertClass; ?> alert-dismissible custom-alert fade show" role="alert">
                        <?php echo htmlspecialchars($mensagem); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <div class="mb-4">
                        <label for="medicamento_id" class="form-label">Escolha o Produto:</label>
                        <select id="medicamento_id" name="medicamento_id" class="form-select" required>
                            <option value="">Selecione...</option>
                            <?php
                            $medicamentos = $conn->query("SELECT id, nome FROM medicamentos");
                            while ($medicamento = $medicamentos->fetch_assoc()) {
                                echo "<option value=\"{$medicamento['id']}\">{$medicamento['nome']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="quantidade_vendida" class="form-label">Quantidade a Vender:</label>
                        <input type="number" id="quantidade_vendida" name="quantidade_vendida" class="form-control" placeholder="Informe a quantidade" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="vender" class="btn custom-btn btn-lg">Confirmar Venda</button>
                    </div>
                </form>

                <div class="text-center">
                    <a href="tbremedios.php" class="btn btn-back btn-lg">Voltar para Tabela de Remédios</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
