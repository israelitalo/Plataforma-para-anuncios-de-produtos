<?php require 'pages/header.php'; ?>
<?php
require 'classes/anuncios.class.php';
require 'classes/categorias.class.php';
    $anuncio = new Anuncios();
    $usuario = new Usuario();
    $categoria = new Categorias();

    $filtros = array(
        'categoria' => '',
        'preco' => '',
        'estado' => ''
    );

    if(isset($_GET['filtros'])){
        $filtros = $_GET['filtros'];
    }

    $categoria = $categoria->getCategorias();
    $totalAnuncios = $anuncio->getQtdAnuncios($filtros);
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
    $totalPaginas = ceil($totalAnuncios/$porPagina); //ceil garante que a quantidade de página será um numero inteiro.

?>
<div class="container-fluid">
    <div class="jumbotron">
        <h3 class="text-dark">Hoje temos <?php echo $totalAnuncios.' '.$novoAnuncio; ?></h3>
        <p class="text-dark font-weight-normal">E <?php echo $totalUsuarios.' '.$usuarioCadastrado; ?></p>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <h4>Busca avançada</h4>

                <form method="GET">
                    <div class="form-group">
                        <label for="categoria">Buscar por categoria</label>
                        <div>
                            <select class="custom-select" name="filtros[categoria]" id="categoria">
                                <option></option>
                            <?php foreach ($categoria as $categoria):?>
                                <option value="<?php echo $categoria['id']; ?>"
                                    <?php echo ($categoria['id']==$filtros['categoria'])?'selected="selected"':''; ?> >
                                    <?php echo utf8_encode($categoria['nome']); ?>
                                </option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="preco">Buscar por preço</label>
                        <div>
                            <select class="form-control" id="preco" name="filtros[preco]">
                                <option></option>
                                <option value="0-50" <?php echo ($filtros['preco']=='0-50')?'selected="selected"':'' ; ?> >R$ 0 - R$ 50</option>
                                <option value="51-500" <?php echo ($filtros['preco']=='51-500')?'selected="selected"':'' ; ?>">R$ 51 - R$ 500</option>
                                <option value="501-2000" <?php echo ($filtros['preco']=='501-2000')?'selected="selected"':'' ; ?>>R$ 501 - R$ 2000</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="estado">Buscar por estado de conservação</label>
                        <div>
                            <select class="form-control" id="estado" name="filtros[estado]">
                                <option></option>
                                <option value="1" <?php echo ($filtros['estado']=='1')?'selected="selected"':'' ; ?> >Ruim</option>
                                <option value="2" <?php echo ($filtros['estado']=='2')?'selected="selected"':'' ; ?> >Bom</option>
                                <option value="3" <?php echo ($filtros['estado']=='3')?'selected="selected"':'' ; ?> > Excelente</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Buscar" />
                    </div>
                </form>


        </div>
        <div class="col-sm-9" style="height: 250px; margin-bottom: 30px">
            <h4>Últimos anúncios</h4>
            <table class="table table-hover table-responsive-md">
                <caption>Lista de anúncios</caption>
                <thead>
                    <tr></tr>
                </thead>
                <tbody>
                    <?php $vetorAnuncio = $anuncio->getUltimosAnuncios($p, $porPagina, $filtros);
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
                        <td style="width: 30%; padding-top: 30px">R$ <?php echo number_format($anuncioIndex['valor'], 2,',','.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <ul class="pagination">
                <?php for($i=1;$i<=$totalPaginas;$i++): ?>
                    <li class="page-item <?php echo ($p==$i)?'active':'';?>"><a class="page-link" href="index.php?<?php
                        $get = $_GET;//Aqui passa tudo que há no $_GET para a variável get.
                        $get['p'] = $i;
                        echo http_build_query($get);//Transforma todos os itens que há em $_GET em url.
                    ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
    <br/>
</div>
<?php require 'pages/footer.php';?>
