<div class="div-button">
    <nav class="pull-right hidden-xs hidden-sm">
        <?php if ($idUsuarioMaster) { ?>
            <a href="#" onclick="popup('<?= $publicoSistema ?>/popup/log/log_listagem.php?t=<?= $t ?>', 'Registro de Logs de Acesso')" class="btn btn-info pull right">
                <i class="fa fa-bar-chart"></i> Log de Acesso
            </a>
        <?php } ?>
        <?php if ($excluir) { ?>
            <button type="submit" id="botão_excluir" class="btn btn-danger pull right disabled">
                <i class="fa fa-trash"></i> Excluir
            </button>
        <?php } ?>
        <?php if ($cadastrar) { ?>
            <a href="<?= $caminhoTela ?>&servico=cadastrar" class="btn btn-primary pull right">
                <i class="fa fa-plus"></i> Cadastrar
            </a>
        <?php } ?>
        <a href="<?= $publicoSistema ?>/inicio.php" class="btn btn-warning pull right">
            <i class="fa fa-ban"></i> Cancelar
        </a>
    </nav>

    <nav class="visible-xs visible-sm">
        <?php if ($idUsuarioMaster) { ?>
            <a href="#" onclick="popup('<?= $publicoSistema ?>/popup/log/log_listagem.php?t=<?= $t ?>', 'Registro de Logs de Acesso')" class="btn btn-info btn-block">
                <i class="fa fa-bar-chart"></i> Log de Acesso
            </a>
        <?php } ?>
        <?php if ($cadastrar) { ?>
            <a href="<?= $caminhoTela ?>&servico=cadastrar" class="btn btn-primary btn-block">
                <i class="fa fa-plus"></i> Cadastrar
            </a>
        <?php } ?>
        <a href="<?= $publicoSistema ?>/inicio.php" class="btn btn-warning btn-block">
            <i class="fa fa-ban"></i> Cancelar
        </a>
    </nav>
</div>
<script>