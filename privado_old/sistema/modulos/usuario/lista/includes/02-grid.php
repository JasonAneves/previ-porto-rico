<div id="div-grid">
    <div class="table-responsive hidden-sm hidden-xs">
        <table class="table table-striped table-hover table-bordered table-condensed">
            <tr class="active grid-topico">
                <th style="width: 90px;">
                    <?php if(empty($statusRegistro) || $statusRegistro == "A") { ?>
                        <input type="checkbox" 
                            name="marcar" 
                            onchange="marcarDesmarcar(this)" 
                            data-toggle="tooltip" 
                            data-placement="right" 
                            title="Marcar / Desmarcar todos">
                    <?php } ?>
                </th>
                <th>
                    <a href="<?= $link ?>&tela=<?= $tela ?>&sort=usuario&direction=<?= empty($direction) || $direction == "DESC" ? "ASC" : "DESC" ?>" 
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Clique para ordenar">
                        Nome do Usuário
                    </a>
                    <?php if($sort == "usuario" && $direction == "ASC") { ?><i class="fa fa-caret-up"></i><?php } ?>
                    <?php if($sort == "usuario" && $direction == "DESC") { ?><i class="fa fa-caret-down"></i><?php } ?>
                    <i  class="fa fa-search pull-right btn-pesquisa"
                        data-toggle="collapse" 
                        data-target="#form-busca" 
                        aria-expanded="false" 
                        aria-controls="form-busca"
                        title="Localizar Registro">
                    </i>
                </th>
            </tr>
            <?php
            if(count($qryObject)) {
                foreach($qryObject as $object) {
                    ?>
                    <tr>
                        <td class="text-center">
                            <?php if($object['status_registro'] == "A") { ?>
                                <?php if($excluir) { ?>
                                    <input 
                                        type="checkbox" 
                                        class="marcar" 
                                        name="id_excluir[]" 
                                        value="<?= $object['id'] ?>" />
                                    <a  href="#" 
                                        class="btn-lista-trash" 
                                        onclick="excluir('<?= $caminhoTela ?>&id_excluir=<?= $object['id'] ?>');" 
                                        data-toggle="tooltip" 
                                        data-placement="right" 
                                        title="Excluir Registro">
                                            <i class="fa fa-trash-o"></i>
                                    </a>
                                <?php } ?>
                                <?php if($cadastrar) { ?>
                                    <a  href="<?= $caminhoTela ?>&id=<?= $object['id'] ?>&servico=alterar" 
                                        class="btn-lista-search" 
                                        data-toggle="tooltip" 
                                        data-placement="right" 
                                        title="Editar Registro">
                                            <i class="fa fa-search"></i>
                                    </a>
                                <?php } ?>
                            <?php } else { ?>
                                <a  href="#" 
                                    class="text-info btn-lista" 
                                    onclick="restaurar('noticia', '<?= $object['id'] ?>', '<?= $caminhoTela ?>');" 
                                    data-toggle="tooltip" 
                                    data-placement="right" 
                                    title="Restaurar Registro">
                                        <i class="fa fa-undo"></i>
                                </a>
                            <?php } ?>
                        </td>
                        <td><?= $object['usuario'] ?></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
    </div>

    <div class="visible-xs visible-sm">
        <?php
        if(count($qryObject)) {
            foreach($qryObject as $object) {
        ?>
            <div class="div-lista-small">
            <table>
                <tr>
                    <td style="width: 35px;">
                        <?php if($excluir) { ?>
                            <a  href="#" 
                                style="font-size: 18pt;"
                                class="text-danger btn-lista-trash" 
                                onclick="excluir('<?= $caminhoTela ?>&id_excluir=<?= $object['id'] ?>');" 
                                data-toggle="tooltip" 
                                data-placement="right" 
                                title="Excluir Registro">
                                    <i class="fa fa-trash-o"></i>
                            </a>
                        <?php } ?>
                    </td>
                    <td class="td-small-principal-single">
                        <?php if($cadastrar) { ?>
                            <a  href="<?= $caminhoTela ?>&id=<?= $object['id'] ?>&servico=alterar" 
                                data-toggle="tooltip" 
                                data-placement="right" 
                                title="Editar Registro">
                                    <?= $object['usuario'] ?>
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            </table>
            </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>