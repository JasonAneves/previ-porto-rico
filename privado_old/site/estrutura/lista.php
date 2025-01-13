<div class="row" style="margin:0;">
  <div class="container acessibilidade" style="min-height: 500px; padding: 20px 15px;">
    <h2  style="color: #007CC2;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">Estrutura</h2>
      <?php
        $codPrev = $url[$ii];
        $qryCat = Conexao::chamar()->prepare("SELECT * FROM estrutura WHERE id_cliente = '$idCliente' AND id = '$codPrev' AND status_registro = 'A' ORDER BY titulo ASC");
        $qryCat->execute();
        $buscaCat = $qryCat->fetchAll(PDO::FETCH_ASSOC);
      
        foreach($buscaCat as $cat): ?>
          <div class="column" style="border: 2px solid aliceblue;padding: 10px;margin: 10px 0;">
            <p style='color: #007CC2; font-size: 16px;'><strong ><?= $cat['titulo'] ?></strong></p>
              <?= $cat['artigo'] ?>
          </div>   
        <?php endforeach ?>

          <?php
            $qryFoto = Conexao::chamar()->prepare("SELECT * FROM estrutura_foto WHERE id_artigo = '$codPrev' ORDER BY id DESC");
            $qryFoto->execute();
            $buscaFoto = $qryFoto->fetchAll(PDO::FETCH_ASSOC); 
            if(count($buscaFoto) > 0) {
          ?>
            
          <div class="galeria-foto">
            <div class="panel-heading" style="background: aliceblue; ">
              <h5 class="panel-title acessibilidade" style="padding:10px;">Galeria de fotos</h5>
            </div>
            <div style="border: 2px solid aliceblue;padding: 10px 0;padding: 10px; display: flex;justify-content: flex-start;flex-wrap: wrap; margin-top: -10px; margin-bottom: 10px;">
            <?php foreach($buscaFoto as $foto): ?>
              <a href="<?=$CAMINHOIMG .'/'. $foto['foto']?>" target="_blank" style="margin-right: 10px;" data-toggle="lightbox" data-gallery="galeria">
                <img src="<?=$CAMINHOIMG .'/'. $foto['foto']?>" alt="arquivo" style="object-fit: cover;width: 250px;height:140px;margin-bottom: 10px;">
              </a>
              <?php endforeach ?>
            </div>
          </div>

          <?php } ?>

          <?php          
            $qryVideo = Conexao::chamar()->prepare("SELECT * FROM estrutura_video WHERE id_artigo = '$codPrev' ORDER BY id DESC");
            $qryVideo->execute();
            $buscaVideo = $qryVideo->fetchAll(PDO::FETCH_ASSOC); 
            if(count($buscaVideo) > 0) {
          ?>

          <div class="galeria-video">
            <div class="panel-heading" style="background: aliceblue; ">
              <h5 class="panel-title acessibilidade" style="padding:10px;">Galeria de vídeos</h5>
            </div>
            <div style="border: 2px solid aliceblue;padding: 10px 0;padding: 10px; display: flex;justify-content: flex-start;flex-wrap: wrap; margin-top: -10px;margin-bottom: 10px;">
            <?php
              foreach($buscaVideo as $busca_video): 
              $link = explode("=", $busca_video['link']);
            ?>
              <iframe width="250" height="140" src="https://www.youtube.com/embed/<?=$link[1];?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="margin-bottom: 10px;"></iframe>
              <?php endforeach; ?>
            </div>
          </div>
          <?php } ?>

          <?php
            $qryAnexo = Conexao::chamar()->prepare("SELECT * FROM estrutura_anexo WHERE id_artigo = '$codPrev' ORDER BY id DESC");
            $qryAnexo->execute();
            $buscaAnexo = $qryAnexo->fetchAll(PDO::FETCH_ASSOC); 
            if(count($buscaAnexo) > 0) {
          ?>

          <div class="galeria-anexo">
            <div class="panel-heading" style="background: aliceblue; ">
              <h5 class="panel-title acessibilidade" style="padding:10px;">Galeria de anexos</h5>
            </div>
            <div style="border: 2px solid aliceblue;padding: 10px 0;padding: 10px; display: flex;justify-content: flex-start;flex-wrap: wrap; margin-top: -10px;margin-bottom: 10px;">
            <?php foreach($buscaAnexo as $busca_anexo): ?>
              <a href="<?= $CAMINHOANEXO .'/'. $busca_anexo['arquivo']?>" class="acessibilidade" style="padding:20px 25px; margin-right: 10px;" target="_blank">
                <img src="<?=$CAMINHO .'/assets/images/arquivo.svg'?>" alt="arquivo" style="margin-bottom: 10px;">
                <?= $busca_anexo["descricao"]?>
              </a>
              <?php endforeach; ?>
            </div>
          </div>
          <?php } ?>

  </div>
</div>