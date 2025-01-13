<div class="div-button">
    <nav class="pull-right hidden-xs hidden-sm div-button">
        <?php if($id && $buscaAdministrador['permissao_log'] == 'S') { ?>
            <a  href="#" 
                onclick="popup('<?= $CAMINHO ?>/popup/log/log_cadastro.php?tela=<?= $tela ?>&id=<?= $id ?>', 'Registro de Logs de Acesso')" 
                class="btn btn-info pull right"><i class="fa fa-bar-chart"></i> Log de Acesso
            </a>
        <?php } ?>
        <button 
            type="submit" 
            class="btn btn-success pull right">
            <i class="fa fa-floppy-o"></i> Salvar
        </button>
        <a  href="<?= $caminhoTela ?>" 
            class="btn btn-warning pull right">
            <i class="fa fa-ban"></i> Cancelar
        </a>
    </nav>

    <nav class="visible-xs visible-sm div-button">
        <?php if($id && $buscaAdministrador['permissao_log'] == 'S') { ?>
            <a  href="#" 
                onclick="popup('<?= $CAMINHO ?>/popup/log/log_cadastro.php?tela=<?= $tela ?>&id=<?= $id ?>', 'Registro de Logs de Acesso')" 
                class="btn btn-info btn-block">
                <i class="fa fa-bar-chart"></i> Log de Acesso
            </a>
        <?php } ?>
        <button 
            type="submit" 
            class="btn btn-success btn-block">
            <i class="fa fa-floppy-o"></i> Salvar
        </button>
        <a  href="<?= $caminhoTela ?>" 
            class="btn btn-warning btn-block">
            <i class="fa fa-ban"></i> Cancelar
        </a>
    </nav>
</div>
