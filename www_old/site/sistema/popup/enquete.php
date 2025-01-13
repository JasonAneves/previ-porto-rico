<?php
    include_once "../../../../privado/config_cliente.php";
?>
<script>
    var nomeFoto = ''
    function saveAlternativa() {
        let inputDescricao = $("#mDescricao");
        if (inputDescricao.val() === '' || inputDescricao.val() == null) {
            alert('Por favor, preencha o campo descrição');
            inputDescricao.focus();
            return false;
        }
        if(!!$("#mFoto").val()){
            uploadFoto();
            return false;
        }
        retorna();
    }

    function retornaNomeFoto(val) {
        nomeFoto = val;
        retorna();
    }

    function uploadFoto() {
        let fd = new FormData();
        let files = $('#mFoto')[0].files;
        fd.append('mFoto',files[0]);
        $.ajax({
            url: 'ajax/upload_imagem.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: (response) => {
                retornaNomeFoto(response)
            },
            error: () => {
                console.error('Ocorreu um erro ao salvar.')
            }
        });
    }

    function limpaFoto() {
        $("#mImagem").val('')
    }

    function retorna() {
        const indice = <?= $_REQUEST['id'] ?>;
        const descricao = $("#mDescricao").val();
        const votos = $("#mVotos").val();
        const foto = nomeFoto;

        $("#<?= $_REQUEST['id'] ?>").val(descricao);
        $("#foto_<?= $_REQUEST['id'] ?>").val(foto);
        $("#votos_<?= $_REQUEST['id'] ?>").val(votos);

        adicionaAlternativa({indice, descricao, votos, foto});
        $('#modal').modal('hide');
    }

    $( document ).ready(function() {
        const descricao = $("#<?= $_REQUEST['id'] ?>").val();
        $("#mDescricao").val(descricao);
        const votos = $("#votos_<?= $_REQUEST['id'] ?>").val();
        $("#mVotos").val(votos);
        const foto = $("#foto_<?= $_REQUEST['id'] ?>").val();
        $("#mImagem").val(foto);
        if($("#mImagem").val()) {
            $("#controle-foto").append("" +
                "<a href=\"<?= $publicoSistema ?>/imagens/<?= $idCliente ?>/" + foto + "\"" +
                "class=\"btn btn-info btn-upload-file-trash\"" +
                "target=\"_blank\"" +
                "data-toggle=\"tooltip\"" +
                "data-placement=\"left\"" +
                "title=\"Visualizar Anexo\">" +
                "<i class=\"fa fa-search\"></i>" +
                "</a>" +
                "<a  href=\"#\"" +
                "onclick=\"limpaFoto()\"" +
                "type=\"button\"" +
                "class=\"btn btn-danger btn-upload-file-trash\"" +
                "data-toggle=\"tooltip\"" +
                "data-placement=\"left\"" +
                "title=\"Excluir Anexo\">" +
                "<i class=\"fa fa-trash\"></i>" +
                "</a>"
            );
        }
    });
</script>

<div class="modal-body">
    <div>
        <div class="row">
            <div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="mDescricao" class="control-label">Descrição</label>
                        <input type="text"
                               name="mDescricao"
                               id="mDescricao"
                               class="form-control input required"
                               placeholder="Informe a alternativa..." />
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <div class="input-group">
                            <span class="input-group-btn" >
                            <span class="btn btn-primary btn-file input">
                                <i class="fa fa-save fa-2x"></i>
                                <input type="file"
                                       accept="image/jpeg, image/png"
                                       name="mFoto"
                                       id="mFoto">
                            </span>
                            </span>
                            <div class="imagem-alternativa">
                                <input type="text"
                                       class="form-control input input-focus-border-none"
                                       id="mImagem"
                                       readOnly placeholder="Selecione o arquivo...">
                                <span id="controle-foto" class="botoes-imagem-alternativa" ></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pull-right">
    <button type="button" class="btn btn-success" onclick="saveAlternativa()"><i class="fa fa-save"></i> Salvar</button>
    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar</button>
</div>
<p class="clearfix"></p>
