<?php require 'pages/header.php';?>
<?php
if(empty($_SESSION['login'])){
    ?>
    <script type="text/javascript">window.location.href="login.php";</script>
    <?php
    exit;
}
?>
<div class="container">

    <div class="modal-header bg-light" style="margin-bottom: 20px">
        <h2>Adicionar anúncio</h2>
    </div>

    <?php
        require 'classes/anuncios.class.php';
        if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
            $titulo = addslashes($_POST['titulo']);
            $categoria = addslashes($_POST['categoria']);
            $valor = addslashes($_POST['valor']);
            $descricao = addslashes($_POST['descricao']);
            $estado = addslashes($_POST['estado']);

            $anuncio = new Anuncios();
            if($anuncio->adicionarAnuncio($titulo, $categoria, $valor, $descricao, $estado) == true){
                ?>
                <div class="alert alert-success">
                    Anúncio adicionado com sucesso.
                </div>
                <?php
            }else{
                ?>
                <div class="alert alert-warning">
                    Erro ao adicionar anúncio.
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
                    <option value="<?php echo $categoria['id']?>">
                        <?php echo utf8_encode($categoria['nome']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="titulo">Título</label>
            <div>
                <input class="form-control" placeholder="Título do anúncio" name="titulo" id="titulo" required />
            </div>
        </div>
        <div class="form-group">
            <label for="valor">Valor</label>
            <div>
                <input class="form-control" placeholder="R$" name="valor" id="valor" required />
            </div>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <div>
                <textarea class="form-control" placeholder="Descreva aqui seu anúncio" name="descricao" id="descricao" required style="height: 100px"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="estado">Estado de conservação</label>
            <div>
                <select class="form-control" name="estado" id="estado" required>
                    <option value="1">Ruim</option>
                    <option value="2">Bom</option>
                    <option value="3">Excelente</option>
                </select>
            </div>
        </div>
        <div style="margin-bottom: 20px">
            <button type="submit" class="btn btn-outline-primary">Adicionar anúncio</button>
        </div>
    </form>

</div>

<?php require 'pages/footer.php';?>
