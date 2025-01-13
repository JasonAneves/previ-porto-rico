<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span>&nbsp;Informações Gerais</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-4 form-group">
                        <label for="titulo" class="control-label">Data</label>
                        <div class="input-group date">
                            <input
                                    type="text"
                                    name="data"
                                    id="data"
                                    value="<?= $object['data'] == '0000-00-00 00:00:00' ? '' : formata_data_hora($object['data']) ?>"
                                    class="form-control data input"
                            />
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-8 form-group">
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
            <div class="card-form-topico"><span> Galeria de Fotos</span></div>
            <div class="card-form-body">
                <?php require $classes."/galerias/foto.php"; ?>
            </div>
        </div>
        <?php include "03-button.php"; ?>
        <?php include "04-javaScript.php"; ?>
    </form>
</div>