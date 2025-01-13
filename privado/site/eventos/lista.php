<style>
  a.bloco {
    text-decoration: none;
  }

  a.bloco:hover .card {
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

  .pagination {justify-content: center;}

  .pagination>li>a, .pagination>li>span {
      position: relative;
      float: left;
      padding: 6px 12px;
      margin-left: -1px;
      line-height: 1.42857143;
      color: #333333;
      text-decoration: none;
      border: 1px solid #ddd;
  }

  .pagination>li:hover{
    background: #f7f7f7;
  }

  .pagination>.active>a, 
  .pagination>.active>a:focus, 
  .pagination>.active>a:hover, 
  .pagination>.active>span, 
  .pagination>.active>span:focus, 
  .pagination>.active>span:hover {
    z-index: 3;
    cursor: default;
    border-color: #333333;
    background: #f7f7f7;
  }

  @media (max-width:768px) {
    .card-header {
      display: none;
    }
  }

</style>

<?php

  $tabela = 'evento';
  $titulo = 'Eventos';

  try {
    if (isset($url[$ii]) && strlen($url[$ii]) > 0 && $url[$ii] !== "pagina") {
      $id = verificaNum($url[$ii]);
      include "visualiza.php";
    } else {
      $total = Conexao::chamar()->query("SELECT count(*) FROM {$tabela} WHERE status_registro = 'A';")->fetchColumn();

      if ($total == 1) {
        $idRegistro = Conexao::chamar()->query("SELECT id FROM {$tabela} WHERE status_registro = 'A' ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        $id = $idRegistro['id'];
        include "visualiza.php";
      } else { ?>

        <div class="container" style="min-height: 500px;">

          <div class="artigo mt-4 mb-4">
            <h2 class="acessibilidade"><?=$titulo?></h2>
          </div>

          <?php
            $max = 5;
            $at = !empty($url[$ii + 1]) ? verificaNum($url[$ii + 1]) : 1;
            $totalPag = $total / $max > intval($total / $max) ? intval($total / $max) + 1 : intval($total / $max);
            $limit = $max * ($at - 1);
            
            $qry = Conexao::chamar()->prepare("SELECT {$tabela}.*, {$tabela}_foto.foto
            FROM {$tabela}
            LEFT JOIN {$tabela}_foto
            ON {$tabela}_foto.id_evento = {$tabela}.id
            WHERE {$tabela}.status_registro = 'A' 
            AND id_cliente = '$idCliente'
            GROUP BY id
            LIMIT $limit,$max");
            $qry->execute();
            $busca = $qry->fetchAll(PDO::FETCH_ASSOC);
          ?>

          <?php  foreach($busca as $artigo): ?>
          <a class="bloco" href="<?= $CAMINHO?>eventos/<?= $artigo['id'] ?>">
            <div class="card flex-row mb-3">
              <div class="card-header">
                <?php
                  if (!empty($artigo['foto'])){
                    $foto = $CAMINHOIMG ."/".$artigo["foto"];
                  } else {
                    $foto = $CAMINHO ."/assets/images/semfoto.png";
                  }
                ?>
                  <img src="<?= $foto ?>" alt="">
              </div>
              <div class="card-block px-4 acessibilidade">
                  <h5 class="card-title acessibilidade"><?= $artigo["titulo"] ?></h5>
                  <p class="card-text"><?= mb_strimwidth(strip_tags($artigo['artigo']), 0, 100, "..."); ?></p>
              </div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      <?php }
      
      if ($total > $max) {
        ?>
        <div class="container">
          <ul class="pagination pagination-lg">
            <?php if ($at > 1) { ?>
              <li><a href="<?= $CAMINHO?>eventos/pagina/1"><i class="fa fa-angle-double-left"></i></a></li>
              <li><a href="<?= $CAMINHO?>eventos/pagina/<?= $at - 1 ?>"><i class="fa fa-angle-left"></i></a></li>
            <?php } ?>
            <?php
              $x = $at <= 3 ? 1 : $at - 2;
              $y = $at >= $totalPag - 2 ? $totalPag : $at + 2;

              for ($x; $x <= $y; $x++) {
            ?>
              <li <?php if ($x == $at) echo "class='active'" ?>><a href="<?= $CAMINHO?>eventos/pagina/<?= $x ?>"><?= $x ?></a></li>
            <?php } ?>
            <?php if ($at < $totalPag) { ?>		  
              <li><a href="<?= $CAMINHO?>eventos/pagina/<?= $at + 1 ?>"><i class="fa fa-angle-right"></i></a></li>
              <li><a href="<?= $CAMINHO?>eventos/pagina/<?= $totalPag ?>"><i class="fa fa-angle-double-right"></i></a></li>
            <?php } ?>
          </ul>
        </div>
        <?php
      }
    }
  } catch (PDOException $e) {
    //print_r($e);
    } ?>