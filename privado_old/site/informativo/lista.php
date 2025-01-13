<div class="row" style="margin:0;">
    <div class="container" style="min-height: 500px;">
            <?php
            try {
                $tabela = "informativo";
                $titulo = "Informativos";

                if (isset($url[$ii]) && strlen($url[$ii]) > 0 && $url[$ii] !== "pagina") {

                    $id = verificaNum($url[$ii]);
                    include "visualiza.php";

                } else {

                    $total = Conexao::chamar()->query("SELECT count(*) FROM {$tabela} WHERE status_registro = 'A';")->fetchColumn();

                    if ($total == 1) {

                        $idRegistro = Conexao::chamar()->query("SELECT id FROM {$tabela} WHERE status_registro = 'A' ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                        $id = $idRegistro[id];
                        include "visualiza.php";

                    } else {

                        ?>
                        <h2 style="color: #007CC2;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;" class="my-4 acessibilidade"><?=$titulo?></h2>
                        <?php
                        $max = 5;
                        $at = !empty($url[$ii + 1]) ? verificaNum($url[$ii + 1]) : 1;
                        $totalPag = $total / $max > intval($total / $max) ? intval($total / $max) + 1 : intval($total / $max);
                        $limit = $max * ($at - 1);

                        try {

                            $qx = Conexao::chamar()->prepare("SELECT * 
                                                              FROM {$tabela}
                                                              WHERE status_registro = :status_registro 
                                                              AND id_cliente = '$idCliente'
                                                              ORDER BY id ASC 
                                                              LIMIT $limit,$max");
                            $qx->bindValue(":status_registro", "A", PDO::PARAM_STR);
                            $qx->execute();

                            echo "<div class=\"div-estrutura\">";
                            foreach ($qx->fetchAll(PDO::FETCH_ASSOC) as $quem_somos) {
                                $ft = Conexao::chamar()->query("SELECT foto FROM {$tabela}_foto WHERE id_artigo = {$quem_somos['id']} ORDER BY RAND() LIMIT 1")->fetch();
                                if (!empty($ft['foto'])){

                                    $foto = $CAMINHOIMG . "/" . $cliente . "/" . $ft['foto'];
                                } else {

                                    $foto = $CAMINHOIMGCSS . "/sem_foto.jpg";
                                }
                                ?>
                                <div class="list-group mb-3 acessibilidade">
                                  <a href="<?= $CAMINHO ?>informativo/<?= $quem_somos['id'] ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                      <h5 class="mb-1 acessibilidade"><?= $quem_somos['titulo'] ?></h5>
                                    </div>
                                    <p class="mb-1 limite-texto acessibilidade"><?= strip_tags($quem_somos['artigo']) ?></p>
                                  </a>
                                </div>

                                <?php
                            }
                            echo "</div>";

                        } catch (PDOException $e) {

                            echo $e->getMessage();

                        }

                        if ($total > $max) {
                            ?>
                            <ul class="pagination pagination-lg mt-4">
                                <?php if ($at > 1) { ?>
                                    <li>
                                        <a href="<?= $CAMINHO ?>informativo/pagina/1">
                                            <i class="fa fa-angle-double-left"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $CAMINHO ?>informativo/pagina/<?= $at - 1 ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php
                                $x = $at <= 3 ? 1 : $at - 2;
                                $y = $at >= $totalPag - 2 ? $totalPag : $at + 2;

                                for ($x; $x <= $y; $x++) {
                                    ?>
                                    <li <?php if ($x == $at) echo "class='active'" ?>><a href="<?= $CAMINHO ?>informativo/pagina/<?= $x ?>"><?= $x ?></a></li>
                                <?php } ?>
                                <?php if ($at < $totalPag) { ?>		  
                                    <li>
                                        <a href="<?= $CAMINHO ?>informativo/pagina/<?= $at + 1 ?>">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $CAMINHO ?>informativo/pagina/<?= $totalPag ?>">
                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <?php
                        }
                    }
                }
            } catch (PDOException $e) {

                //print_r($e);
            }
            ?>
    </div>
</div>
<style>
  .img-estrutura{
    width: 346px;
    height: 212px;
  }
  .div-estrutura{
    display: flex;
    justify-content: space-around;
    width: 100%;
    flex-wrap: wrap;
    flex-direction: column;
  }
  .titulo{
    color: black;
    font-size: 21px;
    text-align: center;
    margin: 10px 0;
  }

  .limite-texto {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
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
</style>