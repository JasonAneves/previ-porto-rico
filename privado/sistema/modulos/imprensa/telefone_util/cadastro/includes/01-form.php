<?php
    $stNumero = Conexao::chamar()->query("SELECT  *
                                                               FROM telefone_util_numero
                                                              WHERE id_telefone_util = '$id'");
    $stNumero->execute();
    $qryNumero = $stNumero->fetchAll(PDO::FETCH_ASSOC);
    $id_cliente = $buscaAdministrador['id_cliente'];
?>
<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" data-toggle="validator" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Local</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="descricao" class="control-label">Descrição</label>
                        <input type="text" 
                               name="descricao"
                               id="descricao"
                               value="<?= $object['descricao'] ?>"
                               class="form-control input required"
                               required 
                               placeholder="Informe o título..." />
                    </div>
                </div>
            </div>
        </div>

        <div class="card-form">
            <div class="card-form-topico">
                <span>
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;Números
                </span>
                <i  class="fa fa-plus-circle pull-right btn-pesquisa"
                    data-toggle="modal"
                    data-target="#modal-numero"
                    aria-expanded="false"
                    aria-controls="form-busca"
                    title="Adicionar Número"
                    onclick="novoNumero()"
                    style="margin-right: 10px">
                </i>
            </div>
            <div class="card-form-body">
                <div id="alerta-alteracoes" style="margin-bottom: 10px;"></div>
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 80px"></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="tbody-numeros" class="tr-numero"></tbody>
                </table>
            </div>
        </div>
        <?php include "03-button.php"; ?>
        <?php include "04-javaScript.php"; ?>
    </form>
</div>
