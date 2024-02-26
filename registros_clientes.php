<?php

include("database.php");

session_start();
if (empty($_SESSION)) {
    header("Location: logar.php");
    exit();
}

$conexao = new PDO ('mysql:host=localhost;dbname=locamedic_estoque', 'locamedic', 'locamedic');
date_default_timezone_set('America/Sao_Paulo');

if (isset($_POST['excluir']) && isset($_POST['id'])) { 
    $id = $_POST['id'];
    $nome_log = $_SESSION['nome'];
    $descricao = "Excluiu o ID $id na tabela Clientes";
    $data_hora = date('Y-m-d H:i:s');

    $sqlDelete = "DELETE FROM clientes WHERE id = ?";
    $stmtDelete = $conexao->prepare($sqlDelete);
    $stmtDelete->bindParam(1, $id);
    if ($stmtDelete->execute()) {
        $sqllog = "INSERT INTO log_clientes (tipo, usuario, descricao, data_hora) VALUES ('Exclusão', ?, ?, ?)";
        $stmtlog = $conexao->prepare($sqllog);
        $stmtlog->bindParam(1, $nome_log);
        $stmtlog->bindParam(2, $descricao);
        $stmtlog->bindParam(3, $data_hora);
        if ($stmtlog->execute()) {
            header("Location: registros_clientes.php");
            exit();
        }
    }
}

    if (isset($_POST['visualizar'])) {
    if (isset($_POST['visualizar_id'])) {
        $id = $_POST['visualizar_id'];
        $nome_log = $_SESSION['nome'];
        $descricao = "Visualizou o ID $id na tabela Clientes";
        $data_hora = date('Y-m-d H:i:s');

        $sqllog = "INSERT INTO log_clientes (tipo, usuario, descricao, data_hora) VALUES ('Exclusão', ?, ?, ?)";
        $stmtlog = $conexao->prepare($sqllog);
        $stmtlog->bindParam(1, $nome_log);
        $stmtlog->bindParam(2, $descricao);
        $stmtlog->bindParam(3, $data_hora);

        if ($stmtlog->execute()) {
            header("Location: ver_clientes.php?id=$id");
            exit();
        } else {
            echo "Erro ao registrar a visualização.";
        }
    }
}

if (isset($_POST['imprimir'])) {
    if (isset($_POST['imprimir_id'])) {
        $id = $_POST['imprimir_id'];
        $nome_log = $_SESSION['nome'];
        $descricao = "Imprimiu o ID $id na tabela Clientes";
        $data_hora = date('Y-m-d H:i:s');

        $sqllog = "INSERT INTO log_clientes (tipo, usuario, descricao, data_hora) VALUES ('Impressão', ?, ?, ?)";
        $stmtlog = $conexao->prepare($sqllog);
        $stmtlog->bindParam(1, $nome_log);
        $stmtlog->bindParam(2, $descricao);
        $stmtlog->bindParam(3, $data_hora);

        if ($stmtlog->execute()) {
            header("Location: imprimir_clientes.php?id=$id");
            exit();
        } else {
            echo "Erro ao registrar a visualização.";
        }
    }
}

    if (isset($_POST['visualizar'])) {
        if (isset($_POST['visualizar_id'])) {
            $id = $_POST['visualizar_id'];
            $nome_log = $_SESSION['nome'];
            $descricao = "Visualizou o ID $id na tabela Clientes";
            $data_hora = date('Y-m-d H:i:s');

            $sqllog = "INSERT INTO log_clientes (tipo, usuario, descricao, data_hora) VALUES ('Exclusão', ?, ?, ?)";
            $stmtlog = $conexao->prepare($sqllog);
            $stmtlog->bindParam(1, $nome_log);
            $stmtlog->bindParam(2, $descricao);
            $stmtlog->bindParam(3, $data_hora);

            if ($stmtlog->execute()) {
                header("Location: ver_clientes.php?id=$id");
                exit();
            } else {
                echo "Erro ao registrar a visualização.";
            }
        }
    }

    $pesquisa = isset($_GET['consultar']) ? ($_GET['consultar']) : '';
    $sql_code = "SELECT * 
        FROM clientes 
        WHERE nome LIKE '%$pesquisa%' 
        OR documento LIKE '%$pesquisa%'
        OR item LIKE '%$pesquisa%'
        OR data_cadastro LIKE '%$pesquisa%'
        ORDER BY id DESC";

    $sql_query = $conexao->query($sql_code);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Clientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/registros.css">
</head>
<body class="bg-light">
    <nav class="navbar">
        <div class="container">
            <h4 class="text-white">Clientes Registrados</h4>
            <div class="justify-content-end navbar-a">
                <a href="inicio.php" class="btn btn-sm btn-primary text-white a-voltar">Voltar</a>
            </div>
        </div>
        <div class="container py-2">
            <form class="justify-content-center col-12">
                <input class="form-control" name="consultar"
                value="<?php if (isset($_GET['consultar'])) echo $_GET['consultar']; ?>"
                placeholder="Consultar Informações" type="text">
                <div class="text-center py-2">
                    <a href="registros_clientes.php" class="btn btn-danger me-2" data-toggle="tooltip" data-placement="top" title="Limpar a Barra de Pesquisa">Limpar</a>
                    <button type="submit" class="btn bg-success text-white me-2" data-toggle="tooltip" data-placement="top" title="Consultar Informações no Banco de Dados">Consultar</button>
                    <a href="registrar_clientes.php" class="btn btn-primary text-white" data-toggle="tooltip" data-placement="top" title="Adicionar Um Cliente">Adicionar</a>
                </div>
            </form>
        </div>
    </nav>
    <?php if ($sql_query->rowCount() > 0): ?>
        <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">Ações</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF / CNPJ</th>
                            <th scope="col">Item</th>
                            <th scope="col">Dia do Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($user_data = $sql_query->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td>
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="visualizar_id" value="<?= $user_data['id'] ?>">
                                        <button type="submit" class='btn btn-primary' name="visualizar" data-toggle="tooltip" data-placement="top" title="Visualizar / Editar">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button type="submit" class='btn btn-danger' onclick="return confirm('Tem certeza que deseja excluir?');" name="excluir" data-toggle="tooltip" data-placement="top" title="Apagar">
                                            <i class="bi bi-trash3"></i>
                                            <input type="hidden" name="id" value="<?= $user_data['id'] ?>">
                                        </button>
                                        <button type="submit" class='btn btn-warning' name="imprimir" data-toggle="tooltip" data-placement="top" title="Imprimir">
                                            <i class="text-white bi bi-printer"></i>
                                            <input type="hidden" name="imprimir_id" value="<?= $user_data['id'] ?>"> 
                                        </button>
                                    </form>
                                </td>
                                <td><?= $user_data ["id"] ?></td>
                                <td><?= $user_data['nome'] ?></td>
                                <td><?= $user_data['documento'] ?></td>
                                <td><?= $user_data["item"] ?></td>
                                <td><?php echo date('d/m/Y', strtotime($user_data['data_cadastro'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
            <h5 class="text-center py-2">Nenhum Cliente Foi Encontrado...</h5>
            <?php endif; ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="scripts/registros_clientes.js"></script>
</html>
