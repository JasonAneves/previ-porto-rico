<div style="padding-top: 30px;">
<?php
// if (isset($url[1]) && $url[1] != "cat") {
//     include "../../privado/site/ata/visualiza.php";
// } else {
    echo "<h2>Atas das Reuni&otilde;es</h2>";
    $qryCat = mysql_query("SELECT * FROM ata_categoria ORDER BY categoria");
    $count = 1;
    while($cat = mysql_fetch_assoc($qryCat)) {
    	echo "<p>&nbsp;</p><p><strong class='chapeu'>$cat[categoria]</strong></p>";
	    $qryArtigo = mysql_query("SELECT * FROM ata WHERE id_categoria = '$cat[id]' ORDER BY id DESC");
	    while($busca_artigo=mysql_fetch_array($qryArtigo)){	
	        ?>
	        <div class="panel-group" id="accordion">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h4 class="panel-title">
	                        <a data-toggle="collapse" data-parent="#accordion" href="#<?=$count?>">
	                        	<i class="fa fa-folder" aria-hidden="true"></i>
		                        <?=$busca_artigo["titulo"]?> 
		                        <? if ($busca_artigo["artigo"] != ""){
		                        	echo " - ". resumo_artigo($busca_artigo["artigo"],50);
		                        }  ?>
	                        <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
	                      </a>
	                    </h4>
	                </div>
	                <div id="<?=$count?>" class="panel-collapse collapse">
	                    <div class="panel-body">
	                   <? $qryAnexo = mysql_query("SELECT * FROM ata_anexo WHERE id_artigo='$busca_artigo[id]' ORDER BY id") or die(mysql_error());
	                   while($buscaAnexo = mysql_fetch_assoc($qryAnexo)) { ?>
	                        <a href="<?=$CAMINHOSIS ?>/arquivos/<?= $buscaAnexo['arquivo'] ?>" target="_blank" class="titulo-certidoes">
	                            <img src="<?=$CAMINHO ?>/images/disquete.png" style="vertical-align: middle; padding-bottom:3px;" height="20" width="20" />
	                            <?= $buscaAnexo['descricao'] ?></a><br />
	                            <? } ?>
	                    </div>
	                </div>
	            </div>
	        </div> 
	        <?php $count++;
	    }
    }
//}
?>
</div>