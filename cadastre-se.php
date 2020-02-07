<?php require 'pages/header.php'; ?>
<div class="container">
    <div class="modal-header bg-light" style="margin-bottom: 20px">
        <h2>Cadastra-se</h2>
    </div>
    <?php
        /*require 'classes/usuarios.class.php';
        $usuario = new Usuario();*/
        if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])){
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $telefone = addslashes($_POST['telefone']);

            if(!empty($nome) && !empty($email) && !empty($senha)){
                if($usuario->cadastrar($nome, $email, $senha, $telefone) == true){
                    ?>
                    <div class="alert alert-success" style="margin-top: 20px">
                        Cadastro realizado com sucesso.
                        Fazer <a class="alert-link" href="login.php">login</a> agora.
                    </div>
                    <?php
                }
                else{
                    ?>
                    <div class="alert alert-warning" style="margin-top: 20px">
                        Usuário já cadastrado.
                        Fazer <a class="alert-link" href="login.php">login</a> agora.
                    </div>
                    <?php
                }
            }
            else{
                ?>
                <br/>
                <div class="alert alert-warning">
                    Erro ao cadastrar-se.
                </div>
                <?php
            }
        }
    ?>

    <form method="POST">
        <div class="form-group">
            <label for="nome">Nome</label>
            <div class="input-group">
                <input type="text" name="nome" id="nome" class="form-control" placeholder="Seu nome" required/>
            </div>
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <div class="input-group">
            <input type="email" name="email" id="email" class="form-control" placeholder="Seu e-mail" required/>
            </div>
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <div class="input-group">
            <input type="password" name="senha" id="senha" class="form-control" placeholder="Sua senha" required/>
            </div>
        </div>
        <div class="form-group">
            <label for="telefone">Telefone</label>
            <div class="input-group">
            <input type="tel" name="telefone" id="telefone" class="form-control" placeholder="Seu telefone"/>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-outline-secondary">Cadastrar</button>
        </div>
    </form>

</div>
<?php require 'pages/footer.php'; ?>
