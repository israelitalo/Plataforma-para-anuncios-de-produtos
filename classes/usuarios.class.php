<?php
    class Usuario {

        public function cadastrar($nome, $email, $senha, $telefone){
            global $pdo;
            $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
            $sql->bindValue(":email", $email);
            $sql->execute();

            if($sql->rowCount() == 0){

                $sql = $pdo->prepare("INSERT INTO usuarios SET nome = :nome, email = :email, senha =
                       :senha, telefone = :telefone");
                $sql->bindValue(":nome", $nome);
                $sql->bindValue(":email", $email);
                $sql->bindValue(":senha", md5($senha));
                $sql->bindValue(":telefone", $telefone);
                $sql->execute();

                return true;
            }else{
                return false;
            }
        }

        public function login($email, $senha){
            global $pdo;
            $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email AND senha = :senha");
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", md5($senha));
            $sql->execute();

            if($sql->rowCount() > 0){
                $dado = $sql->fetch();
                $_SESSION['login'] = $dado['id'];
                return true;
            }else{
                return false;
            }
        }

        public function userLogado($id){
            global $pdo;
            $sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $nome = $sql->fetch();
                return $nome['nome'];
            }else{
                return false;
            }
        }

        public function getQtdUsuarios(){
            global $pdo;
            $sql = $pdo->query("SELECT COUNT(*) as quantidadeUsuarios FROM usuarios");
            $row = $sql->fetch();

            return $row['quantidadeUsuarios'];
        }

    }
?>
