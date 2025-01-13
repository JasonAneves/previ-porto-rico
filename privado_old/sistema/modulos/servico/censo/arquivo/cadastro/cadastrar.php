<?php
    $id = filter_input(INPUT_GET, 'id');
    $tabela             = 'censo';
    $tabelaCategoria    = 'censo_categoria';
    $tabelaSubcategoria = 'censo_subcategoria';

    if($_POST) {
        include_once "includes/02-sqlCadastrar.php";
    }

    if($servico == 'alterar') {
        try {
            $stObject = Conexao::chamar()->prepare("SELECT $tabela.*, 
                                                                 $tabelaCategoria.descricao AS categoria,
                                                                 $tabelaSubcategoria.descricao AS subcategoria
                                                      FROM $tabela
                                                 LEFT JOIN $tabelaCategoria    ON $tabela.id_categoria 		= $tabelaCategoria.id
                                                 LEFT JOIN $tabelaSubcategoria ON $tabela.id_subcategoria 	= $tabelaSubcategoria.id
                                                     WHERE $tabela.id_cliente 								= :id_cliente
                                                       AND $tabela.id 									    = :id
                                                       AND $tabela.status_registro 						    = :status_registro");
            $stObject->bindValue("id", $id, PDO::PARAM_INT);
            $stObject->bindValue("status_registro", 'A', PDO::PARAM_STR);
            $stObject->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
            $stObject->execute();
            $object = $stObject->fetch(PDO::FETCH_ASSOC);

            if(filter_input(INPUT_GET, 'id_excluir')) {
                include_once "$root/privado/sistema/classes/includes/excluir.php";
                excluir($_REQUEST['id_excluir'], $tabela);
            }

        } catch (PDOException $e) {
            echo alerta("danger", "<i class=\"fa fa-ban\"></i> N&atilde;o foi poss&iacute;vel carregar o registro.");
            echo "<script>console.log('Erro: ".addslashes($e->getMessage())."')</script>";
        }


    } else {
        $object['titulo'] = '';
        $object['artigo'] = '';
    }

    $tabelaAnexo                = $tabela."_anexo";
    $relacionamentoTabelaAnexo  = "artigo";
    $tabelaFoto                 = $tabela."_foto";
    $relacionamentoTabelaFoto   = "artigo";
    $tabelaVideo                = $tabela."_video";
    $relacionamentoTabelaVideo  = "artigo";
    include "includes/01-form.php";
