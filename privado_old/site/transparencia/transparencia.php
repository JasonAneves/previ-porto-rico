<div class="row">
    <div class="container" style="min-height: 500px; padding: 20px 15px;">
        <div class="col-md-12">
            <h2 style="color: #007CC2;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">Transpar&ecirc;ncia</h2>
            <?php
            $i = 0;
            $qryNivel1 = Conexao::chamar()->prepare("SELECT * FROM transparencia_categoria_nivel1 WHERE id_cliente = '$idCliente' AND status_registro = 'A'");
            $qryNivel1->execute();
            $buscaNivel1 = $qryNivel1->fetchAll(PDO::FETCH_ASSOC);

            foreach ($buscaNivel1 as $nivel1) { // nivel 1
            ?>
                <div class="panel-group" id="nivel<?= $i ?>">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background: aliceblue;">
                            <h4 class="panel-title" style="padding:10px;">
                                <a data-toggle="collapse" data-parent="#nivel<?= $i ?>" href="#collapse-nivel<?= $i ?>">
                                    <i class="fa fa-folder" aria-hidden="true"></i>
                                    <span class="acessibilidade" style="font-weight: 600;font-size: 16px; ">
                                        <?= $nivel1["descricao"] ?>
                                    </span>
                                    <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
                                </a>
                            </h4>
                        </div>

                        <div id="collapse-nivel<?= $i ?>" class="panel-collapse collapse">
                            <div class="panel-heading" style="border: 2px solid aliceblue;padding: 10px 0;margin-bottom: 10px;margin-top:-10px;">

                                <?php if ($nivel1['link'] != NULL) { ?>
                                    <div class="galeria-anexo" style="margin: -10px 0 10px 20px;">
                                        <div class="panel-heading" style="background: aliceblue; margin-top:10px;">
                                            <h5 class="panel-title" style="padding:10px;color:#007bff;font-weight: 600;font-size: 16px;">Link</h5>
                                        </div>
                                        <div style="border: 1px solid aliceblue;padding: 10px 0; display: flex;justify-content: flex-start;flex-wrap: wrap; margin-top: -10px;">
                                            <a href="<?= $nivel1['link'] ?>" class="acessibilidade" style="padding:20px 25px; margin-right: 10px;" target="_blank">
                                                <img src="<?= $CAMINHO . '/assets/images/file-download.svg'; ?>" alt="icone download" style="height:20px; margin-right: 5px;">
                                                <?= $nivel1["descricao"] ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php
                                $qryArquivoNivel1 = Conexao::chamar()->prepare("SELECT * FROM transparencia_arquivo WHERE id_cliente = '$idCliente' AND status_registro = 'A' AND id_nivel1 = '$nivel1[id]' AND id_nivel2 IS NULL AND id_nivel3 IS NULL");
                                $qryArquivoNivel1->execute();
                                $buscaArquivoNivel1 = $qryArquivoNivel1->fetchAll(PDO::FETCH_ASSOC);
                                if (count($buscaArquivoNivel1) > 0) {
                                ?>
                                    <div class="galeria-anexo" style="margin: -10px 0 10px 20px;">
                                        <div class="panel-heading" style="background: aliceblue; margin-top:10px;">
                                            <h5 class="panel-title" style="padding:10px;color:#007bff;font-weight: 600;font-size: 16px;">Anexos</h5>
                                        </div>
                                        <div style="border: 1px solid aliceblue;padding: 10px 0; display: flex;justify-content: flex-start;flex-wrap: wrap; margin-top: -10px;">
                                            <?php foreach ($buscaArquivoNivel1 as $arquivoNivel1) { ?>
                                                <a href="<?= $CAMINHOANEXO . '/' . $arquivoNivel1['arquivo'] ?>" class="acessibilidade" style="padding:20px 25px; margin-right: 10px;" target="_blank">
                                                    <img src="<?= $CAMINHO . '/assets/images/file-download.svg'; ?>" alt="icone download" style="height:20px; margin-right: 5px;">
                                                    <?= $arquivoNivel1["descricao"] ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php
                                $ii = 0;
                                $queryNivel2 = Conexao::chamar()->prepare("SELECT * FROM transparencia_categoria_nivel2 WHERE id_cliente = '$idCliente' AND status_registro = 'A' AND id_nivel1 = '$nivel1[id]'");
                                $queryNivel2->execute();
                                $buscaNivel2 = $queryNivel2->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($buscaNivel2 as $nivel2) { // nivel 2
                                ?>
                                    <div class="accordion" id="nivel<?= $i . $ii ?>">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" style="border: 1px solid aliceblue;margin: 0 0 10px 20px;background: aliceblue;">
                                                <h4 class="panel-title" style="padding:10px;">
                                                    <a data-toggle="collapse" data-parent="#nivel<?= $i . $ii ?>" href="#collapse-nivel<?= $i . $ii ?>">
                                                        <i class="fa fa-folder" aria-hidden="true"></i>
                                                        <span class="acessibilidade" style="font-weight: 600;font-size: 16px;">
                                                            <?= $nivel2['descricao'] ?>
                                                        </span>
                                                        <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapse-nivel<?= $i . $ii ?>" class="accordion-body collapse" style="border: 2px solid aliceblue; margin: -10px 0 10px 20px;">
                                                <div class="accordion-inner" style="margin: 0 0 10px 20px;">

                                                    <?php if ($nivel2['link'] != NULL) { ?>
                                                        <div class="galeria-anexo">
                                                            <div class="panel-heading" style="background: aliceblue; margin-top:10px;">
                                                                <h5 class="panel-title" style="padding:10px;color:#007bff;font-weight: 600;font-size: 16px;">Link</h5>
                                                            </div>
                                                            <div style="border: 1px solid aliceblue;padding: 10px 0; display: flex;justify-content: flex-start;flex-wrap: wrap; margin-top: -10px;">
                                                                <a href="<?= $nivel2['link'] ?>" class="acessibilidade" style="padding:20px 25px; margin-right: 10px;" target="_blank">
                                                                    <img src="<?= $CAMINHO . '/assets/images/file-download.svg'; ?>" alt="icone download" style="height:20px; margin-right: 5px;">
                                                                    <?= $nivel2["descricao"] ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php
                                                    $qryArquivoNivel2 = Conexao::chamar()->prepare("SELECT * FROM transparencia_arquivo WHERE id_cliente = '$idCliente' AND status_registro = 'A' AND id_nivel1 = '$nivel1[id]' AND id_nivel2 = '$nivel2[id]' AND id_nivel3 IS NULL");
                                                    $qryArquivoNivel2->execute();
                                                    $buscaArquivoNivel2 = $qryArquivoNivel2->fetchAll(PDO::FETCH_ASSOC);
                                                    if (count($buscaArquivoNivel2) > 0) {
                                                    ?>
                                                        <div class="galeria-anexo">
                                                            <div class="panel-heading" style="background: aliceblue; margin-top:10px;">
                                                                <h5 class="panel-title" style="padding:10px;color:#007bff;font-weight: 600;font-size: 16px;">Anexos</h5>
                                                            </div>
                                                            <div style="border: 1px solid aliceblue;padding: 10px 0; display: flex;justify-content: flex-start;flex-wrap: wrap; margin-top: -10px;">
                                                                <?php foreach ($buscaArquivoNivel2 as $arquivoNivel2) { ?>
                                                                    <a href="<?= $CAMINHOANEXO . '/' . $arquivoNivel2['arquivo'] ?>" class="acessibilidade" style="padding:20px 25px; margin-right: 10px;" target="_blank">
                                                                        <img src="<?= $CAMINHO . '/assets/images/file-download.svg'; ?>" alt="icone download" style="height:20px; margin-right: 5px;">
                                                                        <?= $arquivoNivel2["descricao"] ?>
                                                                    </a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php
                                                    $iii = 0;
                                                    $qryNivel3 = Conexao::chamar()->prepare("SELECT * FROM transparencia_categoria_nivel3 WHERE id_cliente = '$idCliente' AND status_registro = 'A' AND id_nivel2 = '$nivel2[id]'");
                                                    $qryNivel3->execute();
                                                    $buscaNivel3 = $qryNivel3->fetchAll(PDO::FETCH_ASSOC);

                                                    foreach ($buscaNivel3 as $nivel3) { // nivel 3
                                                    ?>
                                                        <div class="accordion" id="nivel<?= $i . $ii . $iii ?>">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading" style="border: 1px solid aliceblue;margin: 10px 0 10px 20px;background: aliceblue;">
                                                                    <h4 class="panel-title" style="padding:10px;">
                                                                        <a data-toggle="collapse" data-parent="#nivel<?= $i . $ii . $iii ?>" href="#collapse-nivel<?= $i . $ii . $iii ?>">
                                                                            <i class="fa fa-folder" aria-hidden="true"></i>
                                                                            <span class="acessibilidade" style="font-weight: 600;font-size: 16px;">
                                                                                <?= $nivel3['descricao'] ?>
                                                                            </span>
                                                                            <i class="fa fa-plus-circle" aria-hidden="true" style="float: right;"></i>
                                                                        </a>
                                                                    </h4>
                                                                </div>


                                                                <div id="collapse-nivel<?= $i . $ii . $iii ?>" class="accordion-body collapse in" style="border: 1px solid aliceblue;margin: -10px 0px 10px 20px;">
                                                                    <div class="accordion-inner" style="margin-left: 20px;">

                                                                        <?php if ($nivel3['link'] != NULL) { ?>
                                                                            <div class="galeria-anexo">
                                                                                <div class="panel-heading" style="background: aliceblue; margin-top:10px;">
                                                                                    <h5 class="panel-title" style="padding:10px;color:#007bff;font-weight: 600;font-size: 16px;">Link</h5>
                                                                                </div>
                                                                                <div style="border: 1px solid aliceblue;padding: 10px 0; display: flex;justify-content: flex-start;flex-wrap: wrap; margin-top: -10px;">
                                                                                    <a href="<?= $nivel3['link'] ?>" class="acessibilidade" style="padding:20px 25px; margin-right: 10px;" target="_blank">
                                                                                        <img src="<?= $CAMINHO . '/assets/images/file-download.svg'; ?>" alt="icone download" style="height:20px; margin-right: 5px;">
                                                                                        <?= $nivel3["descricao"] ?>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>

                                                                        <?php
                                                                        $qryArquivoNivel3 = Conexao::chamar()->prepare("SELECT * FROM transparencia_arquivo WHERE id_cliente = '$idCliente' AND status_registro = 'A' AND id_nivel1 = '$nivel1[id]' AND id_nivel2 = '$nivel2[id]' AND id_nivel3 = '$nivel3[id]'");
                                                                        $qryArquivoNivel3->execute();
                                                                        $buscaArquivoNivel3 = $qryArquivoNivel3->fetchAll(PDO::FETCH_ASSOC);
                                                                        if (count($buscaArquivoNivel3) > 0) {
                                                                        ?>
                                                                            <div class="galeria-anexo" style="margin-top: 10px;">
                                                                                <div class="panel-heading" style="background: aliceblue; ">
                                                                                    <h5 class="panel-title" style="padding:10px;color: #007bff;">Anexos</h5>
                                                                                </div>
                                                                                <div style="border: 2px solid aliceblue;padding: 10px 0; display: flex;justify-content: flex-start;flex-wrap: wrap; margin-top: -10px;margin-bottom: 10px;">
                                                                                    <?php foreach ($buscaArquivoNivel3 as $arquivoNivel3) { ?>
                                                                                        <a href="<?= $CAMINHOANEXO . '/' . $arquivoNivel3['arquivo'] ?>" class="acessibilidade" style="padding:20px 25px; margin-right: 10px;" target="_blank">
                                                                                            <img src="<?= $CAMINHO . '/assets/images/file-download.svg'; ?>" alt="icone download" style="height:20px; margin-right: 5px;">
                                                                                            <?= $arquivoNivel3["descricao"] ?>
                                                                                        </a>
                                                                                    <?php } ?>
                                                                                </div>

                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php $iii++;
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php $ii++;
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++;
            } ?>


        </div>
    </div>
</div>

<script>
    $('.list-group-item').on('click', function(event) {
        event.preventDefault();
        $(this).toggleClass('fa-chevron-right fa-chevron-down');
    });

    $('.card-header').on('click', function(event) {
        event.preventDefault();
        $(this).toggleClass('highlight');
    });
</script>