<?php
	$id = filter_input(INPUT_GET, 'id');
	$tabela_arquivo = "transparencia_arquivo";
	$tb_nivel_1     = "transparencia_categoria_nivel1";
	$tb_nivel_2     = "transparencia_categoria_nivel2";
	$tb_nivel_3     = "transparencia_categoria_nivel3";

if($_POST) {
	include_once "includes/02-sqlCadastrar.php";
}

if($servico == 'alterar') {
	try {
		$stObject = Conexao::chamar()->prepare("SELECT $tabela_arquivo.*,
													   $tb_nivel_1.descricao AS categoria_1,
													   $tb_nivel_2.descricao AS categoria_2,
													   $tb_nivel_3.descricao AS categoria_3
												  FROM $tabela_arquivo
											 LEFT JOIN $tb_nivel_1 ON $tabela_arquivo.id_nivel1 = $tb_nivel_1.id
											 LEFT JOIN $tb_nivel_2 ON $tabela_arquivo.id_nivel2 = $tb_nivel_2.id
											 LEFT JOIN $tb_nivel_3 ON $tabela_arquivo.id_nivel3 = $tb_nivel_3.id
												 WHERE $tabela_arquivo.id = :id
												   AND $tabela_arquivo.status_registro = :status_registro");
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

	$object['id_nivel1'] = '';
	$object['categoria_1'] = '';

	$object['id_nivel2'] = '';
	$object['categoria_2'] = '';

	$object['id_nivel3'] = '';
	$object['categoria_3'] = '';
	
}

include "includes/01-form.php";
