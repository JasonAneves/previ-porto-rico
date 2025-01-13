<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" data-toggle="validator" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span></i> Informações Gerais</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="titulo" class="control-label">Título</label>
                        <input type="text" 
                               name="titulo" 
                               id="titulo" 
                               value="<?= $object['titulo'] ?>" 
                               class="form-control input required" 
                               required 
                               placeholder="Informe o título..." />
                    </div>
                </div>
            </div> 
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="link_popup" class="control-label">Link</label>
                        <input type="url"
                               name="link_popup"   
                               id="link_popup" value="<?= $object['url'] ?>"
                               class="form-control input required" 
                               placeholder="Informe uma URL válida..." />
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
                                               name="foto"
                                               accept="image/jpeg, image/png"
                                               id="foto"
                                               <?= (!$object['foto']) ? 'required' : '' ?> />
                                    </span>
                                </span>
                            <input type="text"
                                   id="input-anexo"
                                   class="form-control input"
                                   readonly
                                   value="<?= empty($object['foto']) ? '' : $object['foto'] ?>"
                                   placeholder="Selecione o arquivo...">
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3 div-despesa-file form-group">
                        <?php if(!empty($object['foto'])) { ?>
                            <a  href="<?= $CAMINHOIMG ?>/<?= $object['foto'] ?>"
                                class="btn btn-info btn-upload-file-trash"
                                target="_blank"
                                data-toggle="tooltip"
                                data-placement="left"
                                title="Visualizar Anexo">
                                <i class="fa fa-search"></i>
                            </a>
                            <a  href="#"
                                onclick="excluir_anexo(this, 'foto');"
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

        <div class="card-form">
            <div class="card-form-topico"><span></i> Temporalidade </span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="titulo" class="control-label">Data de Inícial</label>
                        <div class="input-group date">
                            <input 
                                type="text" 
                                name="data_inicial" 
                                id="data_inicial" 
                                value="<?=  empty($id) ? date('d/m/Y') : formata_data($object['data_inicial']) ?>" 
                                class="form-control data input" 
                                required
                                />
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="hora_inicial" class="control-label">Hora de Início</label>
                        <input type="time"
                               name="hora_inicial" 
                               id="hora_inicial" 
                               value="<?=  empty($id) ? date('H:i') : $object['hora_inicial'] ?>" class="form-control input"/>
                    </div>
                </div>
            </div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="titulo" class="control-label">Data de Término</label>
                        <div class="input-group date">
                            <input 
                                type="text" 
                                name="data_limite" 
                                id="data_limite"
                                value="<?= empty($object['data_limite']) ? '' : formata_data($object['data_limite']) ?>"
                                class="form-control data input"/>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="titulo" class="control-label">Hora de Término</label>
                        <input type="time"
                               name="hora_limite" 
                               id="hora_limite"
                               value="<?= $object['hora_limite'] ?>"
                               class="form-control input"/>
                    </div>
                </div>
            </div>
        </div>
        <?php include "03-button.php"; ?>
        <?php include "04-javaScript.php"; ?>
    </form>
</div>