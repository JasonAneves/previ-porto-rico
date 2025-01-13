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

  .artigo h2 {
    color: #007CC2;
    font-size: 35px;
    font-weight: bold;
    font-family: 'Muli', sans-serif;
  }
  </style>
<?php
try {
  if (isset($url[$ii]) && strlen($url[$ii]) > 0) {

      $id = verificaNum($url[$ii]);
      include "visualiza.php";

  } else { ?>
    
    <div class="row" style="margin:0;">
    <div class="container" style="min-height: 500px; padding-bottom: 50px;">
            <?php
            $coresBotoes = array("#337ab7", "#c34c9d", "#59b576", "#bab530", "#5b768e", "#6f787f", "#8b735e", "#757575", "#6fcece", "#5757e0");
            shuffle($coresBotoes);
            $contaCores = 0;

            try {
                $tabela = "galeria_video";
                $titulo = "Galeria de V&iacute;deos";

                if (isset($url[$ii]) && strlen($url[$ii]) > 0 && $url[$ii] !== "pagina") {
                    $id = verificaNum($url[$ii]);
                    include "visualiza.php";
                } else {
                    $total = Conexao::chamar()->query("SELECT count(*) FROM {$tabela} WHERE status_registro = 'A';")->fetchColumn();
                     ?>
                      <div class="artigo my-4">
                        <h2  class="acessibilidade">Galeria de V&iacute;deos</h2>
                      </div>
                    <?php
                        $max = 12;
                        $at = !empty($url[$ii + 1]) ? verificaNum($url[$ii + 1]) : 1;
                        $totalPag = $total / $max > intval($total / $max) ? intval($total / $max) + 1 : intval($total / $max);
                        $limit = $max * ($at - 1);
                        try {
                            $qx = Conexao::chamar()->prepare("SELECT * FROM {$tabela} WHERE status_registro = :status_registro ORDER BY id DESC LIMIT $limit,$max");
                            $qx->bindValue(":status_registro", "A", PDO::PARAM_STR);
                            $qx->execute();?> <div style="display: flex; flex-wrap: wrap;"> <?php
                            foreach ($qx->fetchAll(PDO::FETCH_ASSOC) as $galerias) {

                                $video = video($galerias['link']); ?>

                                <div class="col-md-4 col-sm-6 altura-box-video">
                                  <a href="<?=$video['embed']?>" target="_blank">
                                    <div class="thumbnail" style="height: 380px">
                                        <img src="<?= $video['img'] ?>" style="width: 100%; height: 200px; object-fit: contain;" class="foto-galeria-lista img-responsive" />
                                        <div class="caption text-center">
                                            <h3 class="acessibilidade"><?= $galerias['titulo'] ?></h3>
                                            <p><?= formataArtigo(resumo($galerias['artigo'], 100)) ?></p>
                                        </div>
                                    </div>
                                  </a>
                                </div>
                                
                                <?php
                                $contaCores++;
                                if ($contaCores >= count($coresBotoes)) {
                                    $contaCores = 0;
                                }
                            }?> </div> <?php
                        } catch (PDOException $e) {
                            echo $e->getMessage();
                        }
                        if ($total > $max) {
                            ?>
                            <ul class="pagination pagination-lg">
                                <?php if ($at > 1) { ?>
                                    <li>
                                        <a href="<?= $CAMINHO ?>galeria_video/pagina/1">
                                            <i class="fa fa-angle-double-left"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $CAMINHO ?>galeria_video/pagina/<?= $at - 1 ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php
                                $x = $at <= 3 ? 1 : $at - 2;
                                $y = $at >= $totalPag - 2 ? $totalPag : $at + 2;
                                for ($x; $x <= $y; $x++) {
                                    ?>
                                    <li <?php if ($x == $at) echo "class='active'" ?>><a href="<?= $CAMINHO ?>galeria_video/pagina/<?= $x ?>"><?= $x ?></a></li>
                                <?php } ?>	
                                <?php if ($at < $totalPag) { ?>		  
                                    <li>
                                        <a href="<?= $CAMINHO ?>galeria_video/pagina/<?= $at + 1 ?>">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $CAMINHO ?>galeria_video/pagina/<?= $totalPag ?>">
                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php
                        }
                  
                }
            } catch (PDOException $e) {
                
            }
            ?>
    </div>
</div>        

<?php }} catch (PDOException $e) {
    //print_r($e);
    } ?>