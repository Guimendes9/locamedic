<?php

    include("database.php");

    session_start();
    if (empty($_SESSION)) {
        header("Location: logar.php");
    }

    $conexao = new PDO('mysql:host=localhost;dbname=locamedic_estoque', 'locamedic', 'locamedic');

    date_default_timezone_set('America/Sao_Paulo');

    if (isset($_POST['excluir']) && isset($_POST['id'])) { 
        $id = $_POST['id'];
        $nome_log = $_SESSION['nome'];
        $descricao = "Excluiu o ID $id na tabela Compras";
        $area = 'Compras Pendentes';
        $data_hora = date('Y-m-d H:i:s');

        $sqlDelete = "DELETE FROM compras WHERE id = ?";
        $stmtDelete = $conexao->prepare($sqlDelete);
        $stmtDelete->bindParam(1, $id);
        if ($stmtDelete->execute()) {
            $sqllog = "INSERT INTO log_compras (tipo, usuario, descricao, area, data_hora) VALUES ('Exclusão', ?, ?, ?, ?)";
            $stmtlog = $conexao->prepare($sqllog);
            $stmtlog->bindParam(1, $nome_log);
            $stmtlog->bindParam(2, $descricao);
            $stmtlog->bindParam(3, $area);
            $stmtlog->bindParam(4, $data_hora);
            if ($stmtlog->execute()) {
                header("Location: registros_compras.php");
                exit();
            }
        }
    }

    if (isset($_POST['visualizar'])) {
    if (isset($_POST['visualizar_id'])) {
        $id = $_POST['visualizar_id'];
        $nome_log = $_SESSION['nome'];
        $descricao = "Visualizou o ID $id na tabela Compras";
        $area = 'Compras Pendentes';
        $data_hora = date('Y-m-d H:i:s');

        $sqllog = "INSERT INTO log_compras (tipo, usuario, descricao, area, data_hora) VALUES ('Visualização', ?, ?, ?, ?)";
        $stmtlog = $conexao->prepare($sqllog);
        $stmtlog->bindParam(1, $nome_log);
        $stmtlog->bindParam(2, $descricao);
        $stmtlog->bindParam(3, $area);
        $stmtlog->bindParam(4, $data_hora);

        if ($stmtlog->execute()) {
            header("Location: ver_compras.php?id=$id");
            exit();
        } else {
            echo "Erro ao registrar a visualização.";
        }
    }
}
    
    $pesquisa = isset($_GET['consultar']) ? $_GET['consultar'] : '';
    $sql_code = "SELECT * 
            FROM compras 
            WHERE compradopor LIKE '%$pesquisa%'
            OR id LIKE '%$pesquisa%' 
            OR item LIKE '%$pesquisa%'
            OR loja LIKE '%$pesquisa%'
            OR statuspedido LIKE '%$pesquisa%'
            OR datacompra LIKE '%$pesquisa%'
            ORDER BY id DESC";

    $sql_query = $conexao->query($sql_code);

    if ($sql_query === false) {
        die("Error in query: " . $conexao->errorInfo()[2]);
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Compras</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/registros.css">
</head>
<body class="bg-light">
    <nav class="navbar">
        <div class="container">
            <h4 class="text-white">Compras Pendentes</h4>
            <div class="justify-content-end navbar-a">
                <a href="inicio.php" class="btn btn-sm btn-primary text-white a-voltar me-2">Voltar</a>
                <a href="registros_concluidos.php" class="btn btn-sm btn-primary text-white a-concluidos">Compras Concluídas</a>
            </div>
        </div>
        <div class="container py-2">
            <form class="justify-content-center col-12">
                <input class="form-control me-2 " name="consultar" value="<?php if (isset($_GET['consultar'])) echo $_GET['consultar']; ?>" placeholder="Consultar Informações" type="text">
                <div class="text-center py-2">
                    <a href="registros_compras.php" class="btn btn-danger text-white me-2" data-toggle="tooltip" data-placement="top" title="Limpar a Barra de Pesquisa">Limpar</a>
                    <button type="submit" class="btn btn-success text-white me-2" data-toggle="tooltip" data-placement="top" title="Consultar Informações no Banco de Dados">Consultar</button>
                    <a href="registrar_compras.php" class="btn btn-primary text-white" data-toggle="tooltip" data-placement="top" title="Adicionar Um Cliente">Adicionar</a>
                </div>
            </form>
        </div>
    </nav>
    <?php if ($sql_query->rowCount() > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="color">
                        <tr>
                            <th scope="col">Ações</th>
                            <th scope="col">ID</th>
                            <th scope="col">Item</th>
                            <th scope="col">Loja</th>
                            <th scope="col">Comprado Por</th>
                            <th scope="col">Status</th>
                            <th scope="col">Data da Compra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user_data = $sql_query->fetch(PDO::FETCH_ASSOC)): ?>
                            <?php if ($user_data['statuspedido'] != 'Pedido Concluído'): ?>
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
                                        </form>
                                    </td>
                                        <td><?= $user_data["id"] ?></td>
                                        <td><?= $user_data["item"] ?></td>
                                        <td><?= $user_data['loja'] ?></td>
                                        <td><?= $user_data['compradopor'] ?></td>
                                        <td><?= $user_data['statuspedido'] ?></td>
                                        <td><?= $user_data['datacompra'] ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <h5 class="text-center py-2">Nenhuma Compra Concluída Encontrada...</h5>
        <?php endif; ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>