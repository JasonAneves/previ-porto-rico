<div class="row" style="margin:0;">
    <div class="container" style="min-height: 500px; padding: 20px 15px;">
			<h2 style="color: #007CC2;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">Investimentos</h2>
  <?php
    $codInvestimento = $url[$ii];
		$qryCat = Conexao::chamar()->prepare("SELECT * FROM investimento_categoria WHERE id_cliente = '$idCliente' AND id = '$codInvestimento' AND status_registro = 'A' ORDER BY descricao ASC");
		$qryCat->execute();
		$BuscaCat = $qryCat->fetchAll(PDO::FETCH_ASSOC);
    $count = 1;
    foreach($BuscaCat as $cat){ ?>
			<p style='color: #007CC2; font-size: 16px;'><strong><?=$cat[descricao]?></strong></p>
      <?php 
        $qryAnexoSemSub = Conexao::chamar()->prepare("SELECT * FROM investimento WHERE id_cliente = '$idCliente' AND id_categoria = '$cat[id]' AND id_subcategoria IS NULL AND status_registro = 'A' ORDER BY id DESC");
        $qryAnexoSemSub->execute();
        $BuscaAnexoSemSub = $qryAnexoSemSub->fetchAll(PDO::FETCH_ASSOC); 
        if(count($BuscaAnexoSemSub) > 0) { ?>
          <div class="row" style="border: 2px solid aliceblue;margin: 10px 0;">
          <?php foreach($BuscaAnexoSemSub as $anexo_sem_sub){ ?>
            <a href="<?= $CAMINHOANEXO .'/'. $anexo_sem_sub['arquivo']?>" class="acessibilidade" style="padding:20px 25px;" target="_blank">
              <img src="<?=$CAMINHO .'/assets/images/arquivo.svg'?>" alt="arquivo" style="margin-bottom: 10px;">
              <?= $anexo_sem_sub["descricao"]. '<br>' ?>
            </a>
          <?php } ?>
          </div>
        <?php } ?>

			<?php $qryArtigo = Conexao::chamar()->prepare("SELECT * FROM investimento_subcategoria WHERE id_categoria = '$cat[id]' AND status_registro = 'A' ORDER BY id DESC");
			$qryArtigo->execute();
			$BuscaArtigo = $qryArtigo->fetchAll(PDO::FETCH_ASSOC);
	    foreach($BuscaArtigo as $busca_artigo){	?>
	        <div class="panel-group" id="accordion">
	            <div class="panel panel-default">
	                <div class="panel-heading" style="background: aliceblue; ">
	                    <h4 class="panel-title" style="padding:10px;">
	                        <a data-toggle="collapse" data-parent="#accordion" href="#<?=$count?>">
	                        	<i class="fa fa-folder" aria-hidden="true"></i>
		                        <span class="acessibilidade" style="font-weight: 600;font-size: 16px; "><?=$busca_artigo["descricao"]?></span>
	                        <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
	                      </a>
	                    </h4>
	                </div>
	                <div id="<?=$count?>" class="panel-collapse collapse">
	                    <div class="panel-body" style="border: 2px solid aliceblue;padding: 10px 0;margin: -10px 0 10px 0;">
												<?php
                            $qryAnexo = Conexao::chamar()->prepare("SELECT * FROM investimento WHERE id_cliente = '$idCliente' AND id_categoria = '$cat[id]' AND id_subcategoria = '$busca_artigo[id]' AND status_registro = 'A' ORDER BY id DESC");
                            $qryAnexo->execute();
                            $BuscaAnexo = $qryAnexo->fetchAll(PDO::FETCH_ASSOC); 
                            foreach($BuscaAnexo as $busca_anexo): ?>
                          
                            <a href="<?= $CAMINHOANEXO .'/'. $busca_anexo['arquivo']?>" class="acessibilidade" style="padding:20px 25px;" target="_blank" data-gallery="galeria">
                              <img src="<?=$CAMINHO .'/assets/images/arquivo.svg'?>" alt="arquivo" style="margin-bottom: 10px;">
                              <?= $busca_anexo["descricao"]. '<br>'?>
                            </a>

                        <?php endforeach ?>

	                    </div>
	                </div>
	            </div>
	        </div> 
	        <?php $count++;
	    }} ?>
	</div>
</div>