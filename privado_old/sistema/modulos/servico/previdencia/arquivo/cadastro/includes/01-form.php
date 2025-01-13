<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span> Informações Gerais</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="categoria" class="control-label">Categoria</label>
                            <div class="input-group">
                                <span class="input-group-addon input">
                                    <a  href="#" onclick="popup('<?= $publicoSistema ?>/popup/<?= $tabelaCategoria ?>.php?tela=<?= $tela ?>')"
                                        <i class="fa fa-search"></i>
                                    </a>
                                </span>
                                <input
                                        type="hidden"
                                        name="id_categoria"
                                        id="id_categoria"
                                        value="<?= $object['id_categoria'] ?>"  />
                                <input
                                        type="text"
                                        name="categoria"
                                        id="categoria"
                                        value="<?= $object['categoria'] ?>"
                                        class="form-control input required"
                                        placeholder="Selecione uma categoria..."
                                        required  />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 15px;">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="subcategoria" class="control-label">Subcategoria</label>
                            <div class="input-group">
                                <span class="input-group-addon input">
                                    <a  href="#" onclick="popup('<?= $publicoSistema ?>/popup/<?= $tabelaSubcategoria ?>.php?tela=<?= $tela ?>&id_categoria='+jQuery('#id_categoria').val(), 'Subcategorias')">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </span>
                                <input
                                        type="hidden"
                                        name="id_subcategoria"
                                        id="id_subcategoria"
                                        value="<?= $object['id_subcategoria'] ?>"  />
                                <input
                                        type="text"
                                        name="subcategoria"
                                        id="subcategoria"
                                        value="<?= $object['subcategoria'] ?>"
                                        class="form-control input required"
                                        placeholder="Selecione uma subcategoria..."  readonly/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 15px;">
                    <div class="col-sm-12 form-group">
                        <label for="titulo" class="control-label">Título</label>
                        <input
                            type="text"
                            name="titulo"
                            id="titulo"
                            value="<?= $object['titulo'] ?>"
                            class="form-control input required"
                            required
                            placeholder="Informe a descrição..." />
                    </div>
                    <div class="col-sm-12 form-group">
                        <label for="artigo" class="control-label">Artigo</label>
                        <textarea
                            name="artigo"
                            id="artigo"
                            class="form-control editor"
                            required><?= $object['artigo'] ?>
                        </textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-form">
            <div class="card-form-topico"><span> Anexos Relacionados</span></div>
            <div class="card-form-body">
                <?php include $classes."/galerias/anexo.php"; ?>
            </div>
        </div>

        <div class="card-form">
            <div class="card-form-topico"><span> Galeria de Fotos</span></div>
            <div class="card-form-body">
                <?php require $classes."/galerias/foto.php"; ?>
            </div>
        </div>

        <div class="card-form">
            <div class="card-form-topico"><span> Galeria de Vídeos</span></div>
            <div class="card-form-body">
                <?php include $classes."/galerias/video.php"; ?>
            </div>
        </div>
        <?php include "03-button.php"; ?>
        <?php include "04-javaScript.php"; ?>
    </form>
</div>