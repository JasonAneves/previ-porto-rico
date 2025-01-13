<?php
if ($id) {

    $registro = Conexao::chamar()->prepare("SELECT * FROM {$tabela} WHERE id = :id AND status_registro = :status_registro LIMIT 1");
    $registro->bindValue(":id", $id, PDO::PARAM_INT);
    $registro->bindValue(":status_registro", "A", PDO::PARAM_STR);
    $registro->execute();
    $registro = $registro->fetch(PDO::FETCH_ASSOC);

    if ($registro['id'] > 0) {

        $video = video($registro['link']);

        ?>
        <div class="box-visualizacao">
            <!--<a href="<?= $CAMINHO ?>/videos" class="btn btn-success pull-right voltar"><i class="fa fa-angle-double-left"></i><span class="hidden-xs">VOLTAR</span></a>-->
            <h1><?= $titulo ?> / <?= $registro['titulo'] ?></h1>
            <div class="artigo-completo">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="<?=$video['embed']?>"></iframe>
                </div>
                <br>
                <p><?= formataArtigo($registro['artigo']) ?></p>
            </div>
           
        </div>
        <?php
        $outros = Conexao::chamar()->query("SELECT count(*) FROM {$tabela} WHERE id != $id AND status_registro = 'A'")->fetchColumn();
        if ($outros > 0) {

            $outros = Conexao::chamar()->query("SELECT * FROM {$tabela} WHERE id != $id AND status_registro = 'A' ORDER BY id DESC LIMIT 4");
            ?>
            <div class="outros_artigos">
                <h2>
                   Outros V&iacute;deos
                    <!--<a href="<?= $CAMINHO ?>/tv-museu-esportivo" class="btn btn-success pull-right"><i class="fa fa-plus"></i> <span class="hidden-xs">VER TODOS</span></a>-->
                </h2>
                <?php
                foreach ($outros->fetchAll(PDO::FETCH_ASSOC) as $outros) {
                    $video = video($outros['link']);
                    ?>
                    <div class="col-md-3">
                        <div class="thumbnail" style="height: 340px">
                            <img src="<?= $video['img'] ?>" style="width: 100%" class="foto-galeria-lista img-responsive" />
                            <div class="caption text-center">
                                <h3><?= $outros['titulo'] ?></h3>
                                <!--<p><?= formataArtigo(resumo($outros['artigo'], 100)) ?></p>-->
                                <p class="text-center"><a target="blank" href="<?= $outros['link'] ?>/<?= $outros['id'] ?>" class="btn btn-danger" style=" border:none;" role="button"><i class="fa fa-play" style="margin-right: 10px;"></i> Visualizar</a></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php
    } else {

        echo "<script>location.href='" . $CAMINHO . "/galerias'</script>";
    }
} else {

    echo "<script>location.href='" . $CAMINHO . "/galerias'</script>";
}
				 