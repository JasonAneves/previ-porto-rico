<?php
    include_once "../../../../privado/config_cliente.php";
?>
<script>
    function saveNumero() {
        let inputNumero = $("#mNumero");
        if (inputNumero.val() === '' || inputNumero.val() == null) {
            alert('Por favor, preencha o campo número');
            inputNumero.focus();
            return false;
        }
        retorna();
    }

    function retorna() {
        const indice = <?= $_REQUEST['id'] ?>;
        const numero = $("#mNumero").val();
        $("#<?= $_REQUEST['id'] ?>").val(numero);
        adicionaNumeroTelefone({indice, numero});
        $('#modal').modal('hide');
    }

    $( document ).ready(function() {
        const numero = $("#<?= $_REQUEST['id'] ?>").val();
        $("#mNumero").val(numero);

    });
    $(setMask);

</script>

<div class="modal-body">
    <div>
        <div class="row">
            <div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="mNumero" class="control-label">Número</label>
                        <input type="text"
                               name="mNumero"
                               id="mNumero"
                               class="form-control input required telefone" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pull-right">
    <button type="button" class="btn btn-success" onclick="saveNumero()"><i class="fa fa-save"></i> Salvar</button>
    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar</button>
</div>
<p class="clearfix"></p>
