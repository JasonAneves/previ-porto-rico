<div class="row" style="margin:0;">
    <div class="container" style="min-height: 500px; padding: 20px 15px;">
			<h2 style="color: #007CC2;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">Convênios</h2>
<?php
    $codConvenio = $url[$ii];
		$qryCat = Conexao::chamar()->prepare("SELECT * FROM convenio_categoria WHERE id_cliente = '$idCliente' AND id = '$codConvenio' AND status_registro = 'A' ORDER BY descricao ASC");
		$qryCat->execute();
		$BuscaCat = $qryCat->fetchAll(PDO::FETCH_ASSOC);
    $count = 1;
    foreach($BuscaCat as $cat){
			echo "<p style='color: #007CC2; font-size: 16px;'><strong>$cat[descricao]</strong></p>";
			$qryArtigo = Conexao::chamar()->prepare("SELECT * FROM convenio_instituicao WHERE id_cliente = '$idCliente' AND id_categoria = '$cat[id]' AND status_registro = 'A' ORDER BY id DESC");
			$qryArtigo->execute();
			$BuscaArtigo = $qryArtigo->fetchAll(PDO::FETCH_ASSOC);
	    foreach($BuscaArtigo as $busca_artigo){	
	        ?>
	        <div class="panel-group" id="accordion">
	            <div class="panel panel-default">
	                <div class="panel-heading" style="background: aliceblue;">
	                    <h4 class="panel-title" style="padding: 10px;">
	                        <a data-toggle="collapse" data-parent="#accordion" href="#<?=$count?>">
	                        	<i class="fa fa-folder" aria-hidden="true"></i>
		                        <span class="acessibilidade" style="font-weight: 600;font-size: 16px; "><?=$busca_artigo["nome"]?></span>
	                        <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
	                      </a>
	                    </h4>
	                </div>
	                <div id="<?=$count?>" class="panel-collapse collapse">
	                    <div class="panel-body" style="border: 2px solid aliceblue;margin: -10px 0 10px 0">
												<?php if (count($BuscaArtigo) > 0){ ?>
													<div class="" style="height: 70px;width: auto;object-fit: contain;padding:0 10px;">
                            <a href="<?= $CAMINHOIMG."/". $busca_artigo["logo"] ?>" data-toggle="lightbox" data-gallery="galeria">
                              <img src="<?= $CAMINHOIMG."/". $busca_artigo["logo"] ?>" alt="" style="height: 70px;width: auto;object-fit: contain;margin-top: 10px;">
                            </a>
                          </div>
													<div class="acessibilidade" style="font-weight: 600; font-size:20px; padding:20px 10px;"><?=resumo_artigo($busca_artigo["nome"],300) . '<br>';?></div>
													<div class="acessibilidade" style="font-size:15px; padding:10px;"><?=resumo_artigo($busca_artigo["artigo"],300) . '<br>';?></div>
													<div class="acessibilidade" style="font-size:15px; padding:10px;">
                            <p><?=resumo_artigo($busca_artigo["endereco"],300) .' - '. resumo_artigo($busca_artigo["complemento"],300);?></p>
                            <p><?=resumo_artigo($busca_artigo["bairro"],300) .' - ' .resumo_artigo($busca_artigo["cep"],300);?></p>
                            <p><?=resumo_artigo($busca_artigo["telefone_fixo"],300) .' - ' . resumo_artigo($busca_artigo["telefone_celular"],300);?></p>
                            <p><?=resumo_artigo($busca_artigo["email"],300);?></p>
                            <a href="<?=resumo_artigo($busca_artigo["site"],300);?>" target="_blank"><?=resumo_artigo($busca_artigo["site"],300);?></a>
                          </div>
												<?php }  ?>

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