<div class="fundo_topo_brasao">
  <div class="container container_brasao">
    <div class="controle_brasao">
      <div class="brasao">
        <a href="">
          <img src="<?= $CAMINHO ?>assets/images/logo_site.png" alt="" class="img_brasao">
        </a>
      </div>
      <div class="busca">
        <div id="custom-search-input">
          <div class="input-group">
            <form action="<?= $CAMINHO ?>pesquisa" method="post" class="busca-topo-form">
              <!-- <form action="<?= $dominioPublico ?>/privado/site/pesquisa/busca.php" method="post" class="busca-topo-form"> -->
              <input type="text" name="busca" class="search-query form-control" value="" required="required" title="busca" placeholder="Buscar">
              <button type="submit"><span><img src="<?= $CAMINHO ?>assets/images/lupa.svg" alt="Busca"></span></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>