<?php
try {
	$tela = secure($tela);
	$id_cliente =  $idCliente;
	if(empty($id)) {
		$stCadastro = Conexao::chamar()->prepare("INSERT INTO enquete 
		                                                  SET id_cliente = :id_cliente,
		                                                  	  titulo = :titulo");
		$stCadastro->bindValue("id_cliente", $idCliente, PDO::PARAM_INT);
		$stCadastro->bindValue("titulo", $titulo, PDO::PARAM_STR);
		$cadastro = $stCadastro->execute();
		if($cadastro) {
            $id = Conexao::chamar()->lastInsertId();
            include_once "05-saveEnqueteAlternativas.php";

            logAcesso("A", $tela, $id);
			echo "<script>alerta('$caminhoTela', 'Registro cadastrado com sucesso', 'success');</script>";
		} else {
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível cadastrar o registro.");
		}
	} else {
		$stCadastro = Conexao::chamar()->prepare("UPDATE enquete 
		                                             SET titulo = :titulo
												   WHERE id = :id");
		$stCadastro->bindValue("titulo", $titulo, PDO::PARAM_STR);
		$stCadastro->bindValue("id", $id, PDO::PARAM_INT);
		$cadastro = $stCadastro->execute();

		if($cadastro) {
            include_once "05-saveEnqueteAlternativas.php";
            logAcesso("A", $tela, $id);
			echo "<script>alerta('$caminhoTela', 'Registro alterado com sucesso', 'success');</script>";
		} else {
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível alterar o registro.");
		}
	}
} catch (PDOException $e) {
	echo "<script>console.log('Erro: ".addslashes($e->getMessage())."')</script>";
}