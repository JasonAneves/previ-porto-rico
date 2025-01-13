<style>

  .titulo {
    font: normal normal bold 40px/67px Roboto;
    display: contents;
    line-height: 1.2;
  }

  .titulo::after{
    content: "";
    width: 180px;
    height: 4px;
    background: #007cc2;
    display: block;
    margin-top: 20px;
  }

  .artigo p {
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
  $codNoticia = $url[$ii];
  if($id){$codNoticia = $id;}

  $qryNoticia = Conexao::chamar()->prepare("SELECT *
  FROM noticia
  WHERE id = '$codNoticia'
  AND status_registro = 'A'");
  $qryNoticia->execute();
  $buscaNoticia = $qryNoticia->fetchAll(PDO::FETCH_ASSOC);
  
  $qryNoticiaFoto = Conexao::chamar()->prepare("SELECT *
  FROM noticia_foto
  WHERE id_noticia = '$codNoticia'");
  $qryNoticiaFoto->execute();
  $buscaFoto = $qryNoticiaFoto->fetchAll(PDO::FETCH_ASSOC);
  $isFoto = count($buscaFoto);

  $qryNoticiaVideo = Conexao::chamar()->prepare("SELECT *
  FROM noticia_video
  WHERE id_noticia = '$codNoticia'");
  $qryNoticiaVideo->execute();
  $buscaVideo = $qryNoticiaVideo->fetchAll(PDO::FETCH_ASSOC);
  $isVideo = count($buscaVideo);

  $qryNoticiaAnexo = Conexao::chamar()->prepare("SELECT *
  FROM noticia_anexo
  WHERE id_noticia = '$codNoticia'");
  $qryNoticiaAnexo->execute();
  $buscaAnexo = $qryNoticiaAnexo->fetchAll(PDO::FETCH_ASSOC);
  $isAnexo = count($buscaAnexo);
?>

<div class="row">
    <div class="container">
        <div class="col-md-12">
          <?php 
            foreach($buscaNoticia as $noticia): ?>
              <div class="artigo mt-4 acessibilidade">
                <p class="acessibilidade"><?= $noticia['chapeu'] ?></p>
                <h1 class="titulo acessibilidade"><?= $noticia["titulo"] ?></h1>
                <small>&Uacute;ltima atualiza&ccedil;&atilde;o: <?= formata_data_hora($noticia['data_noticia']) ?></small>
                <p class="acessibilidade"><?= $noticia["artigo"] ?></p>
                <small><strong>Fonte:</strong> <?= $noticia["fonte"] ?></small>
              </div>
          <?php endforeach; ?>
        </div>

        <?php if(!empty($buscaFoto) or !empty($buscaVideo) or !empty($buscaAnexo)) { ?>
        <div class="galerias mb-5">
          <nav>
            <div class="nav nav-tabs mt-4" id="nav-tab" role="tablist">
              <?php 
                if($isFoto > 0) {echo '<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">FOTOS</a>';} else "";
                if($isVideo > 0) {echo '<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">V&Iacute;DEOS</a>';} else "";
                if($isAnexo > 0) {echo '<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">ANEXOS</a>';} else "";
              ?>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade imagem show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <? $i = 1; foreach($buscaFoto as $foto): ?>
              <a href="<?= $CAMINHOIMG ?>/<?= $foto["foto"] ?>" data-toggle="lightbox" data-gallery="noticias">
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
                  $anexo_galeria = $CAMINHOANEXO . "/1/" . $anexo["arquivo"];
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
          FROM noticia
          WHERE id_cliente = '$idCliente' 
          AND id != $codNoticia 
          AND (data_inicial IS NULL 
          OR data_inicial <= CURRENT_DATE())
          AND (data_limite IS NULL 
          OR data_limite >= CURRENT_DATE())
          AND status_registro = 'A' 
          ORDER BY RAND() 
          LIMIT 4");
          $qryOutros->execute();
          $buscaOutros = $qryOutros->fetchAll(PDO::FETCH_ASSOC);

          if (count($buscaOutros) > 0) { 
        ?>
          <div class="outros_artigos acessibilidade">
            <h3 class="acessibilidade">
              Outras Not&iacute;cias
              <a href="<?= $CAMINHO ?>noticias" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <span class="hidden-xs">VER TODOS</span></a>
            </h3>
            <?php foreach ($buscaOutros as $outros):?>
              <a href="<?= $CAMINHO ?>noticias/<?= $outros['id'] ?>" class="linha acessibilidade">
                <h5 class="acessibilidade" style="margin:5px 0 0 0;"><?= $outros['titulo'] ?></h5>
                <small><?= mb_strimwidth(strip_tags($outros['artigo']), 0, 100, "..."); ?></small>
              </a>
            <?php endforeach; ?>
          </div>

        <?php } ?>

    </div>
</div>

<div id="modal-p" class="modal modal-p">
    <span class="close cursor" onclick="closeModal()">&times;</span>
    <div class="modal-content">

    <? foreach($buscaNoticiaFoto as $key => $foto): ?>
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



