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

  .thumbnail{
	position:relative; /* para colocar os elemento dentro do thumbnail */
	overflow:hidden; /*escolher o que deverá acontecer se o conteúdo ultrapassar o tamanho do seletor thumbnail.*/
  }
  .caption {
    position: absolute;
    top: 0;
    right: 0;
    background: rgba(66, 139, 202, 0.55);
    width: 100%;
    height: 100%;
    opacity: 0;
    color: #fff !important;
    z-index: 2;
    transition: opacity 0.2s ease;
    display: flex;
    justify-content: center;
    align-items: center;
}

  .thumbnail:hover .caption{
    opacity: 1;
    transition: opacity 0.2s ease;
    
  }

  .descricao{
    text-align: center;
  }

</style>

<?php
  session_start();

  $codEnquete = $url[$ii];
  if($id){ $codEnquete = $id; }

  $qryEnquete = Conexao::chamar()->prepare("SELECT *
  FROM enquete
  WHERE id_cliente = '$idCliente'
  and id = '$codEnquete'
  AND status_registro = 'A'");
  $qryEnquete->execute();
  $buscaEnquete = $qryEnquete->fetchAll(PDO::FETCH_ASSOC);
  
  $qryEnqueteAlternativa = Conexao::chamar()->prepare("SELECT *
  FROM enquete_alternativa
  WHERE id_enquete = '$codEnquete'");
  $qryEnqueteAlternativa->execute();
  $buscaAlternativa = $qryEnqueteAlternativa->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row">
    <div class="container">
        <div class="col-md-12">
          <?php 
            foreach($buscaEnquete as $enquete): ?>
              <div class="artigo mt-4">
                <h1 class="titulo acessibilidade"><?= $enquete["titulo"] ?></h1>
                <p><?= $enquete["artigo"] ?></p>
              </div>
          <?php endforeach; ?>
        </div>

        <?php

            if(isset($_SESSION['sim']) && isset($_SESSION['nao'])){
              echo $_SESSION['nao'];
            } else {echo $_SESSION['sim'];}

            session_destroy();
        ?>

      <?php foreach($buscaAlternativa as $alternativa): ?>

        <div class="thumbnail">

            <div class="card flex-row mb-3">
              <div class="caption">
                <a  class="btn btn-success" href="<?= $CAMINHO ?>votar/<?= $alternativa['id'] ?>">votar</a>
              </div>
              <?php if($alternativa["foto"] != ""){ ?>
              <div class="card-header">
                  <img src="<?= $CAMINHOIMG ."/".$alternativa["foto"] ?>" alt="">
              </div>
              <?php } ?>
              <div class="card-block px-4">
                  <h5 class="card-data"><?= formata_data($alternativa["data"]) ?></h5>
                  <h5 class="card-title acessibilidade"><?= $alternativa["descricao"] ?></h5>
                  <p class="card-text"><strong>Votos: </strong><?= $alternativa['votos'] ?></p>
              </div>
            </div>

        </div>

      <?php endforeach; ?>


        <?php
          $qryOutros = Conexao::chamar()->query("SELECT * 
          FROM enquete 
          WHERE id_cliente = '$idCliente' 
          AND id != $codEnquete 
          AND status_registro = 'A' 
          ORDER BY RAND() 
          LIMIT 4");
          $qryOutros->execute();
          $buscaOutros = $qryOutros->fetchAll(PDO::FETCH_ASSOC);

          if (count($buscaOutros) > 0) { 
        ?>
        <div class="outros_artigos">
          <h3>
            Outras Enquetes
            <a href="<?= $CAMINHO ?>enquete" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> <span class="hidden-xs">VER TODAS</span></a>
          </h3>
          <?php foreach ($buscaOutros as $outros):?>
            <a href="<?= $CAMINHO ?>enquete/<?= $outros['id'] ?>" class="linha">
              <h5 style="margin-bottom: 0;"><?= $outros['titulo'] ?></h5>
              <small><?= mb_strimwidth(strip_tags($outros['artigo']), 0, 100, "..."); ?></small>
            </a>
          <?php endforeach; ?>
        </div>
        <?php } ?>

    </div>
</div>

<script>
  setTimeout(function() {
    $('.sumir').fadeOut('slow');
  }, 2000);
</script>

