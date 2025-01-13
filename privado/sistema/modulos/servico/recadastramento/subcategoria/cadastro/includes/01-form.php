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
                                    value="<?= $object['categoria'] ?>" 
                                    class="form-control input required" 
                                    placeholder="Selecione uma categoria..." 
                                    required  />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group" style="padding-top: 15px;">
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
            </div>
        </div>
        <?php include "03-button.php"; ?>
        <?php include "04-javaScript.php"; ?>
    </form>
</div>