<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Informações da Instituição</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="categoria" class="control-label">Categoria</label>
                            <div class="input-group">
                                <span class="input-group-addon input">
                                    <a  href="#" onclick="popup('<?= $publicoSistema ?>/popup/<?= $tabelaCategoria ?>.php?tela=<?= $tela ?>')"
                                        <i class="fa fa-search"></i>
                                    </a>
                                </span>
                                <input
                                    type="hidden"
                                    name="id_categoria"
                                    id="id_categoria"
                                    value="<?= $object['id_categoria'] ?>"  />
                                <input
                                    type="text"
                                    name="categoria"
                                    id="categoria"
                                    value="<?= $object['categoria'] ?>"
                                    class="form-control input required"
                                    placeholder="Selecione uma categoria..."
                                    required  />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 15px;">
                    <div class="col-sm-12 form-group">
                        <label for="nome" class="control-label">Nome</label>
                        <input
                            type="text"
                            name="nome"
                            id="nome"
                            value="<?= $object['nome'] ?>"
                            class="form-control input required"
                            placeholder="Informe o Nome..."
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                                <div class="input-group">
                                    <span class="input-group-btn" >
                                        <span class="btn btn-primary btn-file input">
                                            <i class="fa fa-folder-open"></i> Selecionar&hellip;
                                            <input type="file" accept="image/jpeg, image/png" name="logo" id="logo">
                                        </span>
                                    </span>
                                    <input type="text" class="form-control input" value="<?= $object['logo'] ?>" readonly placeholder="Selecione a logomarca...">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3 div-despesa-file form-group">
                                <?php if(!empty($object['logo'])) { ?>
                                    <a  href="<?= $CAMINHOANEXO ?>/<?= $object['logo'] ?>"
                                        class="btn btn-info btn-upload-file-info"
                                        target="_blank"
                                        data-toggle="tooltip"
                                        data-placement="left"
                                        title="Baixar Anexo">
                                        <i class="fa fa-cloud-download"></i>
                                    </a>
                                    <a  href="#" onclick="excluirArquivo('<?= $id ?>', '<?= $tabela ?>', 'logo', 'logo', '<?= $caminhoTela ?>&id=<?= $id ?>&s=alterar');"
                                        type="button"
                                        class="btn btn-danger btn-upload-file-trash"
                                        data-toggle="tooltip"
                                        data-placement="left"
                                        title="Excluir Anexo">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Endereço</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="municipio" class="control-label">Município</label>
                            <div class="input-group">
                                <span class="input-group-addon input">
                                    <a  href="#" onclick="popup('<?= $publicoSistema ?>/popup/municipio.php?tela=<?= $tela ?>')"
                                        <i class="fa fa-search"></i>
                                    </a>
                                </span>
                                <input
                                    type="hidden"
                                    name="id_municipio"
                                    id="id_municipio"
                                    value="<?= $object['id_municipio'] ?>"  />
                                <input
                                    type="text"
                                    name="municipio"
                                    id="municipio"
                                    value="<?= $object['nome_municipio'] ?>"
                                    class="form-control input required"
                                    placeholder="Selecione uma opção..."
                                    required  />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-sm-4 form-group">
                        <label for="cep" class="control-label">CEP</label>
                        <input
                                type="text"
                                name="cep"
                                id="cep"
                                value="<?= $object['cep'] ?>"
                                class="form-control input required"
                                placeholder="00000-000"
                                onblur="formataCep(this);"
                                required />
                    </div>
                    <div class="col-sm-8 form-group">
                        <label for="endereco" class="control-label">Endereço</label>
                        <input
                            type="text"
                            name="endereco"
                            id="endereco"
                            value="<?= $object['endereco'] ?>"
                            class="form-control input required"
                            placeholder="Informe o endereço..."
                            required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="complemento" class="control-label">Complemento</label>
                        <input
                            type="text"
                            name="complemento"
                            id="complemento"
                            value="<?= $object['complemento'] ?>"
                            class="form-control input required"
                            placeholder="Informe o complemento..."
                            required />
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="bairro" class="control-label">Bairro</label>
                        <input
                            type="text"
                            name="bairro"
                            id="bairro"
                            value="<?= $object['bairro'] ?>"
                            class="form-control input required"
                            placeholder="Informe o bairro..."
                            required />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Formas de Contato</span></div>
            <div class="card-form-body">
                <div class="row" style="margin-top: 15px;">
                    <div class="col-sm-6 form-group">
                        <label for="telefone_fixo" class="control-label">Telefone Fixo</label>
                        <input
                            type="text"
                            name="telefone_fixo"
                            id="telefone_fixo"
                            value="<?= $object['telefone_fixo'] ?>"
                            class="form-control input required"
                            placeholder="(00) 0000-0000"
                            onkeyup="mask(this, mphone);"
                            onblur="mask(this, mphone);"
                            required />
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="telefone_celular" class="control-label">Telefone Celular</label>
                        <input
                            type="text"
                            name="telefone_celular"
                            id="telefone_celular"
                            value="<?= $object['telefone_celular'] ?>"
                            class="form-control input required"
                            placeholder="(00) 00000-0000"
                            onkeyup="mask(this, mphone);"
                            onblur="mask(this, mphone);" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="email" class="control-label">E-mail</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="<?= $object['email'] ?>"
                            class="form-control input required"
                            placeholder="Informe um email válido..."
                            required />
                    </div>
                    <div class="col-sm-12 form-group">
                        <label for="website" class="control-label">Website</label>
                        <input
                            type="url"
                            name="website"
                            id="website"
                            value="<?= $object['site'] ?>"
                            class="form-control input required"
                            placeholder="Informe uma URL válida..."
                            required />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-form">
            <div class="card-form-topico"><span><i class="fa fa-chevron-right" aria-hidden="true"></i> Artigo</span></div>
            <div class="card-form-body">
                <div class="row" style="margin-top: 15px;">
                    <div class="col-sm-12 form-group">
                        <textarea
                                name="artigo"
                                id="artigo"
                                class="form-control editor"
                                required><?= $object['artigo'] ?>
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        <?php include "03-button.php"; ?>
        <?php include "04-javaScript.php"; ?>
    </form>
</div>