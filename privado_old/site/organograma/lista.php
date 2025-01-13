
<div style="margin:0;">
  <div class="container" style="padding: 20px 15px;"> 
    <h2 style="color: #007CC2;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">Organograma</h2>
  </div>
  <div class="container" style="min-height: 500px; padding:0 15px;display: flex;flex-direction: column;justify-content: flex-start;"> 
    <?php
      $qryOrganograma = Conexao::chamar()->prepare("SELECT * 
                                            FROM organograma 
                                            WHERE id_cliente = '$idCliente'
                                            AND status_registro = 'A' 
                                            ORDER BY descricao ASC");
      $qryOrganograma->execute();
      $buscaOrganograma = $qryOrganograma->fetchAll(PDO::FETCH_ASSOC);
      $count = 1;
    ?>
		
    <?php foreach($buscaOrganograma as $organograma){ ?>
				
      <div class="panel-group" id="accordion">
          <div class="panel panel-default">
              <div class="panel-heading" style="background: aliceblue; ">
                  <h4 class="panel-title" style="padding: 10px;">
                      <a data-toggle="collapse" data-parent="#accordion" href="#org-<?=$count?>">
                        <i class="fa fa-folder" aria-hidden="true"></i>
                        <span class="acessibilidade" style="font-weight: 600;font-size: 16px;">
                          <?=$organograma["descricao"]?>
                          <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;font-size: 25px;"></i>
                        </span>
                    </a>
                  </h4>
              </div>
              <div id="org-<?=$count?>" class="panel-collapse collapse">
                  <div class="panel-body" style="border: 2px solid aliceblue;margin: -10px 0 20px 0;;">
                    <?php if ($organograma["descricao"] != ""){ ?>
                      <div class="acessibilidade" style="padding:10px;"><?=$organograma["artigo"];?>
                    <?php }

                    $ext = substr($organograma["arquivo"], -3);
                      if($ext == "png" || $ext == "jpg" || $ext == "peg") { ?>
                      <img src="<?=$CAMINHOIMG .'/'. $organograma["arquivo"] ?>" alt="" style="max-width: -webkit-fill-available;padding:10px;">
                    <?php } else { ?>
                      <img src="<?=$CAMINHO.'/assets/images/file-download.svg';?>" alt="icone download" style="height:20px;">
                      <a href="<?=$CAMINHOIMG .'/'. $organograma["arquivo"] ?>"></i><?= $organograma["descricao"] ?></a>
                      <?php } ?>
                    </div>
                  </div>
              </div>
          </div>
          <?php $count++; } ?>
      </div>

   
	</div>
</div>