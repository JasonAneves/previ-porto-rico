<?php
$id = filter_input(INPUT_GET, 'id');

if($servico == 'alterar') {
	try {
		$stObject = Conexao::chamar()->prepare("SELECT *
												  FROM usuario
												 WHERE id = :id
												   AND status_registro = :status_registro
												   AND id_cliente = :id_cliente");
		$stObject->bindValue("id", $id, PDO::PARAM_INT);
		$stObject->bindValue("status_registro", 'A', PDO::PARAM_STR);
		$stObject->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
		$stObject->execute();
		$object = $stObject->fetch(PDO::FETCH_ASSOC);

	} catch (PDOException $e) {
		echo alerta("danger", "<i class=\"fa fa-ban\"></i> N&atilde;o foi poss&iacute;vel carregar o registro.");
		echo "<script>console.log('Erro: ".addslashes($e->getMessage())."')</script>";
	}
} else {
	$verifica_email = filter_input(INPUT_POST, 'verifica_email');
	$usuario_encontrado = filter_input(INPUT_POST, 'usuario_encontrado');
	$confirma_senha = filter_input(INPUT_POST, 'confirma_senha');
	$object['id_cliente'] = '';
	$object['usuario'] = '';
	$object['senha'] = '';
	$object['email'] = '';
	$object['telefone'] = '';
	$object['master'] = '';
	$object['permissao_log'] = '';
	$object['foto'] = '';
	$object['data_validade'] = '';
	$object['recupera_senha'] = '';
	$object['alterar_senha'] = '';
}

if($_POST) {
	include_once "includes/02-sqlCadastrar.php";
}

include "includes/01-form.php";
?>
