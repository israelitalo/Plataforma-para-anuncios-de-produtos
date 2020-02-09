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
        <h2>Meus anúncios</h2>
    </div>

    <?php
        if(isset($_SESSION['msg']) && !empty($_SESSION['msg'])){
            if($_SESSION['msg'] == "Anúncio excluído com sucesso!"){
                ?>
                <div class="alert alert-success"><?php echo $_SESSION['msg'];?></div>
                <?php
            }else if($_SESSION['msg'] == "Erro ao tentar excluir anúncio."){
                ?>
                <div class="alert alert-warning"><?php echo $_SESSION['msg']; ?></div>
                <?php
            }
            unset($_SESSION['msg']);
        }
    ?>

    <div style="margin-bottom: 20px">
        <a href="adicionar_anuncio.php" class="btn btn-primary">Adicionar anúncio</a>
    </div>

    <table class="table table-hover table-responsive-md"">
        <caption>Meus Anúncios</caption>
        <thead class="thead-dark">
            <tr>
            </tr>
        </thead>
        <?php
            require 'classes/anuncios.class.php';
            $anuncio = new Anuncios();
            $meusAnuncios = $anuncio->getMeusAnuncios();
            foreach ($meusAnuncios as $anuncios):
        ?>
        <tr>
            <td style="width: 250px">
                <?php if(!empty($anuncios['url'])): ?>
                <img src="assets/images/anuncios/<?php echo $anuncios['url']; ?>" border="0" height="60" width="100"/>
                <?php else: ?>
                <img src="assets/images/anuncios/default.jpg" border="0" height="60" width="100"/>
                <?php endif; ?>
            </td>
            <td style="padding-top: 30px"><?php echo $anuncios['titulo']; ?></td>
            <td style="padding-top: 30px">R$ <?php echo number_format($anuncios['valor'], 2,',','.'); ?></td>
            <td style="width: 200px; padding-top: 25px">
                <a class="btn btn-outline-secondary" href="editar-anuncio.php?id=<?php echo $anuncios['id']; ?>">Editar</a>
                <a class="btn btn-outline-danger" href="excluir-anuncio.php?id=<?php echo $anuncios['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require 'pages/footer.php';?>
