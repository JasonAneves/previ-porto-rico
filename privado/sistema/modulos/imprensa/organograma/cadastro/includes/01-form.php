<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" data-toggle="validator" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Informações Gerais</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="titulo" class="control-label">Título</label>
                        <input type="text" 
                               name="descricao"
                               id="descricao"
                               value="<?= $object['descricao'] ?>"
                               class="form-control input required" 
                               required 
                               placeholder="Informe o título..." />
                    </div>
                </div>
            </div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <div class="input-group">
                            <span class="input-group-btn" >
                                <span class="btn btn-primary btn-file input">
                                    <i class="fa fa-save fa-2x"></i>
                                    <input type="file"
                                           name="arquivo"
                                           id="arquivo"
                                           accept="application/pdf, image/jpeg, image/png"
                                           <?= (!$object['arquivo']) ? 'required' : '' ?> />
                                </span>
                            </span>
                            <input type="text"
                                   id="input-anexo"
                                   class="form-control input"
                                   value="<?= empty($object['arquivo']) ? '' : $object['arquivo'] ?>"
                                   placeholder="Selecione o arquivo..."
                                   readonly>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 div-despesa-file form-group">
                        <?php if(!empty($object['arquivo'])) { ?>
                            <a  href="<?= $CAMINHOIMG ?>/<?= $object['arquivo'] ?>"
                                class="btn btn-info btn-upload-file-trash"
                                target="_blank"
                                data-toggle="tooltip"
                                data-placement="left"
                                title="Visualizar Anexo">
                                <i class="fa fa-search"></i>
                            </a>
                            <a  href="#"
                                onclick="excluir_anexo(this, 'arquivo');"
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
                <br>
            </div>
        </div>
        <?php include "03-button.php"; ?>
        <?php include "04-javaScript.php"; ?>
    </form>
</div>