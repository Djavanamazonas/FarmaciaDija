<?php
include 'conexao.php';

if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if (!$conn) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM adm WHERE usuario = ? AND senha = ?");
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("ss", $usuario, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header('Location: cadastromed.php');
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Usuário ou senha incorretos</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmácia - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #004d40, #26a69a);
            color: #f8f9fa;
        }

        .card-custom {
            border-radius: 15px;
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .card-header-custom {
            background-color: #004d40;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
        }

        .form-control-custom {
            border-radius: 20px;
            border: 2px solid #004d40;
            padding: 15px;
        }

        .form-control-custom:focus {
            border-color: #26a69a;
            box-shadow: none;
        }

        .btn-custom {
            border-radius: 30px;
            background-color: #004d40;
            color: #ffffff;
            font-weight: bold;
            padding: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #26a69a;
        }

        .form-label {
            color: #004d40;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card card-custom shadow-lg">
                    <div class="card-header card-header-custom">
                        <h4>Entrar no Sistema</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Nome de Usuário</label>
                                <input type="text" id="usuario" name="usuario" class="form-control form-control-custom" placeholder="Informe seu nome de usuário" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Chave de Acesso</label>
                                <input type="password" id="senha" name="senha" class="form-control form-control-custom" placeholder="Informe sua senha" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="login" class="btn btn-custom">Acessar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger text-center mt-3">
                        <?= $error ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
