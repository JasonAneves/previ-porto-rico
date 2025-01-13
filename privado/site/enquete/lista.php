<style>
  a.eventos {
    text-decoration: none;
  }

  a.eventos:hover .card {
    background-color: #fff;
    transition: background-color 0.2s ease;
    color: #000;
  }

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

  .card {
    padding: 15px;
    background-color: #F7F7F7;
    transition: background-color 0.2s ease;
    word-break: break-word;
  }

  .card-header {
    padding: 0;
  }

  .card-title {
    color: #000;
  }

  .card-block p{
  /* overflow: hidden; 
  text-overflow: ellipsis; 
  display: -webkit-box;
  -webkit-line-clamp: 2; 
  -webkit-box-orient: vertical; 
  text-align: justify; */
  color: #000;
  }

  .card-header img {
    width: 100px;
    height: 100px;
    object-fit: cover;
  }

  .card-data {
    color: #007CC2;
  }

</style>

<?php

try {
  if (isset($url[$ii]) && strlen($url[$ii]) > 0 && $url[$ii] !== "pagina") {

      $id = verificaNum($url[$ii]);
      include "visualiza.php";

  } else {

    $total = Conexao::chamar()->query("SELECT count(*) FROM beneficios")->fetchColumn();

    if ($total == 1) {
        $idRegistro = Conexao::chamar()->query("SELECT id_artigo FROM beneficios_anexo ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        $id = $idRegistro[id_evento];
        include "visualiza.php";

    } else {

      $qryEnquete = Conexao::chamar()->prepare("SELECT *
      FROM enquete");
      $qryEnquete->execute();
      $buscaEnquete = $qryEnquete->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container ">

      <div class="artigo mt-4 mb-4">
        <h1 class="titulo">ENQUETE</h1>
      </div>

      <?php foreach($buscaEnquete as $enquete): ?>
      <a class="eventos" href="<?= $CAMINHO ?>enquete/<?= $enquete['id'] ?>">
        <div class="card flex-row mb-3 acessibilidade">
          <div class="card-block px-4">
              <h5 class="card-data"><?= formata_data($enquete["data"]) ?></h5>
              <h5 class="card-title acessibilidade"><?= $enquete["titulo"] ?></h5>
              <p class="card-text"><?= mb_strimwidth(strip_tags($enquete['artigo']), 0, 100, "..."); ?></p>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  <? }}} catch (PDOException $e) {
    //print_r($e);
    } ?>