<?php
    $sqlBanner = Conexao::chamar()->prepare("SELECT id_cliente.*
                                               FROM (
                                             SELECT banner.*,
                                                 IF (data_inicial < CURRENT_DATE() 
                                                 OR (data_inicial = CURRENT_DATE()
                                                AND (hora_inicial IS NULL 
                                                 OR CAST(hora_inicial AS time) <= CURRENT_TIME())), 'S', 'N') AS inicio,
                                                 IF (data_limite IS NULL 
                                                 OR (data_limite > CURRENT_DATE() 
                                                 OR (data_limite = CURRENT_DATE() 
                                                AND (hora_limite IS NULL 
                                                 OR CAST(hora_limite AS time) >= CURRENT_TIME()))), 'S', 'N') AS fim 
                                               FROM banner
                                              WHERE status_registro = 'A'
                                                AND id_cliente = '$idCliente') AS id_cliente
                                           ORDER BY id ASC
                                              LIMIT 3
                                              ");
    $sqlBanner->bindValue(":status_registro", "A", PDO::PARAM_STR);
    $sqlBanner->execute();
    $banners = $sqlBanner->fetchAll(PDO::FETCH_ASSOC);
?>
<?php  if(count($banners) > 0 ) { ?>
    <div id="banner" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
<?php 
$active = "active";
for($i = 0; $i < count($banners); $i++) { ?>
        <li data-target="#banner" data-slide-to="<?=$i?>" class="<?=$active?>"></li>
<?php $active = ""; } ;?>
      </ol>
      <div class="carousel-inner">
    <?php
      $active = "active";
      foreach($banners as $banner):
    ?>
        <div class="carousel-item <?= $active ?>">
          <?php 
          if($banner['inicio'] == 'S' && $banner['fim'] == 'S'){ ?> 
            <a href="<?= $banner['url'] ?>">
              <img src="<?= $CAMINHOIMG ?>/<?= $banner['foto'] ?>" alt="<?= $banner['titulo'] ?>" class="img-responsive">
            </a>
            <?php }?>
        </div>

      <?php
        $active = "";
        endforeach; 
      ?>
      </div>
  <a class="carousel-control-prev" href="#banner" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#banner" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<?php } ?>

