<div class="row" style="margin:0;">
    <div class="container" style="min-height: 500px;">
			<h2 style="color: #0aab60;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">Censo Previdenci&aacute;rio</h2>
<?php
		$qryCat = Conexao::chamar()->prepare("SELECT * FROM censo_categoria WHERE status_registro = 'A' ORDER BY descricao DESC");
		$qryCat->execute();
		$BuscaCat = $qryCat->fetchAll(PDO::FETCH_ASSOC);
    $count = 1;
    foreach($BuscaCat as $cat){
			echo "<p>&nbsp;</p><p style='color: #0aab60; font-size: 16px;'><strong>$cat[descricao]</strong></p>";
			$qryArtigo = Conexao::chamar()->prepare("SELECT * FROM censo WHERE id_categoria = '$cat[id]' AND status_registro = 'A' ORDER BY id DESC");
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
		                        <span class="acessibilidade" style="font-weight: 600;font-size: 16px; "><?=$busca_artigo["titulo"]?></span>
	                        <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
	                      </a>
	                    </h4>
	                </div>
	                <div id="<?=$count?>" class="panel-collapse collapse">
	                    <div class="panel-body">
												<? if ($busca_artigo["artigo"] != ""){ ?>
														<div class="acessibilidade" style="font-weight: 600; font-size:15px; padding:10px;"><?=resumo_artigo($busca_artigo["artigo"],300) . '<br>';?></div>
												<? }  ?>
										 <? $qryAnexo = Conexao::chamar()->prepare("SELECT * FROM censo_anexo WHERE id_artigo='$busca_artigo[id]' ORDER BY ordem ASC, id DESC") or die(mysql_error());
												$qryAnexo->execute();
												$BuscaAnexo = $qryAnexo->fetchAll(PDO::FETCH_ASSOC);
	                   foreach($BuscaAnexo as $buscaAnexo) { ?>
										 			<i class="fa fa-download"></i>
	                        <a href="<?=$CAMINHOANEXO?>/<?= $cliente?>/<?=$buscaAnexo['arquivo']?>" target="_blank" class="acessibilidade titulo-certidoes"><?= $buscaAnexo['descricao'] ?></a><br />
	                            <? } ?>
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