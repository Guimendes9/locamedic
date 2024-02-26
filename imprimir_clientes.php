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
        while ($user_data = mysqli_fetch_assoc($result)) {
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

?>
<!DOCTYPE html>
<html lang="pt-br">
<head class="no-print">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Imprimir Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="css/imprimir_clientes.css">
</head>
<body class="py-2 bg-light">
    <div id="print-header" style="display: none;"></div>
    <div class="container text-center ">
        <div class="btn-group">
            <a href="registros_clientes.php" class="no-print btn bg-primary text-white">Voltar</a>
        </div>
    </div>
    <div class="container mt-3 bg-light">
        <div class="py-2 row form-horizontal-center">
            <div class="no-print rounded card-header text-center bg-primary text-white ">
                Cadastro de Cliente
            </div>
            <form class="py-2 form-group shadow rounded" method="POST">
                <fieldset disabled="disabled">

                    <div class="py-2 row">
                        <div class="mt-1 col-4">
                            <label for="nome">Nome</label>
                            <input type="text" class="mt-1 form-control" id="nome" name="nome" value="<?php echo $nome ?>"
                            required>
                        </div>
                        <div class="col-4">
                            <label for="documento">CPF / CNPJ</label>
                            <input type="text" class="mt-1 form-control" id="documento" name="documento" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18"
                            value="<?php echo $documento ?>" required>
                        </div>
                        <div class="col-4">
                            <label for="idade">Idade</label>
                            <input type="text" class="mt-1 form-control" id="idade" name="idade"
                            value="<?php echo $idade ?>">
                        </div>
                    </div>
                    <div class="py-2 row">
                        <div class="col-4">
                            <label for="cep">CEP</label>
                            <input type="text" class="mt-1 form-control" id="cep" name="cep" value="<?php echo $cep ?>">
                        </div>
                        <div class="col-4">
                            <label for="estado">Estado</label>
                            <input type="text" class="mt-1 form-control" id="estado" name="estado"
                            value="<?php echo $estado ?>">
                        </div>
                        <div class="col-4">
                            <label for="cidade">Cidade</label>
                            <input type="text" class="mt-1 form-control" id="cidade" name="cidade"
                            value="<?php echo $cidade ?>">
                        </div>
                    </div>
                    <div class="py-2 row">
                        <div class="mt-1 col-4">
                            <label for="bairro">Bairro</label>
                            <input type="text" class="mt-1 form-control" id="bairro" name="bairro"
                            value="<?php echo $bairro ?>">
                        </div>
                        <div class="col-4">
                            <label for="rua">Rua</label>
                            <input type="text" class="mt-1 form-control" id="rua" name="rua" value="<?php echo $rua ?>">
                        </div>
                        <div class="col-4">
                            <label for="numero">N°</label>
                            <input type="text" class="mt-1 form-control" id="numero" name="numero"
                            value="<?php echo $numero ?>">
                        </div>
                    </div>
                    <div class="py-2 row">
                        <div class="mt-1 col-12">
                            <label for="complemento">Complemento</label>
                            <input type="text" class="mt-1 form-control" id="complemento" name="complemento"
                            value="<?php echo $complemento ?>">
                        </div>
                    </div>
                    <div class="py-2 row">
                        <div class="col-4">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="mt-1 form-control" id="telefone" name="telefone"
                            value="<?php echo $telefone ?>" required>
                        </div>
                        <div class="col-8">
                            <label for="email">E-mail</label>
                            <input type="email" class="mt-1 form-control" id="email" name="email"
                            value="<?php echo $email ?>" required>
                        </div>
                    </div>
                    <div class="py-2 row">
                        <div class="col-4">
                            <label for="item">Item</label>
                            <input type="text" class="mt-1 form-control" id="item" name="item" value="<?php echo $item ?>" required>
                        </div>
                        <div class="col-4">
                            <label for="valor">Valor</label>
                            <input type="text" class="mt-1 form-control" id="valor" name="valor"
                            value="<?php echo $valor ?>">
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
                    </fieldset>
                    <div class="no-print py-3 text-center">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <button type="button" id="imprimir" name="imprimir" class="btn btn-success" onclick="window.print()">Imprimir</button>
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
<script src="scripts/imprimir_clientes.js"></script>
</html>