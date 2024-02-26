<?php 

    $dbHost = "localhost";
    $dbUsername = "locamedic";
    $dbPassword = "locamedic";
    $dbName = "locamedic_estoque";
    
    $conexao = new mysqli ($dbHost, $dbUsername, $dbPassword, $dbName);

    if($conexao->connect_errno){
        echo 'Conexão com o banco de dados não realizada';
    }
    
?> 