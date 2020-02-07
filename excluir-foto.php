<?php
require 'config.php';

    if(empty($_SESSION['login'])){
        header('Location: login.php');
        exit;
    }

    require 'classes/anuncios.class.php';
    $anuncio = new Anuncios();

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = addslashes($_GET['id']);
        if($id_anuncio = $anuncio->excluirImagemAnuncio($id)){
            $_SESSION['msgFoto'] = "Imagem excluída com sucesso.";
        }else{
            $_SESSION['msgFoto'] = "Erro ao tentar excluir imagem.";
        }
    }

    if(isset($id_anuncio)){
        header("Location: editar-anuncio.php?id=".$id_anuncio);
    }else{
        header("Location: editar-anuncio.php");
    }

?>
