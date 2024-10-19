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

        .btn-login-light {
            background-color: #004d40;
            color: white;
        }

        .btn-login-light:hover {
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

        .custom-alert {
            border-radius: 30px;
            padding: 15px 30px;
            font-size: 1.1rem;
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
                <li><a href="tbremedios.php">Tabela de Remédios</a></li>
                <li><a class="btn btn-login-white mt-4" href="index.php">Sair</a></li>
            </ul>
        </div>
    </div>

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

                <div class="text-center mt-3">
                    <a href="tbremedios.php" class="btn btn-back btn-lg">Voltar para Tabela de Remédios</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
