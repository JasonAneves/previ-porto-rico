<div class="row" style="margin:0;">
    <div class="container" style="min-height: 500px;">
            <?php
            try {
                $tabela = "historia";
                $titulo = "História";

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

                      echo "<div style='display: block;width: 100%;'><h1 class='acessibilidade' style=\" color: #33415C;
                                                    font-size: 41px;
                                                    font-weight: bold;
                                                    font-family: 'Muli', sans-serif;\">{$titulo}</h1>
                              <div style=\"margin: 0 0 0 45px;border-bottom: 4px solid #00FFD8;width: 94px;\"></div>
                              </div>";
                        $max = 10;
                        $at = !empty($url[$ii + 1]) ? verificaNum($url[$ii + 1]) : 1;
                        $totalPag = $total / $max > intval($total / $max) ? intval($total / $max) + 1 : intval($total / $max);
                        $limit = $max * ($at - 1);

                        try {

                            $qx = Conexao::chamar()->prepare("SELECT e.id, e.titulo, e.artigo, ef.foto FROM {$tabela} e
                                                              LEFT JOIN {$tabela}_foto ef ON e.id = ef.id_artigo
                                                              WHERE status_registro = :status_registro ORDER BY id ASC LIMIT $limit,$max");
                            $qx->bindValue(":status_registro", "A", PDO::PARAM_STR);
                            $qx->execute();

                            echo "<div class=\"div-estrutura\">";
                            foreach ($qx->fetchAll(PDO::FETCH_ASSOC) as $quem_somos) {
                                ?>
                                <a href="<?= $CAMINHO ?>estrutura/<?= $quem_somos['id'] ?>" class="linha">
                                    <img class="img-estrutura" src="<?=$CAMINHOIMG?>/1/<?=$quem_somos['foto']?>" alt="">
                                    <div class="acessibilidade titulo"><?= $quem_somos['titulo'] ?></div>
                                </a>	
                                <?php
                            }
                            echo "</div>";

                        } catch (PDOException $e) {

                            echo $e->getMessage();

                        }

                        if ($total > $max) {
                            ?>
                            <ul class="pagination pagination-lg">
                                <?php if ($at > 1) { ?>
                                    <li>
                                        <a href="<?= $CAMINHO ?>/historia/pagina/1">
                                            <i class="fa fa-angle-double-left"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $CAMINHO ?>/historia/pagina/<?= $at - 1 ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php
                                $x = $at <= 3 ? 1 : $at - 2;
                                $y = $at >= $totalPag - 2 ? $totalPag : $at + 2;

                                for ($x; $x <= $y; $x++) {
                                    ?>
                                    <li <?php if ($x == $at) echo "class='active'" ?>><a href="<?= $CAMINHO ?>/historia/pagina/<?= $x ?>"><?= $x ?></a></li>
                                <?php } ?>
                                <?php if ($at < $totalPag) { ?>		  
                                    <li>
                                        <a href="<?= $CAMINHO ?>/historia/pagina/<?= $at + 1 ?>">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $CAMINHO ?>/historia/pagina/<?= $totalPag ?>">
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
  }
  .titulo{
    color: black;
    font-size: 21px;
    text-align: center;
    margin: 10px 0;
  }
</style>