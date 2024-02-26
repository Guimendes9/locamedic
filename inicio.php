<?php

    include_once("database.php");
    
    session_start();
    if (empty($_SESSION)) {
        header("Location: logar.php");
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Ínicio</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/inicio.css">
</head>
<body class="bg-light vh-100">
    <nav class="navbar">
        <div class="container justify-content-center">
            <h4 class="text-white">Sistema Locamedic</h4>
        </div>
    </nav>
        <div class="text-center mt-4">
            <a href="registros_compras.php" class="btn btn-primary text-white">Compras</a>
            <a href="registros_clientes.php" class="btn btn-primary text-white">Clientes</a>
            <div class="btn-group admin-btn">
                <button type="button" class="btn btn-primary text-white dropdown-toggle rounded" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Admin </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="criar_conta.php">Criar Conta</a>
                    <a class="dropdown-item" href="log_login.php">Logs</a> 
                        <form action="logout.php" method="POST">
                            <button type="submit" class="dropdown-item" id="sair" name="sair">Sair da Conta</button>
                        </form>
                    </div>
                </div>
            </div>
        <div class="py-2 text-black text-center footer"> Precisa de Ajuda?
            <a href="https://api.whatsapp.com/send/?phone=558192385712&text=Olá,%20Estou%20Precisando%20de%20Suporte%20no%20Sistema%20da%20Locamedic." target="_blank">Clique Aqui</a>
            <br>
            Desenvolvido por <b>Guilherme Mendes</b>
        </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="scripts/inicio.js"></script>
</html>