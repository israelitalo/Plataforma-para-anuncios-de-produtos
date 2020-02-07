<?php require 'pages/header.php'; ?>
<?php
require 'classes/anuncios.class.php';
    $anuncio = new Anuncios();
    $usuario = new Usuario();

    $totalAnuncios = $anuncio->getQtdAnuncios();
    $totalUsuarios = $usuario->getQtdUsuarios();

    $novoAnuncio = 'novos anúncios.';
    $novoAnuncio = ($totalAnuncios > 1) ? 'novos anúncios.' : 'novo anúncio.';

    $usuarioCadastrado = 'usuários cadastrados.';
    $usuarioCadastrado = ($totalUsuarios > 1) ? 'usuários cadastrados.' : 'usuário cadastrado.';

    $p = 1;
    $porPagina = 2;
    if(isset($_GET['p']) && !empty($_GET['p'])){
        $p = addslashes($_GET['p']);
    }
    $totalPaginas = ceil($totalAnuncios/$porPagina);

?>
<div class="container-fluid">
    <div class="jumbotron">
        <h3 class="text-dark">Hoje temos <?php echo $totalAnuncios.' '.$novoAnuncio; ?></h3>
        <p class="text-dark font-weight-normal">E <?php echo $totalUsuarios.' '.$usuarioCadastrado; ?></p>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <h4>Busca avançada</h4>
        </div>
        <div class="col-sm-8" style="height: 250px; margin-bottom: 30px">
            <h4>Últimos anúncios</h4>
            <table class="table table-hover table-responsive-md">
                <caption>Lista de anúncios</caption>
                <thead>
                    <tr></tr>
                </thead>
                <tbody>
                    <?php
                        $vetorAnuncio = $anuncio->getUltimosAnuncios($p, $porPagina);
                        foreach ($vetorAnuncio as $anuncioIndex):
                    ?>
                    <tr>
                        <td style="width: 30%">
                            <?php if(!empty($anuncioIndex['url'])): ?>
                                <img src="assets/images/anuncios/<?php echo $anuncioIndex['url']; ?>" border="0" height="60"
                                     width="100"/>
                            <?php else: ?>
                                <img src="assets/images/anuncios/default.jpg" border="0" height="60" width="100"/>
                            <?php endif; ?>
                        </td>
                        <td style="width: 40%; padding-top: 20px">
                            <a class="badge badge-primary" href="produto.php?id=<?php echo $anuncioIndex['id'] ;?>"><?php echo $anuncioIndex['titulo']; ?></a><br/>
                            <?php echo utf8_encode($anuncioIndex['categoria']); ?>
                        </td>
                        <td style="width: 30%; padding-top: 30px">R$ <?php echo number_format($anuncioIndex['valor'], 2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <ul class="pagination">
                <?php for($i=1;$i<=$totalPaginas;$i++): ?>
                    <li class="page-item <?php echo ($p==$i)?'active':'';?>"><a class="page-link" href="index.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
    <br/>
</div>
<?php require 'pages/footer.php';?>
