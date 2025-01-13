<?php
$statusRegistro = '';
$descricao = '';
$id_nivel1 = '';
$categoria_1 = '';
?>

<form class="form-horizontal collapse" id="form-busca" action="<?= $caminhoTela ?>" method="POST">
    <div class="card-form">
		<div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Localizar Registro</span></div>
		<div class="card-form-body">
            <div style="margin: 15px;">
                <div class="form-group">
                    <div class="col-sm-12">
                    <label for="categoria" class="control-label">Categoria N&iacute;vel 01</label>
                        <div class="input-group">
                            <span class="input-group-addon input">
                                <a  href="#" onclick="popup('<?= $publicoSistema ?>/popup/transparencia_categoria_1.php?tela=<?= $tela ?>')">
                                    <i class="fa fa-search"></i>
                                </a>
                            </span> 
                            <input 
                                type="hidden" 
                                name="id_nivel1"
                                id="id_nivel1"
                                value="<?= $id_nivel1 ?>"  />
                            <input 
                                type="text" 
                                name="categoria_1"
                                id="categoria_1"
                                value="<?= $categoria_1 ?>"
                                class="form-control input required" 
                                placeholder="Selecione uma categoria nivel 01..." />
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