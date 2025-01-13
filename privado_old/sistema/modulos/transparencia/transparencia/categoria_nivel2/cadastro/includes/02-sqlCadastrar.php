<?php
try {
	$tela = secure($tela);
	if(empty($id)) {
		$stCadastro = Conexao::chamar()->prepare("INSERT INTO $tb_nivel_2 
		                                                  SET id_cliente    = :id_cliente,
														  	  id_nivel1     = :id_nivel1,
															  descricao     = :descricao,
															  link          = :link_categoria");
		$stCadastro->bindValue("id_cliente", $idCliente, PDO::PARAM_INT);
		$stCadastro->bindValue("id_nivel1", $id_nivel1, PDO::PARAM_STR);
		$stCadastro->bindValue("descricao", $descricao, PDO::PARAM_STR);
		$stCadastro->bindValue("link_categoria", $link_categoria, PDO::PARAM_STR);
		$cadastro = $stCadastro->execute();

		if($cadastro) {
			$id = Conexao::chamar()->lastInsertId();
			logAcesso("I", $tela, $id);
			echo "<script>alerta('$caminhoTela', 'Registro cadastrado com sucesso', 'success');</script>";
		} else {
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível cadastrar o registro.");
		}
	} else {
		$stCadastro = Conexao::chamar()->prepare("UPDATE $tb_nivel_2 
		                                             SET id_nivel1  = :id_nivel1,
													 	 descricao  = :descricao,
													 	 link       = :link_categoria
												   WHERE id = :id ");
		$stCadastro->bindValue("id_nivel1", $id_nivel1, PDO::PARAM_STR);
		$stCadastro->bindValue("descricao", $descricao, PDO::PARAM_STR);
		$stCadastro->bindValue("link_categoria", $link_categoria, PDO::PARAM_STR);
		$stCadastro->bindValue("id", $id, PDO::PARAM_INT);
		$cadastro = $stCadastro->execute();

		if($cadastro) {
			logAcesso("A", $tela, $id);
			echo "<script>alerta('$caminhoTela', 'Registro alterado com sucesso', 'success');</script>";
		} else {
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível alterar o registro.");
		}
	}
} catch (PDOException $e) {
	echo "<script>console.log('Erro: ".addslashes($e->getMessage())."')</script>";
}