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

  .ekko-lightbox{
    display: inherit !important;
  }

</style>

<?php
  $tabela = "evento";
  $pagina = "eventos";

  $id = $url[$ii];
  if($id){ $id = $id; }

  $qryEvento = Conexao::chamar()->prepare("SELECT {$tabela}.*
  FROM {$tabela}
  WHERE id = '$id'
  AND status_registro = 'A'");
  $qryEvento->execute();
  $buscaEvento = $qryEvento->fetchAll(PDO::FETCH_ASSOC);
  
  $qryFoto = Conexao::chamar()->prepare("SELECT {$tabela}_foto.*
  FROM {$tabela}_foto
  WHERE id_evento = '$id'");
  $qryFoto->execute();
  $buscaFoto = $qryFoto->fetchAll(PDO::FETCH_ASSOC);
  $isFoto = count($buscaFoto);
?>

<div class="row">
  <div class="container">
    <div class="col-md-12">
      <?php foreach($buscaEvento as $evento): ?>
        <div class="artigo my-4 acessibilidade">
          <h2 class=" acessibilidade"><?=$evento["titulo"]?></h2>
        </div>
        <div class="artigo acessibilidade">
          <p><?= $evento["artigo"] ?></p>
        </div>
      <?php endforeach; ?>
    </div>

    <?php if(!empty($buscaFoto) or !empty($buscaVideo) or !empty($buscaAnexo)) { ?>
      <div class="galerias my-5">
        <nav>
          <div class="nav nav-tabs mt-4" id="nav-tab" role="tablist">
            <? 
              if($isFoto > 0) {echo '<a class="nav-item nav-link active" id="nav-image-tab" data-toggle="tab" href="#nav-image" role="tab" aria-controls="nav-image" aria-selected="true">FOTOS</a>';} else "";
            ?>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade imagem show active" id="nav-image" role="tabpanel" aria-labelledby="nav-image-tab">
          <? $i = 1; foreach($buscaFoto as $foto):?>
            <a href="<?= $CAMINHOIMG ?>/<?= $foto["foto"] ?>" data-toggle="lightbox" data-gallery="galeria">
              <img src="<?= $CAMINHOIMG ?>/<?= $foto["foto"] ?>" alt="" target="_blank">
            </a>
          <? $i++; endforeach; ?>
          </div>

        </div>
      </div>
    <?php } ?>

    <?php
      $qryOutros = Conexao::chamar()->query("SELECT * 
      FROM {$tabela} 
      WHERE id_cliente = '$idCliente' 
      AND id != $id 
      AND status_registro = 'A' 
      ORDER BY RAND() 
      LIMIT 4");
      $qryOutros->execute();
      $buscaOutros = $qryOutros->fetchAll(PDO::FETCH_ASSOC);

      if (count($buscaOutros) > 0) { 
    ?>
      <div class="outros_artigos">
        <h3>
          Outros Artigos
          <a href="<?= $CAMINHO?>eventos" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <span class="hidden-xs">VER TODOS</span></a>
        </h3>
        <?php foreach ($buscaOutros as $outros):?>
          <a href="<?= $CAMINHO?>eventos/<?= $outros['id'] ?>" class="linha">
            <h5 style="margin-bottom: 0;"><?= $outros['titulo'] ?></h5>
            <small><?= mb_strimwidth(strip_tags($outros['artigo']), 0, 100, "..."); ?></small>
          </a>
        <?php endforeach; ?>
      </div>

    <?php } ?>

  </div>
</div>



