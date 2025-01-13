<style>
    .nav-tabs {
        justify-content: center;
        border-bottom: 2px solid #007CC2;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: #ffffff;
        border-color: #dee2e6 #dee2e6 #fff;
        background-color: #007cc2;
        border-color: #007cc2;
    }

    .nav-tabs .nav-link:focus,
    .nav-tabs .nav-link:hover {
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

    .titulo {
        font: normal normal bold 40px/67px Roboto;
    }

    .center {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .artigo h2 {
        color: #007CC2;
        font-size: 35px;
        font-weight: bold;
        font-family: 'Muli', sans-serif;
    }

    .artigo p {
        margin: 5px 0px 10px 0px;
        font-family: 'Roboto' sans-serif;
        color: #000;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: #ffffff;
        border-color: #dee2e6 #dee2e6 #fff;
        background-color: #007cc2;
        border-color: #007cc2;
    }

    .nav-tabs {
        justify-content: center;
        border-bottom: 2px solid #007CC2;
    }


    .foto-destaque {
        width: 641px;
        height: 420px;
        object-fit: contain;
    }

    .no-border {
        border: none;
    }


    .linha {
        margin-bottom: 20px;
        border-bottom: 4px solid #007CC2;
        width: 94px;
    }


    .hidden {
        display: none;
    }



    @media (max-width: 1199px) {
        .row {
            display: flex;
            justify-content: center;
        }

        .titulo {
            font: normal normal bold 30px/67px Roboto;
            text-align: center;
        }

        .foto-destaque {
            width: 536px;
            height: 355px;
            object-fit: cover;
        }

        .artigo p {
            width: 550px;
            font: normal normal normal 18px/37px Roboto;
            padding: 0 20px 0 0;
        }
    }

    @media (max-width: 991px) {
        .container {
            max-width: 670px;
        }

        .foto-destaque {
            width: 100%;
            height: 10%;
        }

        .artigo p {
            width: 100%;
        }
    }

    @media (max-width: 415px) {
        .artigo p {
            line-height: inherit;
        }
    }
</style>

<?php
$codINstitucional = $url[$ii];

$qryCat = Conexao::chamar()->prepare("SELECT institucional.*
  FROM institucional 
  WHERE status_registro = 'A' 
  and id = '$codINstitucional'
  order by id 
  desc limit 1");
$qryCat->execute();
$BuscaCat = $qryCat->fetchAll(PDO::FETCH_ASSOC);

$qryFt = Conexao::chamar()->prepare("SELECT institucional_foto.*
  FROM institucional_foto 
  where id_artigo = '$codINstitucional'
  order by ordem
  desc LIMIT 8");
$qryFt->execute();
$buscaFoto = $qryFt->fetchAll(PDO::FETCH_ASSOC);
$isFoto = count($buscaFoto);

$qryFtPRINCIPAL = Conexao::chamar()->prepare("SELECT institucional_foto.*
  FROM institucional_foto
  where id_artigo = '$codINstitucional'
  order by ordem desc LIMIT 1");
$qryFtPRINCIPAL->execute();
$BuscaFotoPRINCIPAL = $qryFtPRINCIPAL->fetchAll(PDO::FETCH_ASSOC);
$isFotoPrincipal = count($BuscaFotoPRINCIPAL);

$qryVd = Conexao::chamar()->prepare("SELECT institucional_video.*
  FROM institucional_video
  where id_artigo = '$codINstitucional'
  AND status_registro = 'A'
  order by ordem desc 
  LIMIT 8");
$qryVd->execute();
$buscaVideo = $qryVd->fetchAll(PDO::FETCH_ASSOC);
$isVideo = count($buscaVideo);

$qryAn = Conexao::chamar()->prepare("SELECT institucional_anexo.*
  FROM institucional_anexo
  where id_artigo = '$codINstitucional'
  order by ordem desc 
  LIMIT 8");
$qryAn->execute();
$buscaAnexo = $qryAn->fetchAll(PDO::FETCH_ASSOC);
$isAnexo = count($buscaAnexo);
?>


<div class="row">
    <div class="container">
        <div class="col-md-12 center">


            <?php
            foreach ($BuscaCat as $obra) : ?>
                <div class="artigo my-4">
                    <h2><?= $obra["titulo"] ?></h2>
                </div>

                <?php
                if ($isFotoPrincipal > 0) :
                    foreach ($BuscaFotoPRINCIPAL as $fotoPRIN) :
                        $foto_PRINCIPAL = $CAMINHOIMG . "/" . $fotoPRIN["foto"]; ?>
                        <img class="foto-destaque" src=<?= $foto_PRINCIPAL ?> ;>
                <?php
                    endforeach;
                endif;
                ?>
                <div class="artigo mt-4 acessibilidade">

                    <h1 class="titulo"><?= $obra["nome"] ?></h1>
                    <div class="artigo acessibilidade" style="font-size: 20px;">
                        <p><?= $obra["artigo"] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($buscaFoto) or !empty($buscaVideo) or !empty($buscaAnexo)) { ?>
            <div class="galerias mb-5">
                <nav>
                    <div class="nav nav-tabs mt-4" id="nav-tab" role="tablist">
                        <?
                        if ($isFoto > 0) {
                            echo '<a class="nav-item nav-link active" id="nav-image-tab" data-toggle="tab" href="#nav-image" role="tab" aria-controls="nav-image" aria-selected="true">FOTOS</a>';
                        } else "";
                        if ($isVideo > 0) {
                            echo '<a class="nav-item nav-link" id="nav-video-tab" data-toggle="tab" href="#nav-video" role="tab" aria-controls="nav-video" aria-selected="false">V&Iacute;DEOS</a>';
                        } else "";
                        if ($isAnexo > 0) {
                            echo '<a class="nav-item nav-link" id="nav-anexo-tab" data-toggle="tab" href="#nav-anexo" role="tab" aria-controls="nav-anexo" aria-selected="false">ANEXOS</a>';
                        } else "";
                        ?>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade imagem show active" id="nav-image" role="tabpanel" aria-labelledby="nav-image-tab">
                        <? $i = 1;
                        foreach ($buscaFoto as $foto) : ?>
                            <a href="<?= $CAMINHOIMG ?>/<?= $foto["foto"] ?>" data-toggle="lightbox" data-gallery="galeria">
                                <img src="<?= $CAMINHOIMG ?>/<?= $foto["foto"] ?>" alt="" target="_blank">
                            </a>
                        <? $i++;
                        endforeach; ?>
                    </div>
                    <div class="tab-pane fade video" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">
                        <? foreach ($buscaVideo as $video) :
                            $link = video($video['link']); ?>
                            <a href="<?= $link['embed'] ?>" target="_blank">
                                <img src="<?= $link['img'] ?>">
                            </a>
                        <? endforeach; ?>
                    </div>
                    <div class="tab-pane fade anexo" id="nav-anexo" role="tabpanel" aria-labelledby="nav-anexo-tab">
                        <div style="display: grid;grid-template-columns: repeat(6, 1fr);">
                            <? foreach ($buscaAnexo as $anexo) :
                                $anexo_galeria = $CAMINHOANEXO . "/" . $anexo["arquivo"];
                            ?>
                                <a href="<?= $anexo_galeria ?>" target="_blank" style="display: flex;justify-content: center;align-items: center;">
                                    <img src="<?= $CAMINHO ?>/assets/images/pdf.PNG">
                                    <p><?= $anexo["descricao"] ?></p>
                                </a>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<div id="modal-p" class="modal modal-p">
    <span class="close cursor" onclick="closeModal()">&times;</span>
    <div class="modal-content">

        <? foreach ($buscaFoto as $key => $foto) : ?>
            <div class="mySlides">
                <div class="numbertext"><?= $key + 1 ?> / <?= $isFoto ?></div>
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