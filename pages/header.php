<?php require 'config.php';
    require 'classes/usuarios.class.php';
    $usuario = new Usuario();
?>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Classificados</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark" style="margin-bottom: 17px; border-radius: 3px">
            <a class="navbar-brand" href="./">
                <img src="assets/images/logo/logo.jpg" width="60" height="30" class="d-inline-block align-top" alt="">
            </a>
        <?php if(isset($_SESSION['login']) && !empty($_SESSION['login'])){
            $id = $_SESSION['login'];
            $usuarioLogado = $usuario->userLogado($id);
        }
        ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Menu" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="Menu">
            <ul class="navbar-nav">
                <?php if(isset($_SESSION['login']) && !empty($_SESSION['login'])): ?>
                    <a class="navbar-brand text-white">Olá, <?php echo strtok($usuarioLogado, ' ');?>!</a>
                    <a class="navbar-brand text-white" href="./">Classificados</a>
                    <li class="nav-item"><a class="navbar-brand text-white" href="meus-anuncios.php">Meus anúncios</a></li>
                    <li class="nav-item"><a class="navbar-brand text-white" href="sair.php">Sair</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="navbar-brand text-white" href="cadastre-se.php">Cadastre-se</a></li>
                    <li class="nav-item"><a class="navbar-brand text-white" href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
