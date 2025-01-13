<div class="row" style="margin:0;">
    <div class="container" style="min-height: 500px; padding: 20px 15px;">
			<h2 style="color: #007CC2;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">Previdência</h2>
  <?php
    $codPrev = $url[$ii];
		$qryCat = Conexao::chamar()->prepare("SELECT * FROM previdencia_categoria WHERE id_cliente = '$idCliente' AND id = '$codPrev' AND status_registro = 'A' ORDER BY descricao ASC");
		$qryCat->execute();
		$BuscaCat = $qryCat->fetchAll(PDO::FETCH_ASSOC);
    $i = 1;
    $ii = 1;
    foreach($BuscaCat as $cat){ ?>
			<p style='color: #007CC2; font-size: 16px;'><strong><?=$cat[descricao]?></strong></p>
      <?php 
        $qryAnexoSemSub = Conexao::chamar()->prepare("SELECT * FROM previdencia WHERE id_cliente = '$idCliente' AND id_categoria = '$cat[id]' AND id_subcategoria IS NULL AND status_registro = 'A' ORDER BY id DESC");
        $qryAnexoSemSub->execute();
        $BuscaAnexoSemSub = $qryAnexoSemSub->fetchAll(PDO::FETCH_ASSOC); 
        if(count($BuscaAnexoSemSub) > 0) { ?>
          <div class="row" style="border: 2px solid aliceblue;margin: 10px 0;">
          <?php foreach($BuscaAnexoSemSub as $anexo_sem_sub){ ?>
            <a href="<?= $CAMINHOANEXO .'/'. $anexo_sem_sub['arquivo']?>" class="acessibilidade" style="padding:20px 25px;" data-toggle="lightbox" data-gallery="galeria_sem_sub">
              <img src="<?=$CAMINHO .'/assets/images/arquivo.svg'?>" alt="arquivo" style="margin-bottom: 10px;">
              <?= $anexo_sem_sub["descricao"]. '<br>' ?>
            </a>
          <?php } ?>
          </div>
        <?php } ?>

			<?php $qryArtigo = Conexao::chamar()->prepare("SELECT * FROM previdencia_subcategoria WHERE id_categoria = '$cat[id]' AND status_registro = 'A' ORDER BY id DESC");
			$qryArtigo->execute();
			$BuscaArtigo = $qryArtigo->fetchAll(PDO::FETCH_ASSOC);
	    foreach($BuscaArtigo as $busca_artigo){	?>
	        <div class="panel-group" id="accordion">
	            <div class="panel panel-default">
	                <div class="panel-heading" style="background: aliceblue; ">
	                    <h4 class="panel-title" style="padding:10px;">
	                        <a data-toggle="collapse" data-parent="#accordion" href="#sub<?=$i?>">
	                        	<i class="fa fa-folder" aria-hidden="true"></i>
		                        <span class="acessibilidade" style="font-weight: 600;font-size: 16px; "><?=$busca_artigo["descricao"]?></span>
	                        <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
	                      </a>
	                    </h4>
	                </div>
	                <div id="sub<?=$i?>" class="panel-collapse collapse">
                            
	                    <div class="panel-heading" style="border: 2px solid aliceblue;padding: 10px 0;margin-bottom: 10px;margin-top:-10px;">
												<?php
                          $qrySub = Conexao::chamar()->prepare("SELECT * FROM previdencia WHERE id_cliente = '$idCliente' AND id_categoria = '$cat[id]' AND id_subcategoria = '$busca_artigo[id]' AND status_registro = 'A' ORDER BY id DESC");
                          $qrySub->execute();
                          $buscaSub = $qrySub->fetchAll(PDO::FETCH_ASSOC); 
                          foreach($buscaSub as $busca_sub): 
                        ?>

                          <h4 class="panel-title" style="padding:10px;">
                              <a id="titulo<?=$i.$ii?>" data-toggle="collapse" data-parent="#sub<?=$i?>" href="#anexo<?=$i.$ii?>" style="margin-right: 10px;">
                                <i class="fa fa-folder" aria-hidden="true"></i>
                                <span class="acessibilidade" style="font-weight: 600;font-size: 16px; "><?=$busca_sub["titulo"]?></span>
                              <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
                            </a>
                          </h4>

                          <div id="anexo<?=$i.$ii?>" class="panel-collapse collapse acessibilidade" style="padding:10px; border: 1px solid aliceblue;">
                            <?= $busca_sub["artigo"]. '<br>'?>

                            <?php
                              $qryFoto = Conexao::chamar()->prepare("SELECT * FROM previdencia_foto WHERE id_artigo = '$busca_sub[id]' ORDER BY id DESC");
                              $qryFoto->execute();
                              $buscaFoto = $qryFoto->fetchAll(PDO::FETCH_ASSOC); 
                              if(count($buscaFoto) > 0) {
                            ?>
                            
                            <div class="galeria-foto">
                              <div class="panel-heading" style="background: aliceblue; ">
                                <h5 class="panel-title" style="padding:10px;">Galeria de fotos</h5>
                              </div>
                              <div style="border: 2px solid aliceblue;padding: 10px 0;padding: 10px; display: flex;justify-content: flex-start;flex-wrap: wrap; margin-top: -10px; margin-bottom: 10px;">
                              <?php
                                foreach($buscaFoto as $busca_foto): 
                              ?>
                                <a href="<?=$CAMINHOIMG .'/'. $busca_foto['foto']?>" target="_blank" style="margin-right: 10px;" data-toggle="lightbox" data-gallery="galeria">
                                  <img src="<?=$CAMINHOIMG .'/'. $busca_foto['foto']?>" alt="arquivo" style="object-fit: cover;width: 250px;height:140px;margin-bottom: 10px;">
                                </a>
                              <?php endforeach; ?>
                              </div>
                            </div>

                            <?php } 
                            
                              $qryVideo = Conexao::chamar()->prepare("SELECT * FROM previdencia_video WHERE id_artigo = '$busca_sub[id]' ORDER BY id DESC");
                              $qryVideo->execute();
                              $buscaVideo = $qryVideo->fetchAll(PDO::FETCH_ASSOC); 
                              if(count($buscaVideo) > 0) {
                            ?>

                            <div class="galeria-video">
                              <div class="panel-heading" style="background: aliceblue; ">
                                <h5 class="panel-title" style="padding:10px;">Galeria de vídeos</h5>
                              </div>
                              <div style="border: 2px solid aliceblue;padding: 10px 0;padding: 10px; display: flex;justify-content: flex-start;flex-wrap: wrap; margin-top: -10px;margin-bottom: 10px;">
                              <?php
                                foreach($buscaVideo as $busca_video): 
                                $link = explode("=", $busca_video['link']);
                              ?>
                                <iframe width="250" height="140" src="https://www.youtube.com/embed/<?=$link[1];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="margin: 0 10px 10px 0"></iframe>
                                <?php endforeach; ?>
                              </div>
                            </div>
                            <?php } 
                              $qryAnexo = Conexao::chamar()->prepare("SELECT * FROM previdencia_anexo WHERE id_artigo = '$busca_sub[id]' ORDER BY id DESC");
                              $qryAnexo->execute();
                              $buscaAnexo = $qryAnexo->fetchAll(PDO::FETCH_ASSOC); 
                              if(count($buscaAnexo) > 0) {
                            ?>

                            <div class="galeria-anexo">
                              <div class="panel-heading" style="background: aliceblue; ">
                                <h5 class="panel-title" style="padding:10px;">Galeria de anexos</h5>
                              </div>
                              <div style="border: 2px solid aliceblue;padding: 10px 0;padding: 10px; display: flex;justify-content: flex-start;flex-wrap: wrap; margin-top: -10px;margin-bottom: 10px;">
                              <?php foreach($buscaAnexo as $busca_anexo): ?>
                                <a href="<?= $CAMINHOANEXO .'/'. $busca_anexo['arquivo']?>" class="acessibilidade" style="padding:20px 25px; margin-right: 10px;" target="_blank">
                                  <img src="<?=$CAMINHO .'/assets/images/arquivo.svg'?>" alt="arquivo" style="margin-bottom: 10px;">
                                  <?= $busca_anexo["descricao"]?>
                                </a>
                                <?php endforeach; ?>
                              </div>
                            </div>
                            <?php } ?>
                          </div>

                        <?php $ii++; endforeach ?>

	                    </div>
	                </div>
	            </div>
	        </div> 
	        <?php $i++;
	    }} ?>
	</div>
</div>