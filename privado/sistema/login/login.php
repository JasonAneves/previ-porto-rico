<?php
session_start();
// $CAMINHO = "http://localhost/PortalCOVID-19/www/sistema/";

$msgSuccess = filter_input(INPUT_POST, 'msg_sucesso');
$msg = filter_input(INPUT_POST, 'msg');
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Fundo de Previdência</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
		<link rel="shortcut icon" href="configuracao/images/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="configuracao/css/login.css">
		<link rel="stylesheet" type="text/css" href="configuracao/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="configuracao/css/font-awesome.min.css">
		<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/alertify.min.js"></script>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/alertify.min.css"/>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.0/build/css/themes/semantic.min.css"/>
		<script type="text/javascript" src="configuracao/js/jquery-1.11.3.min.js"></script>
		<script type="text/javascript" src="configuracao/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="configuracao/js/jquery.ui.touch.js"></script>
		<script type="text/javascript" src="configuracao/js/jquery.validate.js"></script>
		<script type="text/javascript" src="configuracao/js/funcoesLogin.js"></script>
		<style>
			label.error {
				position: absolute;
				top: 33px;
				left: 39px;
			}
			.alertify-notifier .ajs-message.ajs-success {
				color: #fff;
				background: #286090!important;
				text-shadow: none!important;
			}
		</style>
	</head>
	<body style="background-image: url('configuracao/images/background_login.png');">
		<div class="vertical-center">
			<div class="container text-center">
				<div class="row vertical-align">
					<div class="col-xs-12 col-sm-6 col-lg-4 col-sm-offset-3 col-lg-offset-4">
						<?php if($msgSuccess != '') { ?>
						<script>
							$( document ).ready(function() {
							alertify.set('notifier','position', 'top-center');
							var msg = alertify.success('<?= $msgSuccess ?>', 0);
								$('body').one('click', function(){
									msg.dismiss();
								});
							});
						</script>
						<?php } ?>
						<?php if($msg != '') { ?>
							<script>
								$( document ).ready(function() {
								alertify.set('notifier','position', 'top-center');
								var msg = alertify.error('<?= $msg ?>', 0);
									$('body').one('click', function(){
										msg.dismiss();
									});
								});
							</script>
						<?php } ?>
						<div class="panel panel-primary">
							<div class="panel-heading">
								<strong>Seja bem Bem Vindo!</strong>
							</div>
							<div class="panel-body">
								<form name="form_login" id="form_login" action="verifica.php" method="post">
									<div class="row">
										<div class="col-sm-12 col-md-10 col-md-offset-1 ">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-envelope"></i>
													</span> 
													<input class="form-control" placeholder="Email" name="email" type="email" required autofocus>
												</div>
											</div>
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-unlock"></i>
													</span>
													<input class="form-control password" placeholder="Senha" name="senha"  type="password" required>
												</div>
											</div>
											<div class="form-group" >
												<div id="texto"></div>
											</div>
											<div class="form-group">
												<button type="submit" class="btn btn-primary btn-block valida_enviar">Efetuar Login</button>
											</div>
										</div>
									</div>
								</form>
							</div>
							<div class="panel-footer ">
								<a href="http://www.ingadigital.com.br" target="_blank" class="text-danger">www.ingadigital.com.br</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="valor_cidade" id="valor_cidade" value="<?php echo $CAMINHO ?>" />
	</body>
</html>