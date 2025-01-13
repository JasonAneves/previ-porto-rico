<style>
  .artigo {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .titulo {
    font: normal normal bold 40px/67px Roboto;
    display: contents;
  }

  .titulo::after{
    content: "";
    width: 180px;
    height: 4px;
    background: #007cc2;
    display: block;
  }

  .panel-body {
    padding-left: 15px;
  }
</style>
<?php
  $qryPerguntas = Conexao::chamar()->prepare("SELECT * FROM pergunta_frequente WHERE status_registro = :status_registro AND id_cliente = :cliente");
  $qryPerguntas->bindValue(":status_registro", "A", PDO::PARAM_STR);
  $qryPerguntas->bindValue(":cliente", $idCliente, PDO::PARAM_STR);
  $qryPerguntas->execute();
  $stPerguntas = $qryPerguntas->fetchAll(PDO::FETCH_ASSOC);
  $count = 1;
?>
<div class="container" style="min-height: 500px;">
  <div class="artigo mt-4 mb-4">
    <h1 class="titulo">Perguntas Frequentes</h1>
  </div>

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 lista-mapa">
      <?php foreach ($stPerguntas as $key => $perguntas) { ?>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#<?=$count?>">
                        <i class="fa fa-question-circle"></i>
                          <span class="acessibilidade" style="font-weight: 600;font-size: 16px; "><?=$perguntas["titulo"]?></span>
                        <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
                      </a>
                    </h4>
                </div>
                <div id="<?=$count?>" class="panel-collapse collapse">
                    <div class="panel-body">
                      <div class="acessibilidade panel-body">
                        <?=$perguntas['artigo']?>
                      </div>
                    </div>
                </div>
            </div>
        </div> 
      <?php $count++; } ?>
    </div>
      
  </div>
</div>
