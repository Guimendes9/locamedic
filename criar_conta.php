<?php

    session_start();
    if (empty($_SESSION)) {
        header("Location: logar.php");
    }

    if (isset($_POST["submit"])) {
    
    include("database.php");

    $nome = $_POST["nome"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $funcao = $_POST["funcao"];
    $telefone = $_POST["telefone"];

    $conexao->query("INSERT INTO `login` (nome, senha, funcao,telefone) VALUES ('" . $nome . "', '" . $senha . "', '" . $funcao . "', '" . $telefone . "')");

}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/criar_conta.css">
</head>
<body class="bg-light vh-100">
    <div class="container text-center py-2">
        <div class="btn-group">
            <a href="inicio.php" class="btn bg-primary text-white">Voltar</a>
        </div>
    </div>
    <div class="container mt-3 bg-light">
        <div class="py-2 row form-horizontal-center">
            <div class="rounded card-header text-center bg-primary text-white">
                Criar Conta
            </div>
            <form class="py-2 form-group shadow rounded" method="POST" action="">
                <div class="py-2 row">
                    <div class="mt-1 col-12">
                        <label for="nome">Nome da Conta</label>
                        <input type="text" class="mt-1 form-control" id="nome" name="nome"
                        placeholder="Digite o Nome da Conta" maxlength="255" required>
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="mt-1 col-12">
                        <label for="senha">Senha da Conta</label>
                        <input type="text" class="mt-1 form-control" id="senha" name="senha"
                        placeholder="Digite a Senha da Conta" required>
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="mt-1 col-12">
                        <label for="funcao">Função</label>
                        <input type="text" class="mt-1 form-control" id="funcao" name="funcao"
                        placeholder="Digite a Função da Conta" required>
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="mt-1 col-12">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="mt-1 form-control" id="telefone" name="telefone"
                        placeholder="Digite o Telefone para contato" required>
                    </div>
                </div>
                <div class="py-3 text-center">
                    <button type="submit" id="submit" name="submit" class="btn btn-success">Enviar</button>
                </div>
                <div class="py-3 text-black text-center footer"> Precisa de Ajuda?
                    <a href="https://api.whatsapp.com/send/?phone=558192385712&text=Olá,%20Estou%20Precisando%20de%20Suporte%20no%20Sistema%20da%20Locamedic."
                    target="_blank">Clique Aqui</a>
                </div>
            </form>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
<script src="scripts/criar_conta.js"></script>
</html>