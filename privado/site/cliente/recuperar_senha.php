
<?
	if($url[5] != ""){
		$hash = secure($url[5]);
		

		$conf = Conexao::chamar()->prepare(" SELECT id, cpf_cnpj FROM pedido_cadastro WHERE hash = :hash  ");
		$conf->bindValue("hash", $hash, PDO::PARAM_STR);
		$conf->execute();

		if( $conf->rowCount() > 0) {

			$cadastro = $conf->fetch();
			

			if($_POST['senha'] && $_POST['conf_senha']) {

				$senha = secure($_POST['senha']);
				$conf_senha = secure($_POST['conf_senha']);

				if($senha == '' || $conf_senha == '') {
					echo "<script>alert('Os dados não foram informados corretamente.')</script>";
				} else if($senha != $conf_senha){
				 	echo "<script>alert('As senhas informadas nao conferem.')</script>";
				} else if(strlen($senha) < 6 ){
				 	echo "<script>alert('A senha deve conter pelo menos 6 caracteres.')</script>";
				} else {

					try {

						$cad = Conexao::chamar()->prepare(" UPDATE pedido_cadastro 

		 												   SET senha = :senha,
		 												       hash  = :hash

		 												       WHERE id = :id_cadastro ");

						$hash = gerarHash($cadastro['cpf_cnpj']);

						$cad->bindValue("senha", hash('sha256', $senha) , PDO::PARAM_STR);
						$cad->bindValue("hash", $hash , PDO::PARAM_STR);
						$cad->bindValue("id_cadastro", $cadastro['id'] , PDO::PARAM_INT);
						$cad->execute();
					
						if($cad) {
							
							echo "<script>alert('Cadastro alterado com sucesso.')</script>";
							echo "<script>window.location='$CAMINHO'</script>";
							
						} else {
							
							echo "<script>alert('Erro ao alterar o cadastro! Tente novamente ou entre em contato conosco.')</script>";
							
						}
						
					} catch (Exception $e) {

						echo "<script>alert('Erro ao alterar o cadastro! Tente novamente ou entre em contato conosco.')</script>";

					}
					
				}
				
			}
			
		}

	}

	


?>

<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <div class="navbar-header" style="padding-top: 5px;padding-bottom: 5px">
	       <a href="">
			    <img class="img-responsive center-img" src="<?=$CAMINHO?>/images/logo.png" style="height: 50px">
			</a>
	    </div>
	    <a href="<?= $CAMINHO ?>" class="btn btn-default pull-right hidden-xs" style="border-color: #3784C3; color: #3784C3;margin-top: 15px; width: 150px">Voltar a Loja</a>
	  </div>
</nav>

<? if( $conf->rowCount() > 0) {?>
<div class="row">
	<div class="container text-center">
		<div class="form_wrapper" >
			  <div class="form_container">
			    <div class="title_container">
			      <h2>Cadastrar senha</h2>
			    </div>
			    <div class="row clearfix">
			      <div class="col_half last" style="width: 100%;border: none;">
			        <form name="recuperar" id="recuperar" method="post" enctype="multipart/form-data">
			          <div class="input_field"><span><i class="fa fa-lock" aria-hidden="true"></i></span>
			            <input type="password"  name="senha" id="senha" placeholder="Senha" required=""/>
			          </div>
			          <div class="input_field"><span><i class="fa fa-lock" aria-hidden="true"></i></span>
			            <input type="password" name="conf_senha" id="conf_senha"  placeholder="Confirma Senha" required/>
			          </div>
			          <input class="button" type="submit" value="Salvar"/>
			        </form>
			       </div>
			    </div>
			 </div>
		</div>
		<p class="credit">Desenvolvido<a href="http://ingadigital.com.br/" target="_blank"> Ingá Digital </a></p>
	</div>
</div>

<? } else { ?>

<div class="row">
	<div class="container">
		<div class="alert alert-danger">
  			<strong>Usuário inexistente!</strong>
		</div>
	</div>
</div>

<? } ?>