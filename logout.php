
<?php

session_start();

if (isset($_POST['sair'])) {
    $conexao = new PDO('mysql:host=localhost;dbname=locamedic_estoque', 'locamedic', 'locamedic');
    $nome_log = $_SESSION['nome'];
    $sqllog = "INSERT INTO log_users (tipo, usuario, descricao, data_hora) VALUES ('Saída', ?, ?, NOW())";
    $stmt = $conexao->prepare($sqllog);
    $stmt->execute([$nome_log, 'Saiu da Conta']);

    session_unset();
    session_destroy();

    header("Location: logar.php");
    exit;
}

?>