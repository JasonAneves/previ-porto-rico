<?php
	$id = filter_input(INPUT_GET, 'id');
    $tabela = 'planejamento_subcategoria';
    $tabelaCategoria = 'planejamento_categoria';

	if($_POST) {
		include_once "includes/02-sqlCadastrar.php";
	}

	if($servico == 'alterar') {
		try {
			$stObject = Conexao::chamar()->prepare("SELECT $tabela.*,
														   $tabelaCategoria.descricao AS categoria
													  FROM $tabela
												 LEFT JOIN $tabelaCategoria ON $tabela.id_categoria = $tabelaCategoria.id
													 WHERE $tabela.id = :id
													   AND $tabela.status_registro = :status_registro");
			$stObject->bindValue("id", $id, PDO::PARAM_INT);
			$stObject->bindValue("status_registro", 'A', PDO::PARAM_STR);
			$stObject->execute();
			$object = $stObject->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> N&atilde;o foi poss&iacute;vel carregar o registro.");
			echo "<script>console.log('Erro: ".addslashes($e->getMessage())."')</script>";
		}
	} else {
		$object['descricao'] = '';
		$object['link'] = '';
		$object['id_categoria'] = '';
		$object['categoria'] = '';
	}
	include "includes/01-form.php";
