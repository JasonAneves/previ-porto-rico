<div class="container noticias">
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 titulo-noticias">
      <span class="acessibilidade">NOTÍCIAS</span>
    </div>
    
    <div class="col-lg-12 bloco-noticias">
      <?php
        $qryNoticia = Conexao::chamar()->prepare("SELECT * FROM noticia
                                                     WHERE id_cliente = '$idCliente' 
                                                     AND (data_inicial IS NULL 
                                                        OR data_inicial <= CURRENT_DATE())
                                                       AND (data_limite IS NULL 
                                                        OR data_limite >= CURRENT_DATE()) 
                                                       AND id_cliente = :cliente
                                                       AND status_registro = :status_registro
                                                       AND tipo = :tipo
                                                     ORDER BY id DESC
                                                     LIMIT 3");
        $qryNoticia->execute(array(":cliente" => $idCliente, ":status_registro" => "A", ":tipo" => "F"));
        $StNoticias = $qryNoticia->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <div class="col-lg-8 col-md-12 col-sm-12 col-sx-12">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php $index = 0;
              foreach ($StNoticias as $key => $noticia) {
                $qryNoticiaFoto = Conexao::chamar()->prepare("SELECT * FROM noticia_foto WHERE id_noticia = :id_noticia LIMIT 1");
                $qryNoticiaFoto->execute(array(":id_noticia" => $noticia['id']));
                $noticiaFoto = $qryNoticiaFoto->fetch(PDO::FETCH_ASSOC);
                $fotoDestaque = $CAMINHO."assets/images/semfoto.png";
                if($noticiaFoto){
                  $fotoDestaque = $CAMINHOIMG ."/".$noticiaFoto['foto'];
                }
            ?>
              <div class="carousel-item <?php if ($index == 0){echo "active";} ?>">
                <a href="<?=$CAMINHO?>noticias/<?=$noticia['id']?>">
                  <img class="d-block w-100" src="<?=$fotoDestaque?>" alt="First slide" style="object-fit: cover;">
                  <div class="carousel-caption d-md-block">
                    <p class="acessibilidade"><?=$noticia['titulo']?></p>
                  </div>
                </a>
              </div>
              <?php $index ++; } ?>
          </div>
            
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
      </div>
      <div class="row col-lg-4 col-md-12 bloco-ultimas hidden-sm hidden-xs">
          <?php
            $qryNoticiaUltimas = Conexao::chamar()->prepare("SELECT *
                                                        FROM noticia
                                                        WHERE id_cliente = :cliente
                                                          AND status_registro = :status_registro
                                                          AND tipo = :tipo
                                                        ORDER BY id DESC
                                                        LIMIT 2");
            $qryNoticiaUltimas->execute(array(":cliente" => $idCliente, ":status_registro" => "A", ":tipo" => "U"));
            $StNoticiasUltimas = $qryNoticiaUltimas->fetchAll(PDO::FETCH_ASSOC);

            foreach ($StNoticiasUltimas as $key => $ultimas_noticias) {
              $qryNoticiaFoto = Conexao::chamar()->prepare("SELECT * FROM noticia_foto WHERE id_noticia = :id_noticia LIMIT 1");
              $qryNoticiaFoto->execute(array(":id_noticia" => $ultimas_noticias['id']));
              $noticiaFoto = $qryNoticiaFoto->fetch(PDO::FETCH_ASSOC);
              $foto = $CAMINHO."assets/images/semfoto.png";
              if($noticiaFoto){
                $foto = $CAMINHOIMG."/".$noticiaFoto['foto'];
              }
          ?>
          <div class="item-ultimas col-lg-12 col-md-6 hidden-sm hidden-xs">
            <a href="<?=$CAMINHO?>noticias/<?=$ultimas_noticias['id']?>">
              <div class="ultimas-noticias">
                <img src="<?=$foto?>" alt="<?=$noticiaFoto['legenda']?>" style="object-fit: cover;">
                <p class="acessibilidade"><?=$ultimas_noticias['titulo']?></p>
              </div>
            </a>
          </div>
          <?php  } ?>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn-ver-todas">
      <a href="<?=$CAMINHO?>noticias">
        <span class="acessibilidade">VER TODAS AS NOT&Iacute;CIAS</span>
      </a>
    </div>

</div>