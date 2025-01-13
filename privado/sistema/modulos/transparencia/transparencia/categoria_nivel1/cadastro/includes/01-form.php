<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Informações Gerais</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="descricao" class="control-label">Descrição</label>
                            <input 
                                type="text" 
                                name="descricao" 
                                id="descricao" 
                                value="<?= $object['descricao'] ?>" 
                                class="form-control input required" 
                                required 
                                placeholder="Informe a descrição..." />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="link_categoria" class="control-label">Link</label>
                            <input 
                                type="url" 
                                name="link_categoria" 
                                id="link_categoria" 
                                value="<?= $object['link'] ?>" 
                                class="form-control input required url" 
                                placeholder="Informe uma URL válida..." />
                    </div>
                </div>
            </div>
        </div>
        <?php include "03-button.php"; ?>
        <?php include "04-javaScript.php"; ?>
    </form>
</div>