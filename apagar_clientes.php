<?php
if (!empty($_GET['id'])) {
    include_once("database.php");

    $id = $_GET["id"];

    $sqlSelect = "SELECT * FROM clientes WHERE id=$id";

    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM clientes WHERE id=$id";
        $resultDelete = $conexao->query($sqlDelete);


        if ($resultDelete === TRUE) {

            header("Location: registros_clientes.php");
            exit();
        } else {

            echo "Erro ao excluir registro: " . $conexao->error;
        }
    }
}
?>
