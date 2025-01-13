<div id="div-grid">
    <div class="table-responsive hidden-sm hidden-xs">
        <table class="table table-striped table-hover table-bordered table-condensed">
            <tr class="active grid-topico">
                <th style="width: 90px;">
                    <?php if($totalRegistrosFilhos == 0 && (empty($statusRegistro) || $statusRegistro == "A")) { ?>
                        <input type="checkbox"
                            id="marcar" 
                            name="marcar" 
                            onchange="marcarDesmarcar(this)" 
                            data-toggle="tooltip" 
                            data-placement="right" 
                            onclick="habilita_botao()"
                            title="Marcar / Desmarcar todos">
                    <?php } ?>
                </th>
                <th>
                    <a  href="<?= $link ?>&tela=<?= $tela ?>&sort=<?= $tb_nivel_2 ?>.descricao&direction=<?= empty($direction) || $direction == "DESC" ? "ASC" : "DESC" ?>"
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Clique para ordenar">
                        Descrição
                    </a>
                    <?php if($sort == $tb_nivel_2.".descricao" && $direction == "ASC") { ?><i class="fa fa-caret-up"></i><?php } ?>
                    <?php if($sort == $tb_nivel_2.".descricao" && $direction == "DESC") { ?><i class="fa fa-caret-down"></i><?php } ?>
                </th>
                <th>
                    <a  href="<?= $link ?>&tela=<?= $tela ?>&sort=<?= $tb_nivel_1 ?>.descricao&direction=<?= empty($direction) || $direction == "DESC" ? "ASC" : "DESC" ?>"
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="Clique para ordenar">
                        Categoria N&iacute;vel 01
                    </a>
                    <i  class="fa fa-search pull-right btn-pesquisa"
                        data-toggle="collapse"
                        data-target="#form-busca"
                        aria-expanded="false"
                        aria-controls="form-busca"
                        title="Localizar Registro">
                    </i>
                    <?php if($sort == $tb_nivel_1.".descricao" && $direction == "ASC") { ?><i class="fa fa-caret-up"></i><?php } ?>
                    <?php if($sort == $tb_nivel_1.".descricao" && $direction == "DESC") { ?><i class="fa fa-caret-down"></i><?php } ?>
                </th>
            </tr>
            <?php
            if(count($qryObject)) {
                foreach($qryObject as $object) {
                    $podeExcluir = false;
                    ?>
                  <tr>
                    <td class="text-center">
                        <?php if($object['status_registro'] == "A") {
                            ?>
                            <?php
                            for($i = 0; $i <= $totalCadastrosFilhos; $i++){
                                if ($object['id'] == $qryCadastrosFilhos[$i]['id_nivel2'] || $object['id'] == $qryCategoria_2Filhos[$i]['id_nivel2']) {
                                    $podeExcluir = true;
                                }
                            }
                            ?>
                            <?php if(!$podeExcluir) { ?>
                            <input
                                    type="checkbox"
                                    id="marcar"
                                    class="marcar"
                                    onclick="habilita_botao()"
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
                            <?php } else { ?>
                            <input  type="checkbox"
                                    id="marcar"
                                    class="marcar"
                                    onclick=""
                                    name=""
                                    value=""
                                    disabled/>
                            <a  href="#"
                                class="btn-lista-trash no-remove"
                                data-toggle="tooltip"
                                data-placement="right"
                                title="Não é possível excluir! Existe(m) registro(s) vinculado(s) à esta categoria.">
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
                                    onclick="restaurar('<?= $tb_nivel_2 ?>', '<?= $object['id'] ?>', '<?= $caminhoTela ?>');"
                                    data-toggle="tooltip" 
                                    data-placement="right" 
                                    title="Restaurar Registro">
                                        <i class="fa fa-undo"></i>
                                </a>
                            <?php } ?>
                        </td>
                        <td><?= $object['descricao'] ?></td>
                        <td><?= $object['categoria'] ?></td>
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
                        <?php if($podeExcluir) { ?>
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
                    <td class="td-small-principal">
                        <?php if($cadastrar) { ?>
                            <a  href="<?= $caminhoTela ?>&id=<?= $object['id'] ?>&servico=alterar" 
                                data-toggle="tooltip" 
                                data-placement="right" 
                                title="Editar Registro">
                                    <?= $object['descricao'] ?>
                            </a>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td class="td-small-secundaria">
                        <?php if($cadastrar) { ?>
                            <a  href="<?= $caminhoTela ?>&id=<?= $object['id'] ?>&servico=alterar" 
                                data-toggle="tooltip" 
                                data-placement="right" 
                                title="Editar Registro">
                                    <?= $object['categoria'] ?>
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