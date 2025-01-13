<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span> Informações Gerais</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-12 form-group">
                        <label for="tipo" class="control-label">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control input required" required>
                            <option value="">&raquo;&nbsp;Selecione</option>
                            <option value="U" <?= ($object["tipo"] == "U" ? "selected" : "") ?>>&Uacute;ltimas Not&iacute;cias</option>
                            <option value="F" <?= ($object["tipo"] == "F" ? "selected" : "") ?>>Foto Destaque</option>
                        </select>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label for="chapeu" class="control-label">Chapéu</label>
                        <input 
                            type="text" 
                            name="chapeu" 
                            id="chapeu" 
                            value="<?= $object['chapeu'] ?>" 
                            class="form-control input required" 
                            required 
                            placeholder="Informe a descrição..." />
                    </div>

                    <div class="col-sm-6 form-group">
                        <label for="fonte" class="control-label">Fonte</label>
                        <input 
                            type="text" 
                            name="fonte" 
                            id="fonte" 
                            value="<?= $object['fonte'] ?>" 
                            class="form-control input required" 
                            required 
                            placeholder="Informe a descrição..." />
                    </div>
                </div>
            </div>
        </div>

        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Temporalidade </span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="titulo" class="control-label">Data de Início</label>
                        <div class="input-group date">
                            <input
                                    type="text"
                                    name="data_inicial"
                                    id="data_inicial"
                                    value="<?= $object['data_inicial'] == '0000-00-00 00:00:00' ? '' : formata_data_hora($object['data_inicial']) ?>"
                                    class="form-control data input"
                            />
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="hora_inicial" class="control-label">Hora de Início</label>
                        <input type="time"
                               name="hora_inicial"
                               id="hora_inicial"
                               value="<?= $object['data_inicial'] == '0000-00-00 00:00:00' ? '' : formata_hora($object['data_inicial']) ?>" class="form-control input"/>
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
                                    value="<?= $object['data_inicial'] == '0000-00-00 00:00:00' ? '' : formata_data_hora($object['data_limite']) ?>"
                                    class="form-control data input"/>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="titulo" class="control-label">Hora de Término</label>
                        <input type="time"
                               name="hora_limite"
                               id="hora_limite"
                               value="<?= $object['data_inicial'] == '0000-00-00 00:00:00' ? '' : formata_hora($object['data_limite']) ?>"
                               class="form-control input"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-form">
            <div class="card-form-topico"><span> Artigo</span></div>
            <div class="card-form-body">
                <div class="row">
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