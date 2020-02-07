<?php
require 'config.php';
if(empty($_SESSION['login'])){
    header("Location: login.php");
    exit;
}
    require 'classes/anuncios.class.php';
    $anuncio = new Anuncios();

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = addslashes($_GET['id']);
        if($anuncio->excluirAnuncio($id) == true){
            $_SESSION['msg'] = "Anúncio excluído com sucesso.";
        }else{
            $_SESSION['msg'] = "Erro ao tentar excluir anúncio.";
        }
        header("Location: meus-anuncios.php");
    }
?>
