<?php
try {
	$tela       = secure($tela);
	$id_cliente =  $idCliente;

	if(empty($id)) {
		$stCadastro = Conexao::chamar()->prepare("INSERT INTO galeria_foto 
                                                          SET id_cliente = :id_cliente,
                                                              titulo = :titulo,
                                                              linha_fina = :linha_fina,
                                                              data_publicacao = :data_publicacao");
		$stCadastro->bindValue("id_cliente", $idCliente, PDO::PARAM_INT);
		$stCadastro->bindValue("titulo", $titulo, PDO::PARAM_STR);
		$stCadastro->bindValue("linha_fina", $linha_fina, PDO::PARAM_STR);
		$stCadastro->bindValue("data_publicacao", formata_data_banco($data_publicacao), PDO::PARAM_STR);
		$cadastro = $stCadastro->execute();

		if($cadastro) {
            $id         = Conexao::chamar()->lastInsertId();
            $upFoto     = true;
            $upAnexo    = false;
            $upVideo    = false;
            $upLink     = false;
            $upTabela   = "galeria_foto";
            $upRel      = "id_artigo";
            include_once $classes."/includes/upload.php";

            $id = Conexao::chamar()->lastInsertId();
			logAcesso("I", $tela, $id);
			echo "<script>alerta('$caminhoTela', 'Registro cadastrado com sucesso', 'success');</script>";
		} else {
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível cadastrar o registro.");
		}
	} else {
		$stCadastro = Conexao::chamar()->prepare("UPDATE galeria_foto 
		                                             SET titulo = :titulo,
                                                         linha_fina = :linha_fina,
                                                         data_publicacao = :data_publicacao
												   WHERE id = :id
												     AND id_cliente = :id_cliente ");
		$stCadastro->bindValue("id_cliente", $idCliente, PDO::PARAM_INT);
		$stCadastro->bindValue("titulo", $titulo, PDO::PARAM_STR);
        $stCadastro->bindValue("linha_fina", $linha_fina, PDO::PARAM_STR);
        $stCadastro->bindValue("data_publicacao", formata_data_banco($data_publicacao), PDO::PARAM_STR);
		$stCadastro->bindValue("id", $id, PDO::PARAM_INT);
		$cadastro = $stCadastro->execute();

		if($cadastro) {
            $upFoto     = true;
            $upAnexo    = false;
            $upVideo    = false;
            $upLink     = false;
            $upTabela   = "galeria_foto";
            $upRel      = "id_artigo";
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