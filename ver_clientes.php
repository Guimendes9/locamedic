<?php

session_start();
if (empty($_SESSION['nome'])) {
    header("Location: logar.php");
    exit;
}

$conexao = new PDO('mysql:host=localhost;dbname=locamedic_estoque', 'locamedic', 'locamedic');

if (!empty($_GET['id'])) {
    include_once("database.php");

    $id = $_GET["id"];

    $sqlSelect = "SELECT * FROM clientes WHERE id=$id";

    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_array($result)) {
            $nome = $user_data["nome"];
            $documento = $user_data["documento"];
            $idade = $user_data["idade"];
            $cep = $user_data["cep"];
            $estado = $user_data["estado"];
            $cidade = $user_data["cidade"];
            $bairro = $user_data["bairro"];
            $rua = $user_data["rua"];
            $complemento = $user_data["complemento"];
            $numero = $user_data["numero"];
            $telefone = $user_data["telefone"];
            $email = $user_data["email"];
            $item = $user_data["item"];
            $valor = $user_data["valor"];
            $pagamento = $user_data["pagamento"];
        }
    }

}

if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $nome_log = $_SESSION['nome'];

    $nomeDepois = $_POST['nome'];
    $documentoDepois = $_POST['documento'];
    $idadeDepois = $_POST['idade'];
    $cepDepois = $_POST['cep'];
    $estadoDepois = $_POST['estado'];
    $cidadeDepois = $_POST['cidade'];
    $bairroDepois = $_POST['bairro'];
    $ruaDepois = $_POST['rua'];
    $complementoDepois = $_POST['complemento'];
    $numeroDepois = $_POST['numero'];
    $telefoneDepois = $_POST['telefone'];
    $emailDepois = $_POST['email'];
    $itemDepois = $_POST['item'];
    $valorDepois = $_POST['valor'];
    $pagamentoDepois = $_POST['pagamento'];

    $nomeAntes = $_POST['nomeAntes'];
    $documentoAntes = $_POST['documentoAntes'];
    $idadeAntes = $_POST['idadeAntes'];
    $cepAntes = $_POST['cepAntes'];
    $estadoAntes = $_POST['estadoAntes'];
    $cidadeAntes = $_POST['cidadeAntes'];
    $bairroAntes = $_POST['bairroAntes'];
    $ruaAntes = $_POST['ruaAntes'];
    $complementoAntes = $_POST['complementoAntes'];
    $numeroAntes = $_POST['numeroAntes'];
    $telefoneAntes = $_POST['telefoneAntes'];
    $emailAntes = $_POST['emailAntes'];
    $itemAntes = $_POST['itemAntes'];
    $valorAntes = $_POST['valorAntes'];
    $pagamentoAntes = $_POST['pagamentoAntes'];


    $descricao = "Alteração na Tabela Clientes, ID $id. ";

    if ($nomeAntes!= $nomeDepois) {
        $descricao .= "Nome Alterado de $nomeAntes Para $nomeDepois, ";
    }
    if ($documentoAntes != $documentoDepois) {
        $descricao .= "Documento Alterado de $documentoAntes Para $documentoDepois, ";
    }
    if ($idadeAntes!= $idadeDepois) {
        $descricao .= "Idade Alterada de $idadeAntes Para $idadeDepois, ";
    }
    if ($cepAntes!= $cepDepois) {
        $descricao .= "CEP Alterado de $cepAntes Para $cepDepois, ";
    }
    if ($estadoAntes!= $estadoDepois) {
        $descricao .= "Estado Alterado de $estadoAntes Para $estadoDepois, ";
    }
    if ($cidadeAntes!= $cidadeDepois) {
        $descricao .= "Cidade Alterada de $cidadeAntes Para $cidadeDepois, ";
    }
    if ($bairroAntes!= $bairroDepois) {
        $descricao .= "Bairro Alterado de $bairroAntes Para $bairroDepois, ";
    }
    if ($ruaAntes!= $ruaDepois) {
        $descricao .= "Rua Alterada de $ruaAntes Para $ruaDepois, ";
    }
    if ($complementoAntes!= $complementoDepois) {
        $descricao .= "Complemento Alterado de $complementoAntes Para $complementoDepois, ";
    }
    if ($numeroAntes!= $numeroDepois) {
        $descricao .= "Número Alterado de $numeroAntes Para $numeroDepois, ";
    }
    if ($telefoneAntes!= $telefoneDepois) {
        $descricao .= "Telefone Alterado de $telefoneAntes Para $telefoneDepois, ";
    }
    if ($emailAntes!= $emailDepois) {
        $descricao .= "Email Alterado de $emailAntes Para $emailDepois, ";
    }
    if ($itemAntes!= $itemDepois) {
        $descricao .= "Item Alterado de $itemAntes Para $itemDepois, ";
    }
    if ($valorAntes!= $valorDepois) {
        $descricao .= "Valor Alterado de $valorAntes Para $valorDepois, ";
    }
    if ($pagamentoAntes!= $pagamentoDepois) {
        $descricao .= "Forma de Pagamento Alterada de $pagamentoAntes Para $pagamentoDepois, ";
    }

    $sqllog = "INSERT INTO log_clientes (tipo, usuario, descricao, data_hora)
    VALUES ('Alteração', '$nome_log', '$descricao', NOW())";
    $conexao->exec($sqllog);

    $sqlUpdate = "UPDATE clientes SET nome=?, documento=?, idade=?, cep=?, estado=?, cidade=?, bairro=?, rua=?, complemento=?, numero=?, telefone=?, email=?, item=?, valor=?, pagamento=? WHERE id=?";
    $stmt = $conexao->prepare($sqlUpdate);
    $stmt->bindParam(1, $nomeDepois);
    $stmt->bindParam(2, $documentoDepois);
    $stmt->bindParam(3, $idadeDepois);
    $stmt->bindParam(4, $cepDepois);
    $stmt->bindParam(5, $estadoDepois);
    $stmt->bindParam(6, $cidadeDepois);
    $stmt->bindParam(7, $bairroDepois);
    $stmt->bindParam(8, $ruaDepois);
    $stmt->bindParam(9, $complementoDepois);
    $stmt->bindParam(10, $numeroDepois);
    $stmt->bindParam(11, $telefoneDepois);
    $stmt->bindParam(12, $emailDepois);
    $stmt->bindParam(13, $itemDepois);
    $stmt->bindParam(14, $valorDepois);
    $stmt->bindParam(15, $pagamentoDepois);
    $stmt->bindParam(16, $id);
    $stmt->execute();

    if ($stmt->execute()) {
        header("Location: registros_clientes.php");
        exit();
    } else {
        echo "Erro ao atualizar o registro.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="css/formulario.css">
</head>
<body class="py-2 bg-light">
    <div class="container text-center ">
        <div class="btn-group">
            <a href="registros_clientes.php" class="btn bg-primary text-white">Voltar</a>
        </div>
    </div>
    <div class="container mt-3 bg-light">
        <div class="py-2 row form-horizontal-center">
            <form class="py-2 form-group shadow rounded" method="POST" action="ver_clientes.php" onsubmit="return validarForm()">
                <input type="hidden" id="nomeAntes" name="nomeAntes" value="<?php echo $nome ?>">
                <input type="hidden" id="documentoAntes" name="documentoAntes" value="<?php echo $documento ?>">
                <input type="hidden" id="idadeAntes" name="idadeAntes" value="<?php echo $idade ?>">
                <input type="hidden" id="cepAntes" name="cepAntes" value="<?php echo $cep ?>">
                <input type="hidden" id="estadoAntes" name="estadoAntes" value="<?php echo $estado ?>">
                <input type="hidden" id="cidadeAntes" name="cidadeAntes" value="<?php echo $cidade ?>">
                <input type="hidden" id="bairroAntes" name="bairroAntes" value="<?php echo $bairro ?>">
                <input type="hidden" id="ruaAntes" name="ruaAntes" value="<?php echo $rua ?>">
                <input type="hidden" id="complementoAntes" name="complementoAntes" value="<?php echo $complemento ?>">
                <input type="hidden" id="numeroAntes" name="numeroAntes" value="<?php echo $numero ?>">
                <input type="hidden" id="telefoneAntes" name="telefoneAntes" value="<?php echo $telefone ?>">
                <input type="hidden" id="emailAntes" name="emailAntes" value="<?php echo $email ?>">
                <input type="hidden" id="itemAntes" name="itemAntes" value="<?php echo $item ?>">
                <input type="hidden" id="valorAntes" name="valorAntes" value="<?php echo $valor ?>">
                <input type="hidden" id="pagamentoAntes" name="pagamentoAntes" value="<?php echo $pagamento ?>">
                <div class="py-2 row">
                    <div class="rounded card-header text-center bg-primary text-white">
                        Informações do Cliente
                    </div>
                    <div class="mt-1 col-4">
                        <label for="nome">Nome</label>
                        <input type="text" class="mt-1 form-control" id="nome" name="nome" maxlength="115" value="<?php echo $nome ?>"
                        required>
                    </div>
                    <div class="col-4">
                        <label for="documento">CPF / CNPJ</label>
                        <input type="text" class="mt-1 form-control" id="documento" name="documento" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()'
                        value="<?php echo $documento ?>" required>
                    </div>
                    <div class="col-4">
                        <label for="idade">Idade</label>
                        <input type="text" class="mt-1 form-control" id="idade" name="idade"
                        maxlength="3" value="<?php echo $idade ?>">
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="mt-1 col-4">
                        <label for="cep">CEP</label>
                        <input type="text" class="mt-1 form-control" id="cep" name="cep" maxlength="8" value="<?php echo $cep ?>">
                    </div>
                    <div class="col-4">
                        <label for="estado">Estado</label>
                        <input type="text" class="mt-1 form-control" id="estado" name="estado"
                        maxlength="19" value="<?php echo $estado ?>">
                    </div>
                    <div class="col-4">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="mt-1 form-control" id="cidade" name="cidade"
                        maxlength="32" value="<?php echo $cidade ?>">
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="mt-1 col-4">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="mt-1 form-control" id="bairro" name="bairro"
                        maxlength="255" value="<?php echo $bairro ?>">
                    </div>
                    <div class="col-4">
                        <label for="rua">Rua</label>
                        <input type="text" class="mt-1 form-control" id="rua" name="rua" maxlength="255" value="<?php echo $rua ?>">
                    </div>
                    <div class="col-4">
                        <label for="numero">N°</label>
                        <input type="text" class="mt-1 form-control" id="numero" name="numero"
                        maxlength="5" value="<?php echo $numero ?>">
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="mt-1 col-12">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="mt-1 form-control" id="complemento" name="complemento"
                        maxlength="255" value="<?php echo $complemento ?>">
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-4">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="mt-1 form-control" id="telefone" name="telefone"
                        maxlength="16" value="<?php echo $telefone ?>" required>
                    </div>
                    <div class="col-8">
                        <label for="email">E-mail</label>
                        <input type="email" class="mt-1 form-control" id="email" name="email"
                        maxlength="255" value="<?php echo $email ?>" required>
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-4">
                        <label for="item">Item</label>
                        <input type="text" class="mt-1 form-control" id="item" name="item" maxlength="255" value="<?php echo $item ?>" required>
                    </div>
                    <div class="col-4">
                        <label for="valor">Valor</label>
                        <input type="text" class="mt-1 form-control" id="valor" name="valor"
                        maxlength="16" value="<?php echo $valor ?>">
                    </div>
                    <div class="col-4">
                        <label for="pagamento">Pagamento</label>
                        <select class="mt-1 form-select" id="pagamento" name="pagamento" required>
                            <option>
                            <?php echo $pagamento ?>
                        </option>
                        <option value="Alugado">Alugado</option>
                        <option value="Crédito">Cartão de Crédito</option>
                        <option value="PIX">PIX</option>
                        <option value="Débito">Cartão de Débito</option>
                        <option value="Dinheiro">Dinheiro</option>
                            <option value="Boleto">Boleto</option>
                        </select>
                    </div>
                </div>
                    <div class="py-3 text-center">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <button type="submit" id="update" name="update" class="btn btn-success ">Alterar</button>
                        <div class="py-3 text-black text-center footer "> Precisa de Ajuda?
                            <a href="https://api.whatsapp.com/send/?phone=558192385712&text=Olá,%20Estou%20Precisando%20de%20Suporte%20no%20Sistema%20da%20Locamedic."
                            target="_blank">Clique Aqui</a>
                        </div>
                        <div class="py-2"></div>
                    </div>
                </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="scripts/reg_clientes.js"></script>
</html>