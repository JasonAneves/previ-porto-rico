<style>
  .thumbnail{
	  position:relative; /* para colocar os elemento dentro do thumbnail */
	  overflow:hidden; /*escolher o que deverá acontecer se o conteúdo ultrapassar o tamanho do seletor thumbnail.*/
  }
  .caption {
    position: absolute;
    top: 0;
    right: 0;
    background: rgba(66, 139, 202, 0.55);
    width: 100%;
    height: 100%;
    opacity: 0;
    color: #fff !important;
    z-index: 2;
    transition: opacity 0.2s ease;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .thumbnail:hover .caption{
    opacity: 1;
    transition: opacity 0.2s ease; 
  }
</style>

<div class="container-fluid" style="background-color:#f2f2f2;">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 titulo-enquete">
    <span class="acessibilidade">ENQUETE</span>
  </div>
  <div class="container enquetes d-flex align-items-center justify-content-center">
    <div class="enquete">
    
      <?php
        $qryEnquete = Conexao::chamar()->prepare("SELECT id, titulo FROM enquete WHERE id_cliente = :id_cliente AND status_registro = :status_registro ORDER BY id DESC LIMIT 1");
        $qryEnquete->bindValue(":status_registro", "A", PDO::PARAM_STR);
        $qryEnquete->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
        $qryEnquete->execute();
        $buscaEnquete = $qryEnquete->fetchAll(PDO::FETCH_ASSOC);

        foreach ($buscaEnquete as $enquete):
      ?>
        <div class="thumbnail">

            <div class="caption">
              <a  class="btn btn-success" href="<?= $CAMINHO ?>enquete/<?= $enquete['id'] ?>">Visualizar enquete</a>
            </div>

            <div class="container py-4">
              <h5 class="card-title"><?= $enquete["titulo"] ?></h5>
            </div>

        </div>

        <?php endforeach; ?>

    </div>
  </div>

</div>
