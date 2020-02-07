<?php require 'pages/header.php'; ?>
<div class="container">

    <div class="modal-header bg-light" style="margin-bottom: 20px">
        <h2>Login</h2>
    </div>

    <?php
        /*require 'classes/usuarios.class.php';
        $usuario = new Usuario();*/

        if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){
            $email = addslashes($_POST['email']);
            $senha = $_POST['senha'];
            if($usuario->login($email, $senha) == true){
                ?>
                <script type="text/javascript">window.location.href="./";</script>
                <?php
            }
            else{
                ?>
                <div class="alert alert-danger">
                    Login não realizado. Verifique os dados e tente novamente.
                </div>
                <?php
            }
        }
    ?>

    <form method="POST">
        <div class="form-group">
            <label for="email">E-mail</label>
            <div class="input-group">
                <input class="form-control" type="email" placeholder="Seu e-mail" name="email" id="email" required />
            </div>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <div class="input-group">
                <input class="form-control" type="password" placeholder="Sua senha" name="senha" id="senha" required />
            </div>
        </div>
        <div class="flex-wrap">
            <button style="margin-right: 10px" type="submit" class="btn btn-outline-secondary">Logar</button>
            <button type="button" class="btn btn-outline-info">Esqueceu a senha?</button>
        </div>
    </form>

</div>

<?php require 'pages/footer.php'; ?>
