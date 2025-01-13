<?php
try {
	$tela = secure($tela);

	$stArquivo = Conexao::chamar()->prepare("SELECT foto
											   FROM popup
											  WHERE id = :id
												AND status_registro = :status_registro
												AND id = :id");
	$stArquivo->bindValue("id", $id, PDO::PARAM_INT);
	$stArquivo->bindValue("status_registro", 'A', PDO::PARAM_STR);
	$stArquivo->execute();
	$buscaArquivo = $stArquivo->fetch(PDO::FETCH_ASSOC);

	$up = new Uploader('foto');
	$up->setDirectory("$caminhoUploadImagem/$idCliente/");
	$foto = $up->uploadFile();
	if ($foto == '') {
		$foto = $buscaArquivo['foto'];
	}

	if(empty($id)) {
		$stCadastro = Conexao::chamar()->prepare("INSERT INTO popup 
		                                                  SET id_cliente = :id_cliente,
		                                                      titulo = :titulo,
															  url = :link_popup,
		                                                      data_inicial = :data_inicial,
		                                                      hora_inicial = :hora_inicial,
															  data_limite = :data_limite,	
		                                                      hora_limite = :hora_limite,
															  foto = :foto");
		$stCadastro->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
		$stCadastro->bindValue("titulo", $titulo, PDO::PARAM_STR);
		$stCadastro->bindValue("link_popup", $link_popup, PDO::PARAM_STR);
		$stCadastro->bindValue("data_inicial", formata_data_banco($data_inicial), PDO::PARAM_STR);
		$stCadastro->bindValue("hora_inicial", $hora_inicial, PDO::PARAM_STR);
		$stCadastro->bindValue("data_limite", formata_data_banco($data_limite), PDO::PARAM_STR);
		$stCadastro->bindValue("hora_limite", validaHoraPelaDataLimite($data_limite, $hora_limite), PDO::PARAM_STR);
		$stCadastro->bindValue("foto", $foto, PDO::PARAM_STR);
		$cadastro = $stCadastro->execute();

		if($cadastro) {
			logAcesso("A", $tela, $id);
			echo "<script>alerta('$caminhoTela', 'Registro cadastrado com sucesso', 'success');</script>";
		} else {
			echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível cadastrar o registro.");
		}
	} else {
		$stCadastro = Conexao::chamar()->prepare("UPDATE popup 
		                                             SET titulo = :titulo,
													  	 url = :link_popup,
														 data_inicial = :data_inicial,
														 hora_inicial = :hora_inicial,
														 data_limite = :data_limite,
														 hora_limite = :hora_limite,
														 foto = :foto	
												   WHERE id = :id");
												   
		$stCadastro->bindValue("titulo", $titulo, PDO::PARAM_STR);
		$stCadastro->bindValue("link_popup", $link_popup, PDO::PARAM_STR);
		$stCadastro->bindValue("data_inicial", formata_data_banco($data_inicial), PDO::PARAM_STR);
		$stCadastro->bindValue("hora_inicial", $hora_inicial, PDO::PARAM_STR);
		$stCadastro->bindValue("data_limite", formata_data_banco($data_limite), PDO::PARAM_STR);
		$stCadastro->bindValue("hora_limite", validaHoraPelaDataLimite($data_limite, $hora_limite), PDO::PARAM_STR);
		$stCadastro->bindValue("foto", $foto, PDO::PARAM_STR);
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