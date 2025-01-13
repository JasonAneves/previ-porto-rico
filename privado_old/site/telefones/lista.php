<div class="row" style="margin:0;">
    <div class="container" style="min-height: 500px; padding: 20px 15px;">
			<h2 style="color: #007CC2;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">Telefones &Uacute;teis</h2>
      <?php
        $qryCat = Conexao::chamar()->prepare("SELECT * FROM telefone_util WHERE id_cliente = '$idCliente' AND status_registro = 'A' ORDER BY descricao ASC");
        $qryCat->execute();
        $BuscaCat = $qryCat->fetchAll(PDO::FETCH_ASSOC);
        $count = 1;
        foreach($BuscaCat as $cat){ 
      ?>
	        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading" style="background: aliceblue; ">
                <h4 class="panel-title" style="padding:10px;">
                  <a data-toggle="collapse" data-parent="#accordion" href="#<?=$count?>">
                    <i class="fa fa-folder" aria-hidden="true"></i>
                    <span class="acessibilidade" style="font-weight: 600;font-size: 16px; "><?=$cat["descricao"]?></span>
                  <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
                </a>
                </h4>
              </div>
              <div id="<?=$count?>" class="panel-collapse collapse">
                <div class="panel-body" style="border: 2px solid aliceblue;padding: 10px 0;margin: -10px 0 10px 0;">
                  <?php
                    $qryAnexo = Conexao::chamar()->prepare("SELECT * FROM telefone_util_numero WHERE id_telefone_util = '$cat[id]' AND status_registro = 'A' ORDER BY id DESC");
                    $qryAnexo->execute();
                    $BuscaAnexo = $qryAnexo->fetchAll(PDO::FETCH_ASSOC); 
                    foreach($BuscaAnexo as $busca_anexo): 
                  ?>
                      <p style="padding: 10px 20px">
                        <i class="fa fa-phone" aria-hidden="true" style="margin-right: 5px;"></i>
                        <?= $busca_anexo["numero"]. '<br>'?>
                      </p>
                    
                  <?php endforeach ?>
                </div>
              </div>
            </div>
	        </div> 
	        <?php $count++;
	    } ?>
	</div>
</div>