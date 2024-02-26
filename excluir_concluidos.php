<?php

    if (!empty($_GET['id'])) {
        include_once("database.php");

        $id = $_GET["id"];

        $sqlSelect = "SELECT * FROM compras WHERE id=$id";

        $result = $conexao->query($sqlSelect);

        if ($result->num_rows > 0) {
            $sqlDelete = "DELETE FROM compras WHERE id=$id";
            $resultDelete = $conexao->query($sqlDelete);


            if ($resultDelete === TRUE) {

                header("Location: registros_concluidos.php");
                exit();
            } else {

                echo "Erro ao excluir registro: " . $conexao->error;
            }
        }
    }
    if(isset($_POST['excluir'])) {
        $conexao = new PDO('mysql:host=localhost;dbname=locamedic_estoque', 'locamedic', 'locamedic');

        $id = $_POST['id'];
        $nome_log = $_SESSION['nome'];
    
        $sqllog = "INSERT INTO log_compras (tipo, descricao, area, data_hora) VALUES ('Exclusão', '$nome_log fez uma exclusão na tabela Compras no ID $id', 'Compras Concluídas', NOW())";
    
        $conexao->exec($sqllog);
    }

?>
