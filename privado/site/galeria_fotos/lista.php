<style>
  a.fotos {
    text-decoration: none;
  }

  a.fotos:hover .card {
    background-color: #fff;
    transition: background-color 0.2s ease;
    color: #000;
  }

  .artigo {
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
  overflow: hidden; 
  text-overflow: ellipsis; 
  display: -webkit-box;
  -webkit-line-clamp: 4; 
  -webkit-box-orient: vertical; 
  text-align: justify;
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

  @media (max-width: 768px) {
    .card-header img {
      display: none;
    }
  }

</style>

<?php

try {
  if (isset($url[$ii]) && strlen($url[$ii]) > 0 && $url[$ii] !== "pagina") {

      $id = verificaNum($url[$ii]);
      include "visualiza.php";

  } else {

    $total = Conexao::chamar()->query("SELECT count(*) FROM galeria_foto")->fetchColumn();

    if ($total == 1) {
        $idRegistro = Conexao::chamar()->query("SELECT id_artigo FROM galeria_foto ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        $id = $idRegistro[id_evento];
        include "visualiza.php";

    } else {

      $qryFoto = Conexao::chamar()->prepare("SELECT galeria_foto.*, galeria_foto_foto.foto
      FROM galeria_foto
      LEFT JOIN galeria_foto_foto
      ON galeria_foto_foto.id_artigo = galeria_foto.id
      WHERE galeria_foto.status_registro = 'A' 
      AND id_cliente = '$idCliente'
      GROUP BY id
      ORDER BY galeria_foto.data_publicacao DESC");
      $qryFoto->execute();
      $buscaFoto = $qryFoto->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container ">

    <div class="artigo my-4">
      <h2 class=" acessibilidade">Galeria de Fotos</h2>
    </div>

      <?php foreach($buscaFoto as $foto): ?>
      <a class="fotos" href="<?= $CAMINHO ?>galeria_fotos/<?= $foto['id'] ?>">
        <div class="card flex-row mb-3">
          <div class="card-header">
              <img src="<?= $CAMINHOIMG ."/".$foto["foto"] ?>" alt="">
          </div>
          <div class="card-block px-4 acessibilidade">
              <h5 class="card-data acessibilidade"><?= formata_data($foto["data_publicacao"]) ?></h5>
              <h5 class="card-title acessibilidade"><?= $foto["titulo"] ?></h5>
              <p class="card-text"><?= 	strip_tags($foto["linha_fina"]) ?></p>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  <?php }}} catch (PDOException $e) {
    //print_r($e);
    } ?>