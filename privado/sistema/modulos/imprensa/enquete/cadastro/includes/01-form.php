<?php
    $stAlternativa = Conexao::chamar()->query("SELECT  *
                                                               FROM enquete_alternativa
                                                              WHERE id_enquete = '$id'");
    $stAlternativa->execute();
    $qryAlternativa = $stAlternativa->fetchAll(PDO::FETCH_ASSOC);
    $id_cliente = $buscaAdministrador['id_cliente'];
?>
<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" data-toggle="validator" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Informações Gerais</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="titulo" class="control-label">Título</label>
                        <input type="text" 
                               name="titulo"
                               id="titulo"
                               value="<?= $object['titulo'] ?>"
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
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;Alternativas
                </span>
                <i  class="fa fa-plus-circle pull-right btn-pesquisa"
                    data-toggle="modal"
                    data-target="#modal-alternativa"
                    aria-expanded="false"
                    aria-controls="form-busca"
                    title="Adicionar alternativa"
                    onclick="novaAlternativa()"
                    style="margin-right: 10px">
                </i>
            </div>
            <div class="card-form-body">
                <div id="alerta-alteracoes" style="margin-bottom: 10px;"></div>
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width: 80px"></th>
                        <th>Descricão</th>
                        <th>Votos</th>
                    </tr>
                    </thead>
                    <tbody id="tbody-alternativas" class="tr-alternativas"></tbody>
                </table>
            </div>
        </div>
        <?php include "03-button.php"; ?>
        <?php include "04-javaScript.php"; ?>
    </form>
</div>
