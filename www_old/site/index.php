 <!DOCTYPE html>

 <html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br">

 <head>

 	<?php



		$ppb = "../../";

		include $ppb . "privado/config_cliente.php";
		include $ppb . "privado/site/conexao.php";


		// if( $url[$ii] != ""){
		// 	$compartilhamento = compartilhamento($url[$i], $url[$ii]);
		// 	if($compartilhamento['foto'] != ''){
		// 		$compartilhamento['foto'] = getimagesize($CAMINHOIMG . "/gd_" . $compartilhamento['foto'] ) ? $CAMINHOIMG . "/gd_" . $compartilhamento['foto'] : $CAMINHOIMGCSS . "/sem_foto.jpg";
		//     } else {
		// 		$compartilhamento['foto'] = $CAMINHO."/images/brasao_topo.png";
		// 	}
		// }

		date_default_timezone_set('America/Sao_Paulo');

		setlocale(LC_TIME, "");

		//setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

		$queryConfig = Conexao::chamar()->prepare("SELECT cliente.*, 
													  municipio.nome municipio, 
													  estado.nome estado,
														cliente_configuracao.*
												 FROM cliente 
											LEFT JOIN municipio 
												   ON cliente.id_municipio = municipio.id
	 										LEFT JOIN estado 
											       ON municipio.id_estado = estado.id 
											LEFT JOIN cliente_configuracao
														 ON cliente_configuracao.id_cliente = cliente.id 
												WHERE cliente.id = :cliente 
												  AND cliente.status_registro = :status_registro 
												LIMIT 1");

		$queryConfig->execute(array(":cliente" => $idCliente, ":status_registro" => "A"));

		$config = $queryConfig->fetchAll(PDO::FETCH_ASSOC);

		$configuracao = $config[0];



		?>

 	<?
		if (isset($compartilhamento)) {
		?>

 		<title><?= $compartilhamento['titulo'] ?></title>
 		<meta property="og:image" content="<?= $compartilhamento['foto'] ?>" />
 		<meta property="og:title" content="<?= $compartilhamento['titulo'] ?>" />
 		<meta property="og:description" content="<?= resumo_artigo($compartilhamento['artigo'], 300) ?>" />

 	<?
		} else {
		?>
 		<title>Instituto de Previd&ecirc;ncia</title>
 	<?
		}
		?>

 	<!-- <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> -->
 	<meta charset="utf-8">
 	<meta http-equiv="Content-Language" content="PT-BR" />
 	<meta name="keywords" content="Instituto de Previd&ecirc;ncia" />
 	<meta name="author" content="Ingá Digital Ltda. - www.ingadigital.com.br" />
 	<meta name="URL" content="" />
 	<meta name="language" content="portuguese" />
 	<meta name="revisit-after" content="2 days" />
 	<meta name="document-state" content="Dynamic" />
 	<meta name="document-distribution" content="Global" />
 	<meta name="viewport" content="width=device-width, initial-scale=1">

 	<link rel="preconnect" href="https://fonts.googleapis.com">
 	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 	<link href="https://fonts.googleapis.com/css2?family=Oswald&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
 	<link rel="preconnect" href="https://fonts.gstatic.com">
 	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
 	<link rel="preconnect" href="https://fonts.gstatic.com">
 	<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
 	<link rel="preconnect" href="https://fonts.gstatic.com">
 	<link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Extra+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
 	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600&display=swap" rel="stylesheet">
 	<link rel="preconnect" href="https://fonts.gstatic.com">
 	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
 	<link rel="icon" href="<?= $CAMINHO ?>/assets/images/favicon.png" type="image/x-icon" />

 	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 	<link rel="stylesheet" href="<?= $CAMINHO ?>assets/css/bootstrap-dropdownhover.min.css">
 	<link rel="stylesheet" href="<?= $CAMINHO ?>assets/css/owl.carousel.min.css">
 	<link rel="stylesheet" href="<?= $CAMINHO ?>assets/css/owl.theme.default.min.css">
 	<link rel="stylesheet" type="text/css" href="<?= $CAMINHO; ?>/assets/css/styles.css" />

 	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

 	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.js"></script>
 	<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.2.0/ekko-lightbox.min.css" rel="stylesheet" />

 	<script>
 		function alerta(link, mensagem, tipo) {
 			noty({
 				text: mensagem,
 				type: tipo ? tipo : 'alert',
 				buttons: [{
 					addClass: 'btn btn-primary',
 					text: 'OK',
 					onClick: function($noty) {
 						window.location = link;
 					}
 				}]
 			});
 		}
 	</script>

 </head>

 <body>
 	<header>
 		<?php
			// if($url[$i] == "") { include "paginas/00-pop-up/00-pop-up.php"; } //index
			if ($url[$i] == "") {
				include "paginas/toast-popup/toast-popup.php";
			}

			include "paginas/01-topo/01-topo.php";
			include "paginas/02-logo-busca/02-logo-busca.php";
			include "paginas/03-menu-topo/03-menu-topo.php";
			?>
 	</header>

 	<section>
 		<?php include "{$ppb}privado/site/sequencia.php"; ?>
 	</section>

 	<footer>
	 	<?php include "paginas/09-horario-atendimento/09-horario-atendimento.php"; ?>
 		<?php include "paginas/10-dados-rodape/10-dados-rodape.php"; ?>
 		<?php include "paginas/botoes-rodape-responsivo/botoes.php"; ?>
 	</footer>

 	<script>
 		$(document).on('click', '[data-toggle="lightbox"]', function(event) {
 			event.preventDefault();
 			$(this).ekkoLightbox();
 		});
 	</script>

 	<script src="jquery.min.js"></script>
 	<script type="text/javascript" src="<?= $CAMINHO ?>assets/js/owl.carousel.min.js"></script>

 	<!--Slick Carousel Slider-->
 	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
 	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
 	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

 	<!-- ACESSIBILIDADE -->
 	<script src="<?= $CAMINHO ?>/assets/js/fonte.js"></script>
 	<!-- ACESSIBILIDADE -->
 </body>

 </html>