<style>
  a.programas {
    text-decoration: none;
  }

  a.programas:hover .card {
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

    $total = Conexao::chamar()->query("SELECT count(*) FROM programa_foto")->fetchColumn();

    if ($total == 1) {
        $idRegistro = Conexao::chamar()->query("SELECT id_artigo FROM programa_foto ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        $id = $idRegistro[id_artigo];
        include "visualiza.php";

    } else {

      $qryprograma = Conexao::chamar()->prepare("SELECT programa.*, programa_foto.foto
      FROM programa
      LEFT JOIN programa_foto
      ON programa_foto.id_artigo = programa.id
      WHERE programa.id_cliente = '$idCliente'
      AND programa.status_registro = 'A' 
      GROUP BY id");
      $qryprograma->execute();
      $buscaprograma = $qryprograma->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container ">

      <div class="artigo mt-4 mb-4">
        <h1 class="titulo">Programas</h1>
      </div>

      <?php foreach($buscaprograma as $programa): ?>
      <a class="programas" href="<?= $CAMINHO ?>programas/<?= $programa['id'] ?>">
        <div class="card flex-row mb-3">
          <div class="card-header">
              <img src="<?= $CAMINHOIMG ."/".$programa["foto"] ?>" alt="">
          </div>
          <div class="card-block px-4">
              <h5 class="card-data"><?= formata_data($programa["data"]) ?></h5>
              <h5 class="card-title"><?= $programa["titulo"] ?></h5>
              <p class="card-text"><?= mb_strimwidth(strip_tags($programa['artigo']), 0, 100, "..."); ?></p>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  <?php }}} catch (PDOException $e) {
    //print_r($e);
    } ?>