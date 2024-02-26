<?php

include_once("database.php");

session_start();
if (empty($_SESSION)) {
    header("Location: logar.php");
}

date_default_timezone_set('America/Sao_Paulo');

if (isset($_POST["submit"])) {

    $nome = $_POST["nome"];
    $documento = $_POST["documento"];
    $idade = $_POST["idade"];
    $cep = $_POST["cep"];
    $estado = $_POST ["estado"];
    $cidade = $_POST["cidade"];
    $bairro = $_POST["bairro"];
    $rua = $_POST["rua"];
    $complemento = $_POST["complemento"];
    $numero = $_POST["numero"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $item = $_POST["item"];
    $valor = $_POST["valor"];
    $pagamento = $_POST["pagamento"];

    $dados = mysqli_query($conexao, "INSERT INTO clientes (nome, documento, idade, cep, estado, cidade, bairro, rua, complemento, numero, telefone, email, item, valor, pagamento) VALUES ('$nome', '$documento', '$idade', '$cep', '$estado', '$cidade', '$bairro', '$rua', '$complemento', '$numero', '$telefone', '$email', '$item', '$valor', '$pagamento')");

    if ($conexao->error) {
        echo "<div class='alert alert-danger alert-dismissible fade show w-50 mx-auto text-center justify-content-center' role='alert'>
            Formulário Enviado Com Sucesso
        </div>";

    } else {
        $tipo = "Adição";
        $nome_log = $_SESSION['nome'];
        $data_hora = date('Y-m-d H:i:s');

        $log_query = mysqli_query($conexao, "INSERT INTO log_clientes (tipo, usuario, descricao, data_hora) VALUES ('$tipo', '$nome_log', 'Adicionou Uma Informação na Tabela Clientes, Nome: $nome', '$data_hora')");

        if ($conexao->error) {
            echo "<div class='alert alert-danger alert-dismissible fade show w-50 mx-auto text-center justify-content-center' style='overflow-x: hidden;' role='alert'>
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
    <title>Registrar Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/formulario.css">
</head>
<body class="py-2 bg-light">
    <div class="container text-center ">
        <a href="registros_clientes.php" class="btn bg-primary text-white">Voltar</a>
    </div>
    <div class="container mt-3 bg-light">
        <div class="py-2 row form-horizontal-center">
            <div class="rounded card-header text-center bg-primary text-white">
                Registrar Clientes
            </div>
            <form id="clienteForm" class="py-2 form-group shadow rounded" method="POST" action="registrar_clientes.php" onsubmit="return validarForm()">
                <div class="py-2 row">
                    <div class="mt-1 col-4">
                        <label for="nome">Nome</label>
                        <input type="text" class="mt-1 form-control" id="nome" name="nome" maxlength="115" required>
                    </div>
                    <div class="col-4">
                        <label for="documento">CPF / CNPJ</label>
                        <input type="text" class="mt-1 form-control" id="documento" name="documento" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18" required>
                    </div>
                    <div class="col-4">
                        <label for="idade">Idade</label>
                        <input type="text" class="mt-1 form-control" id="idade" name="idade" maxlength="3">
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-4">
                        <label for="cep">CEP</label>
                        <input type="text" class="mt-1 form-control" id="cep" name="cep" maxlength="8">
                    </div>
                    <div class="col-4">
                        <label for="estado">Estado</label>
                        <input type="text" class="mt-1 form-control" id="estado" name="estado" maxlength="19" required>
                    </div>
                    <div class="col-4">
                        <label for="cidade">Cidade</label>
                        <input type="text" class="mt-1 form-control" id="cidade" name="cidade" maxlength="32" required>
                    </div>
                </div>
                <div class="py-2 row">
                    <div class="col-4">
                        <label for="bairro">Bairro</label>
                        <input type="text" class="mt-1 form-control" id="bairro" name="bairro" maxlength="255" required>
                    </div>
                    <div class="col-4">
                        <label for="rua">Rua</label>
                        <input type="text" class="mt-1 form-control" id="rua" name="rua" maxlength="255" required>
                    </div>
                    <div class="col-4">
                        <label for="numero">N°</label>
                        <input type="text" class="mt-1 form-control" id="numero" name="numero" maxlength="5">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label for="complemento">Complemento</label>
                        <input type="text" class="mt-1 form-control" id="complemento" name="complemento" maxlength="255">
                    </div>
                </div>
            <div class="py-2 row">
                <div class="col-4">
                    <label for="telefone">Telefone</label>
                    <input type="text" class="mt-1 form-control" id="telefone" name="telefone" required>
                </div>
                <div class="col-8">
                    <label for="email">E-mail</label>
                    <input type="email" class="mt-1 form-control" id="email" name="email" maxlength="255">
                </div>
            </div>
            <div class="py-2 row">
                <div class="col-4">
                    <label for="item">Item</label>
                    <input type="text" class="mt-1 form-control" id="item" name="item" maxlength="255" required>
                </div>
                <div class="col-4">
                    <label for="valor">Valor</label>
                    <input type="text" class="mt-1 form-control" id="valor" name="valor" maxlength="16">
                </div>
                <div class="col-4">
                    <label for="pagamento">Pagamento</label>
                    <select class="mt-1 form-select" id="pagamento" name="pagamento" >
                        <option value="" hidden></option>
                        <option value="Alugado">Alugado</option>
                        <option value="Crédito">Cartão de Crédito</option>
                        <option value="PIX">PIX</option>
                        <option value="Débito">Cartão de Débito</option>
                        <option value="Dinheiro">Dinheiro</option>
                        <option value="Boleto">Boleto</option>
                    </select>
                </div>
            </div>
                <div class="py-3 text-center ">
                    <button type="reset" class="btn btn-danger me-4" id="limpar" >Limpar</button>
                    <button type="submit" id="submit" name="submit" class="btn btn-success" onclick="card();">Enviar</button>
                </div>
                <div class="py-3 text-black text-center footer "> Precisa de Ajuda? 
                    <a href="https://api.whatsapp.com/send/?phone=558192385712&text=Olá,%20Estou%20Precisando%20de%20Suporte%20no%20Sistema%20da%20Locamedic." target="_blank">Clique Aqui</a>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.16/dist/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="scripts/reg_clientes.js"></script>
</html>