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
            </div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="url_video" class="control-label">Link</label>
                            <input 
                                type="url"
                                name="url_video"
                                id="url_video"
                                value="<?= $object['link'] ?>"
                                class="form-control input required" 
                                required 
                                placeholder="Informe uma URL válida..." />
                    </div>
                </div>
            </div>
        </div>

        <?php include "03-button.php"; ?>
        <?php include "04-javaScript.php"; ?>
    </form>
</div>

