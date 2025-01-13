<div class="row" style="margin:0;">
    <div class="container" style="min-height: 500px; padding: 20px 15px;">
			<h2 style="color: #007CC2;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">Downloads</h2>
      <?php
        $qryCat = Conexao::chamar()->prepare("SELECT * FROM download_categoria WHERE id_cliente = '$idCliente' AND status_registro = 'A' ORDER BY descricao ASC");
        $qryCat->execute();
        $BuscaCat = $qryCat->fetchAll(PDO::FETCH_ASSOC);
        $i = 1;
        $ii = 1;
        foreach($BuscaCat as $cat){ //categoria
      ?>
      <div class="panel-group" id="accordion" style="margin-bottom: 10px;">
        <div class="panel panel-default">
          <div class="panel-heading" style="background: aliceblue; ">
            <h4 class="panel-title" style="padding:10px;">
              <a data-toggle="collapse" data-parent="#accordion" href="#sub<?=$i?>">
                <i class="fa fa-folder" aria-hidden="true"></i>
                <span class="acessibilidade" style="font-weight: 600;font-size: 16px; "><?=$cat["descricao"]?></span>
                <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
              </a>
            </h4>
          </div>
          
          <div id="sub<?=$i?>" class="panel-collapse collapse" style="margin-top: -10px;">
            <?php //arquivo sem subcategoria
              $qryAnexoSemSub = Conexao::chamar()->prepare("SELECT * FROM download_anexo WHERE id_cliente = '$idCliente' AND id_categoria = '$cat[id]' AND id_subcategoria IS NULL AND status_registro = 'A' ORDER BY id DESC");
              $qryAnexoSemSub->execute();
              $BuscaAnexoSemSub = $qryAnexoSemSub->fetchAll(PDO::FETCH_ASSOC); 
              if(count($BuscaAnexoSemSub) > 0) { ?>
                <div class="row" style="border: 2px solid aliceblue;margin: 0;">
                <?php foreach($BuscaAnexoSemSub as $anexo_sem_sub){ ?>
                  <a href="<?= $CAMINHOANEXO .'/'. $anexo_sem_sub['arquivo']?>" class="acessibilidade" style="padding:20px 25px;">
                    <img src="<?=$CAMINHO .'/assets/images/arquivo.svg'?>" alt="arquivo">
                    <?= $anexo_sem_sub["descricao"]. '<br>' ?>
                  </a>
                <?php } ?>
                </div>
            <?php } ?>
          
            <?php //subcategoria
              $qrySub = Conexao::chamar()->prepare("SELECT * FROM download_subcategoria WHERE id_cliente = '$idCliente' AND id_categoria = '$cat[id]' AND status_registro = 'A' ORDER BY id DESC");
              $qrySub->execute();
              $buscaSub = $qrySub->fetchAll(PDO::FETCH_ASSOC);
              foreach($buscaSub as $sub){	
            ?>
            <div class="panel-heading" style="border: 2px solid aliceblue;">
              <h4 class="panel-title" style="padding:10px;">
                <a id="titulo<?=$i.$ii?>" data-toggle="collapse" data-parent="#sub<?=$i?>" href="#anexo<?=$i.$ii?>" style="margin-right: 10px;">
                  <i class="fa fa-folder" aria-hidden="true"></i>
                  <span class="acessibilidade" style="font-weight: 600;font-size: 16px; "><?=$sub["descricao"]?></span>
                  <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
                </a>
              </h4>
            </div>

            <?php //anexo
              $qryAnexo = Conexao::chamar()->prepare("SELECT * FROM download_anexo WHERE id_cliente = '$idCliente' AND id_categoria = '$cat[id]' AND id_subcategoria = '$sub[id]' AND status_registro = 'A' ORDER BY id DESC");
              $qryAnexo->execute();
              $buscaAnexo = $qryAnexo->fetchAll(PDO::FETCH_ASSOC); 
              if(count($buscaAnexo) > 0) {
            ?>
            <div id="anexo<?=$i.$ii?>" class="panel-collapse collapse acessibilidade" style="padding:10px; border: 1px solid aliceblue;">
              <div class="galeria-anexo">
                <div class="panel-heading" style="background: aliceblue; ">
                  <h5 class="panel-title" style="padding:10px;">Anexos</h5>
                </div>
                <div style="border: 2px solid aliceblue;padding: 10px 0;display: flex;justify-content: flex-start;flex-wrap: wrap;">
                <?php foreach($buscaAnexo as $busca_anexo): ?>
                  <a href="<?= $CAMINHOANEXO .'/'. $busca_anexo['arquivo']?>" class="acessibilidade" style="padding:20px 25px; margin-right: 10px;" target="_blank">
                    <img src="<?=$CAMINHO .'/assets/images/arquivo.svg'?>" alt="arquivo">
                    <?= $busca_anexo["descricao"]?>
                  </a>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <?php } $ii++; } ?>

          </div>
        </div>
      </div> 
      <?php $i++; } ?>
	</div>
</div>