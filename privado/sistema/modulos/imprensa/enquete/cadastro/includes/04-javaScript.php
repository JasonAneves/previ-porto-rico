<script>
    let hasChanges        = false
    let hasAlternativa    = false
    let listaAlternativas = <?php echo json_encode($qryAlternativa) ?>;
    let tbodyAlternativas = document.getElementById('tbody-alternativas')

    function addAlertaAlteracao() {
        if(!hasChanges) {
            hasChanges = true;
            $("#alerta-alteracoes").append("<div class='alert-warning alert-alteracoes'>Atenção: As alterações só serão efetivadas ao salvar o cadastro.</div>")
        }
    }

    function listarAlternativas(alternativas) {
        $("#tbody-alternativas").empty() // Limpa as alternativas antes de gerar novamente.
        for(let alternativa of alternativas) {
            let trAlternativa = document.createElement('tr') // Cria row
            trAlternativa.innerHTML =
                "<td>" + // Add celulas na tr
                    "<a href=\"#\" class=\"btn-lista-trash\" onclick=\"validaRemoverItem(" + alternativas.indexOf(alternativa) + ")\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"Excluir\"><i class=\"fa fa-trash-o\"></i></a>" +
                    "<a href=\"#\" onclick=\"popup('<?= $publicoSistema ?>popup/enquete.php?tela=<?= $tela ?>&id=" + alternativas.indexOf(alternativa) + "&novo=0')\" class=\"btn-lista-search\" data-toggle=\"tooltip\" data-target=\"#modal-alternativa\" data-placement=\"right\" title=\"Editar Registro\">" +
                    "<i class=\"fa fa-search\"></i></a>" +
                "</td>" +
                "<td>" +
                    "<input type=\"hidden\" name=\"idBanco[]\" id=\"idBanco_" + alternativas.indexOf(alternativa) + "\" value=\"" + alternativa.id + "\" readOnly />" +
                    "<input type=\"text\" name=\"descricao[]\" id=\"" + alternativas.indexOf(alternativa) + "\" value=\"" + alternativa.descricao + "\" class=\"form-control input input-border-none\" readOnly />" +
                "</td>" +
                "<td>" +
                    "<input type=\"number\" name=\"votos[]\" id=\"votos_" + alternativas.indexOf(alternativa) + "\" value=\"" + (alternativa.votos ? alternativa.votos : 0) + "\" class=\"form-control input input-border-none\" readOnly />" +
                "</td>" +
                "<td>" +
                    "<input type=\"hidden\" class=\"form-control input input-focus-border-none\" name=\"foto[]\" id=\"foto_" + alternativas.indexOf(alternativa) + "\" value=\"" + alternativa.foto + "\" readOnly placeholder=\"Selecione o arquivo...\" />" +
                "</td>"
            tbodyAlternativas.appendChild(trAlternativa) // Add linha no body da tabela.
        }
        validateSave()
      console.log(listaAlternativas)

    } listarAlternativas(listaAlternativas) // Inicializa lista de alternativas

    function novaAlternativa() { // Chama popup passando um id para o novo item e um parametro de validação
        let url = '<?= $publicoSistema ?>popup/enquete.php?tela=<?= $tela ?>&id=' + listaAlternativas.length +'&novo=1'
        popup(url)
    }

    function adicionaAlternativa(item) {
        addAlertaAlteracao()
        let filtered = listaAlternativas.find(alternativa => listaAlternativas.indexOf(alternativa) === item.indice)
        if (filtered) { // Valida se é uma edição de alternativa, ou se é uma alternativa nova.
            filtered.descricao = item.descricao
            filtered.foto = item.foto
            listarAlternativas(listaAlternativas)
            return
        }
        listaAlternativas.push(item) // Se nova alternativa, insere no array de alternativas e chama funcao pra gerar novamente a lista.
        listarAlternativas(listaAlternativas)
    }

    function removeAlternativa(indice) { // Indice é a alternavita.index que deve ser removida
        addAlertaAlteracao()
        let item = listaAlternativas.find(alternativa => listaAlternativas.indexOf(alternativa) === indice)
        listaAlternativas.splice(listaAlternativas.indexOf(item), 1) // Remove a alternativa e chama função pra gerar novamente a lista.
        listarAlternativas(listaAlternativas)
    }

    function validaRemoverItem(indice) {
        noty({
            text: 'Deseja realmente remover o registro?',
            type: 'alert',
            buttons: [{
                addClass: 'btn btn-primary', text: 'Sim', onClick: function ($noty) {
                    removeAlternativa(indice)
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
        if (listaAlternativas.length >= 2) {
            document.getElementById('save-button').removeAttribute('disabled')
            $("#alerta-qtde-alternativa").remove()
        } else {
            if (!hasAlternativa) {
              hasAlternativa = true
              $("#alerta-alteracoes").append("<div id='alerta-qtde-alternativa' class='alert-danger alert-alteracoes'>A enquete deve ter pelo menos 2 alternativas.</div>")
            }
        }
    }
</script>
