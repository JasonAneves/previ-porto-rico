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

<div class="container-fluid bg-rodape">
    <div class="container">
        <div class="grid-container-rodape">

            <div class="rodape">
                <div class="area-brasao">
                    <div class="brasao">
                        <a href="<?= $CAMINHO ?>">
                            <img src="<?= $CAMINHO ?>assets/images/brasao.png" alt="">
                        </a>
                    </div>
                    <div class="titulo-rodape">
                        <p class="titulo-1">FUNDO DE PREVIDÊNCIA</p>
                        <p class="titulo-2">WENCESLAU BRAZ</p>
                    </div>
                </div>
                <div class="info">
                    <?php foreach ($configuracoes as $config) : ?>
                        <div class="ico-local"><img src="<?= $CAMINHO ?>assets/images/ico-local.svg" alt=""></div>
                        <div class="desc-local acessibilidade"><?= $config['endereco'] . " - " . $config['complemento'] . " - " . $config['bairro'] ?></div>
                        <div class="ico-tel"><img src="<?= $CAMINHO ?>assets/images/ico-tel.svg" alt=""></div>
                        <div class="desc-tel acessibilidade"><?= $config['telefone'] ?></div>
                        <div class="ico-email"><img src="<?= $CAMINHO ?>assets/images/ico-email.svg" alt=""></div>
                        <div class="desc-email acessibilidade"><?= $config['email'] ?></div>
                    <?php endforeach ?>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid bg-rodape borda-rodape-inga">
    <div class="container rodape-inga">
        <div class="ultima-atualizacao acessibilidade">
            <p>Última atualização do site:&nbsp;</p><span><?= formata_data_hora($atualizacao["data_acesso"]) ?></span>
        </div>
        <div class="logo-inga"><img src="<?= $CAMINHO ?>assets/images/ingaDigital.svg" alt=""></div>
    </div>
</div>