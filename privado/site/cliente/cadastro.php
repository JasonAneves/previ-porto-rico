<?php

if(is_numeric($_SESSION['id_cadastro'])) {
	
	$id_cadastro = $url[5];

	$stBuscaCadastro = Conexao::chamar()->prepare("SELECT pedido_cadastro.*, m1.id_estado, m2.id_estado id_estado_entrega 
													  FROM pedido_cadastro 
												 LEFT JOIN municipio m1 ON pedido_cadastro.id_municipio = m1.id 
												 LEFT JOIN municipio m2 ON pedido_cadastro.id_municipio_entrega = m2.id 
													 WHERE pedido_cadastro.id = :id_cadastro ");
	$stBuscaCadastro->bindValue(':id_cadastro', $id_cadastro, PDO::PARAM_INT );
	$stBuscaCadastro->execute();
	$buscaCadastro = $stBuscaCadastro->fetch();
}

if($_POST['acao']== "cadastrar") {

	foreach ($_POST as $campo => $valor) { $$campo = secure($valor); }

	if(empty($id_cadastro)) {
	
		$confEmail	= Conexao::chamar()->query("SELECT * FROM pedido_cadastro WHERE email = '$email'")->fetchAll(PDO::FETCH_ASSOC);
		$confCpf	= Conexao::chamar()->query("SELECT * FROM pedido_cadastro WHERE cpf_cnpj = '$cpf_cnpj' AND tipo = 'F'")->fetchAll(PDO::FETCH_ASSOC);
		$confCnpj	= Conexao::chamar()->query("SELECT * FROM pedido_cadastro WHERE cpf_cnpj = '$cpf_cnpj' AND tipo = 'J'")->fetchAll(PDO::FETCH_ASSOC);

		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) echo "<script>alert('Forneca um e-mail valido.')</script>";
		else if($tipo == "F" && !validaCPF($cpf_cnpj)) echo "<script>alert('O CPF informado nao e valido.')</script>";
		else if($tipo == "J" && !validaCNPJ($cpf_cnpj)) echo "<script>alert('O CNPJ informado nao e valido.')</script>";
		else if(count($confEmail) > 0) echo "<script>alert('Ja existe um cadastro com o e-mail informado. Digite ele e sua senha previamente cadastrada.')</script>";
		else if($tipo == "F" && mysql_num_rows($confCpf) > 0) echo "<script>alert('Ja existe um cadastro com o CPF informado. Digite seu e-mail e senha previamente cadastrados.')</script>";
		else if($tipo == "J" && mysql_num_rows($confCnpj) > 0) echo "<script>alert('Ja existe um cadastro com o CNPJ informado. Digite seu e-mail e senha previamente cadastrados.')</script>";
		else if($senha != $conf_senha) echo "<script>alert('As senhas informadas nao conferem.')</script>";
		else {
	

		$stCad = Conexao::chamar()->prepare("INSERT INTO pedido_cadastro 
												   SET tipo = :tipo_pessoa,
													   data_cadastro = NOW(),
													   nome = :nome,
													   email = :email,
													   cpf_cnpj = :cpf_cnpj,
													   hash = :hash,
													   ie = :ie, 
													   telefone = :telefone, 
													   telefone_celular = :telefone_celular, 
													   telefone_outro = :telefone_outro,
													   cep = :cep, 
													   endereco = :endereco, 
													   numero = :numero, 
													   bairro = :bairro, 
													   complemento = :complemento, 
													   id_municipio	= :id_municipio, 
													   cep_entrega = :cep_entrega, 
													   endereco_entrega = :endereco_entrega, 
													   numero_entrega = :numero_entrega, 
													   bairro_entrega = :bairro_entrega, 
													   complemento_entrega = :complemento_entrega, 
													   id_municipio_entrega = :id_municipio_entrega, 
													   senha = :senha  ");

			$hash = gerarHash($cpf_cnpj);

			$stCad->bindValue('tipo_pessoa', $tipo_pessoa, PDO::PARAM_STR);
			$stCad->bindValue('nome', $nome, PDO::PARAM_STR);
			$stCad->bindValue('email', $email, PDO::PARAM_STR);
			$stCad->bindValue('cpf_cnpj', $cpf_cnpj, PDO::PARAM_STR);
			$stCad->bindValue('hash', $hash, PDO::PARAM_STR);
			$stCad->bindValue('ie', $ie, PDO::PARAM_STR);
			$stCad->bindValue('telefone', $telefone, PDO::PARAM_STR);
			$stCad->bindValue('telefone_celular', $telefone_celular, PDO::PARAM_STR);
			$stCad->bindValue('telefone_outro', $telefone_outro, PDO::PARAM_STR);
			$stCad->bindValue('cep', $cep, PDO::PARAM_STR);
			$stCad->bindValue('endereco', $endereco, PDO::PARAM_STR);
			$stCad->bindValue('numero', $numero, PDO::PARAM_STR);
			$stCad->bindValue('bairro', $bairro, PDO::PARAM_STR);
			$stCad->bindValue('complemento', $complemento, PDO::PARAM_STR);
			$stCad->bindValue('id_municipio', $id_municipio, PDO::PARAM_INT);
			$stCad->bindValue('cep_entrega', $cep_entrega, PDO::PARAM_STR);
			$stCad->bindValue('endereco_entrega', $endereco_entrega, PDO::PARAM_STR);
			$stCad->bindValue('numero_entrega', $numero_entrega, PDO::PARAM_STR);
			$stCad->bindValue('bairro_entrega', $bairro_entrega, PDO::PARAM_STR);
			$stCad->bindValue('complemento_entrega', $complemento_entrega, PDO::PARAM_STR);
			$stCad->bindValue('id_municipio_entrega', $id_municipio_entrega, PDO::PARAM_INT);
			$stCad->bindValue('senha', hash('sha256', $senha), PDO::PARAM_STR);
			$cad = $stCad->execute();


			
			if($cad) {
				
				$html = "<div style='width: 100%;padding:10px; font-family: 'Trebuchet MS', 'Helvetica Neue', Arial, Sans-Serif; font-size: 14pt; background-color: #99F399;'>
				<p><strong>Novo Cadastro - $configuracao[nome_fantasia]</strong></p>
				<p>$nome, obrigado por se cadastrar em nosso site. Sempre que precisar, utilize o login e senha abaixo:</p>
				<p><strong style='font-size: 13pt;'>Login: $email</strong></p>
				<p>&nbsp;</p><p>Em caso de d&uacute;vidas e/ou problemas no cadastro ou pagamento, entre em contato conosco atrav&eacute;s do link abaixo:</p>
				<p><a href='$CAMINHO/contato'><strong>Fale Conosco</strong></a></p>
				</div>";
				
				$headers  = "$configuracao[nome_fantasia] <$configuracao[email]>";
				$to[0]['email'] = $email;
				$to[0]['nome'] = "Cliente";

				$vai = envia_email_aws($to, html_entity_decode("Novo Cadastro - $configuracao[nome_fantasia] "),  html_entity_decode($html), $headers, [], "cisaamerios.com.br/privado/site/cliente/cadastro.php:104");
				
				$_SESSION['login_valido'] = false;

				$_SESSION['id_cadastro'] = mysql_insert_id();
				$_SESSION['nome_cadastro'] = '';
				echo "<script>window.location='$CAMINHO/login'</script>";
				
			} else
				echo "<script>alert('Erro ao efetuar o cadastro! Tente novamente ou entre em contato conosco.')</script>";
		}
	
	} else {
		
//		$confEmail = mysql_query("SELECT * FROM pedido_cadastro WHERE email = '$email' AND id <> '$id_cadastro'");
//		$confCpf = mysql_query("SELECT * FROM pedido_cadastro WHERE cpf = '$cpf_cnpj' AND id <> '$id_cadastro'");
//		$confCnpj = mysql_query("SELECT * FROM pedido_cadastro WHERE cnpj = '$cpf_cnpj' AND id <> '$id_cadastro'");

		$confEmail	= Conexao::chamar()->query(" SELECT * FROM pedido_cadastro WHERE email = '$email' AND id <> '$id_cadastro' ")->fetchAll(PDO::FETCH_ASSOC);
		$confCpf	= Conexao::chamar()->query("SELECT * FROM pedido_cadastro WHERE tipo = 'F' AND cpf_cnpj = '$cpf_cnpj' AND id <> '$id_cadastro'")->fetch(PDO::FETCH_ASSOC);
		$confCnpj	= Conexao::chamar()->query("SELECT * FROM pedido_cadastro WHERE tipo = 'J' AND cpf_cnpj = '$cpf_cnpj' AND id <> '$id_cadastro'")->fetch(PDO::FETCH_ASSOC);
		
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) echo "<script>alert('Forneca um e-mail valido.')</script>";
		else if($tipo == "F" && !validaCPF($cpf_cnpj)) echo "<script>alert('O CPF informado nao e valido.')</script>";
		else if($tipo == "J" && !validaCNPJ($cpf_cnpj)) echo "<script>alert('O CNPJ informado nao e valido.')</script>";
		else if( count($confEmail) > 0 ) echo "<script>alert('Ja existe um cadastro com o e-mail informado. Digite ele e sua senha previamente cadastrada.')</script>";
//		else if(mysql_num_rows($confEmail) > 0) echo "<script>alert('Ja existe um cadastro com o e-mail informado. Digite ele e sua senha previamente cadastrada.')</script>";
		else if($tipo == "F" && mysql_num_rows($confCpf) > 0) echo "<script>alert('Ja existe um cadastro com o CPF informado. Digite seu e-mail e senha previamente cadastrados.')</script>";
		else if($tipo == "J" && mysql_num_rows($confCnpj) > 0) echo "<script>alert('Ja existe um cadastro com o CNPJ informado. Digite seu e-mail e senha previamente cadastrados.')</script>";
		else {
			
			$cad = Conexao::chamar()->prepare(" UPDATE pedido_cadastro 
 												   SET tipo = :tipo_pessoa,
 												       nome = :nome,
 												       email = :email,
 												       cpf_cnpj = :cpf_cnpj,
 												       ie = :ie,
 												       telefone = :telefone,
 												       telefone_celular = :telefone_celular,
 												       telefone_outro = :telefone_outro,
 												       cep = :cep,
 												       endereco = :endereco,
 												       numero = :numero,
 												       bairro = :bairro,
 												       complemento = :complemento,
 												       id_municipio = :id_municipio,
 												       cep_entrega = :cep_entrega,
 												       endereco_entrega = :endereco_entrega,
 												       numero_entrega = :numero_entrega,
 												       bairro_entrega = :bairro_entrega,
 												       complemento_entrega = :complemento_entrega,
 												       id_municipio_entrega = :id_municipio_entrega
 												       WHERE id = :id_cadastro ");

			$cad->bindValue("tipo_pessoa", $tipo_pessoa, PDO::PARAM_STR);
			$cad->bindValue("nome", $nome, PDO::PARAM_STR);
			$cad->bindValue("email", $email, PDO::PARAM_STR);
			$cad->bindValue("cpf_cnpj", $cpf_cnpj, PDO::PARAM_STR);
			$cad->bindValue("ie", $ie, PDO::PARAM_STR);
			$cad->bindValue("telefone", $telefone, PDO::PARAM_STR);
			$cad->bindValue("telefone_celular", $telefone_celular, PDO::PARAM_STR);
			$cad->bindValue("telefone_outro", $telefone_outro, PDO::PARAM_STR);
			$cad->bindValue("cep", $cep, PDO::PARAM_STR);
			$cad->bindValue("endereco", $endereco, PDO::PARAM_STR);
			$cad->bindValue("numero", $numero, PDO::PARAM_STR);
			$cad->bindValue("bairro", $bairro, PDO::PARAM_STR);
			$cad->bindValue("complemento", $complemento, PDO::PARAM_STR);
			$cad->bindValue("id_municipio", $buscaCadastro['id_municipio'], PDO::PARAM_INT);
			$cad->bindValue("cep_entrega", $cep_entrega, PDO::PARAM_STR);
			$cad->bindValue("endereco_entrega", $endereco_entrega, PDO::PARAM_STR);
			$cad->bindValue("numero_entrega", $numero_entrega, PDO::PARAM_STR);
			$cad->bindValue("bairro_entrega", $bairro_entrega, PDO::PARAM_STR);
			$cad->bindValue("complemento_entrega", $complemento_entrega, PDO::PARAM_STR);
			$cad->bindValue("id_municipio_entrega", $buscaCadastro['id_municipio_entrega'], PDO::PARAM_INT);
			$cad->bindValue("id_cadastro", $id_cadastro, PDO::PARAM_INT);
			$cad->execute();
			
			if($cad) {
				
				echo "<script>alert('Cadastro alterado com sucesso.')</script>";
				echo "<script>window.location='$CAMINHO/cadastro'</script>";
				
			} else {
				
				echo "<script>alert('Erro ao alterar o cadastro! Tente novamente ou entre em contato conosco.')</script>";
				
			}
		}
	} 
}
?>
<div class="row">
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header" style="padding-top: 5px;padding-bottom: 5px">
	       <a href="<?= $CAMINHO ?>/cadastro">
			    <img class="img-responsive center-img" src="<?=$CAMINHO?>/images/logo.png" style="height: 50px">
			</a>
	    </div>
	    <a href="<?= $CAMINHO ?>" class="btn btn-default pull-right hidden-xs" style="border-color: #3784C3; color: #3784C3;margin-top: 15px; width: 150px">Voltar a Loja</a>
	  </div>
	</nav>
</div>


<div class="row">
<div class="container">
	
	<div class="col-md-12 text-center">
		<? if ($id_cadastro) {	?>
		<a href="<?=$CAMINHO?>/cliente" class="btn btn-primary pull-right" style="margin-bottom: 15px">Voltar</a>
		<? } ?>
		<h2><?=$id_cadastro ? "ALTERAR CADASTRO" : "CADASTRE-SE" ?></h2>
	</div>

	

	<form class="form-horizontal" action="" name="cadastro" id="cadastro" method="post">

		<p><strong>Dados Pessoais</strong></p>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-8">
				<label class="radio">
					<input type="radio" name="tipo_pessoa" value="F" checked onclick="tipoPessoa('F')" <? if($buscaCadastro['tipo'] == "F") echo "checked"; ?> >Pessoa F&iacute;sica
				</label>
				<label class="radio">
					<input type="radio" name="tipo_pessoa" value="J" onclick="tipoPessoa('J')" <? if($buscaCadastro['tipo'] == "J") ?> >Pessoa Jur&iacute;dica
				</label>
			</div>
		</div>

		<div class="form-group">
			<label for="nome" class="col-sm-2 control-label">Nome</label>
			<div class="col-sm-8">
				<input type="text" name="nome" id="nome" class="form-control required" value="<?=$buscaCadastro['nome'] ?>" placeholder="Nome" required>
			</div>
		</div>

		<div class="form-group">
			<label for="email" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-8">
				<input type="email" name="email" id="email" class="form-control required email" value="<?=$buscaCadastro['email'] ?>" placeholder="E-mail" required>
			</div>
		</div>

		<div class="form-group">
			<label for="cpf_cnpj" class="col-sm-2 control-label">CPF / CNJP</label>
			<div class="col-sm-8">
				<input type="text" name="cpf_cnpj" id="cpf_cnpj" class="form-control cpf required" value="<?=$buscaCadastro['cpf_cnpj'] ?>" placeholder="CPF" required>
			</div>
		</div>

		<div class="form-group">
<!--			<label for="ie" class="col-sm-2 control-label" style="display: none;">Inscri&ccedil;&atilde;o Estadual</label>-->
			<div class="col-sm-8 col-xs-8 col-md-offset-2">
				<input type="text" name="ie" id="ie" class="form-control" style="display: none;" value="<?=$buscaCadastro['ie'] ?>" placeholder="Inscri&ccedil;&atilde;o Estadual" >
			</div>
		</div>

		<hr>

		<div class="form-group">
			<label for="telefone" class="col-sm-2 control-label">Telefone</label>
			<div class="col-sm-8">
				<input type="text" name="telefone" id="telefone" class="form-control telefone required" value="<?=$buscaCadastro['telefone'] ?>" placeholder="Telefone" >
			</div>
		</div>

		<div class="form-group">
			<label for="telefone_celular" class="col-sm-2 control-label">Celular</label>
			<div class="col-sm-8">
				<input type="text" name="telefone_celular" id="telefone_celular" class="form-control telefone" value="<?=$buscaCadastro['telefone_celular'] ?>" placeholder="Celular" required>
			</div>
		</div>

		<div class="form-group">
			<label for="telefone_outro" class="col-sm-2 control-label">Outro Telefone</label>
			<div class="col-sm-8">
				<input type="text" name="telefone_outro" id="telefone_outro" class="form-control telefone" value="<?=$buscaCadastro['telefone_outro'] ?>" placeholder="Outro Telefone" >
			</div>
		</div>

		<?php
		if (!$id_cadastro) {
			?>
			<div class="form-group">
				<label for="senha" class="col-sm-2 control-label">Senha</label>
				<div class="col-sm-8">
					<input type="password" name="senha" id="senha" class="form-control required" placeholder="Senha" required >
				</div>
			</div>

			<div class="form-group">
				<label for="conf_senha" class="col-sm-2 control-label">Confirma a Senha</label>
				<div class="col-sm-8">
					<input type="password" name="conf_senha" id="conf_senha" class="form-control form-control" placeholder="Confirma senha" required>
				</div>
			</div>
			<?
		}
		else {
			?>
			<div class="form-group">
				<label for="conf_senha" class="col-sm-2 control-label"></label>
				<div class="col-sm-8">
					Deseja alterar sua senha? <a href="<?=$CAMINHO ?>/alterar-senha">Clique aqui</a>.</strong>
				</div>
			</div>
			<?
		}
		?>

		<hr>

		<p><strong>Endereço de Cobran&ccedil;a</strong></p>

		<div class="form-group">
			<label for="cep" class="col-sm-2 control-label">CEP</label>
			<div class="col-sm-3">
				<input type="text" name="cep" id="cep" class="form-control cep required" value="<?=$buscaCadastro['cep'] ?>" placeholder="CEP" onchange="buscaCEP()" required>
			</div>
			<div class="col-sm-3">
				<img src="<?=$CAMINHO ?>/css/images/loader.gif" id="load_cep" style="vertical-align: middle; margin-left: 10px; display: none;" />
			</div>
		</div>

		<div class="form-group">
			<label for="endereco" class="col-sm-2 control-label">Endere&ccedil;o</label>
			<div class="col-sm-6">
				<input type="text" name="endereco" id="endereco" class="form-control required" value="<?=$buscaCadastro['endereco'] ?>" placeholder="Endere&ccedil;o" required>
			</div>
			<div class="col-sm-2">
				<input type="text" name="numero" id="numero" class="form-control required" value="<?=$buscaCadastro['numero'] ?>" placeholder="N&ordm;" required>
			</div>
		</div>

		<div class="form-group">
			<label for="bairro" class="col-sm-2 control-label">Bairro</label>
			<div class="col-sm-8">
				<input type="text" name="bairro" id="bairro" class="form-control require" value="<?=$buscaCadastro['bairro'] ?>" placeholder="Bairro" required>
			</div>
		</div>

		<div class="form-group">
			<label for="complemento" class="col-sm-2 control-label">Complemento</label>
			<div class="col-sm-8">
				<input type="text" name="complemento" id="complemento" class="form-control" value="<?=$buscaCadastro['complemento'] ?>" placeholder="Complemento" >
			</div>
		</div>

		<div class="form-group">
			<label for="id_estado" class="col-sm-2 col-xs-2 control-label">Estado</label>
			<div class="col-sm-8">
				<select name="id_estado" id="id_estado" class="form-control required col-sm-8" onchange="buscaMunicipio()">
					<option value="">>> Selecione o estado</option>
					<?php
					$uf = Conexao::chamar()->query("SELECT * FROM estado WHERE status_registro = 'A' ORDER BY nome");
					foreach ($uf->fetchAll(PDO::FETCH_ASSOC) as $estado)
					{
						 echo "<option value='$estado[id]'";
						if($buscaCadastro['id_estado'] == $estado['id']) echo " selected"; echo ">$estado[nome]</option>";
					}
					?>
				</select>
			</div>
		</div>


		<div class="form-group">
			<label for="id_municipio" class="col-sm-2 col-xs-2 control-label">Munic&iacute;pio</label>
			<div class="col-sm-8">
				<select name="id_municipio" id="id_municipio" class="form-control required">
					<option value="">>> Munic&iacute;pio</option>
					<?php
					if($id_cadastro)
					{
						$cidades = Conexao::chamar()->prepare("SELECT * FROM municipio WHERE id_estado = :id_estado AND status_registro = 'A' ORDER BY nome");
						$cidades->bindValue(":id_estado", $buscaCadastro[id_estado], PDO::PARAM_INT);
						$cidades->execute();

						foreach ($cidades->fetchAll(PDO::FETCH_ASSOC) as $municipio)
						{
							echo "<option value='$municipio[id]'";
							if($buscaCadastro[id_municipio] == $municipio[id]) echo " selected";
							echo ">$municipio[nome]</option>";
						}
					}
					?>
				</select>
			</div>
		</div>

		<hr>

		<p><strong>Endere&ccedil;o de Entrega</strong></p>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="repetir_endereco" id="repetir_endereco" style="vertical-align: middle;" onchange="repetirEndereco()"> <strong>Usar o mesmo endere&ccedil;o de cobran&ccedil;a para a entrega</strong>
					</label>
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="cep_entrega" class="col-sm-2 control-label">CEP</label>
			<div class="col-sm-3">
				<input type="text" name="cep_entrega" id="cep_entrega" class="form-control cep required" value="<?=$buscaCadastro['cep_entrega'] ?>" placeholder="CEP" onchange="buscaCEPEntrega()">
			</div>
			<div class="col-sm-3">
				<img src="<?=$CAMINHO ?>/css/images/loader.gif" id="load_cep_entrega" style="vertical-align: middle; margin-left: 10px; display: none;" />
			</div>
		</div>

		<div class="form-group">
			<label for="endereco_entrega" class="col-sm-2 control-label">Endere&ccedil;o</label>
			<div class="col-sm-6">
				<input type="text" name="endereco_entrega" id="endereco_entrega" class="form-control required" value="<?=$buscaCadastro['endereco_entrega'] ?>" placeholder="Endere&ccedil;o" >
			</div>
			<div class="col-sm-2">
				<input type="text" name="numero_entrega" id="numero_entrega" class="form-control required" value="<?=$buscaCadastro['numero_entrega'] ?>" placeholder="N&ordm;" >
			</div>
		</div>

		<div class="form-group">
			<label for="bairro_entrega" class="col-sm-2 control-label">Bairro</label>
			<div class="col-sm-8">
				<input type="text" name="bairro_entrega" id="bairro_entrega" class="form-control require" value="<?=$buscaCadastro['bairro_entrega'] ?>" placeholder="Bairro" >
			</div>
		</div>

		<div class="form-group">
			<label for="complemento_entrega" class="col-sm-2 control-label">Complemento</label>
			<div class="col-sm-8">
				<input type="text" name="complemento_entrega" id="complemento_entrega" class="form-control" value="<?=$buscaCadastro['complemento_entrega'] ?>" placeholder="Complemento" >
			</div>
		</div>

		<div class="form-group">
			<label for="id_estado_entrega" class="col-sm-2 col-xs-2 control-label">Estado</label>
			<div class="col-sm-8">
				<select name="id_estado_entrega" id="id_estado_entrega" class="form-control required col-sm-8" onchange="buscaMunicipioEntrega()">
					<option value="">>> Selecione o estado</option>
					<?php
					$uf = Conexao::chamar()->query("SELECT * FROM estado WHERE status_registro = 'A' ORDER BY nome");
					foreach ($uf->fetchAll(PDO::FETCH_ASSOC) as $estado)
					{
						echo "<option value='$estado[id]'";
						if($buscaCadastro['id_estado'] == $estado['id']) echo " selected";
						echo ">$estado[nome]</option>";
					}
					?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="id_municipio_entrega" class="col-sm-2 col-xs-2 control-label">Munic&iacute;pio</label>
			<div class="col-sm-8">
				<select name="id_municipio_entrega" id="id_municipio_entrega" class="form-control required">
					<option value="">>> Munic&iacute;pio</option>
					<?php
					if($id_cadastro)
					{
						$cidades = Conexao::chamar()->prepare("SELECT * FROM municipio WHERE id_estado = :id_estado AND status_registro = 'A' ORDER BY nome");
						$cidades->bindValue(":id_estado", $buscaCadastro[id_estado_entrega], PDO::PARAM_INT);
						$cidades->execute();

						foreach ($cidades->fetchAll(PDO::FETCH_ASSOC) as $municipio)
						{
							echo "<option value='$municipio[id]'";
							if($buscaCadastro[id_municipio_entrega] == $municipio[id]) echo " selected";
							echo ">$municipio[nome]</option>";
						}
					}
					?>
				</select>
			</div>
		</div>


		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
<!--				<button type="submit" class="btn btn-default">Sign in</button>-->
				<input type="hidden" name="acao" value="cadastrar" />
				<input type="submit" name="enviar" value="Enviar" class="btn btn-primary" />
			</div>
		</div>

	</form>

	<?php
	if($buscaCadastro['tipo'] == "J")
	{
		?><script>tipoPessoa('J');</script><?php
	}
	?>

</div>

</div>