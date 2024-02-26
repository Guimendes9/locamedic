<?php

    include('database.php');

    session_start();

    if (empty($_POST) or empty($_POST['nome'])) {
        header('Location: logar.php');
        exit();
    }

    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM login WHERE nome = '{$nome}'";

    $result = $conexao->query($sql) or die($conexao->error);

    $row = $result->fetch_object();

    $qtd = $result->num_rows;

    if ($qtd > 0 && password_verify($senha, $row->senha)) {
        $_SESSION['nome'] = $row->nome;
        header('Location: inicio.php');
    } else {
        echo "<script>alert('Informações não validadas')</script>";
        header('Location: logar.php');
    }

    if (isset($_POST['entrar'])) {
    
        $conexao = new PDO('mysql:host=localhost;dbname=locamedic_estoque', 'locamedic', 'locamedic');

        $nome_log = $_SESSION['nome'];

        $sqllog = "INSERT INTO log_users (tipo, usuario, descricao, data_hora) VALUES ('Entrada', '$nome_log', 'Realizou Login', NOW())";
        
        $conexao->exec($sqllog);

    }

?>