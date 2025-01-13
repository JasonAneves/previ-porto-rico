<?php
try {
	$tela = secure($tela);

	$stArquivo = Conexao::chamar()->prepare("SELECT ata.*
											            FROM ata
											            WHERE id                = :id
												        AND status_registro     = :status_registro
												        AND id                  = :id");
	$stArquivo->bindValue("id", $id, PDO::PARAM_INT);
	$stArquivo->bindValue("status_registro", 'A', PDO::PARAM_STR);
	$stArquivo->execute();
	$buscaArquivo = $stArquivo->fetch(PDO::FETCH_ASSOC);

	$up = new Uploader('arquivo');
	$up->setDirectory("$caminhoUploadArquivo/$idCliente/");
	$arquivo = $up->uploadFile();
	if ($arquivo == '') {
		$arquivo = $buscaArquivo['arquivo'];
	}

	if(empty($id)) {

		$stCadastro = Conexao::chamar()->prepare("INSERT INTO ata
                                                            SET id_cliente    = :id_cliente,
                                                            id_categoria      = :id_categoria,
                                                            id_subcategoria   = :id_subcategoria,
                                                            descricao         = :descricao,
                                                            arquivo           = :arquivo");
		$stCadastro->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
		$stCadastro->bindValue("id_categoria", $id_categoria, PDO::PARAM_STR);
		$stCadastro->bindValue("id_subcategoria", empty($id_subcategoria) ? null : $id_subcategoria, PDO::PARAM_STR);
		$stCadastro->bindValue("descricao", $descricao, PDO::PARAM_STR);
		$stCadastro->bindValue("arquivo", $arquivo, PDO::PARAM_STR);
		$cadastro = $stCadastro->execute();

		if($cadastro) {
			$id = Conexao::chamar()->lastInsertId();
			logAcesso("I", $tela, $id);
			echo "<script>alerta('$caminhoTela', 'Registro cadastrado com sucesso', 'success');</script>";
		} else {
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível cadastrar o registro.");
		}
	} else {

		$stCadastro = Conexao::chamar()->prepare("UPDATE ata 
                                                            SET id_categoria   = :id_categoria,
                                                            id_subcategoria    = :id_subcategoria,
                                                            descricao          = :descricao,
                                                            arquivo            = :arquivo
                                                            WHERE id           = :id ");
		$stCadastro->bindValue("id_categoria", $id_categoria, PDO::PARAM_STR);
		$stCadastro->bindValue("id_subcategoria", empty($id_subcategoria) ? null : $id_subcategoria, PDO::PARAM_STR);
		$stCadastro->bindValue("descricao", $descricao, PDO::PARAM_STR);
		$stCadastro->bindValue("arquivo", $arquivo, PDO::PARAM_STR);
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