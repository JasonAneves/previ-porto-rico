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

  .panel-title span,
  .panel-body a {
    color: #333;
  }
</style>
<div class="row" style="margin:0;">
  <div class="container" style="min-height: 500px;">
    <div class="artigo mt-4 mb-4">
      <h1 class="titulo">Pesquisa de Satisfa&ccedil;&atilde;o</h1>
    </div>
<?php
  $qryCat = Conexao::chamar()->prepare("SELECT * FROM pesquisa_categoria WHERE id_cliente = '$idCliente' AND status_registro = 'A' ORDER BY descricao");
  $qryCat->execute();
  $BuscaCat = $qryCat->fetchAll(PDO::FETCH_ASSOC);
  $count = 1;
  foreach($BuscaCat as $cat){
    echo "<p>&nbsp;</p><p style='color: #333; font-size: 16px;'><strong>$cat[descricao]</strong></p>";
    $qryArtigo = Conexao::chamar()->prepare("SELECT * FROM pesquisa WHERE id_cliente = '$idCliente' AND id_categoria = '$cat[id]' AND status_registro = 'A' ORDER BY id DESC");
    $qryArtigo->execute();
    $BuscaArtigo = $qryArtigo->fetchAll(PDO::FETCH_ASSOC);
    foreach($BuscaArtigo as $busca_artigo){	
?>
      <div class="panel-group" id="accordion">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h4 class="panel-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#<?=$count?>">
                        <i class="fa fa-folder" aria-hidden="true"></i>
                        <span class="acessibilidade" style="font-weight: 600;font-size: 16px; "><?=$busca_artigo["descricao"]?></span>
                        <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
                    </a>
                  </h4>
              </div>
              <div id="<?=$count?>" class="panel-collapse collapse">
                  <div class="panel-body">
                    <? if ($busca_artigo["artigo"] != ""){ ?>
                        <div class="acessibilidade" style="font-weight: 600; font-size:15px; padding:10px;"><?=resumo_artigo($busca_artigo["descricao"],300) . '<br>';?></div>
                    <? } ?>
         
                      <i class="fa fa-download"></i>
                      <a href="<?=$CAMINHOANEXO?>/<?= $cliente?>/<?=$busca_artigo['arquivo']?>" target="_blank" class="acessibilidade titulo-certidoes"><?= $busca_artigo['descricao'] ?></a><br />
                          
                  </div>
              </div>
          </div>
      </div> 
      <?php $count++;
    }
  }
?>
	</div>
</div>