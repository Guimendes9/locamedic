<?php

include_once("database.php");

session_start();
if (empty($_SESSION)) {
    header("Location: logar.php");
}

date_default_timezone_set('America/Sao_Paulo');

if (isset($_POST["submit"])) {

    $compradopor = $_POST["compradopor"];
    $loja = $_POST["loja"];
    $item = $_POST["item"];
    $unidades = $_POST["unidades"];
    $valor = $_POST["valor"];
    $pagamento = $_POST["pagamento"];
    $endereco = $_POST["endereco"];
    $codigo = $_POST["codigo"];
    $datacompra = $_POST["datacompra"];
    $entregaprevista = $_POST["entregaprevista"];
    $datachegada = $_POST["datachegada"];
    $statusPedido = $_POST["statusPedido"];
    $descricao = $_POST["descricao"];

    $dados = mysqli_query($conexao, "INSERT INTO compras (compradopor, loja, item, unidades, valor, pagamento, endereco, codigo, datacompra, entregaprevista, datachegada, statuspedido, descricao) VALUES ('$compradopor', '$loja', '$item', '$unidades', '$valor', '$pagamento', '$endereco', '$codigo', '$datacompra', '$entregaprevista', '$datachegada', '$statusPedido', '$descricao')");

    if ($conexao->error) {
        echo "<div class='alert alert-danger alert-dismissible fade show w-50 mx-auto text-center justify-content-center' role='alert'>
            Formulário Enviado Com Sucesso
        </div>";
    } else {
        $tipo = "Adição";
        $nome_log = $_SESSION['nome'];
        $area = $statusPedido === 'Pedido Concluído' ? "Compras Concluídas" : "Compras Pendentes";
        $data_hora = date('Y-m-d H:i:s');

        $log_query = mysqli_query($conexao, "INSERT INTO log_compras (tipo, usuario, descricao, area, data_hora) VALUES ('$tipo', '$nome_log', 'Adicionou Uma Informação na Tabela Compras, Comprado Por: $compradopor', '$area', '$data_hora')");

        if ($conexao->error) {
            echo "<div class='alert alert-danger alert-dismissible fade show w-50 mx-auto text-center justify-content-center' role='alert'>
                Erro ao registrar no log
            </div>";
        } else {
            echo "<div class='alert alert-success alert-dismissible fade show w-50 mx-auto text-center justify-content-center' role='alert'>
                Formulário Enviado Com Sucesso
            </div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Registrar Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/formulario.css">
</head>
<body class="py-2 bg-light">
    <div class="container text-center">
        <div class="btn-group">
            <a href="registros_compras.php" class="btn bg-primary text-white">Voltar</a>
        </div>
    </div>
    <div class="container mt-3 bg-light">
        <div class="py-2 row">
            <div class="rounded card-header text-center bg-primary text-white">
                Registrar Compras
            </div>
            <form id="clienteForm" class="py-2 form-group shadow rounded" method="POST" action="registrar_compras.php" onsubmit="return validarData()">
                <div class="py-2 row">
                    <div class="col-6">
                        <label for="compradopor">Compra Feita Por:</label>
                        <select class="mt-1 form-select" id="compradopor" name="compradopor" required>
                            <option selected disabled value="">Selecione o Comprador</option>
                            <option value="Ellys">Ellys</option>
                            <option value="Rodrigo">Rodrigo</option>
                            <option value="Uziel">Uziel</option>
                            <option value="Locamedic">Locamedic</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="loja">Loja</label>
                        <input type="text" class="mt-1 form-control" id="loja" name="loja" maxlength="255">
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-9">
                        <label for="item">Item</label>
                        <input type="text" class="mt-1 form-control" id="item" name="item" maxlength="255">
                    </div>
                    <div class="col-3">
                        <label for="unidades">Unidades</label>
                        <input type="text" class="mt-1 form-control" id="unidades" name="unidades" maxlength="10">
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-6">
                        <label for="valor">Valor</label>
                        <input type="text" class="mt-1 form-control" id="valor" name="valor" maxlength="16">
                    </div>
                    <div class="col-6">
                        <label for="pagamento">Forma de Pagamento</label>
                        <select type="text" class="mt-1 form-select" id="pagamento" name="pagamento" required>
                            <option value="" hidden></option>
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
                        <input type="text" class="mt-1 form-control" id="endereco" name="endereco" maxlength="255">
                    </div>
                    <div class="col-6">
                        <label for="codigo">Código do Pedido</label>
                        <input type="text" class="mt-1 form-control" id="codigo" name="codigo" maxlength="45">
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-4">
                    <label for="datacompra">Data da Compra</label>
                    <input type="text" class="mt-1 form-control" id="datacompra" name="datacompra" onblur="validarData()">
                    </div>
                    <div class="col-4">
                        <label for="entregaprevista">Entrega Prevista</label>
                        <input type="text" class="mt-1 form-control" id="entregaprevista" name="entregaprevista" onblur="validarData()">
                    </div>
                    <div class="col-4">
                        <label for="datachegada">Data da Chegada</label>
                        <input type="text" class="mt-1 form-control" id="datachegada" name="datachegada" onblur="validarData()">
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-12">
                        <label for="statusPedido">Status do Pedido</label>
                        <select type="text" class="mt-1 form-select" id="statusPedido" name="statusPedido" required>
                            <option value="" hidden></option>
                            <option value="Pedido Confirmado">Pedido Confirmado</option>
                            <option value="Pedido em Separação">Pedido em Separação</option>
                            <option value="Pedido em Transporte">Pedido em Transporte</option>
                            <option value="Pedido na Alfândega">Pedido na Alfândega</option>
                            <option value="Pedido em Entrega">Pedido em Entrega</option>
                            <option value="Pedido Entregue">Pedido Entregue</option>
                            <option value="Pedido Concluído">Pedido Concluído</option>
                        </select>
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-12">
                        <label for="descricao">Descrição do Item</label>
                        <input type="text" class="mt-1 form-control" id="descricao" name="descricao" maxlength="500">
                    </div>
                </div>
                <div class="py-3 text-center">
                    <button type="reset" class="btn btn-danger me-4" id="limpar" name="limpar" >Limpar</button>
                    <button type="submit" class="btn btn-success" id="submit" name="submit">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="scripts/reg_compras.js"></script>
</html>