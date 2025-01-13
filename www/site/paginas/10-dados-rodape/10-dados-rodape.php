<?php

$sqlConfig = Conexao::chamar()->prepare("SELECT * FROM cliente_configuracao WHERE id_cliente = :cliente");
$sqlConfig->execute(array(":cliente" => $idCliente));
$configuracoes = $sqlConfig->fetchAll(PDO::FETCH_ASSOC);

$sqlAtualizacao = Conexao::chamar()->prepare("(SELECT data_acesso
    FROM controle_log_acesso
    WHERE id_cliente = :cliente
    ORDER BY id DESC LIMIT 1)
    UNION ALL
    (SELECT data_acesso
    FROM controle_log_acesso
    WHERE id_cliente = :cliente
    ORDER BY id DESC LIMIT 1)
    ORDER BY data_acesso DESC LIMIT 1");
$sqlAtualizacao->execute(array(":cliente" => $idCliente));
$atualizacao = $sqlAtualizacao->fetch(PDO::FETCH_ASSOC);
?>

<div class="fundo_dados_rodape">
    <div class="container container_dados_rodape">
        <div class="controle_rodape">
            <a href="<?= $CAMINHO ?>" class="logo_rodape">
                <img class="img_logoRodape" src="<?= $CAMINHO ?>/assets/images/logo_rodape.png" alt="logo">
            </a>
            <a href="https://www.google.com/maps/place/Av.+Jo%C3%A3o+Carraro,+557,+Porto+Rico+-+PR,+87950-000/@-22.7750995,-53.269892,1002m/data=!3m2!1e3!4b1!4m6!3m5!1s0x948db12c1b1d403d:0x5baf08961f45eea6!8m2!3d-22.7750995!4d-53.2673171!16s%2Fg%2F11hbc4h_sy?entry=ttu&g_ep=EgoyMDI1MDEwOC4wIKXMDSoASAFQAw%3D%3D" class="endereco" target="_blank">
                <img src="<?= $CAMINHO ?>/assets/images/local.svg" alt="">
                <p class="infoRodape acessibilidade">Avenida João Carraro, 557</p>
                </img>
            </a>
            <div class="fones">
                <div class="telRodape">
                    <img src="<?= $CAMINHO ?>/assets/images/telefone_rodape.svg" alt="telefone1">
                    <p class="infoRodape acessibilidade">(44) 2301-0305</p>
                </div>
                <div class="telRodape">
                    <img src="<?= $CAMINHO ?>/assets/images/telefone_rodape.svg" alt="telefone2">
                    <p class="infoRodape acessibilidade">(44) 2301-0306</p>
                </div>
                <p class="infoRodape acessibilidade">Ramal: 220/227/214</p>
            </div>
            <a href="https://webmail.funpremportorico.com.br/" target="_blank" class="email">
                <img src="<?= $CAMINHO ?>/assets/images/email_rodape.svg" alt="">
                <p class="infoRodape acessibilidade">fundoprevidencia@funpremportorico.com.br</p>
                </img>
            </a>
        </div>
    </div>
</div>

<div class="fundo_atualiza">
    <div class="container rodape-inga">
        <div class="ultima-atualizacao">
            <p class="titulo_atualiza acessibilidade">Última atualização do site: <?= formata_data_hora($atualizacao["data_acesso"]) ?></p>
            <div class="logo-inga">
                <a href="https://ingadigital.com.br/" target="_blank">
                    <img src="<?= $CAMINHO ?>assets/images/inga_logo.svg" alt="inga Logo">
                </a>
            </div>
        </div>
    </div>
</div>