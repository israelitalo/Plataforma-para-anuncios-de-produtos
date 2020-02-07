<?php require 'pages/header.php';?>
<?php
if(empty($_SESSION['login'])){
    ?>
    <script type="text/javascript">window.location.href="login.php";</script>
    <?php
    exit;
}
?>
<html>
<body>
<div class="container">

    <div class="modal-header bg-light" style="margin-bottom: 20px">
        <h2>Editar anúncio</h2>
    </div>

    <?php
    require 'classes/anuncios.class.php';
    $anuncio = new Anuncios();

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $info = $anuncio->getAnuncio($_GET['id']);
    }
    else{
        ?>
        <script type="text/javascript">window.location.href="meus-anuncios.php";</script>
        <?php
        exit;
    }

    if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
        $titulo = addslashes($_POST['titulo']);
        $categoria = addslashes($_POST['categoria']);
        $valor = addslashes($_POST['valor']);
        $descricao = addslashes($_POST['descricao']);
        $estado = addslashes($_POST['estado']);

        if(isset($_FILES['fotos'])){
            $fotos = $_FILES['fotos'];
        }else{
            $fotos = array();
        }

        if($anuncio->alterarAnuncio($titulo, $categoria, $valor, $descricao, $estado, $fotos, $_GET['id']) == true){
            ?>
            <div class="alert alert-success">
                Anúncio alterado com sucesso.
            </div>
            <?php
        }else{
            ?>
            <div class="alert alert-warning">
                Erro ao alterar anúncio.
            </div>
            <?php
        }
    }

    ?>
    <form method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" é necessário para o form aceitar imagens-->
        <div class="form-group">
            <label for="categoria">Categoria</label>
            <div>
                <select class="form-control" name="categoria" id="categoria" required>
                    <?php
                    require 'classes/categorias.class.php';
                    $categ = new Categorias();
                    $categorias = $categ->getCategorias();
                    foreach ($categorias as $categoria):
                        ?>
                        <option value="<?php echo $categoria['id']; ?>" <?php echo ($info['id_categoria']==$categoria['id'])?'selected="selected"':''; ?> > <?php
                            echo utf8_encode($categoria['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="titulo">Título</label>
            <div>
                <input class="form-control" placeholder="Título do anúncio" name="titulo" id="titulo" value="<?php echo $info['titulo']; ?> " required />
            </div>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <div>
                <input class="form-control" placeholder="R$" name="valor" id="valor" value="<?php echo $info['valor']; ?> " required />
            </div>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <div>
                <textarea class="form-control" placeholder="Descreva aqui seu anúncio" name="descricao" id="descricao" required style="height: 100px"><?php echo $info['descricao']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="estado">Estado de conservação</label>
            <div>
                <select class="form-control" name="estado" id="estado" required>
                    <option value="0" <?php echo ($info['estado']=='0')?'selected="selected"':''; ?>>Ruim</option>
                    <option value="1" <?php echo ($info['estado']=='1')?'selected="selected"':''; ?>>Bom</option>
                    <option value="2" <?php echo ($info['estado']=='2')?'selected="selected"':''; ?>>Excelente</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="foto">Adicionar fotos</label><br/>
            <input type="file" name="fotos[]" multiple style="padding-bottom: 25px"/>

            <?php
                if(isset($_SESSION['msgFoto']) && !empty($_SESSION['msgFoto'])){
                    if($_SESSION['msgFoto'] == "Imagem excluída com sucesso."){
                        ?>
                        <div class="alert alert-success">
                            Imagem excluída com sucesso.
                        </div>
                        <?php
                    }elseif($_SESSION['msgFoto'] == "Erro ao tentar excluir imagem."){
                        ?>
                        <div class="alert alert-warning">
                            Erro ao tentar excluir imagem.
                        </div>
                        <?php
                    }
                    unset($_SESSION['msgFoto']);
                }
            ?>

            <div class="card border-secondary mb-3">
                <br/>
                <div class="card-header bg-secondary text-white">Fotos do Anúncio</div>
                <div class="card-body bg-light">
                    <?php foreach ($info['fotos'] as $foto):?>
                    <div class="foto_item">
                        <img src="assets/images/anuncios/<?php echo $foto['url']; ?>" border="0" /><br/><br/>
                        <a class="btn btn-outline-danger" href="excluir-foto.php?id=<?php echo $foto['id']; ?>">Excluir imagem</a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div style="margin-bottom: 20px">
            <button type="submit" class="btn btn-outline-primary">Alterar anúncio</button>
        </div>
    </form>

</div>

<?php require 'pages/footer.php';?>
