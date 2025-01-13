<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Informações Gerais</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="categoria" class="control-label">Categoria N&iacute;vel 01</label>
                            <div class="input-group">
                                <span class="input-group-addon input">
                                    <a  href="#" onclick="popup('<?= $publicoSistema ?>/popup/transparencia_categoria_1.php?tela=<?= $tela ?>')">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </span>
                                <input 
                                    type="hidden" 
                                    name="id_nivel1"
                                    id="id_nivel1"
                                    value="<?= $object['id_nivel1'] ?>"  />
                                <input 
                                    type="text" 
                                    name="categoria_1"
                                    id="categoria_1"
                                    value="<?= $object['categoria_1'] ?>"
                                    class="form-control input required" 
                                    placeholder="Selecione uma categoria nivel 01..." 
                                    required  />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 15px;">
                    <div class="form-group">
                        <div class="col-sm-12">
                        <label for="subcategoria" class="control-label">Categoria N&iacute;vel 02</label>
                            <div class="input-group">
                                <span class="input-group-addon input">
                                    <a  href="#" onclick="popup('<?= $publicoSistema ?>/popup/transparencia_categoria_2.php?tela=<?= $tela ?>&id_nivel1='+jQuery('#id_nivel1').val(), 'Categorias N&iacute;vel 02')">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </span> 
                                <input 
                                    type="hidden" 
                                    name="id_nivel2"
                                    id="id_nivel2"
                                    value="<?= $object['id_nivel2'] ?>"  />
                                <input 
                                    type="text" 
                                    name="categoria_2"
                                    id="categoria_2"
                                    value="<?= $object['categoria_2'] ?>"
                                    class="form-control input" 
                                    placeholder="Selecione uma categoria nivel 02..." readonly/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 15px;">
                    <div class="form-group">
                        <div class="col-sm-12">
                        <label for="subcategoria" class="control-label">Categoria N&iacute;vel 03</label>
                            <div class="input-group">
                                <span class="input-group-addon input">
                                <a  href="#" onclick="popup('<?= $publicoSistema ?>/popup/transparencia_categoria_3.php?tela=<?= $tela ?>&id_nivel1='+jQuery('#id_nivel1').val()+'&id_nivel2='+jQuery('#id_nivel2').val(), 'Categorias N&iacute;vel 03')">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </span> 
                                <input 
                                    type="hidden" 
                                    name="id_nivel3"
                                    id="id_nivel3"
                                    value="<?= $object['id_nivel3'] ?>"  />
                                <input 
                                    type="text" 
                                    name="categoria_3"
                                    id="categoria_3"
                                    value="<?= $object['categoria_3'] ?>"
                                    class="form-control input" 
                                    placeholder="Selecione uma categoria nivel 03..." readonly/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 15px;">
                    <div class="col-sm-12 form-group">
                        <label for="descricao" class="control-label">Descrição</label>
                            <input 
                                type="text" 
                                name="descricao" 
                                id="descricao" 
                                value="<?= $object['descricao'] ?>" 
                                class="form-control input required" 
                                placeholder="Informe a descrição..."
                                required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <div class="input-group">
                                    <span class="input-group-btn" >
                                        <span class="btn btn-primary btn-file input">
                                            <i class="fa fa-folder-open"></i> Selecionar&hellip;
                                            <input type="file" name="arquivo" id="arquivo" <?= (!$object['arquivo']) ? 'required' : '' ?>>
                                        </span>
                                    </span>
                                    <input type="text" class="form-control input" readonly placeholder="Selecione um arquivo...">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3 div-despesa-file form-group">
                                <?php if(!empty($object['arquivo'])) { ?>
                                    <a  href="<?= $caminhoAnexo ?>/<?= $object['arquivo'] ?>"
                                        class="btn btn-info btn-upload-file-info" 
                                        target="_blank" 
                                        data-toggle="tooltip" 
                                        data-placement="left" 
                                        title="Baixar Anexo">
                                        <i class="fa fa-cloud-download"></i>
                                    </a>
                                    <a  href="#" onclick="excluirArquivo('<?= $id ?>', 'transparencia_arquivo', 'arquivo', 'arquivo', '<?= $caminhoTela ?>&id=<?= $id ?>&s=alterar');"
                                        type="button" 
                                        class="btn btn-danger btn-upload-file-trash" 
                                        data-toggle="tooltip" 
                                        data-placement="left" 
                                        title="Excluir Anexo">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "03-button.php"; ?>
        <?php include "04-javaScript.php"; ?>
    </form>
</div>