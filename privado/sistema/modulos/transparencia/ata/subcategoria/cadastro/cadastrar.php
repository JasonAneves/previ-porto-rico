<?php
$id = filter_input(INPUT_GET, 'id');

if($_POST) {
	include_once "includes/02-sqlCadastrar.php";
}

if($servico == 'alterar') {
	try {
		$stObject = Conexao::chamar()->prepare("SELECT ata_subcategoria.*,
													   ata_categoria.descricao AS categoria
												  FROM ata_subcategoria
											 LEFT JOIN ata_categoria ON ata_subcategoria.id_categoria = ata_categoria.id
												 WHERE ata_subcategoria.id = :id
												   AND ata_subcategoria.status_registro = :status_registro");
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
