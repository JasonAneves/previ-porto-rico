
<?php

if($_POST['login'] && $_POST['senha']) {

	foreach ($_POST as $campo => $valor) { $$campo = secure($valor);}

	$conf = Conexao::chamar()->prepare(" SELECT id, nome FROM pedido_cadastro WHERE email = :email AND senha = :senha ");
	$conf->bindValue("email", $login, PDO::PARAM_STR);
	$conf->bindValue("senha", hash('sha256', $senha), PDO::PARAM_STR);
	$conf->execute();
//	$conf->fetch();

	if( $conf->rowCount() > 0) {

		$cadastro = $conf->fetch();
		$_SESSION['login_valido'] = true;
		$_SESSION['id_cadastro'] = $cadastro['id'];
		$_SESSION['nome_cadastro'] = $cadastro['nome'];


		
		
		echo "<script>window.location='".$CAMINHO."/".$_SESSION['retorno_login']."'</script>";
		

	} else {

		echo "<script>alert('Login e senha nao conferem! Verifique se os dados foram digitados corretamente.')</script>";
	}

} else if($_POST['esqueci_email'] && $_POST['cpf_cnpj']) {

	foreach ($_POST as $campo => $valor) { $$campo = secure($valor);}


	$stConfSenha = Conexao::chamar()->prepare(" SELECT * FROM pedido_cadastro WHERE email = :esqueci_email AND cpf_cnpj = :cpf_cnpj LIMIT 1 ");
	$stConfSenha->bindValue("esqueci_email", $esqueci_email, PDO::PARAM_STR);
	$stConfSenha->bindValue("cpf_cnpj", $cpf_cnpj, PDO::PARAM_STR);
	$stConfSenha->execute();

	if($stConfSenha->rowCount() > 0) {

		$dadosSenha = $stConfSenha->fetch(PDO::FETCH_ASSOC);

		
		$html = "<div style='width: 100%;padding:10px;border-width: 1px; font-family: 'Trebuchet MS', 'Helvetica Neue', Arial, Sans-Serif; font-size: 14pt; background-color: #99F399;'>
		<p><strong>Recupera&ccedil;&atilde;o de Senha - $configuracao[nome_fantasia]</strong></p>
		<p>$dadosSenha[nome], segue o link abaixo:</p>
		<p><a href='$CAMINHO/recuperar/$dadosSenha[hash]'><strong>Clique aqui para cadastrar nova senha</strong></a></p>
		<p>&nbsp;</p><p>Recomendamos que a senha seja trocada logo no primeiro acesso por seguran&ccedil;a.</p>
		<p>Em caso de d&uacute;vidas e/ou problemas no cadastro ou pagamento, entre em contato conosco atrav&eacute;s do link abaixo:</p>
		<p><a href='$CAMINHO/contato'><strong>Fale Conosco</strong></a></p>
		</div>";

		$headers  = "$configuracao[nome_fantasia] <$configuracao[email]>";
		$to[0]['email'] = $dadosSenha['email'];
		$to[0]['nome'] = "Recuperação de senha";
		$vai = envia_email_aws( $to,  html_entity_decode("Recupera&ccedil;&atilde;o - $configuracao[nome_fantasia] "),  html_entity_decode($html), $headers, [], "cisaamerios.com.br/privado/site/cliente/login.php:60");

		if($vai) {

			echo "<script>alert('Um e-mail foi enviado com o link para recuperacao de senha!. Enviado para:  ".$dadosSenha['email']."')</script>";

		} else {

			echo "<script>alert('Houve um erro no envio do e-mail com sua senha! Tente novamente, se o erro se repetir, entre em contato conosco.')</script>";

		}
	} else {

		echo "<script>alert('Nenhum cadastro encontrado com os dados fornecidos! Verifique se os dados foram digitados corretamente.')</script>";

	}

}
?>
<!--
<div class="row">

	
	<div class="container text-center">

		

		
		<div class="row" id="loga">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Login</b></div>
				<div class="panel-body">
					<div class="col-sm-offset-3 col-md-6" style="padding-top: 30px">
						<form class="form-horizontal" action="" name="login" id="login" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="login" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="email" name="login" id="login" class="form-control" id="inputEmail3" placeholder="Email" autofocus>
								</div>
							</div>
							<div class="form-group">
								<label for="senha" class="col-sm-2 control-label">Password</label>
								<div class="col-sm-10">
									<input type="password" name="senha" id="senha" class="form-control" id="inputPassword3" placeholder="Password">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-success pull-left">Enviar</button>
								</div>
							</div>
							
						</form>
					</div>
				</div>
				<div class="panel-footer" style="min-height: 50px">
					<div class="col-md-12 text-right">
						<a class="btn btn-primary" style="width: 150px" href="<?= $CAMINHO . '/' . 'cadastro' ?>">Cadastre-se</a>
						<a class="btn btn-default" style="width: 150px" href="#" onclick="jQuery('#esqueci_senha').slideToggle();jQuery('#loga').slideToggle();return false">Recuperar Senha</a>
					</div>

				</div>
			</div>

		</div>
		

	</div>

	<div class="row">
		<div class="container">
			<form class="form-horizontal" name="esqueci_senha" id="esqueci_senha" action="" method="post" style="display: none; margin-bottom: 50px;">
				<div class="panel panel-default text-center">
					<div class="panel-heading"><b>Recuperar Senha</b></div>
					<div class="panel-body">
						<div class="col-sm-offset-2 col-md-8 text-center" style="padding-top: 10px">
							<div class="form-group">
								<label class="radio-inline">
									<input type="radio" name="tipo_pessoa" value="F" onclick="tipoPessoa('F')" checked="checked"> Pessoa Física
								</label>
								<label class="radio-inline">
									<input type="radio" name="tipo_pessoa" value="J" onclick="tipoPessoa('J')"> Pessoa Jurídica
								</label>
							</div>

							<p style="clear: both"></p>

							<div class="form-group">
								<label class="sr-only" for="exampleInputEmail3">Email address</label>
								<input type="text" name="cpf_cnpj" id="cpf_cnpj" class="form-control cpf required" placeholder="CPF">
							</div>
							<div class="form-group">
								<label class="sr-only" for="exampleInputPassword3">Password</label>
								<input type="text" name="esqueci_email" class="form-control email required" id="esqueci_email" placeholder="E-mail">
							</div>
							<div class="col-md-12 ">
								<input name="enviar" type="submit" value="Enviar" class="btn btn-primary input_submit pull-left" style="width: 150px" />
								<button onclick="jQuery('#esqueci_senha').hide();jQuery('#loga').slideToggle();return false" class="btn btn-default pull-right" style="width: 150px">Cancelar</button>
							</div>
						</div>
					</div>
				</div>
				
				
			</form>
		</div>
	</div>

</div>
-->
<div class="row">	

	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header" style="padding-top: 5px;padding-bottom: 5px">
	       <a href="<?= $CAMINHO ?>/login">
			    <img class="img-responsive center-img" src="<?=$CAMINHO?>/images/logo.png" style="height: 50px">
			</a>
	    </div>
	    <a href="<?= $CAMINHO ?>" class="btn btn-default pull-right hidden-xs" style="border-color: #3784C3; color: #3784C3;margin-top: 15px; width: 150px">Voltar a Loja</a>
	  </div>
	</nav>

	<div class="row">
		<div class="container">
			<div class="form_wrapper">
			  <div class="form_container">
			    <div class="title_container">
			      <h2 id="texto_login">Login</h2>
			      <h2 id="texto_recuperar" style="display: none;">Recuperar senha</h2>
			    </div>
			    <div class="row clearfix">
			      <div class="col_half last">
			        <form name="login" id="login" method="post" enctype="multipart/form-data">
			          <div class="input_field"><span><i class="fa fa-envelope" aria-hidden="true"></i></span>
			            <input type="email" type="email" name="login" id="login" placeholder="Email" required=""/>
			          </div>
			          <div class="input_field"><span><i class="fa fa-lock" aria-hidden="true"></i></span>
			            <input type="password"  name="senha" id="senha" placeholder="Senha" required=""/>
			          </div>
			          <input class="button" type="submit" value="Enviar"/>
			          <div class="row clearfix bottom_row">
			            <div class="col_half remember_me">
			              <input name="" type="checkbox" value=""/>              Lembrar
			            </div>
			            <div class="col_half forgot_pw">
			            	<a href="" class="text-primary" onclick="jQuery('form#login').hide();jQuery('form#esqueci_senha').show();jQuery('#texto_login').hide();jQuery('#texto_recuperar').show();return false" style=" color: #545454;">
			            		Esqueceu a senha?
			            	</a>
			            </div>
			          </div>
			        </form>
			        <form class="form-horizontal" name="esqueci_senha" id="esqueci_senha" action="" method="post" style="display: none;">
			        	<div class="form-group">
			        		<label class="radio-inline">
								<input type="radio" name="tipo_pessoa" value="F" onclick="tipoPessoa('F')" checked="checked"> Pessoa Física
							</label>
							<label class="radio-inline">
								<input type="radio" name="tipo_pessoa" value="J" onclick="tipoPessoa('J')"> Pessoa Jurídica
							</label>
			          	</div>
						<div class="input_field"><span><i class="fa fa-address-card-o" aria-hidden="true"></i></span>
			            	<input type="text" class="cpf" name="cpf_cnpj" id="cpf_cnpj"  placeholder="CPF" required=""/>
			          	</div>
			          	<div class="input_field"><span><i class="fa fa-envelope" aria-hidden="true"></i></span>
			            	<input type="email" name="esqueci_email"  id="esqueci_email" placeholder="E-mail" required=""/>
			          	</div>	
			          	<input class="button" type="submit" value="Enviar"/>
				        <div class="row clearfix bottom_row">
				            
				            <div class="col_half forgot_pw" style="width: 100%">
				            	<a href="" class="pull-right text-primary" onclick="jQuery('form#esqueci_senha').hide();jQuery('form#login').show();jQuery('#texto_recuperar').hide();jQuery('#texto_login').show();return false">
				            		Voltar
				            	</a>
				            </div>
				        </div>   
										
					</form>
			       </div>
			      <div class="col_half container-flex" style="height: 190px;">
			        <div class="row clearfix create_account">
			          <div><a href="<?= $CAMINHO . '/' . 'cadastro' ?>" class="btn btn-default" style="width: 200px;border-color:#3281C2">Criar conta</a></div>
			        </div>
			      </div>
			    </div>
			  </div>
			</div>
			<p class="credit">Desenvolvido<a href="http://ingadigital.com.br/" target="_blank"> Ingá Digital </a></p>
		</div>
	</div>
</div>
