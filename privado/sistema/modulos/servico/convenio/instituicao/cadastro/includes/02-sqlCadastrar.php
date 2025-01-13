<?php
try {
	$tela = secure($tela);

	$stArquivo = Conexao::chamar()->prepare("SELECT $tabela.*
											            FROM $tabela
											            WHERE id                = :id
												        AND status_registro     = :status_registro
												        AND id                  = :id");
	$stArquivo->bindValue("id", $id, PDO::PARAM_INT);
	$stArquivo->bindValue("status_registro", 'A', PDO::PARAM_STR);
	$stArquivo->execute();
	$buscaArquivo = $stArquivo->fetch(PDO::FETCH_ASSOC);

	$up = new Uploader('logo');
	$up->setDirectory("$caminhoUploadImagem/$idCliente/");
	$logo = $up->uploadFile();
	if ($logo == '') {
		$logo = $buscaArquivo['logo'];
	}

	if(empty($id)) {

		$stCadastro = Conexao::chamar()->prepare("INSERT INTO $tabela
                                                            SET id_cliente          = :id_cliente,
                                                                id_categoria        = :id_categoria,
                                                                id_municipio        = :id_municipio,
                                                                nome                = :nome,
                                                                endereco            = :endereco,
                                                                complemento         = :complemento,
                                                                bairro              = :bairro,
                                                                cep                 = :cep,
                                                                telefone_fixo       = :telefone_fixo,
                                                                telefone_celular    = :telefone_celular,
                                                                email               = :email,
                                                                site                = :site,
                                                                artigo              = :artigo,
                                                                logo                = :logo");
		$stCadastro->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
		$stCadastro->bindValue("id_categoria", $id_categoria, PDO::PARAM_STR);
		$stCadastro->bindValue("id_municipio", $id_municipio, PDO::PARAM_STR);
        $stCadastro->bindValue("nome", $nome, PDO::PARAM_STR);
        $stCadastro->bindValue("endereco", $endereco, PDO::PARAM_STR);
        $stCadastro->bindValue("complemento", $complemento, PDO::PARAM_STR);
        $stCadastro->bindValue("bairro", $bairro, PDO::PARAM_STR);
        $stCadastro->bindValue("cep", $cep, PDO::PARAM_STR);
        $stCadastro->bindValue("telefone_fixo", $telefone_fixo, PDO::PARAM_STR);
        $stCadastro->bindValue("telefone_celular", $telefone_celular, PDO::PARAM_STR);
        $stCadastro->bindValue("email", $email, PDO::PARAM_STR);
        $stCadastro->bindValue("site", $website, PDO::PARAM_STR);
        $stCadastro->bindValue("artigo", $artigo, PDO::PARAM_STR);
		$stCadastro->bindValue("logo", $logo, PDO::PARAM_STR);
		$cadastro = $stCadastro->execute();

		if($cadastro) {
			$id = Conexao::chamar()->lastInsertId();
			logAcesso("I", $tela, $id);
			echo "<script>alerta('$caminhoTela', 'Registro cadastrado com sucesso', 'success');</script>";
		} else {
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível cadastrar o registro.");
		}
	} else {

		$stCadastro = Conexao::chamar()->prepare("UPDATE $tabela 
                                                            SET id_categoria        = :id_categoria,
                                                                id_municipio        = :id_municipio,
                                                                nome                = :nome,
                                                                endereco            = :endereco,
                                                                complemento         = :complemento,
                                                                bairro              = :bairro,
                                                                cep                 = :cep,
                                                                telefone_fixo       = :telefone_fixo,
                                                                telefone_celular    = :telefone_celular,
                                                                email               = :email,
                                                                site                = :site,
                                                                artigo              = :artigo,
                                                                logo                = :logo
                                                            WHERE id = :id ");
        $stCadastro->bindValue("id_categoria", $id_categoria, PDO::PARAM_STR);
        $stCadastro->bindValue("id_municipio", $id_municipio, PDO::PARAM_STR);
        $stCadastro->bindValue("nome", $nome, PDO::PARAM_STR);
        $stCadastro->bindValue("endereco", $endereco, PDO::PARAM_STR);
        $stCadastro->bindValue("complemento", $complemento, PDO::PARAM_STR);
        $stCadastro->bindValue("bairro", $bairro, PDO::PARAM_STR);
        $stCadastro->bindValue("cep", $cep, PDO::PARAM_STR);
        $stCadastro->bindValue("telefone_fixo", $telefone_fixo, PDO::PARAM_STR);
        $stCadastro->bindValue("telefone_celular", $telefone_celular, PDO::PARAM_STR);
        $stCadastro->bindValue("email", $email, PDO::PARAM_STR);
        $stCadastro->bindValue("site", $website, PDO::PARAM_STR);
        $stCadastro->bindValue("artigo", $artigo, PDO::PARAM_STR);
        $stCadastro->bindValue("logo", $logo, PDO::PARAM_STR);
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