<div class="conteudo">
    <form id="form-cadastro" action="" enctype="multipart/form-data" method="post">
        <div class="card-form">
            <div class="card-form-topico"><span> Informações Gerais</span></div>
            <div class="card-form-body">
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <label for="titulo" class="control-label">Pergunta</label>
                        <input
                            type="text"
                            name="titulo"
                            id="titulo"
                            value="<?= $object['titulo'] ?>"
                            class="form-control input required"
                            required
                            placeholder="Informe a pergunta..." />
                    </div>
                    <div class="col-sm-12 form-group">
                        <label for="artigo" class="control-label">Resposta</label>
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