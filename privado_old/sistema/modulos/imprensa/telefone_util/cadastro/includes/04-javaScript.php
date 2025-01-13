<script>
    let hasChanges                = false;
    let hasNumeroTelefone         = false;
    let listaNumerosTelefoneUtil  = <?php echo json_encode($qryNumero) ?>;
    let tbodyNumerosTelefoneUtil  = document.getElementById('tbody-numeros');
    console.log(listaNumerosTelefoneUtil)

    function addAlertaAlteracao() {
        if(!hasChanges) {
            hasChanges = true;
            $("#alerta-alteracoes").append("<div class='alert-warning alert-alteracoes'>Atenção: As alterações só serão efetivadas ao salvar o cadastro.</div>")
        }
    }

    function listarNumerosTelefoneUtil(numeros) {
        $("#tbody-numeros").empty() // Limpa as numeros antes de gerar novamente.
        for(let numero of numeros) {
            let trNumeroTelefone = document.createElement('tr') // Cria row
            trNumeroTelefone.innerHTML =
                "<td>" + // Add celulas na tr
                    "<a href=\"#\" class=\"btn-lista-trash\" onclick=\"validaRemoverItem(" + numeros.indexOf(numero) + ")\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Excluir\"><i class=\"fa fa-trash-o\"></i></a>" +
                    "<a href=\"#\" onclick=\"popup('<?= $publicoSistema ?>popup/numero_telefone_util.php?tela=<?= $tela ?>&id=" + numeros.indexOf(numero) + "&novo=0')\" class=\"btn-lista-search\" data-toggle=\"tooltip\" data-target=\"#modal-numero\" data-placement=\"right\" title=\"Editar Registro\">" +
                    "<i class=\"fa fa-search\"></i></a>" +
                "</td>" +
                "<td>" +
                    "<input type=\"hidden\" name=\"idBanco[]\" id=\"idBanco_" + numeros.indexOf(numero) + "\" value=\"" + numero.id + "\" readOnly />" +
                    "<input type=\"text\" name=\"numeros[]\" id=\"" + numeros.indexOf(numero) + "\" value=\"" + numero.numero + "\" class=\"form-control input input-border-none\" readOnly />" +
                "</td>"
            tbodyNumerosTelefoneUtil.appendChild(trNumeroTelefone) // Add linha no body da tabela.
        }
        validateSave()
    } listarNumerosTelefoneUtil(listaNumerosTelefoneUtil)

    function novoNumero() { // Chama popup passando um id para o novo item e um parametro de validação
        let url = '<?= $publicoSistema ?>popup/numero_telefone_util.php?tela=<?= $tela ?>&id=' + listaNumerosTelefoneUtil.length +'&novo=1'
        popup(url)
    }

    function adicionaNumeroTelefone(item) {
        addAlertaAlteracao()
        let filtered = listaNumerosTelefoneUtil.find(numero => listaNumerosTelefoneUtil.indexOf(numero) === item.indice)
        if (filtered) { // Valida se é uma edição de numero, ou se é uma numero nova.
            filtered.numero = item.numero
            listarNumerosTelefoneUtil(listaNumerosTelefoneUtil)
            return
        }
        listaNumerosTelefoneUtil.push(item) // Se nova numero, insere no array de numeros e chama funcao pra gerar novamente a lista.
        listarNumerosTelefoneUtil(listaNumerosTelefoneUtil)
    }

    function removeNumeroTelefone(indice) { // Indice é a alternavita.index que deve ser removida
        addAlertaAlteracao()
        let item = listaNumerosTelefoneUtil.find(numero => listaNumerosTelefoneUtil.indexOf(numero) === indice)
        listaNumerosTelefoneUtil.splice(listaNumerosTelefoneUtil.indexOf(item), 1) // Remove a numero e chama função pra gerar novamente a lista.
        listarNumerosTelefoneUtil(listaNumerosTelefoneUtil)
    }

    function validaRemoverItem(indice) {
        noty({
            text: 'Deseja realmente remover o registro?',
            type: 'alert',
            buttons: [{
                addClass: 'btn btn-primary', text: 'Sim', onClick: function ($noty) {
                    removeNumeroTelefone(indice)
                    $noty.close()
                }
            },
            {
                addClass: 'btn btn-danger', text: 'N&atilde;o', onClick: function ($noty) {
                    $noty.close()
                }
            }]
        });
        return false
    }

    function validateSave() {
        document.getElementById('save-button').disabled = true
        if (listaNumerosTelefoneUtil.length >= 1) {
            document.getElementById('save-button').removeAttribute('disabled')
            $("#alerta-qtde-numero").remove()
        } else {
            if (!hasNumeroTelefone) {
              hasNumeroTelefone = true
              $("#alerta-alteracoes").append("<div id='alerta-qtde-numero' class='alert-danger alert-alteracoes'>O Registro deve ter pelo menos 1 número</div>")
            }
        }
    }
</script>
