<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_STATIC ?>styles/style.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="/redesocial/RedeSocial/Views/pages/styles/style.css"> -->
    <title>Login na Rede Social</title>
</head>

<body>
    <div class="sidebar"></div>
    <div class="form-container-login">
        <div class="logo-chamada-login">
            <h1 style="color: #490695;">A REDE</h1>
            <p>Conecte-se com seus amigos e expanda seus aprendizados com a nova rede social.</p>
        </div>
        <!--logo-chamada-login-->
        <div class="form-login">
            <form method="post">
                <input type="text" name="email" placeholder="email...">
                <input type="password" name="senha" placeholder="Senha...">
                <input type="submit" name="acao" value="Logar!">
                <input type="hidden" name="login">
            </form>
            <p><a href="<?php echo INCLUDE_PATH ?>registrar">Criar Conta</a></p>
        </div>
        <!--form-login-->
    </div>
</body>
</html>

