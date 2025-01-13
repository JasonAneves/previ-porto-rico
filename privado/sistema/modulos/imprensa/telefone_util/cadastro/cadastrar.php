<?php
$id = filter_input(INPUT_GET, 'id');

if($_POST) {
	include_once "includes/02-sqlCadastrar.php";
}

if($servico == 'alterar') {
	try {
		$stObject = Conexao::chamar()->prepare("SELECT *
												  FROM telefone_util
												 WHERE id = :id
												   AND status_registro = :status_registro
												   AND id_cliente = :id_cliente");
		$stObject->bindValue("id", $id, PDO::PARAM_INT);
		$stObject->bindValue("status_registro", 'A', PDO::PARAM_STR);
		$stObject->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
		$stObject->execute();
		$object = $stObject->fetch(PDO::FETCH_ASSOC);

		if(filter_input(INPUT_GET, 'id_excluir')) {
			include_once "$root/privado/sistema/classes/includes/excluir.php";
			excluir($_REQUEST['id_excluir'], "telefone_util");
		}

	} catch (PDOException $e) {
		echo alerta("danger", "<i class=\"fa fa-ban\"></i> N&atilde;o foi poss&iacute;vel carregar o registro.");
		echo "<script>console.log('Erro: ".addslashes($e->getMessage())."')</script>";
	}

	
} else {
	$object['descricao'] = '';
}

include "includes/01-form.php";
