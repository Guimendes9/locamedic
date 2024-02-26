<?php

    session_start();
    if (empty($_SESSION)) {
        header("Location: logar.php");
    }

    $conexao = new PDO('mysql:host=localhost;dbname=locamedic_estoque', 'locamedic', 'locamedic');

    if (!empty($_GET['id'])) {
        include_once("database.php");

        $id = $_GET["id"];

        $sqlSelect = "SELECT compradopor, loja, item, unidades, valor, pagamento, endereco, codigo, datacompra, entregaprevista, datachegada, statuspedido, descricao  FROM compras WHERE id=$id";

        $result = $conexao->query($sqlSelect);

        if ($result->num_rows > 0) {
            while ($user_data = mysqli_fetch_array($result)) {

            $compradopor = $user_data["compradopor"];
            $loja = $user_data["loja"];
            $item = $user_data["item"];
            $unidades = $user_data["unidades"];
            $valor = $user_data["valor"];
            $pagamento = $user_data["pagamento"];
            $endereco = $user_data["endereco"];
            $codigo = $user_data["codigo"];
            $datacompra = $user_data["datacompra"];
            $entregaprevista = $user_data["entregaprevista"];
            $datachegada = $user_data["datachegada"];
            $statuspedido = $user_data["statuspedido"];
            $descricao = $user_data["descricao"];
        }
    }
}

    if (isset($_POST['update'])) {

        $compradoporDepois = $_POST['compradopor'];
        $lojaDepois = $_POST['loja'];
        $itemDepois = $_POST['item'];
        $unidadesDepois = $_POST['unidades'];
        $valorDepois = $_POST['valor'];
        $pagamentoDepois = $_POST['pagamento'];
        $enderecoDepois = $_POST['endereco'];
        $codigoDepois = $_POST['codigo'];
        $datacompraDepois = $_POST['datacompra'];
        $entregaprevistaDepois = $_POST['entregaprevista'];
        $datachegadaDepois = $_POST['datachegada'];
        $statuspedidoDepois = $_POST['statuspedido'];
        $descricaoDepois = $_POST['descricao'];
        
        $compradoporAntes = $_POST['compradoporAntes'];
        $lojaAntes = $_POST['lojaAntes'];
        $itemAntes = $_POST['itemAntes'];
        $unidadesAntes = $_POST['unidadesAntes'];
        $valorAntes = $_POST['valorAntes'];
        $pagamentoAntes = $_POST['pagamentoAntes'];
        $enderecoAntes = $_POST['enderecoAntes'];
        $codigoAntes = $_POST['codigoAntes'];
        $datacompraAntes = $_POST['datacompraAntes'];
        $entregaprevistaAntes = $_POST['entregaprevistaAntes'];
        $datachegadaAntes = $_POST['datachegadaAntes'];
        $statuspedidoAntes = $_POST['statuspedidoAntes'];
        $descricaoAntes = $_POST['descricaoAntes'];

        
        $id = $_POST['id'];
        $nome_log = $_SESSION['nome'];
        
        
        $descricao = "Alteração: ";
        
        if ($compradoporAntes != $compradoporDepois) {
            $descricao .= 'A opção "Comprado Por" Foi Alterada de ' . $compradoporAntes . ' Para ' . $compradoporDepois . ', ';
        }
        if ($lojaAntes != $lojaDepois) {
            $descricao .= "Loja Alterada de $lojaAntes Para $lojaDepois, ";
        }
        if ($itemAntes!= $itemDepois) {
            $descricao .= "Item Alterado de $itemAntes Para $itemDepois, ";
        }
        if ($unidadesAntes!= $unidadesDepois) {
            $descricao .= "Quantidade de Unidades Alterada de $unidadesAntes Para $unidadesDepois, ";
        }
        if ($valorAntes!= $valorDepois) {
            $descricao .= "Valor Alterado de $valorAntes Para $valorDepois, ";
        }
        if ($pagamentoAntes!= $pagamentoDepois) {
            $descricao .= "Forma de Pagamento Alterada de $pagamentoAntes Para $pagamentoDepois, ";
        }
        if ($enderecoAntes!= $enderecoDepois) {
            $descricao .= "Endereço Alterado de $enderecoAntes Para $enderecoDepois, ";
        }
        if ($codigoAntes!= $codigoDepois) {
            $descricao .= "Código Alterado de $codigoAntes Para $codigoDepois, ";
        }
        if ($datacompraAntes!= $datacompraDepois) {
            $descricao .= "A Data da Compra Foi Alterada de $datacompraAntes Para $datacompraDepois, ";
        }
        if ($entregaprevistaAntes!= $entregaprevistaDepois) {
            $descricao .= "A Entrega Prevista Foi Alterada de $entregaprevistaAntes Para $entregaprevistaDepois, ";
        }
        if ($datachegadaAntes!= $datachegadaDepois) {
            $descricao .= "A Data de Chegada Foi Alterada de $datachegadaAntes Para $datachegadaDepois, ";
        }
        if ($statuspedidoAntes!= $statuspedidoDepois) {
            $descricao .= "O Status do Pedido Foi Alterado de $statuspedidoAntes Para $statuspedidoDepois, ";
        }
        if ($descricaoAntes!= $descricaoDepois) {
            $descricao .= "Descrição Alterada de $descricaoAntes Para $descricaoDepois, ";
        }

        $sqllog = "INSERT INTO log_compras (tipo, usuario, descricao, area, data_hora)
        VALUES ('Alteração', '$nome_log', '$descricao', 'Compras Concluídas', NOW())";

        $conexao->exec($sqllog);

        $sqlUpdate = "UPDATE compras SET compradopor=?, loja=?, item=?, unidades=?, valor=?, pagamento=?, endereco=?, codigo=?, datacompra=?, entregaprevista=?, datachegada=?, statuspedido=?, descricao=? WHERE id=?";
        $stmt = $conexao->prepare($sqlUpdate);
        $stmt->bindParam(1, $compradoporDepois);
        $stmt->bindParam(2, $lojaDepois);
        $stmt->bindParam(3, $itemDepois);
        $stmt->bindParam(4, $unidadesDepois);
        $stmt->bindParam(5, $valorDepois);
        $stmt->bindParam(6, $pagamentoDepois);
        $stmt->bindParam(7, $enderecoDepois);
        $stmt->bindParam(8, $codigoDepois);
        $stmt->bindParam(9, $datacompraDepois);
        $stmt->bindParam(10, $entregaprevistaDepois);
        $stmt->bindParam(11, $datachegadaDepois);
        $stmt->bindParam(12, $statuspedidoDepois);
        $stmt->bindParam(13, $descricaoDepois);
        $stmt->bindParam(14, $id);
        $stmt->execute();
        if ($stmt->execute()) {
            header("Location: registros_concluidos.php");
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
    <title>Visualizar Compra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/formulario.css">
</head>
<body class="py-2 bg-light">
    <div class="container text-center">
        <div class="btn-group">
            <a href="registros_concluidos.php" class="btn bg-primary text-white">Voltar</a>
        </div>
    </div>
    <div class="container mt-3 bg-light">
        <div class="py-2 row form-horizontal-center">
            <div class="rounded card-header text-center bg-primary text-white">
                Informações da Compra
            </div>
            <form class="py-2 form-group shadow rounded" method="POST" action="ver_concluidos.php">
                <input type="hidden" id="compradoporAntes" name="compradoporAntes" value="<?php echo $compradopor ?>">
                <input type="hidden" id="lojaAntes" name="lojaAntes" value="<?php echo $loja ?>">
                <input type="hidden" id="itemAntes" name="itemAntes" value="<?php echo $item ?>">
                <input type="hidden" id="unidadesAntes" name="unidadesAntes" value="<?php echo $unidades ?>">
                <input type="hidden" id="valorAntes" name="valorAntes" value="<?php echo $valor ?>">
                <input type="hidden" id="pagamentoAntes" name="pagamentoAntes" value="<?php echo $pagamento ?>">
                <input type="hidden" id="enderecoAntes" name="enderecoAntes" value="<?php echo $endereco ?>">
                <input type="hidden" id="codigoAntes" name="codigoAntes" value="<?php echo $codigo ?>">
                <input type="hidden" id="datacompraAntes" name="datacompraAntes" value="<?php echo $datacompra ?>">
                <input type="hidden" id="entregaprevistaAntes" name="entregaprevistaAntes" value="<?php echo $entregaprevista ?>">
                <input type="hidden" id="datachegadaAntes" name="datachegadaAntes" value="<?php echo $datachegada ?>">
                <input type="hidden" id="statuspedidoAntes" name="statuspedidoAntes" value="<?php echo $statuspedido ?>">
                <input type="hidden" id="descricaoAntes" name="descricaoAntes" value="<?php echo $descricao ?>">
                <div class="py-2 row">
                    <div class="col-6">
                        <label for="compradopor">Compra Feita Por:</label>
                        <select class="mt-1 form-select" id="compradopor" name="compradopor">
                            <?php if ($compradopor == null): ?>
                                <option selected disabled>Selecione o Comprador</option>
                                <?php endif; ?>
                                <option value="Ellys" <?php if ($compradopor == "Ellys") echo "selected"; ?>>Ellys</option>
                                <option value="Rodrigo" <?php if ($compradopor == "Rodrigo") echo "selected"; ?>>Rodrigo</option>
                                <option value="Uziel" <?php if ($compradopor == "Uziel") echo "selected"; ?>>Uziel</option>
                                <option value="Locamedic" <?php if ($compradopor == "Locamedic") echo "selected"; ?>>Locamedic</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="loja">Loja</label>
                            <input type="text" class="mt-1 form-control" id="loja" maxlength="255" name="loja" value="<?php echo $loja ?>">
                        </div>
                    </div>
                <div class="py-2 row">
                    <div class="col-9">
                        <label for="item">Item</label>
                        <input type="text" class="mt-1 form-control" id="item" name="item" maxlength="255" value="<?php echo $item ?>">
                    </div>
                    <div class="col-3">
                        <label for="unidades">Unidades</label>
                        <input type="text" class="mt-1 form-control" id="unidades" name="unidades" maxlength="10" value="<?php echo $unidades ?>">
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-6">
                        <label for="valor">Valor</label>
                        <input type="text" class="mt-1 form-control" id="valor" name="valor" maxlength="16" value="<?php echo $valor ?>">
                    </div>
                    <div class="col-6">
                        <label for="pagamento">Forma de Pagamento</label>
                        <select type="text" class="mt-1 form-select" id="pagamento" name="pagamento">
                            <option><?php echo $pagamento ?></option>
                            <option value="Dinheiro">Dinheiro</option>
                            <option value="Cartão de Crédito">Cartão de Crédito</option>
                            <option value="Cartão de Débito">Cartão de Débito</option>
                            <option value="Boleto">Boleto</option>
                            <option value="PIX">PIX</option>
                        </select>
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-6">
                        <label for="endereco">Endereço da Entrega</label>
                        <input type="text" class="mt-1 form-control" id="endereco" name="endereco" maxlength="255" value="<?php echo $endereco ?>">
                    </div>
                    <div class="col-6">
                        <label for="codigo">Código do Pedido</label>
                        <input type="text" class="mt-1 form-control" id="codigo" name="codigo" maxlength="45" value="<?php echo $codigo ?>">
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-4">
                        <label for="datacompra">Data da Compra</label>
                        <input type="text" class="mt-1 form-control" id="datacompra" name="datacompra" placeholder="Digite a Data" onblur="validarData()" value="<?php echo $datacompra ?>">
                    </div>
                    <div class="col-4">
                        <label for="entregaprevista">Entrega Prevista</label>
                        <input type="text" class="mt-1 form-control" id="entregaprevista" name="entregaprevista" placeholder="Digite a Data" onblur="validarData()" value="<?php echo $entregaprevista ?>">
                    </div>
                    <div class="col-4">
                        <label for="datachegada">Data da Chegada</label>
                        <input type="text" class="mt-1 form-control" id="datachegada" name="datachegada" placeholder="Digite a Data" onblur="validarData()" value="<?php echo $datachegada ?>">
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-12">
                        <label for="statuspedido">Status do Pedido</label>
                        <select type="text" class="mt-1 form-select" id="statuspedido" name="statuspedido">
                            <option> <?php echo $statuspedido ?></option>
                            <option value="Pedido Confirmado">Pedido Confirmado</option>
                            <option value="Em Separação">Pedido em Separação</option>
                            <option value="Em Transporte">Pedido em Transporte</option>
                            <option value="Na Alfândega">Pedido na Alfândega</option>
                            <option value="Em Entrega">Pedido em Entrega</option>
                            <option value="Pedido Entregue">Pedido Entregue</option>
                            <option value="Pedido Concluído">Pedido Concluído</option>
                        </select>
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-12">
                        <label for="descricao">Descrição do Item</label>
                        <input type="text" class="mt-1 form-control" id="descricao" name="descricao" maxlength="500" value="<?php echo $descricao ?>">
                    </div>
                </div>
                <div class="py-3 text-center">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                <button type="submit" id="update" name="update" class="btn btn-success">Atualizar</button>
            </div>
            <div class="py-3 text-black text-center footer"> Precisa de Ajuda? 
                <a href="https://api.whatsapp.com/send/?phone=558192385712&text=Olá,%20Estou%20Precisando%20de%20Suporte%20no%20Sistema%20da%20Locamedic." target="_blank">Clique Aqui</a>
            </div>
        </form>
    </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="scripts/reg_compras.js"></script>
</html>