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

</style>

<?php
  $codInformativo = $url[$ii];
  if($id){$codInformativo = $id;}

  $qryInformativo = Conexao::chamar()->prepare("SELECT *
  FROM informativo
  WHERE id = '$codInformativo'
  AND status_registro = 'A'");
  $qryInformativo->execute();
  $buscaInformativo = $qryInformativo->fetchAll(PDO::FETCH_ASSOC);
  
  $qryInformativoFoto = Conexao::chamar()->prepare("SELECT *
  FROM informativo_foto
  WHERE id_artigo = '$codInformativo'");
  $qryInformativoFoto->execute();
  $buscaFoto = $qryInformativoFoto->fetchAll(PDO::FETCH_ASSOC);
  $isFoto = count($buscaFoto);

  $qryInformativoVideo = Conexao::chamar()->prepare("SELECT *
  FROM informativo_video
  WHERE id_artigo = '$codInformativo'");
  $qryInformativoVideo->execute();
  $buscaVideo = $qryInformativoVideo->fetchAll(PDO::FETCH_ASSOC);
  $isVideo = count($buscaVideo);

  $qryInformativoAnexo = Conexao::chamar()->prepare("SELECT *
  FROM informativo_anexo
  WHERE id_artigo = '$codInformativo'");
  $qryInformativoAnexo->execute();
  $buscaAnexo = $qryInformativoAnexo->fetchAll(PDO::FETCH_ASSOC);
  $isAnexo = count($buscaAnexo);
?>

<div class="row">
    <div class="container">
        <div class="col-md-12 acessibilidade">
          <?php 
            foreach($buscaInformativo as $informativo): ?>
            <div class="artigo my-4">
              <h2 class="acessibilidade"><?=$informativo["titulo"]?></h2>
            </div>
            <div class="artigo">
              <p class="acessibilidade"><?= $informativo["artigo"] ?></p>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="galerias my-5">
          <nav>
            <div class="nav nav-tabs my-4" id="nav-tab" role="tablist">
              <? 
                if($isFoto > 0) {echo '<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">FOTOS</a>';} else "";
                if($isVideo > 0) {echo '<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">V&Iacute;DEOS</a>';} else "";
                if($isAnexo > 0) {echo '<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">ANEXOS</a>';} else "";
              ?>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade imagem show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <? $i = 1; foreach($buscaFoto as $foto): ?>
              <a href="<?= $CAMINHOIMG ?>/<?= $foto["foto"] ?>" data-toggle="lightbox" data-gallery="galeria">
                <img src="<?= $CAMINHOIMG ?>/<?= $foto["foto"] ?>" alt="" target="_blank">
              </a>
            <? $i++; endforeach; ?>
            </div>
            <div class="tab-pane fade video" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              <? foreach($buscaVideo as $video):
                $link = video($video['link']); ?>
                <a href="<?=$link['embed']?>" target="_blank">
                  <img src= <?=$link['img']?>>
                </a>
              <? endforeach; ?>
            </div>
            <div class="tab-pane fade anexo" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
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

    </div>
</div>

<div id="modal-p" class="modal modal-p">
    <span class="close cursor" onclick="closeModal()">&times;</span>
    <div class="modal-content">

    <? foreach($buscaInformativoFoto as $key => $foto): ?>
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



