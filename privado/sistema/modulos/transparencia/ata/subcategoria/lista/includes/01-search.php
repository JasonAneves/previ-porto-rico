<?php
$statusRegistro = '';
$descricao = '';
$id_categoria = '';
$categoria = '';
?>

<form class="form-horizontal collapse" id="form-busca" action="<?= $caminhoTela ?>" method="POST">
    <div class="card-form">
		<div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Localizar Registro</span></div>
		<div class="card-form-body">
            <div style="margin: 15px;">
                <div class="form-group">
                    <div class="col-sm-12">
                    <label for="categoria" class="control-label">Categoria</label>
                        <div class="input-group"> 
                            <span class="input-group-addon input">
                                <a  href="#" onclick="popup('<?= $publicoSistema ?>/popup/ata_categoria.php?tela=<?= $tela ?>')"
                                    <i class="fa fa-search"></i>
                                </a>
                            </span>
                            <input 
                                type="hidden" 
                                name="id_categoria"
                                id="id_categoria"
                                value="<?= $id_categoria ?>"  />
                            <input 
                                type="text" 
                                name="categoria"
                                id="categoria"
                                value="<?= $categoria ?>" 
                                class="form-control input required" 
                                placeholder="Selecione uma categoria..." />
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-12">
                        <label for="descricao" class="control-label">Descricao</label>
                        <input 
                            type="text" 
                            name="descricao" 
                            id="descricao" 
                            class="form-control input" 
                            value="<?= $descricao ?>" 
                            placeholder="Informe o Descrição..." />
                    </div>
                </div>

                <?php if($idUsuarioMaster) { ?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label class="radio-inline">
                                <input 
                                    type="radio" 
                                    name="status_registro" 
                                    id="status_registro_0" 
                                    value="A" <? if(empty($statusRegistro) || $statusRegistro == "A") echo "checked"; ?>> 
                                    Registros Ativos
                            </label>
                            <label class="radio-inline">
                                <input 
                                    type="radio" 
                                    name="status_registro" 
                                    id="status_registro_1" 
                                    value="I" <? if($statusRegistro == "I") echo "checked"; ?>> 
                                    Registros Excluídos
                            </label>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="div-button-search">
        <div class="form-group">
            <div class="col-sm-12">
                <input 
                    type="hidden" 
                    name="acao" 
                    value="busca" />
                <button 
                    type="submit" 
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-search"></i> Pesquisar
                </button>
                <button 
                    type="button" 
                    data-toggle="collapse" 
                    data-target="#form-busca" 
                    class="btn btn-sm btn-warning">
                    <i class="fa fa-ban"></i> Cancelar
                </button>
            </div>
        </div>
    </div>
</form>