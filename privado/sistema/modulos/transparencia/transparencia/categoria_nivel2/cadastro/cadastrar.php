<?php
$id = filter_input(INPUT_GET, 'id');
$tb_nivel_1 = "transparencia_categoria_nivel1";
$tb_nivel_2 = "transparencia_categoria_nivel2";

if($_POST) {
	include_once "includes/02-sqlCadastrar.php";
}

if($servico == 'alterar') {
	try {
		$stObject = Conexao::chamar()->prepare("SELECT $tb_nivel_2.*,
													   $tb_nivel_1.descricao AS categoria
												  FROM $tb_nivel_2
											 LEFT JOIN $tb_nivel_1 ON $tb_nivel_2.id_nivel1 = $tb_nivel_1.id
												 WHERE $tb_nivel_2.id = :id
												   AND $tb_nivel_2.status_registro = :status_registro");
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
?>
