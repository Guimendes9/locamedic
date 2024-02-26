<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/logar.css">
</head>
<body class="bg-light">
    <div class="card-header bg-primary text-center text-white">
        <div class="titulo-login">
            Acesso ao Sistema
        </div>
    </div>
    <form class="form-control shadow vh-100" action="login.php" method="POST">
        <div class="py-3">
            <div class="container">
                <div class="nome col-8 mx-auto py-2">
                    <label for="nome">Nome</label>
                    <input type="text" class="mt-1 form-control" id="nome" name="nome" placeholder="Usuário...">
                </div>
                <div class="senha col-8 mx-auto py-1 ">
                    <label for="senha">Senha</label>
                    <div class="input-group mb-3">
                        <input type="password" class="me-1 form-control" id="senha" name="senha" placeholder="12345...">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-black" id="mostrarSenha">
                                <i class="bi bi-eye-fill" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="button text-center entrar">
            <button type="submit" id="entrar" name="entrar" class="col-2 btn btn-primary">Entrar</button>
        </div>
        <div class="py-3 text-black text-center footer">
            Precisa de Ajuda? <a
                href="https://api.whatsapp.com/send/?phone=558192385712&text=Olá,%20Estou%20Precisando%20de%20Suporte%20no%20Sistema%20da%20Locamedic."
                target="_blank">Clique Aqui</a><br>
        </div>
    </form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<script src="scripts/logar.js"></script>
</html>