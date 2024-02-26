<?php

    include("database.php");

    session_start();
    if (empty($_SESSION)) {
        header("Location: logar.php");
    }

    $mysqli = new mysqli("localhost", "locamedic", "locamedic", "locamedic_estoque");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    $pesquisa = isset($_GET['consultar']) ? $mysqli->real_escape_string($_GET['consultar']) : '';
    $sql_code = "SELECT * 
        FROM log_users
        WHERE id LIKE '%$pesquisa%' 
        OR tipo LIKE '%$pesquisa%'
        OR usuario LIKE '%$pesquisa%'
        OR descricao LIKE '%$pesquisa%'
        OR data_hora LIKE '%$pesquisa%'
        ORDER BY id DESC";

    $sql_query = $mysqli->query($sql_code);

    if ($sql_query === false) {
        die("Error in query: " . $mysqli->error);
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log de Login</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/log.css">
</head>
<body class="bg-light">
    <nav class="navbar">
        <div class="container">
            <h4 class="text-white">Log de Login</h4>
            <div class="justify-content-end navbar-a">
                <a href="inicio.php" class="btn btn-sm btn-primary text-white a-voltar">Voltar</a>
                <a href="log_compras.php" class="btn btn-sm btn-primary text-white a-voltar">Log de Compras</a>
                <a href="log_clientes.php" class="btn btn-sm btn-primary text-white a-voltar">Log de Clientes</a>
            </div>
        </div>
        <div class="container py-2">
            <form class="justify-content-center col-12">
                <input class="form-control" name="consultar"
                value="<?php if (isset($_GET['consultar'])) echo $_GET['consultar']; ?>"
                placeholder="Consultar Informações" type="text">
                <div class="text-center py-2">
                    <a href="logs.php" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Limpar a Barra de Pesquisa">Limpar</a>
                    <button type="submit" class="btn bg-success text-white" data-toggle="tooltip" data-placement="top" title="Consultar Informações no Banco de Dados">Consultar</button>
                </div>
            </form>
        </div>
    </nav>
    <?php if ($sql_query->num_rows > 0) : ?>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Data / Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user_data = $sql_query->fetch_assoc()) : ?>
                            <tr>
                                <td><?= $user_data ["id"] ?></td>
                                <td><?= $user_data ["tipo"] ?></td>
                                <td><?= $user_data['usuario'] ?></td>
                                <td><?= $user_data['descricao'] ?></td>
                                <td><?php echo date('d/m/Y H:i:s', strtotime($user_data['data_hora'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
        <?php else : ?>
            <h5 class="text-center py-2">Nenhum Log Foi Encontrado...</h5>
            <?php endif; ?>
</body>
</html>
