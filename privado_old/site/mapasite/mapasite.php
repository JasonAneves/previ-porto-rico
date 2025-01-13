<?php
  $qryMapaSitePai = Conexao::chamar()->prepare("SELECT * FROM controle_menu WHERE status_registro = :status_registro AND mapa_site = :mapa_site AND id_menu IS NULL");
  $qryMapaSitePai->bindValue(":status_registro", "A", PDO::PARAM_STR);
  $qryMapaSitePai->bindValue(":mapa_site", "1", PDO::PARAM_STR);
  $qryMapaSitePai->execute();
  $stMapaSitePai = $qryMapaSitePai->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
  <div class="row">
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 titulo-mapa-site">
      <div style="display: block;width: 100%;margin-bottom: 20px;">
        <h1 class="acessibilidade" style=" color: #0AAB60;font-size: 41px;font-weight: bold;font-family: 'Muli', sans-serif;" class="acessibilidade">Mapa do Site</h1>
        <div style="margin-bottom: 20px;margin: 0 0 0 45px;border-bottom: 4px solid #0AAB60;width: 94px;"></div>
      </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 lista-mapa">
      <?php
      foreach ($stMapaSitePai as $key => $mapa_pai) {
      ?>
        
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pai-mapa">
          <div class="panel panel-success">
            <div class="panel-heading text-center">
              <h3 class="acessibilidade"><?=$mapa_pai['descricao']?></h3>
            </div>
            <div class="panel-body">
              <ul class="list-group">
              <?php
                $qryMapaSite = Conexao::chamar()->prepare("SELECT * FROM controle_menu WHERE status_registro = :status_registro AND mapa_site = :mapa_site AND id_menu = :id_menu");
                $qryMapaSite->bindValue(":status_registro", "A", PDO::PARAM_STR);
                $qryMapaSite->bindValue(":mapa_site", "1", PDO::PARAM_STR);
                $qryMapaSite->bindValue(":id_menu", $mapa_pai['id'], PDO::PARAM_STR);
                $qryMapaSite->execute();
                $stMapaSite = $qryMapaSite->fetchAll(PDO::FETCH_ASSOC);
                foreach ($stMapaSite as $key => $mapa_site) {
                  if($mapa_pai['id'] == '137' && $key == 0){
                    ?>
                <a href="<?=$CAMINHO?>contato">
                  <li class="list-group-item acessibilidade"><i class="fa fa-chevron-right" aria-hidden="true"></i> Fale Conosco</li>
                </a>
              <?php
                  }
              ?>
                <a href="<?=$CAMINHO?><?=$mapa_site['link']?>">
                  <li class="list-group-item acessibilidade"><i class="fa fa-chevron-right" aria-hidden="true"></i> <?=$mapa_site['descricao']?></li>
                </a>
              <?php
                }
              ?>
              </ul>
            </div>
          </div>
          
        </div>
        
      <?php
      }
      ?>
    </div>
      
  </div>
</div>