<?php
function setDateTime($date, $time) {
    if (empty($date) || ($date === "00/00/0000")) {
        return NULL;
    }
    return formata_data_banco($date).' '.$time;
}

try {
  setDateTime($data_inicial, $hora_inicial);
	$tela = secure($tela);
	$id_cliente =  $idCliente;

	if(empty($id)) {
		$stCadastro = Conexao::chamar()->prepare("INSERT INTO $tabela 
		                                                  SET id_cliente = :id_cliente,
		                                                      titulo = :titulo,
		                                                      artigo = :artigo");
		$stCadastro->bindValue("id_cliente", $idCliente, PDO::PARAM_INT);
		$stCadastro->bindValue("titulo", $titulo, PDO::PARAM_STR);
		$stCadastro->bindValue("artigo", $artigo, PDO::PARAM_STR);
        $cadastro = $stCadastro->execute();

		if($cadastro) {
			$id = Conexao::chamar()->lastInsertId();
			$upFoto = true;
			$upAnexo = true;
			$upVideo = true;
			$upLink = false;
      $upTabela = "$tabela";
      $upRel = "id_artigo";
			include_once $classes."/includes/upload.php";

			logAcesso("I", $tela, $id);
			echo "<script>alerta('$caminhoTela', 'Registro cadastrado com sucesso', 'success');</script>";
		} else {
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível cadastrar o registro.");
		}
	} else {
		$stCadastro = Conexao::chamar()->prepare("UPDATE $tabela 
		                                             SET titulo = :titulo,
		                                                 artigo = :artigo
												   WHERE id = :id
												     AND id_cliente = :id_cliente ");
		$stCadastro->bindValue("id_cliente", $idCliente, PDO::PARAM_INT);
        $stCadastro->bindValue("titulo", $titulo, PDO::PARAM_STR);
        $stCadastro->bindValue("artigo", $artigo, PDO::PARAM_STR);
		$stCadastro->bindValue("id", $id, PDO::PARAM_INT);
		$cadastro = $stCadastro->execute();

		if($cadastro) {
			$upFoto = true;
			$upAnexo = true;
			$upVideo = true;
			$upLink = false;
			$upTabela = "$tabela";
			$upRel = "id_artigo";
			include_once $classes."/includes/upload.php";

			logAcesso("A", $tela, $id);
			echo "<script>alerta('$caminhoTela', 'Registro alterado com sucesso', 'success');</script>";
		} else {
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível alterar o registro.");
		}
	}
} catch (PDOException $e) {
	echo "<script>console.log('Erro: ".addslashes($e->getMessage())."')</script>";
}