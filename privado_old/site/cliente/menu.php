<?

if(!$_SESSION['login_valido']) {

	$_SESSION['retorno_login'] = 'cliente';
	echo "<script>window.location='$CAMINHO/login'</script>";
}

?>

<div class="row">
	<div class="container">
		<div class="col-md-12 text-center">
			<div style="margin-bottom: 30px" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<a style="width: 100%" href="<?=$CAMINHO ?>/pedidos" class="btn btn-lg btn-default"><i class="fa fa-outdent pull-left" style="margin-right: 10px"></i>Pedidos</a>
			</div>
			<div style="margin-bottom: 30px" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<a style="width: 100%" href="<?=$CAMINHO ?>/cadastro/<?=$_SESSION['id_cadastro']?>" class="btn btn-lg btn-default"><i class="fa fa-id-card pull-left" style="margin-right: 10px"></i>Cadastro</a>
			</div>
		</div>
	</div>
</div>