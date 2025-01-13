<div class="row" style="margin:0;">
    <div class="container" style="min-height: 500px; padding: 20px 15px;">
			<h2 style="color: #007CC2;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">Links &uacute;teis</h2>
<?php
		$qryCat = Conexao::chamar()->prepare("SELECT * FROM link_categoria WHERE id_cliente = '$idCliente' AND status_registro = 'A' ORDER BY id ASC");
		$qryCat->execute();
		$BuscaCat = $qryCat->fetchAll(PDO::FETCH_ASSOC);
    $count = 1;
    foreach($BuscaCat as $cat){ ?>
	        <div class="panel-group" id="accordion">
	            <div class="panel panel-default">
	                <div class="panel-heading" style="background: aliceblue;">
	                    <h4 class="panel-title" style="padding: 10px;">
	                        <a data-toggle="collapse" data-parent="#accordion" href="#<?=$count?>">
	                        	<i class="fa fa-folder" aria-hidden="true"></i>
		                        <span class="acessibilidade" style="font-weight: 600;font-size: 16px; "><?=$cat["descricao"]?></span>
	                        <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
	                      </a>
	                    </h4>
	                </div>
	                <div id="<?=$count?>" class="panel-collapse collapse">
                    <div class="panel-body" style="border: 2px solid aliceblue;margin: -10px 0 10px 0;padding: 10px;">
                        <?php
                          $qryLink = Conexao::chamar()->prepare("SELECT * FROM link WHERE id_cliente = '$idCliente' AND id_categoria = '$cat[id]' AND status_registro = 'A' ORDER BY id ASC");
                          $qryLink->execute();
                          $buscaLink = $qryLink->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php foreach($buscaLink as $link): ?>
                          <p><a href="<?=$link['link']?>" target="_blank"><?=$link['titulo']?></a></p>
                        <?php endforeach; ?>

                    </div>
	                </div>
	            </div>
	        </div> 
	        <?php $count++;
	    
    }
?>
	</div>
</div>