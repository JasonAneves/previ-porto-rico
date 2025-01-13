<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" data-toggle="validator" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Informações Gerais</span></div>
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
                            placeholder="Informe o título..." />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="titulo" class="control-label">Linha Fina</label>
                        <input
                            type="text"
                            name="linha_fina"
                            id="linha_fina"
                            value="<?= $object['linha_fina'] ?>"
                            class="form-control input required"
                            required
                            placeholder="Informe uma breve descrição..." />
                    </div>
                </div>
                <div class="col-sm-12 form-group" style="padding: 0 !important;">
                    <label for="titulo" class="control-label">Data de Publicação</label>
                    <div class="input-group date">
                        <input
                            type="text"
                            name="data_publicacao"
                            id="data_publicacao"
                            value="<?=  empty($id) ? date('d/m/Y') : formata_data($object['data_publicacao']) ?>"
                            class="form-control data input"
                            required />
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="card-form-body">
                <div class="card-form-topico"><span>Fotos</span></div>
                <div class="card-form-body">
                    <?php require $classes."/galerias/foto.php"; ?>
                </div>
            </div>
        </div>

        <?php include "03-button.php"; ?>
        <?php include "04-javaScript.php"; ?>
    </form>
</div>

