<style>
.h3, h3 {
    font-size: 24px;
    text-align: left;
    font-weight: 700;
    color: #333333;
}
.h5, h5 {
    font-size: 14px;
    font-weight: 700;
    color: #0aab60;
    height: 4vh;
    display: flex;
    align-items: center;
}

h5 .fa{
    font-size: 20px;
    padding-right: 5px;
}
.items{
    height: 50vh;
}
.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
    z-index: 3;
    color: #fff;
    cursor: default;
    border-color: #333333;
    background: #ffffff;
}
.pagination>li>a, .pagination>li>span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #333333;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
}
</style>
<div class="row" style="margin:0;">
    <div class="container" style="min-height: 500px;">
            <?php
            try {

                $tabela = "obra_unida";
                $titulo = "Entidades";

                if (isset($url[$ii]) && strlen($url[$ii]) > 0 && $url[$ii] !== "pagina") {

                    $id = verificaNum($url[$ii]);
                    include "visualiza.php";

                } else {
                    
                    $total = Conexao::chamar()->query("SELECT count(*) FROM {$tabela} WHERE status_registro = 'A';")->fetchColumn();
                    
                    if ($total == 1) {

                        $idRegistro = Conexao::chamar()->query("SELECT id FROM {$tabela} WHERE status_registro = 'A' ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                        $id = $idRegistro['id'];
                        include "visualiza.php";

                    } else {

                      echo "<div style='display: block;width: 100%;'><h1 class='acessibilidade' style=\" color: #0AAB60;
                                                  font-size: 41px;
                                                  font-weight: bold;
                                                  font-family: 'Muli', sans-serif;\">{$titulo}</h1>
                            <div style=\"margin: 0 0 0 45px;border-bottom: 4px solid #0AAB60;width: 94px;\"></div>
                            </div>";
                        $max = 1000;
                        $at = !empty($url[$ii + 1]) ? verificaNum($url[$ii + 1]) : 1;
                        $totalPag = $total / $max > intval($total / $max) ? intval($total / $max) + 1 : intval($total / $max);
                        $limit = $max * ($at - 1);

                        try {
                            $qxCategoria = Conexao::chamar()->prepare("SELECT * FROM {$tabela}_categoria WHERE status_registro = :status_registro ORDER BY descricao DESC");
                            $qxCategoria->bindValue(":status_registro", "A", PDO::PARAM_STR);
                            $qxCategoria->execute();

                            foreach ($qxCategoria->fetchAll(PDO::FETCH_ASSOC) as $obra_unida_categoria) {
                                ?>
                                <h3>
                                    <?=$obra_unida_categoria['descricao']?>
                                </h3>	
                                <?php
                            
                                $qxSemSub = Conexao::chamar()->prepare("SELECT id, titulo, artigo FROM {$tabela} WHERE status_registro = :status_registro AND id_categoria = :id_categoria AND id_subcategoria IS NULL ORDER BY id ASC LIMIT $limit,$max");
                                $qxSemSub->bindValue(":status_registro", "A", PDO::PARAM_STR);
                                $qxSemSub->bindValue(":id_categoria", $obra_unida_categoria['id'], PDO::PARAM_INT);
                                $qxSemSub->execute();

                                foreach ($qxSemSub->fetchAll(PDO::FETCH_ASSOC) as $obra_unida) {
                                    ?>
                                    <a href="<?= $CAMINHO ?>obra_unida/<?= $obra_unida['id'] ?>" class="linha">
                                        <h5 class="acessibilidade"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i><?= $obra_unida['titulo'] ?></h5>
                                    </a>	
                                    <?php
                                }

                                $qxSubCategoria = Conexao::chamar()->prepare("SELECT * FROM {$tabela}_subcategoria WHERE status_registro = :status_registro AND id_categoria = :id_categoria ORDER BY subcategoria DESC");
                                $qxSubCategoria->bindValue(":status_registro", "A", PDO::PARAM_STR);
                                $qxSubCategoria->bindValue(":id_categoria", $obra_unida_categoria['id'], PDO::PARAM_INT);
                                $qxSubCategoria->execute();

                                foreach ($qxSubCategoria->fetchAll(PDO::FETCH_ASSOC) as $subcategoria) {
                                    ?>
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h4 class="acessibilidade panel-title"><?=$subcategoria['subcategoria']?></h4>
                                        </div>
                                    	<div class="panel-body">
                                        <?php
                                        $qx = Conexao::chamar()->prepare("SELECT id, titulo, artigo FROM {$tabela} WHERE status_registro = :status_registro AND id_categoria = :id_categoria AND id_subcategoria = :id_subcategoria ORDER BY id ASC LIMIT $limit,$max");
                                        $qx->bindValue(":status_registro", "A", PDO::PARAM_STR);
                                        $qx->bindValue(":id_categoria", $obra_unida_categoria['id'], PDO::PARAM_INT);
                                        $qx->bindValue(":id_subcategoria", $subcategoria['id'], PDO::PARAM_INT);
                                        $qx->execute();

                                        foreach ($qx->fetchAll(PDO::FETCH_ASSOC) as $obra_unida) {
                                            ?>
                                            <a href="<?= $CAMINHO ?>obra_unida/<?= $obra_unida['id'] ?>" class="linha">
                                                <h5 class="acessibilidade"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i><?= $obra_unida['titulo'] ?></h5>
                                            </a>	
                                            <?php
                                        }
                                        ?>
                                        </div>
                                    </div>
                                <?php
                                }
                            }

                        } catch (PDOException $e) {

                            echo $e->getMessage();

                        }

                        if ($total > $max) {
                            ?>
                            <ul class="pagination pagination-lg">
                                <?php if ($at > 1) { ?>
                                    <li>
                                        <a href="<?= $CAMINHO ?>obra_unida/pagina/1">
                                            <i class="fa fa-angle-double-left"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $CAMINHO ?>obra_unida/pagina/<?= $at - 1 ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php
                                $x = $at <= 3 ? 1 : $at - 2;
                                $y = $at >= $totalPag - 2 ? $totalPag : $at + 2;

                                for ($x; $x <= $y; $x++) {
                                    ?>
                                    <li <?php if ($x == $at) echo "class='active'" ?>><a href="<?= $CAMINHO ?>obra_unida/pagina/<?= $x ?>"><?= $x ?></a></li>
                                <?php } ?>
                                <?php if ($at < $totalPag) { ?>		  
                                    <li>
                                        <a href="<?= $CAMINHO ?>obra_unida/pagina/<?= $at + 1 ?>">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= $CAMINHO ?>obra_unida/pagina/<?= $totalPag ?>">
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