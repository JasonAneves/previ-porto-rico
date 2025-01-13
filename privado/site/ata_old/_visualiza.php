<?php

if (isset($url[1])) {

    $id  = verifica($url[1]);

    $whi = "WHERE id = '$id'";

}

$qryArtigo = mysql_query("SELECT * FROM ata $whi ORDER BY id DESC LIMIT 1");

while ($busca_artigo = mysql_fetch_assoc($qryArtigo)) {

?>

<div style="float: left; width: 99%;">

    <h2>Atas das Reuni&otilde;es</h2>
		<br /><br />
        <h3><?=$busca_artigo["titulo"];?></h3>
       <?php

        	$qryFoto  = mysql_query("SELECT * FROM ata_foto WHERE id_artigo='$busca_artigo[id]' ORDER BY id")  or die(mysql_error());

			$qryAnexo = mysql_query("SELECT * FROM ata_anexo WHERE id_artigo='$busca_artigo[id]' ORDER BY id") or die(mysql_error());

			

			if(mysql_num_rows($qryFoto) > 0 || mysql_num_rows($qryAnexo) > 0){

				$primerira = true;

				while($buscaFoto=mysql_fetch_array($qryFoto)){

				

					if(!$primerira)

						$displai = "display:none;";

					else

						$displai = "";

	   ?>

            <a href="<?=$CAMINHOSIS ?>/imagens/gd_<?=$buscaFoto['foto'];?>" style="position: relative; float: right; width: 330px;" title="<? if($buscaFoto[credito]){ echo 'CR&Eacute;DITO: '.$buscaFoto[credito].'<br>'; } echo $buscaFoto['legenda']; ?>"  class="lightbox" rel="lightbox[foto]">

            <img src="<?=$CAMINHO ?>/images/ico_ampliar.jpg" width="54" height="20" align="right" border="0" style="z-index:90; position:absolute; margin:2px; <?=$displai ?>" />

            <img src="<?=$CAMINHOSIS ?>/imagens/gd_<?=$buscaFoto['foto'];?>" width="330" style="padding:2px; <?=$displai ?>" /></a>            

        <?php

					$primerira = false;

				}
				
		?>

        <p><?=nl2br($busca_artigo["artigo"]);?></p>
		<?php 

				while($buscaAnexo = mysql_fetch_assoc($qryAnexo)) {

		?>

            <a href="<?=$CAMINHOSIS ?>/arquivos/<?= $buscaAnexo['arquivo'] ?>" target="_blank" class="titulo-ata">
            <img src="<?=$CAMINHO ?>/images/disquete.png" style="vertical-align: middle; padding-bottom:3px;" height="20" width="20" />
            <?=(empty($buscaAnexo['descricao']) ? "Anexo" : $buscaAnexo['descricao']) ?></a><br />

        <?php

				}

			} else {
		?>
			<p><?=nl2br($busca_artigo["artigo"]);?></p>
		<?php
			}

			echo "<div style='width: 99%; position: relative; clear: both;'>";
			$qryVideo = mysql_query("SELECT * FROM ata_video WHERE id_artigo='$busca_artigo[id]' ORDER BY id") or die(mysql_error());
			while ($buscaVideo = mysql_fetch_assoc($qryVideo)) {

			?>
			<div align="center" style="float: left; margin-right: 20px; margin-bottom: 20px;">
				<object width="450" height="325" title="<?=$buscaVideo["titulo"] ?>" >
					<param name="movie" value="http://<?=str_replace("watch?v=","v/",$buscaVideo['link']) ?>"></param>
					<param name="allowFullScreen" value="true"></param>
					<param name="allowscriptaccess" value="always"></param>
					<param name="wmode" value="transparent"></param>
					<embed src="http://<?=str_replace("watch?v=","v/",$buscaVideo['link']) ?>" 
						wmode="transparent" 
						type="application/x-shockwave-flash" 
						allowscriptaccess="always" 
						allowfullscreen="true" 
						width="450" 
						height="325">
					</embed>
				</object>
			</div>
			<?php
			}
			echo "</div>";

			$idUsado = $busca_artigo["id"];
       }
       
       echo "</div><div style='width: 99%; position: relative; clear: both;'>";
       
       $qryArtigo = mysql_query("SELECT * FROM ata WHERE id <> '$idUsado' ORDER BY id ASC");
       
       if(mysql_num_rows($qryArtigo) > 0){
       	
       		echo "<div style='height: 50px;'></div>";
       		
       		echo "<h2>Outros <span class='sub'>Artigos</sub></h2>";

		    while($busca_artigo=mysql_fetch_array($qryArtigo)){	
		
		        //$qryFoto  = mysql_query("SELECT * FROM ata_foto WHERE id_artigo='$busca_artigo[id]' ORDER BY RAND() LIMIT 1")  or die(mysql_error());
		        //$numFoto = mysql_fetch_assoc($qryFoto);
		
		        ?>
		
		        <div style="position: relative; padding-top: 20px;">
		        <h3><a href="<?php echo "$CAMINHO/atas/{$busca_artigo[id]}"; ?>"><?=$busca_artigo["titulo"]?></a></h3>
		        <a href="<?php echo "$CAMINHO/atas/{$busca_artigo[id]}"; ?>">
		        	<p><?=resumo_artigo($busca_artigo["artigo"], 300) ?></p>
		        </a>
		        <hr style="height: 1px; background: url(<?=$CAMINHO ?>/css/images/hrpq.png) top left repeat-x;" />
		        </div>
		        <?php
		
		   }
	    
       }       
       
       ?>

</div>
