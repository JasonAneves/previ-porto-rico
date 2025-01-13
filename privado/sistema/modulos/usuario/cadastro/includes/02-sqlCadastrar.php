<?php
try {
	$tela = secure($tela);
	$id_cliente =  $idCliente;
    
	$year = date('Y');
	$month = date('m');
	$day = date('d');
	$dt = new DateTime();
	$dt->setDate($year, $month, $day);
	$dt->add(new DateInterval("P6M"));
	$data_validade = $dt->format('Y/m/d');

	if(empty($id)) {
		if($verifica_email) {
			$stVerificaUsuario = Conexao::chamar()->prepare("SELECT *
															   FROM usuario
															  WHERE email = :verifica_email
																AND id_cliente = :id_cliente
																AND status_registro = :status_registro");
			$stVerificaUsuario->bindValue("verifica_email", $verifica_email, PDO::PARAM_STR);
			$stVerificaUsuario->bindValue("id_cliente", $idCliente, PDO::PARAM_INT);
			$stVerificaUsuario->bindValue("status_registro", 'A', PDO::PARAM_STR);
			$stVerificaUsuario->execute();
			$buscaUsuario = $stVerificaUsuario->fetch(PDO::FETCH_ASSOC);
		}

		if(isset($usuario)) {
			if($senha == $confirma_senha) {
				$stCadastro = Conexao::chamar()->prepare("INSERT INTO usuario 
																  SET id_cliente = :id_cliente,
																	  usuario = :usuario,
																	  email = :email,
																	  senha = :senha,
																	  master = :master,
																	  permissao_log = :permissao_log,
																	  data_validade = :data_validade");
				$stCadastro->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
				$stCadastro->bindValue("usuario", $usuario, PDO::PARAM_STR);
				$stCadastro->bindValue("email", $verifica_email, PDO::PARAM_STR);
				$stCadastro->bindValue("senha",  hashBcriypt($senha), PDO::PARAM_STR);
				$stCadastro->bindValue("master", isset($master) ? 'S' : 'N', PDO::PARAM_STR);
				$stCadastro->bindValue("permissao_log", isset($permissao_log) ? 'S' : 'N', PDO::PARAM_STR);
				$stCadastro->bindValue("data_validade", $data_validade, PDO::PARAM_STR);
				$cadastro = $stCadastro->execute();

				$id = Conexao::chamar()->lastInsertId();

				if(isset($_POST['id_menu'])) {
					$stRemoveMenu = Conexao::chamar()->prepare("DELETE FROM controle_menu_usuario WHERE id_usuario = :id");
					$stRemoveMenu->bindValue("id", $id, PDO::PARAM_INT);
					$stRemoveMenu->execute();

					foreach($_POST['id_menu'] as $indice => $idMenu) {
						$stMenuUsuario = Conexao::chamar()->prepare("INSERT INTO controle_menu_usuario 
																			 SET id_menu = :id_menu,
																				 id_usuario = :id_usuario,
																				 cadastrar = 'S',
																				 excluir = 'S'");
						$stMenuUsuario->bindValue("id_menu", $idMenu, PDO::PARAM_INT);
						$stMenuUsuario->bindValue("id_usuario", $id, PDO::PARAM_INT);
						$stMenuUsuario->execute();
	
						$stMenu2 = Conexao::chamar()->prepare("SELECT * 
																 FROM controle_menu 
																WHERE id_menu = :id_menu 
																  AND status_registro = :status_registro");
						$stMenu2->bindValue("id_menu", $idMenu, PDO::PARAM_INT);
						$stMenu2->bindValue("status_registro", 'A', PDO::PARAM_STR);
						$qryMenu2 = $stMenu2->fetchAll(PDO::FETCH_ASSOC);
	
						if(count($qryMenu2)) {
							foreach ($qryMenu2 as $menu2) {
								$stMenuUsuario2 = Conexao::chamar()->prepare("INSERT INTO controle_menu_usuario 
																					  SET id_menu = :id_menu,
																						  id_usuario = :id_usuario,
																						  cadastrar = 'S',
																						  excluir = 'S'");
								$stMenuUsuario2->bindValue("id_menu", $menu2['id'], PDO::PARAM_INT);
								$stMenuUsuario2->bindValue("id_usuario", $id, PDO::PARAM_INT);
								$stMenuUsuario2->execute();
							}
						}
					}
				}

				if($cadastro) {
					logAcesso("I", $tela, $id);
					echo "<script>alerta('$caminhoTela', 'Registro cadastrado com sucesso', 'success');</script>";
				} else {
					echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível cadastrar o registro.");
				}
			} else {
				echo alerta("danger", "<i class=\"fa fa-ban\"></i> As senhas informadas não são iguais.");
			}
		}
		
	} else {
		if(isset($email)) {
		    
			$verificaSenha = verificaSenhaAtual($senha_atual, $object['senha']);
			if(isset($verificaSenha)) {
				if($senha == $confirma_senha) {
					$stConfEmail = Conexao::chamar()->prepare("SELECT * 
																 FROM usuario 
																WHERE email = :email 
																  AND status_registro = :status_registro
																  AND id_cliente = :id_cliente
																  AND id <> :id");
					$stConfEmail->bindValue("email", $email, PDO::PARAM_STR);
					$stConfEmail->bindValue("status_registro", 'A', PDO::PARAM_STR);
					$stConfEmail->bindValue("id_cliente", $idCliente, PDO::PARAM_INT);
					$stConfEmail->bindValue("id", $id, PDO::PARAM_INT);
					$stConfEmail->execute();
					$confEmail = $stConfEmail->fetch(PDO::FETCH_ASSOC);
					
					if(!empty($confEmail)) {
						echo alerta("danger", "<i class=\"fa fa-ban\"></i> Já existe um usuário com este e-mail!");
					} else {
						$stCadastro = Conexao::chamar()->prepare("UPDATE usuario 
																	 SET usuario = :usuario,
																		 email = :email,
																		 senha = :senha,
																		 master = :master,
																		 permissao_log = :permissao_log,
																		 data_validade = :data_validade
																   WHERE id = :id 
																	 AND id_cliente = :id_cliente");
						$stCadastro->bindValue("usuario", $usuario, PDO::PARAM_STR);
						$stCadastro->bindValue("email", $email, PDO::PARAM_STR);
						$stCadastro->bindValue("senha",  hashBcriypt($senha), PDO::PARAM_STR);
						$stCadastro->bindValue("master", isset($master) ? 'S' : 'N', PDO::PARAM_STR);
						$stCadastro->bindValue("permissao_log", isset($permissao_log) ? 'S' : 'N', PDO::PARAM_STR);
						$stCadastro->bindValue("data_validade", $data_validade, PDO::PARAM_STR);
						$stCadastro->bindValue("id", $id, PDO::PARAM_STR);
						$stCadastro->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
						$cadastro = $stCadastro->execute();

						if(isset($_POST['id_menu'])) {
							$stRemoveMenu = Conexao::chamar()->prepare("DELETE FROM controle_menu_usuario WHERE id_usuario = :id");
							$stRemoveMenu->bindValue("id", $id, PDO::PARAM_INT);
							$stRemoveMenu->execute();
		
							foreach($_POST['id_menu'] as $indice => $idMenu) {
								$stMenuUsuario = Conexao::chamar()->prepare("INSERT INTO controle_menu_usuario 
																					SET id_menu = :id_menu,
																						id_usuario = :id_usuario,
																						cadastrar = 'S',
																						excluir = 'S'");
								$stMenuUsuario->bindValue("id_menu", $idMenu, PDO::PARAM_INT);
								$stMenuUsuario->bindValue("id_usuario", $id, PDO::PARAM_INT);
								$stMenuUsuario->execute();
			
								$stMenu2 = Conexao::chamar()->prepare("SELECT * 
																		FROM controle_menu 
																		WHERE id_menu = :id_menu 
																		AND status_registro = :status_registro");
								$stMenu2->bindValue("id_menu", $idMenu, PDO::PARAM_INT);
								$stMenu2->bindValue("status_registro", 'A', PDO::PARAM_STR);
								$qryMenu2 = $stMenu2->fetchAll(PDO::FETCH_ASSOC);
			
								if(count($qryMenu2)) {
									foreach ($qryMenu2 as $menu2) {
										$stMenuUsuario2 = Conexao::chamar()->prepare("INSERT INTO controle_menu_usuario 
																							SET id_menu = :id_menu,
																								id_usuario = :id_usuario,
																								cadastrar = 'S',
																								excluir = 'S'");
										$stMenuUsuario2->bindValue("id_menu", $menu2['id'], PDO::PARAM_INT);
										$stMenuUsuario2->bindValue("id_usuario", $id, PDO::PARAM_INT);
										$stMenuUsuario2->execute();
									}
								}
							}
						}
		
						if($cadastro) {
							logAcesso("I", $tela, $id);
							echo "<script>alerta('$caminhoTela', 'Registro cadastrado com sucesso', 'success');</script>";
						} else {
							echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível cadastrar o registro.");
						}
					}
				} else {
					echo alerta("danger", "<i class=\"fa fa-ban\"></i> As novas senhas informadas não são iguais.");
				}
			} else {
				echo alerta("danger", "<i class=\"fa fa-ban\"></i> A Senha atual informada não confere!");
			}

		}
		if(isset($_POST['id_menu'])) {
			$stRemoveMenu = Conexao::chamar()->prepare("DELETE FROM controle_menu_usuario WHERE id_usuario = :id");
			$stRemoveMenu->bindValue("id", $id, PDO::PARAM_INT);
			$stRemoveMenu->execute();

			foreach($_POST['id_menu'] as $indice => $idMenu) {
				$stMenuUsuario = Conexao::chamar()->prepare("INSERT INTO controle_menu_usuario 
																	SET id_menu = :id_menu,
																		id_usuario = :id_usuario,
																		cadastrar = 'S',
																		excluir = 'S'");
				$stMenuUsuario->bindValue("id_menu", $idMenu, PDO::PARAM_INT);
				$stMenuUsuario->bindValue("id_usuario", $id, PDO::PARAM_INT);
				$stMenuUsuario->execute();

				$stMenu2 = Conexao::chamar()->prepare("SELECT * 
														FROM controle_menu 
														WHERE id_menu = :id_menu 
														AND status_registro = :status_registro");
				$stMenu2->bindValue("id_menu", $idMenu, PDO::PARAM_INT);
				$stMenu2->bindValue("status_registro", 'A', PDO::PARAM_STR);
				$qryMenu2 = $stMenu2->fetchAll(PDO::FETCH_ASSOC);

				if(count($qryMenu2)) {
					foreach ($qryMenu2 as $menu2) {
						$stMenuUsuario2 = Conexao::chamar()->prepare("INSERT INTO controle_menu_usuario 
																			SET id_menu = :id_menu,
																				id_usuario = :id_usuario,
																				cadastrar = 'S',
																				excluir = 'S'");
						$stMenuUsuario2->bindValue("id_menu", $menu2['id'], PDO::PARAM_INT);
						$stMenuUsuario2->bindValue("id_usuario", $id, PDO::PARAM_INT);
						$stMenuUsuario2->execute();
					}
				}
			}
		}
		if(isset($_POST['id_menu'])) {
			$stRemoveMenu = Conexao::chamar()->prepare("DELETE FROM controle_menu_usuario WHERE id_usuario = :id");
			$stRemoveMenu->bindValue("id", $id, PDO::PARAM_INT);
			$stRemoveMenu->execute();

			foreach($_POST['id_menu'] as $indice => $idMenu) {
				$stMenuUsuario = Conexao::chamar()->prepare("INSERT INTO controle_menu_usuario 
																	SET id_menu = :id_menu,
																		id_usuario = :id_usuario,
																		cadastrar = 'S',
																		excluir = 'S'");
				$stMenuUsuario->bindValue("id_menu", $idMenu, PDO::PARAM_INT);
				$stMenuUsuario->bindValue("id_usuario", $id, PDO::PARAM_INT);
				$stMenuUsuario->execute();

				$stMenu2 = Conexao::chamar()->prepare("SELECT * 
														FROM controle_menu 
														WHERE id_menu = :id_menu 
														AND status_registro = :status_registro");
				$stMenu2->bindValue("id_menu", $idMenu, PDO::PARAM_INT);
				$stMenu2->bindValue("status_registro", 'A', PDO::PARAM_STR);
				$qryMenu2 = $stMenu2->fetchAll(PDO::FETCH_ASSOC);

				if(count($qryMenu2)) {
					foreach ($qryMenu2 as $menu2) {
						$stMenuUsuario2 = Conexao::chamar()->prepare("INSERT INTO controle_menu_usuario 
																			SET id_menu = :id_menu,
																				id_usuario = :id_usuario,
																				cadastrar = 'S',
																				excluir = 'S'");
						$stMenuUsuario2->bindValue("id_menu", $menu2['id'], PDO::PARAM_INT);
						$stMenuUsuario2->bindValue("id_usuario", $id, PDO::PARAM_INT);
						$stMenuUsuario2->execute();
					}
				}
			}
		}
	}
} catch (PDOException $e) {
	echo "<script>console.log('Erro: ".addslashes($e->getMessage())."')</script>";
}