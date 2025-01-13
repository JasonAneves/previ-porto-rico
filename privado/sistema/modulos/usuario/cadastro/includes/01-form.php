<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" method="post">
    <?php if(empty($id)) { ?>
        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Verificar Usuário</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group form-group">
                            <input 
                                type="email" 
                                name="verifica_email"
                                id="verifica_email"
                                value="<?= $verifica_email ?>"
                                class="form-control email input required" 
                                placeholder="Informe um e-mail válido..."
                                required />
                                <span class="input-group-btn">
                                    <button 
                                        class="btn btn-sm btn-primary input" 
                                        type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </div>
                    <?php if(!empty($buscaUsuario['email']) && isset($verifica_email)) { ?>
                        <div class="col-sm-12 resultado-busca-usuario-indisponivel">
                            E-mail já cadastrado, tente outro e-mail!
                        </div>
                    <?php } else if(empty($buscaUsuario['email']) && isset($verifica_email)) { ?>
                        <div class="col-sm-12 resultado-busca-usuario-disponivel">
                            Usuário Disponível!
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if((empty($buscaUsuario['email']) && isset($verifica_email)) || $id) { ?>
    <div class="card-form">
        <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Identificação do Usuário</span></div>
        <div class="card-form-body">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label for="usuario" class="control-label">Nome</label>
                    <input 
                        type="text" 
                        name="usuario" 
                        id="usuario" 
                        value="<?= $object['usuario'] ?>" 
                        class="form-control input required" 
                        placeholder="Informe o nome..."
                        required />
                </div>
                <?php if($id) { ?>
                    <div class="col-sm-12 form-group">
                        <label for="email" class="control-label">E-mail</label>
                        <input 
                            type="text" 
                            name="email" 
                            id="email" 
                            value="<?= $object['email'] ?>" 
                            class="form-control input" 
                            placeholder="Informe o email..."
                            disabled />
                    </div>
                    <div id="div-alterar-sernha" style="display:none">
                        <div class="col-sm-4 form-group">
                            <label for="senha_atual" class="control-label">Senha Atual</label>
                            <input 
                                type="password" 
                                name="senha_atual" 
                                id="senha_atual"
                                class="form-control input required" 
                                placeholder="Informe a senha atual..."
                                disabled />
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="senha" class="control-label">Nova Senha</label>
                            <input 
                                type="password" 
                                name="senha" 
                                id="senha"
                                class="form-control input" 
                                placeholder="Informe a senha..."
                                disabled />
                        </div>
                        <div class="col-sm-4 form-group">
                            <label for="confirma_senha" class="control-label">Confirme a senha</label>
                            <input 
                                type="password" 
                                name="confirma_senha" 
                                id="confirma_senha"
                                class="form-control input" 
                                placeholder="Confirme a senha digitada..."
                                disabled />
                        </div>
                    </div>
                    <div class="col-sm-12 form-group">
                        <label>
                            <input 
                                type="checkbox" 
                                name="alterar_senha" 
                                id="alterar_senha"
                                value="S" />
                                Alterar dados de acesso!
                        </label>
                    </div>
                <?php } else { ?>
                    <div class="col-sm-6 form-group">
                        <label for="senha" class="control-label">Senha</label>
                        <input 
                            type="password" 
                            name="senha" 
                            id="senha"
                            class="form-control input required" 
                            placeholder="Informe a senha..."
                            required />
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="confirma_senha" class="control-label">Confirme a senha</label>
                        <input 
                            type="password" 
                            name="confirma_senha" 
                            id="confirma_senha"
                            class="form-control input required" 
                            placeholder="Confirme a senha digitada..."
                            required />
                    </div>
                <?php } ?>
                <div class="col-sm-12 form-group">
                    <label">
                        <input 
                            type="checkbox" 
                            name="permissao_log" 
                            id="permissao_log"
                            value="S" 
                            <?= $object['permissao_log'] == 'S' ? 'checked' : '' ?> />&nbsp;Permitir visualização de logs de acesso.
                    </label>
                </div>
                <div class="col-sm-12 form-group">
                    <label style="color: red;">
                        <input 
                            type="checkbox" 
                            name="master" 
                            id="master"
                            value="S" 
                            <?= $object['master'] == 'S' ? 'checked' : '' ?> />&nbsp;Usuário Master.
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="card-form">
        <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Permissões de Acesso</span></div>
        <div class="card-form-body">
            <label class="label-permissao"><input type="checkbox" name="marcar_desmarcar" id="marcar_desmarcar" />&nbsp;Marcar / Desmarcar Todos</label>
			<table class="table table-condensed table-hover">
                <?php 
                $stModulo = Conexao::chamar()->prepare("SELECT *
                                                          FROM controle_menu
                                                         WHERE id_menu IS NULL
                                                           AND status_registro = :status_registro");
                $stModulo->bindValue("status_registro", 'A', PDO::PARAM_STR);
                $stModulo->execute();
                $qryModulo = $stModulo->fetchAll(PDO::FETCH_ASSOC);
                foreach ($qryModulo AS $buscaModulo) {
                    $stConfModulo = Conexao::chamar()->prepare("SELECT *
                                                                  FROM controle_menu_usuario
                                                                 WHERE id_usuario = :id_usuario
                                                                   AND id_menu = :id_menu");
                    $stConfModulo->bindValue("id_usuario", $id, PDO::PARAM_INT);
                    $stConfModulo->bindValue("id_menu", $buscaModulo['id'], PDO::PARAM_INT);
                    $stConfModulo->execute();
                    $confModulo = $stConfModulo->fetch(PDO::FETCH_ASSOC);
                ?>
                    <tr>
                        <td style="padding-left: 20px;" class="info">
                            <label class="label-permissao">
                                <input 
                                    type="checkbox" 
                                    name="id_menu[]" 
                                    id="id_menu_<?= $buscaModulo['id'] ?>" 
                                    class="marcar" 
                                    value="<?= $buscaModulo['id'] ?>"
                                    onchange="marcaDesmarcaModulo('<?= $buscaModulo['id'] ?>')"
                                    <?= isset($confModulo['id']) ? 'checked' : '' ?>  />
                                    <?= $buscaModulo['descricao'] ?>
                            </label>
                        </td>
                    </tr>
                    <?php
                    $stMenu = Conexao::chamar()->prepare("SELECT *
                                                            FROM controle_menu
                                                           WHERE id_menu = :id_menu
                                                             AND status_registro = :status_registro
                                                        ORDER BY ordem");
                    $stMenu->bindValue("id_menu", $buscaModulo['id'], PDO::PARAM_INT);
                    $stMenu->bindValue("status_registro", 'A', PDO::PARAM_STR);
                    $stMenu->execute();
                    $qryMenu = $stMenu->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($qryMenu AS $buscaMenu) {
                        $stConfMenu = Conexao::chamar()->prepare("SELECT *
                                                                FROM controle_menu_usuario
                                                               WHERE id_usuario = :id_usuario
                                                                 AND id_menu = :id_menu");
                        $stConfMenu->bindValue("id_usuario", $id, PDO::PARAM_INT);
                        $stConfMenu->bindValue("id_menu", $buscaMenu['id'], PDO::PARAM_INT);
                        $stConfMenu->execute();
                        $confMenu = $stConfMenu->fetch(PDO::FETCH_ASSOC);
                    ?>
                        <tr class="tr_modulo_<?=$buscaModulo['id'] ?> active">
                            <td style="padding-left: 35px;">
                                <label class="label-permissao">
                                    <input 
                                        type="checkbox" 
                                        name="id_menu[]" 
                                        id="id_menu_<?= $buscaMenu['id'] ?>" 
                                        class="marcar marcar_<?= $buscaModulo['id'] ?>" 
                                        value="<?=$buscaMenu['id'] ?>" 
                                        onchange="marcaDesmarcaMenu('<?= $buscaMenu['id'] ?>')" 
                                        <?= isset($confMenu['id']) ? 'checked' : '' ?> />
                                        <?= $buscaMenu['descricao'] ?>
                                </label>
                            </td>
                        </tr>
                        <?php
                        $stMenu2 = Conexao::chamar()->prepare("SELECT *
                                                                 FROM controle_menu
                                                                WHERE id_menu = :id_menu
                                                                  AND status_registro = :status_registro
                                                             ORDER BY ordem");
                        $stMenu2->bindValue("id_menu", $buscaMenu['id'], PDO::PARAM_INT);
                        $stMenu2->bindValue("status_registro", 'A', PDO::PARAM_STR);
                        $stMenu2->execute();
                        $qryMenu2 = $stMenu2->fetchAll(PDO::FETCH_ASSOC);
                        if(count($qryMenu2)) {
                            foreach ($qryMenu2 as $buscaMenu2) {
                                $stConfMenu2 = Conexao::chamar()->prepare("SELECT *
                                                                             FROM controle_menu_usuario
                                                                            WHERE id_usuario = :id_usuario
                                                                              AND id_menu = :id_menu");
                                $stConfMenu2->bindValue("id_usuario", $id, PDO::PARAM_INT);
                                $stConfMenu2->bindValue("id_menu", $buscaMenu2['id'], PDO::PARAM_INT);
                                $stConfMenu2->execute();
                                $confMenu2 = $stConfMenu2->fetch(PDO::FETCH_ASSOC);
                        ?>
                                <tr class="tr_modulo_<?=$buscaModulo['id'] ?> active">
									<td style="padding-left: 55px;">
										<label class="label-permissao">
                                            <input 
                                                type="checkbox" 
                                                name="id_menu[]" 
                                                id="id_menu_<?= $buscaMenu2['id'] ?>" 
                                                class="marcar marcar_<?=$buscaModulo['id'] ?>" 
                                                value="<?= $buscaMenu2['id'] ?>" 
                                                onchange="marcaDesmarcaMenu('<?= $buscaMenu2['id'] ?>')"
                                                <?= isset($confMenu2['id']) ? 'checked' : '' ?> />
                                                <?= $buscaMenu2['descricao'] ?>
                                        </label>
									</td>
								</tr>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php include "03-button.php"; } ?>
    <?php include "04-javaScript.php"; ?>
    </form>
</div>