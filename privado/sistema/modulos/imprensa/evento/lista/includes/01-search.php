<?php
    $statusRegistro = '';
    $data = '';
    $titulo = '';
?>
<form class="form-horizontal collapse" id="form-busca" action="<?= $caminhoTela ?>" method="POST">
    <div class="card-form">
		<div class="card-form-topico"><span> Localizar Registro</span></div>
		<div class="card-form-body">
            <div style="margin: 15px;">
                <div class="form-group">
                    <div class="col-sm-6">
                        <label for="data" class="control-label">Data</label>
                        <div class="input-group date">
                            <input 
                                type="text" 
                                name="data"
                                id="data"
                                value="<?= formata_data($data) ?>"
                                class="form-control data input"/>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="titulo" class="control-label">Título</label>
                        <input 
                            type="text" 
                            name="titulo" 
                            id="titulo" 
                            class="form-control input" 
                            value="<?= $titulo ?>" 
                            placeholder="Informe o Título..." />
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
                                    value="A"> <? if(empty($statusRegistro) || $statusRegistro == "A") echo "checked"; ?>
                                    Registros Ativos
                            </label>
                            <label class="radio-inline">
                                <input 
                                    type="radio" 
                                    name="status_registro" 
                                    id="status_registro_1" 
                                    value="I"> <? if($statusRegistro == "I") echo "checked"; ?>
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