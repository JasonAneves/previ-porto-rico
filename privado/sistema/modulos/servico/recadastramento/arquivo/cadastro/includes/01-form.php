<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Informações Gerais</span></div>
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
                                    value="<?= $object['descricao'] ?>" 
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
                                            <input type="file" name="arquivo" id="arquivo">
                                        </span>
                                    </span>
                                    <input type="text" class="form-control input" readonly placeholder="Selecione um arquivo...">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3 div-despesa-file form-group">
                                <?php if(!empty($object['arquivo'])) { ?>
                                    <a  href="<?= $CAMINHOANEXO ?>/<?= $object['arquivo'] ?>"
                                        class="btn btn-info btn-upload-file-info" 
                                        target="_blank"
                                        data-toggle="tooltip"
                                        data-placement="left" 
                                        title="Baixar Anexo">
                                        <i class="fa fa-cloud-download"></i>
                                    </a>
                                    <a  href="#" onclick="excluirArquivo('<?= $id ?>', '<?= $tabela ?>', 'arquivo', 'arquivo', '<?= $caminhoTela ?>&id=<?= $id ?>&s=alterar');"
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