<?php
function excluir($ids, $tb, $tabelas = "", $relacionamentos = "", $chave = "") {

	$id_usuario = $_COOKIE['id_usuario'];
	$id_menu = secure($_REQUEST['tela']);

	$arrayIds = array();
	$arrayTabelas = array();
	$arrayRelacionamentos = array();

	if(is_array($ids))
		$arrayIds = $ids;
	else
		$arrayIds[] = $ids;

	if(is_array($tabelas))
		$arrayTabelas = $tabelas;
	else if($tabelas != "")
		$arrayTabelas[] = $tabelas;

	if(is_array($relacionamentos))
		$arrayRelacionamentos = $relacionamentos;
	else
		$arrayRelacionamentos[] = $relacionamentos;

	$erro = 0;
	$stValidaAcesso = Conexao::chamar()->prepare("SELECT *
													FROM controle_menu_usuario
												   WHERE id_menu = :id_menu
													 AND id_usuario = :id_usuario
												   LIMIT 1");

	$stValidaAcesso->execute(array("id_menu" => $id_menu , "id_usuario" => $id_usuario));
	$usuario_acesso = $stValidaAcesso->fetch(PDO::FETCH_ASSOC);

	if($usuario_acesso['excluir'] == 'S'){
			foreach ($arrayIds as $idExcluir) {
				try {
					if(count($arrayTabelas) > 0) {
						foreach ($arrayTabelas as $indice => $tabela) {
							if($tabela == 'controle_menu_usuario'){
								
								$stExcluir = Conexao::chamar()->prepare("DELETE FROM $tabela WHERE id_usuario = :id");
								$x = $stExcluir->execute(array("id" => $idExcluir));

								$stConf = Conexao::chamar()->prepare("SELECT COUNT(id) total FROM $tabela WHERE ".$arrayRelacionamentos[$indice]." = :id_relacionamento");
								$stConf->execute(array("id_relacionamento" => $idExcluir));
								$totalConf = $stConf->fetch(PDO::FETCH_ASSOC);
							} else {
								$stConf = Conexao::chamar()->prepare("SELECT COUNT(id) total FROM $tabela WHERE ".$arrayRelacionamentos[$indice]." = :id_relacionamento AND status_registro = :status_registro");
								$stConf->execute(array("id_relacionamento" => $idExcluir, "status_registro" => "A"));
								$totalConf = $stConf->fetch(PDO::FETCH_ASSOC);
							}

							if($totalConf['total'] > 0) {
								$erro = 1;
								break;
							} else {
								$erro = 0;
							}
						}
					}

					if($erro == 0) {
						$stExcluir = Conexao::chamar()->prepare("UPDATE $tb SET status_registro = :status_registro WHERE id = :id");
						$x = $stExcluir->execute(array("status_registro" => "I", "id" => $idExcluir));
					}
				} catch(PDOException $e) {
					echo "<script>console.log('Erro: ".addslashes($e->getMessage())."')</script>";
					$erro = 2;
					break;
				}
			}
	} else {
		$erro = 3;	
	}

	switch ($erro) {
		case 0:
			echo alerta("success", "<i class=\"fa fa-check\"></i> Registro exclu&iacute;do com sucesso.");
			break;
		case 1:
			echo alerta("warning", "<i class=\"fa fa-exclamation-triangle\"></i> Alguns registros n&atilde;o puderam ser exclu&iacute;dos por estarem sendo utilizados em outros cadastros.");
			break;
		case 2:
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> N&atilde;o foi poss&iacute;vel excluir o registro.");
			break;
		case 3:
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> Sem permiss&atilde;o para excluir  registros.");
			break;
	}
}