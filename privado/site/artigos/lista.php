

            <?php
            try {
                $tabela = "artigo";
                $titulo = "Artigos";

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

                        echo "<h1>{$titulo}</h1>";
                        $max = 10;
                        $at = !empty($url[$ii + 1]) ? verificaNum($url[$ii + 1]) : 1;
                        $totalPag = $total / $max > intval($total / $max) ? intval($total / $max) + 1 : intval($total / $max);
                        $limit = $max * ($at - 1);

                        try {

                            $qx = Conexao::chamar()->prepare("SELECT id, titulo, artigo FROM {$tabela} WHERE status_registro = :status_registro ORDER BY id ASC LIMIT $limit,$max");
                            $qx->bindValue(":status_registro", "A", PDO::PARAM_STR);
                            $qx->execute();

                            foreach ($qx->fetchAll(PDO::FETCH_ASSOC) as $quem_somos) {
                                ?>
                                <a href="<?= $CAMINHO ?>/artigos/<?= $quem_somos['id'] ?>" class="linha">
                                    <div class="titulo"><?= $quem_somos['titulo'] ?></div>	
                                    <div class="artigo"><?= resumo($quem_somos['artigo'], 500) ?></div>
                                </a>	
                                <?php
                            }
                        } catch (PDOException $e) {

                            echo $e->getMessage();

                        }

                        if ($total > $max) {
                            ?>
                            <ul class="pagination pagination-lg">
                                <?php if ($at > 1) { ?>
                                    <li>
                                        <a href="<?= $CAMINHO ?>/artigos/pagina/1">
                                            <i class="fa fa-angle-double-left"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $CAMINHO ?>/artigos/pagina/<?= $at - 1 ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php
                                $x = $at <= 3 ? 1 : $at - 2;
                                $y = $at >= $totalPag - 2 ? $totalPag : $at + 2;

                                for ($x; $x <= $y; $x++) {
                                    ?>
                                    <li <?php if ($x == $at) echo "class='active'" ?>><a href="<?= $CAMINHO ?>/artigos/pagina/<?= $x ?>"><?= $x ?></a></li>
                                <?php } ?>
                                <?php if ($at < $totalPag) { ?>		  
                                    <li>
                                        <a href="<?= $CAMINHO ?>/artigos/pagina/<?= $at + 1 ?>">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $CAMINHO ?>/artigos/pagina/<?= $totalPag ?>">
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
       