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
    color: #000;
    text-align: center;
    line-height: 1.8;
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
  $codEvento = $url[$ii];
  if($id){ $codEvento = $id; }

  $qryEvento = Conexao::chamar()->prepare("SELECT *
  FROM galeria_foto
  WHERE id = '$codEvento'
  AND status_registro = 'A'");
  $qryEvento->execute();
  $buscaEvento = $qryEvento->fetchAll(PDO::FETCH_ASSOC);
  
  $qryEventoFoto = Conexao::chamar()->prepare("SELECT *
  FROM galeria_foto_foto
  WHERE id_artigo = '$codEvento'");
  $qryEventoFoto->execute();
  $buscaEventoFoto = $qryEventoFoto->fetchAll(PDO::FETCH_ASSOC);
  $isFoto = count($buscaEventoFoto);
?>

<div class="row">
    <div class="container">
        <div class="col-md-12">
          <?php 
            foreach($buscaEvento as $evento): ?>

              <div class="artigo my-4">
                <h2 class="acessibilidade"><?=$evento["titulo"]?></h2>
              </div>
              <div class="artigo mt-4">
                <p class="acessibilidade"><?= $evento["linha_fina"] ?></p>
              </div>
          <?php endforeach; ?>
        </div>

        <div class="galerias my-5">
          <nav>
            <div class="nav nav-tabs my-4" id="nav-tab" role="tablist">
              <?php 
                if($isFoto > 0) {echo '<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">FOTOS</a>';} else "";
              ?>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade imagem show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <? $i = 1; foreach($buscaEventoFoto as $foto): ?>
              <a href="<?= $CAMINHOIMG ?>/<?= $foto["foto"] ?>" alt="" target="_blank" data-toggle="lightbox" data-gallery="galeria">
                <img src="<?= $CAMINHOIMG ?>/<?= $foto["foto"] ?>" alt="">
              </a>
            <? $i++; endforeach; ?>
            </div>
          </div>
        </div>

        <?php
          $qryOutros = Conexao::chamar()->query("SELECT * 
          FROM galeria_foto 
          WHERE id_cliente = '$idCliente' 
          AND id != $codEvento 
          AND status_registro = 'A' 
          ORDER BY RAND() 
          LIMIT 4");
          $qryOutros->execute();
          $buscaOutros = $qryOutros->fetchAll(PDO::FETCH_ASSOC);

          if (count($buscaOutros) > 0) { 
        ?>
          <div class="outros_artigos">
            <h3 class="acessibilidade">
              Outras Publica&ccedil;&otilde;es
              <a href="<?= $CAMINHO ?>galeria_fotos" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <span class="hidden-xs">VER TODOS</span></a>
            </h3>
            <?php foreach ($buscaOutros as $outros):?>
              <a href="<?= $CAMINHO ?>galeria_fotos/<?= $outros['id'] ?>" class="linha">
                <h5 class="acessibilidade" style="margin-bottom: 0;"><?= $outros['titulo'] ?></h5>
                <small class="acessibilidade"><?= mb_strimwidth(strip_tags($outros['linha_fina']), 0, 100, "..."); ?></small>
              </a>
            <?php endforeach; ?>
          </div>

        <?php } ?>

    </div>
</div>

<div id="modal-p" class="modal modal-p">
    <span class="close cursor" onclick="closeModal()">&times;</span>
    <div class="modal-content">

    <? foreach($buscaEventoFoto as $key => $foto): ?>
    <div class="mySlides">
      <div class="numbertext"><?=$key+1?> / <?=$isFoto?></div>
      <img src="<?= $CAMINHOIMG ?>/<?= $foto["foto"] ?>" style="width:100%; max-height: 700px;object-fit: contain;margin-bottom: 0;">
    </div>
    <? endforeach; ?>
    
    <a class="prev" onclick="plusSlides(-1)" id="prev1">&#10094;</a>
    <a class="next" onclick="plusSlides(1)" id="next1">&#10095;</a>

    <!-- <div class="caption-container">
      <p id="caption"></p>
    </div> -->

  </div>
</div>



