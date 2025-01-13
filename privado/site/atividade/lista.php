<div class="row" style="margin:0;">
    <div class="container" style="min-height: 500px;">
            <?php
            try {
                $tabela = "modalidade";
                $titulo = "Modalidades";

                if (isset($url[$ii]) && strlen($url[$ii]) > 0 && $url[$ii] !== "pagina") {

                    $id = verificaNum($url[$ii]);
                    include "visualiza.php";

                } else {

                    $total = Conexao::chamar()->query("SELECT DISTINCT count(mc.id)FROM {$tabela}_categoria mc LEFT JOIN {$tabela} m ON m.id_categoria = mc.id WHERE m.status_registro = 'A' ORDER BY mc.descricao")->fetchColumn();

                    if ($total == 1) {

                        $idRegistro = Conexao::chamar()->query("SELECT id FROM {$tabela}_categoria WHERE status_registro = 'A' ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                        $id = $idRegistro[id];
                        include "visualiza.php";

                    } else {

                        echo "<div style='display: block;width: 100%;'><h1 style=\" color: #33415C;
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
                            $categoriax = Conexao::chamar()->prepare("SELECT DISTINCT mc.id, mc.descricao, mc.icone 
                                                                        FROM {$tabela}_categoria mc
                                                                        LEFT JOIN {$tabela} m
                                                                        ON m.id_categoria = mc.id
                                                                        WHERE m.status_registro = :status_registro
                                                                        ORDER BY mc.descricao
                                                                        LIMIT $limit,$max");
                            $categoriax->bindValue(":status_registro", 'A', PDO::PARAM_STR);
                            $categoriax->execute();
                            foreach($categoriax->fetchAll(PDO::FETCH_ASSOC) as $categoria){
                                echo "<h3 class='text-center' style='color: #33415C; font-weight: bold;'>".$categoria['descricao']."</h3><hr>";
                                
                                    $qx = Conexao::chamar()->prepare("SELECT * FROM {$tabela}
                                                                    WHERE status_registro = :status_registro 
                                                                    AND id_categoria = :id_categoria
                                                                    ORDER BY id ASC");
                                    $qx->bindValue(":status_registro", "A", PDO::PARAM_STR);
                                    $qx->bindValue(":id_categoria", $categoria['id'], PDO::PARAM_STR);
                                    $qx->execute();

                                    echo "<div class=\"div-estrutura\">";
                                    foreach ($qx->fetchAll(PDO::FETCH_ASSOC) as $quem_somos) {
                                        $fotox = Conexao::chamar()->prepare("SELECT * 
                                                                            FROM {$tabela}_foto
                                                                            WHERE id_artigo = :id_artigo 
                                                                            ORDER BY ordem ASC 
                                                                            LIMIT 1");
                                        $fotox->bindValue(":id_artigo", $quem_somos['id'], PDO::PARAM_STR);
                                        $fotox->execute();
                                        $fotoValue = $fotox->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                        <a href="<?= $CAMINHO ?>atividade/<?= $quem_somos['id'] ?>" class="linha">
                                            <img class="img-estrutura" src="<?=$CAMINHOIMG?>/1/<?=$fotoValue['foto']?>" alt="">
                                            <div class="titulo"><?= $quem_somos['titulo'] ?></div>
                                            <!-- <div class="artigo"><?= resumo($quem_somos['artigo'], 500) ?></div> -->
                                        </a>	
                                        <?php
                                    }
                                    echo "</div>";
                            }

                        } catch (PDOException $e) {

                            echo $e->getMessage();

                        }

                        if ($total > $max) {
                            ?>
                            <ul class="pagination pagination-lg">
                                <?php if ($at > 1) { ?>
                                    <li>
                                        <a href="<?= $CAMINHO ?>atividade/pagina/1">
                                            <i class="fa fa-angle-double-left"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $CAMINHO ?>atividade/pagina/<?= $at - 1 ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php
                                $x = $at <= 3 ? 1 : $at - 2;
                                $y = $at >= $totalPag - 2 ? $totalPag : $at + 2;

                                for ($x; $x <= $y; $x++) {
                                    ?>
                                    <li <?php if ($x == $at) echo "class='active'" ?>><a href="<?= $CAMINHO ?>atividade/pagina/<?= $x ?>"><?= $x ?></a></li>
                                <?php } ?>
                                <?php if ($at < $totalPag) { ?>		  
                                    <li>
                                        <a href="<?= $CAMINHO ?>atividade/pagina/<?= $at + 1 ?>">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $CAMINHO ?>atividade/pagina/<?= $totalPag ?>">
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
    justify-content: flex-start;
    width: 100%;
    flex-wrap: wrap;
  }
  .div-estrutura>a{
      margin-right: 20px;
  }
  .titulo{
    color: black;
    font-size: 21px;
    text-align: center;
    margin: 10px 0;
  }
</style>