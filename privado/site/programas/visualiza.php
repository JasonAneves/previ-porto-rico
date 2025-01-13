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
  $codPrograma = $url[$ii];
  if($id){ $codPrograma = $id; }

  $qryPrograma = Conexao::chamar()->prepare("SELECT programa.*
  FROM programa
  WHERE id_cliente = '$idCliente'
  AND id = '$codPrograma'
  AND status_registro = 'A'");
  $qryPrograma->execute();
  $buscaprograma = $qryPrograma->fetchAll(PDO::FETCH_ASSOC);

  $qryProgramaFoto = Conexao::chamar()->prepare("SELECT programa_foto.*
  FROM programa_foto
  WHERE id_artigo = '$codPrograma'");
  $qryProgramaFoto->execute();
  $buscaprogramaFoto = $qryProgramaFoto->fetchAll(PDO::FETCH_ASSOC);
  $isFoto = count($buscaprogramaFoto);

  $qryProgramaVideo = Conexao::chamar()->prepare("SELECT programa_video.*
  FROM programa_video
  WHERE id_artigo = '$codPrograma'");
  $qryProgramaVideo->execute();
  $buscaProgramaVideo = $qryProgramaVideo->fetchAll(PDO::FETCH_ASSOC);
  $isVideo = count($buscaProgramaVideo);

  $qryProgramaAnexo = Conexao::chamar()->prepare("SELECT programa_anexo.*
  FROM programa_anexo
  WHERE id_artigo = '$codPrograma'");
  $qryProgramaAnexo->execute();
  $buscaProgramaAnexo = $qryProgramaAnexo->fetchAll(PDO::FETCH_ASSOC);
  $isAnexo = count($buscaProgramaAnexo);
?>

<div class="row">
    <div class="container">
        <div class="col-md-12">
          <?php 
            foreach($buscaprograma as $programa): ?>
              <div class="artigo mt-4">
                <h1 class="titulo"><?= $programa["titulo"] ?></h1>
                <p><?= $programa["artigo"] ?></p>
              </div>
          <?php endforeach; ?>
        </div>

        <div class="galerias mb-5">
          <nav>
            <div class="nav nav-tabs mt-4" id="nav-tab" role="tablist">
              <? 
                if($isFoto > 0) {echo '<a class="nav-item nav-link active" id="nav-image-tab" data-toggle="tab" href="#nav-image" role="tab" aria-controls="nav-image" aria-selected="true">FOTOS</a>';} else "";
                if($isVideo > 0) {echo '<a class="nav-item nav-link" id="nav-video-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-video" aria-selected="false">V&Iacute;DEOS</a>';} else "";
                if($isAnexo > 0) {echo '<a class="nav-item nav-link" id="nav-anexo-tab" data-toggle="tab" href="#nav-anexo" role="tab" aria-controls="nav-anexo" aria-selected="false">ANEXOS</a>';} else "";
              ?>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade imagem show active" id="nav-image" role="tabpanel" aria-labelledby="nav-image-tab">
            <? $i = 1; foreach($buscaprogramaFoto as $foto):?>
              <a href="<?= $CAMINHOIMG ?>/<?= $foto["foto"] ?>" data-toggle="lightbox" data-gallery="galeria_sem_sub">
                <img src="<?= $CAMINHOIMG ?>/<?= $foto["foto"] ?>" alt="" target="_blank">
              </a>
            <? $i++; endforeach; ?>
            </div>
            <div class="tab-pane fade video" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
              <? foreach($buscaProgramaVideo as $video):
                $link = video($video['link']); ?>
                <a href="<?=$link['embed']?>" target="_blank">
                  <img src="<?=$link['img']?>" >
                </a>
              <? endforeach; ?>
            </div>
            <div class="tab-pane fade anexo" id="nav-anexo" role="tabpanel" aria-labelledby="nav-anexo-tab">
              <div style="display: grid;grid-template-columns: repeat(6, 1fr);">
                <? foreach($buscaProgramaAnexo as $anexo):
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

        <?php
          $qryOutros = Conexao::chamar()->query("SELECT * 
          FROM programa 
          WHERE id_cliente = '$idCliente' 
          AND id != $codPrograma 
          AND status_registro = 'A' 
          ORDER BY RAND() 
          LIMIT 4");
          $qryOutros->execute();
          $buscaOutros = $qryOutros->fetchAll(PDO::FETCH_ASSOC);

          if (count($buscaOutros) > 0) { 
        ?>
          <div class="outros_artigos">
            <h3>
              Outros programas
              <a href="<?= $CAMINHO ?>programas" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <span class="hidden-xs">VER TODOS</span></a>
            </h3>
            <?php foreach ($buscaOutros as $outros):?>
              <a href="<?= $CAMINHO ?>programas/<?= $outros['id'] ?>" class="linha">
                <h5 style="margin-bottom: 0;"><?= $outros['titulo'] ?></h5>
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

    <? foreach($buscaprogramaFoto as $key => $foto): ?>
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



