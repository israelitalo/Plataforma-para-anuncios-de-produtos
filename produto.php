<?php
    require 'pages/header.php';
    require 'classes/anuncios.class.php';
    $anuncio = new Anuncios();

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = addslashes($_GET['id']);
    }else{
        ?>
        <script type="text/javascript">window.location.href="index.php";</script>
        <?php
        exit;
    }

    $info = $anuncio->getAnuncio($id);
    $countInfo = count($info['fotos']);

?>

<div class="container-fluid">
    <div class="row" style="margin-right: 1px">
        <div class="col-sm-5">
            <!-- Carousel -->
            <div id="carousel" class="carousel slide" data-ride="carousel" data-interval="4000">
                <ol class="carousel-indicators">
                    <?php for($i=0;$i<$countInfo;$i++): ?>
                        <li data-target="#carousel" data-slide-to="<?php echo $i?>" class="<?php echo ($i==0)?'active':'' ;?>"></li>
                    <?php endfor; ?>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <?php if($countInfo == 0): ?>
                    <div class="carousel-item active">
                        <img height="350" class="d-block w-100" src="assets/images/anuncios/default.jpg" />
                    </div>
                    <?php else: ?>
                    <?php foreach ($info['fotos'] as $chave => $foto): ?>
                        <div class="carousel-item <?php echo ($chave=='0')?'active':''; ?>">
                            <img class="d-block w-100" src="assets/images/anuncios/<?php echo $foto['url']; ?>" />
                        </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
        <div class="col-sm-7 textoProduto">
            <h1><?php echo $info['titulo']; ?></h1>
            <h4><?php echo utf8_encode($info['categoria']); ?></h4>
            <p><?php echo $info['descricao']; ?></p>
            <br/>
            <h3>R$ <?php echo number_format($info['valor'], 2); ?></h3>
            <h5>Telefone: <?php echo $info['telefone']; ?></h5>
        </div>
    </div>
</div>

<?php require 'pages/footer.php';
