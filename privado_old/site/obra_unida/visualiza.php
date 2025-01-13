<style>
  .titulo {
    font: normal normal bold 40px/67px Roboto;
  }

  .artigo p{
    margin: 5px 0px 10px 0px;
    width: 637px;
    font: normal normal normal 20px/37px Roboto;
    color: #000;
  }

  .grid-container-institucional {
    display: grid; 
    grid-template-areas: 'artigo foto';
  }

  .grid-galerias {
    grid-area: foto; 
    border-left: 1px solid #707070;
  }

  .grid-galeria-titulo {
    display: grid;
    justify-items: center;
    width: 100%;
    margin-bottom: 20px;
    /* display: contents; */
  }

  .grid-galeria-titulo h1,
  .grid-galeria-anexo-titulo {
    text-align: center;
    font: normal normal bold 30px/44px Fira Sans;
    color: #000000;
    opacity: 1;
  }

  .area-galerias {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-left: 10px
  }

  .area-galeria-anexo {
    border-top: 1px solid #707070;
    margin-top: 22px;
    padding-top: 20px;
  }

  .grid-galeria-anexo {
    display: grid;
    justify-items: center;
    width: 100%;
  }

  .grid-arquivo-galeria {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 40px;
  }

  .grid-arquivo-galeria img{
    transition: all 0.2s ease;
  }

  .grid-arquivo-galeria a:hover img {
    margin-top: -15px;
    transition: all 0.2s ease;
  }

  .grid-arquivo-galeria a {
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
  }

  .grid-arquivo-galeria p {
    margin-left: 10px;
    font: normal normal 800 17px/27px Fira Sans;
    letter-spacing: 0.19px;
  }

  div.area-galerias:nth-child(2) {
    margin-top: 20px;
  }

  .foto-destaque {
    width: 641px; 
    height: 420px;
    object-fit: contain;
  }

  .grid-imagens-galeria-foto,
  .grid-imagens-galeria-video,
  .grid-imagens-galeria-shimmer-foto,
  .grid-imagens-galeria-shimmer-video {
    border-bottom: 1px solid #707070;
    padding-bottom: 40px;
    display: grid; 
    grid-template-columns: repeat(2, 0fr);
    gap: 15px 15px;
  }

  .no-border {
    border: none;
  }

  .grid-imagens-galeria-foto img,
  .grid-imagens-galeria-video img {
    width: 179px; 
    height: 113px;
    object-fit: cover;
  }

  .grid-imagens-galeria-foto img:hover,
  .grid-imagens-galeria-video img:hover {
    opacity: 0.8;
  }

  .linha {
    margin-bottom: 20px;
    border-bottom: 4px solid #007CC2;
    width: 94px;
  }

  /* shimmer */
  .shine {
    background: #f6f7f8;
    background-image: linear-gradient(to right, #f6f7f8 0%, #edeef1 20%, #f6f7f8 40%, #f6f7f8 100%);
    background-repeat: no-repeat;
    background-size: 800px 104px; 
    display: inline-block;
    position: relative; 
    
    -webkit-animation-duration: 1s;
    -webkit-animation-fill-mode: forwards; 
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-name: placeholderShimmer;
    -webkit-animation-timing-function: linear;
    }

  box {
    width: 194px;
      height: 128px;
  }

  lines {
    height: 10px;
    margin-top: 10px;
    width: 200px; 
  }

  photo {
    display: block!important;
    width: 325px; 
    height: 100px; 
    margin-top: 15px;
  }

  @-webkit-keyframes placeholderShimmer {
    0% {
      background-position: -468px 0;
    }
    
    100% {
      background-position: 468px 0; 
    }
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
    .grid-imagens-galeria-foto img,
    .grid-imagens-galeria-video img {
      width: 144px;
      height: 98px;
      object-fit: cover;
    }
    .grid-galerias {
      padding-left: 25px;
      margin-left: 10px;
    }
    .grid-galeria-titulo h1, .grid-galeria-anexo-titulo {
      font: normal normal bold 25px/44px Fira Sans;
    }
    .grid-arquivo-galeria p {
      font: normal normal 800 14px/27px Fira Sans;
      letter-spacing: 0;
      line-height: inherit;
    }
  }
  @media (max-width: 991px) {
    .grid-container-institucional {
      display: contents;
    }
    .grid-galerias {
      border-left: none;
      padding-left: 0;
      margin-left: 0;
    }
    .grid-imagens-galeria-foto img,
    .grid-imagens-galeria-video img {
      width: 244px;
      height: 148px;
    }
    .grid-arquivo-galeria {
      grid-template-columns: repeat(1, 1fr);
    }
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
    .area-galerias {
    margin-left: 0;
    }
    box {
      display: none;
    }
  }
  @media (max-width: 562px) {
    .grid-imagens-galeria-foto img, .grid-imagens-galeria-video img {
      width: 184px;
      height: 122px;
    }
  }
  @media (max-width: 415px) {
    .grid-imagens-galeria-foto img,
    .grid-imagens-galeria-video img {
      width: 164px;
      height: 108px;
    }
  }

</style>

<?php

    $codObra = explode('/', $_GET['cod'])[1];

		$qryCat = Conexao::chamar()->prepare("SELECT obra_unida.*, obra_unida_foto.foto, obra_unida_foto.id_artigo, obra_unida_foto.legenda
                                                FROM obra_unida 
                                                INNER JOIN obra_unida_foto ON obra_unida.id = obra_unida_foto.id_artigo 
                                                WHERE status_registro = 'A' 
                                                and id_artigo = '$codObra'
                                                order by id 
                                                desc limit 1");
		$qryCat->execute();
		$BuscaCat = $qryCat->fetchAll(PDO::FETCH_ASSOC);


        $qryFt = Conexao::chamar()->prepare("SELECT obra_unida_foto.*
        FROM obra_unida_foto 
        where id_artigo = '$codObra'
        order by ordem
        desc LIMIT 8");
        $qryFt->execute();
        $BuscaFoto = $qryFt->fetchAll(PDO::FETCH_ASSOC);

        $qryVd = Conexao::chamar()->prepare("SELECT obra_unida_video.*
        FROM obra_unida_video
        where id_artigo = '$codObra'
        AND status_registro = 'A'
        order by ordem
        desc LIMIT 8");
        $qryVd->execute();
        $BuscaVideo = $qryVd->fetchAll(PDO::FETCH_ASSOC);

        $qryAn = Conexao::chamar()->prepare("SELECT obra_unida_anexo.*
        FROM obra_unida_anexo
        where id_artigo = '$codObra'
        order by ordem
        desc LIMIT 8");
        $qryAn->execute();
        $BuscaAnexo = $qryAn->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="row">
    <div class="container">
        <div class="col-md-12">

            <br>
            <?php 

            foreach($BuscaCat as $cat): $foto = $CAMINHOIMG . "/" . $cat["foto"];?>
            <div class="grid-container-institucional">
                <div class="artigo" style="grid-area: artigo;">
                    <h1 class="titulo"><?= $cat["nome"] ?></h1>
                    <img class="foto-destaque" src= <?= $foto ?> ;>
                    <p style="font-size: 14px;"><?= $cat["legenda"] ?></p>
                    <p><?= $cat["artigo"] ?></p>
                </div>
                <div class="grid-galerias">
                    <div class="area-galerias" >
                        <div class="grid-galeria-titulo">
                            <h1 class="acessibilidade">Galeria de Imagens</h1>
                            <div class="linha"></div>
                        </div>

                        <div class="grid-imagens-galeria-shimmer-foto">
                          <box class="shine"></box>
                          <box class="shine"></box>
                          <box class="shine"></box>
                          <box class="shine"></box>
                          <box class="shine"></box>
                          <box class="shine"></box>
                          <box class="shine"></box>
                          <box class="shine"></box>
                        </div>

                        <div class="grid-imagens-galeria-foto hidden">
                            <?php foreach($BuscaFoto as $foto):  
                              $foto_galeria = $CAMINHOIMG . "/" . $foto["foto"];?>
                                <a href="<?= $foto_galeria ?>" target="_blank">
                                  <img src= <?= $foto_galeria ?>>
                                </a>
                            <?php endforeach; ?>
                          
                        </div>
                    </div>
                    <div class="area-galerias" >
                        <div class="grid-galeria-titulo">
                            <h1 class="acessibilidade">Galeria de V&iacute;deos</h1>
                            <div class="linha"></div>
                        </div>

                        <div class="grid-imagens-galeria-shimmer-video no-border">
                          <box class="shine"></box>
                          <box class="shine"></box>
                          <box class="shine"></box>
                          <box class="shine"></box>
                          <box class="shine"></box>
                          <box class="shine"></box>
                          <box class="shine"></box>
                          <box class="shine"></box>
                        </div>

                        <div class="grid-imagens-galeria-video no-border hidden">
                        <?php foreach($BuscaVideo as $video): 
                          $link = video($video['link']); ?>
                                <a href="<?=$link['embed']?>" target="_blank" data-toggle="lightbox" data-gallery="quem_somos_videos" data-title="<?=$link['title']?>">
                                  <img src= <?=$link['img']?>>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
                <div class="area-galeria-anexo">
                    <div class="grid-galeria-anexo">
                        <h1 class="acessibilidade grid-galeria-anexo-titulo">Galeria de Anexos</h1>
                        <div class="linha"></div>
                    </div>
                    <div class="grid-arquivo-galeria">
                    <?php foreach($BuscaAnexo as $anexo): $anexo_galeria = $CAMINHOANEXO . "/" . $anexo["arquivo"];?>
                      <a href="<?= $anexo_galeria?>" target="_blank">
                          <img src="<?= $CAMINHO . $caminhoUploadArquivo?>pdf.PNG">
                          <p> <strong><?= $anexo["descricao"] ?></strong> </p>
                      </a>
                    <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>



