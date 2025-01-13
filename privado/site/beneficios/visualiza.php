<style>

  .artigo {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .titulo {
    font: normal normal bold 40px/67px Roboto;
    display: contents;
  }

  .titulo::after{
    content: "";
    width: 180px;
    height: 4px;
    background: #007cc2;
    display: block;
  }

  .artigo h2 {
    color: #007CC2;
    font-size: 35px;
    font-weight: bold;
    font-family: 'Muli', sans-serif;
  }

  .artigo p {
    font: normal normal normal 16px/37px Roboto;
    color: #000;
    text-align: center;
    line-height: 1.8;
    margin-top: 1rem;
  }

  .nav-tabs {
    justify-content: center;
    border-bottom: 2px solid #007CC2;
  }

  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #ffffff;
    border-color: #dee2e6 #dee2e6 #fff;
    background-color: #007cc2;
    border-color: #007cc2;
  } 

  .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
    border-color: #007cc2;
  }

  .nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    width: 130px;
    text-align: center;
    background-color: #F1F1F1;
    margin: 0 2px;
  } 

  .tab-pane.imagem img,
  .tab-pane.video img {
    width: 200px;
    height: 130px;
    object-fit: cover;
    margin: 2px 0;
  }

  .tab-content {
    padding: 10px;
  }

  .outros_artigos {
    margin-bottom: 20px;
    border: 2px solid aliceblue;
    padding: 10px;
    margin-top: 10px;
  }

  .outros_artigos h5,
  .outros_artigos small {
    color: #333;
  }

  .outros_artigos a:hover h5,
  .outros_artigos a:hover small {
    color: #007CC2;
  }

</style>

<?php

  $codBeneficio = $url[$ii];
  if($id){ $codBeneficio = $id; }

  $qryBeneficio = Conexao::chamar()->prepare("SELECT *
  FROM beneficios
  WHERE id = '$codBeneficio'
  AND status_registro = 'A'");
  $qryBeneficio->execute();
  $buscaBeneficio = $qryBeneficio->fetchAll(PDO::FETCH_ASSOC);
  
  $qryBeneficioAnexo = Conexao::chamar()->prepare("SELECT *
  FROM beneficios_anexo
  WHERE id_artigo = '$codBeneficio'");
  $qryBeneficioAnexo->execute();
  $buscaAnexo = $qryBeneficioAnexo->fetchAll(PDO::FETCH_ASSOC);
  $isAnexo = count($buscaAnexo);
?>

<div class="row">
    <div class="container">
        <div class="col-md-12">
          <?php 
            foreach($buscaBeneficio as $beneficio): ?>
            <div class="artigo my-4 acessibilidade">
              <h2 class="acessibilidade"><?=$beneficio["titulo"]?></h2>
            </div>
              <div class="artigo mt-4">
                <p class="acessibilidade"><?= $beneficio["artigo"] ?></p>
              </div>
          <?php endforeach; ?>
        </div>
        <?php if(!empty($buscaFoto) or !empty($buscaVideo) or !empty($buscaAnexo)) { ?>
        <div class="galerias mb-5">
          <nav>
            <div class="nav nav-tabs mt-4" id="nav-tab" role="tablist">
              <? 
                if($isAnexo > 0) {echo '<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">ANEXOS</a>';} else "";
              ?>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade anexo show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <div style="display: grid;grid-template-columns: repeat(6, 1fr);">
                <? foreach($buscaAnexo as $anexo):
                  $anexo_galeria = $CAMINHOANEXO . "/" . $anexo["arquivo"];
                ?>
                <a href="<?= $anexo_galeria?>" target="_blank" style="display: flex;justify-content: center;align-items: center;">
                  <img src="<?=$CAMINHO ?>/assets/images/pdf.PNG">
                  <p><?= $anexo["descricao"] ?></p>
                </a>
                <? endforeach; ?>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>

        <?php
          $qryOutros = Conexao::chamar()->query("SELECT * 
          FROM beneficios 
          WHERE id_cliente = '$idCliente' 
          AND id != $codBeneficio 
          AND status_registro = 'A' 
          ORDER BY RAND() 
          LIMIT 4");
          $qryOutros->execute();
          $buscaOutros = $qryOutros->fetchAll(PDO::FETCH_ASSOC);

          if (count($buscaOutros) > 0) { 
        ?>
          <div class="outros_artigos">
            <h3 class="acessibilidade">
              Outros Benef&iacute;cios
              <a href="<?= $CAMINHO ?>beneficios" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <span class="hidden-xs">VER TODOS</span></a>
            </h3>
            <?php foreach ($buscaOutros as $outros):?>
              <a href="<?= $CAMINHO ?>beneficios/<?= $outros['id'] ?>" class="linha">
                <h5 class=" acessibilidade" style="margin-bottom: 0;"><?= $outros['titulo'] ?></h5>
                <small class=" acessibilidade"><?= mb_strimwidth(strip_tags($outros['artigo']), 0, 100, "..."); ?></small>
              </a>
            <?php endforeach; ?>
          </div>

        <?php } ?>

    </div>
</div>


