<?php
$userEmail = trim(addslashes($_REQUEST['email']));
$userSenha = trim(addslashes($_REQUEST['senha']));

$stAdministrador = Conexao::chamar()->prepare("SELECT *
												 FROM usuario
												WHERE email = :email
												  AND status_registro = :status_registro");
$stAdministrador->execute(array("email" => $userEmail, "status_registro" => "A"));
$buscaAdministrador = $stAdministrador->fetch(PDO::FETCH_ASSOC);

if($buscaAdministrador) {
	if (password_verify($userSenha,  $buscaAdministrador['senha'])) { 
		if(strtotime($buscaAdministrador['data_validade']) >= strtotime(date("Y-m-d"))) {
			setcookie("id_usuario", $buscaAdministrador["id"], time() + 86400, "/");
			setcookie("id_cliente", $buscaAdministrador["id_cliente"], time() + 86400, "/");
			echo "<script>window.location='$publicoSistema/inicio.php?id_cliente=$buscaAdministrador[id_cliente]&time=".time()."'</script>";
		} else {
			echo "<script>window.location='index.php?msg=".urlencode('O prazo de utilização do sistema expirou entre em contato com administrador do sistema.')."'</script>";
		}
	} else {
		echo "<script>window.location='index.php?msg=".urlencode('O Email ou senha não conferem. Por favor tente novamente.')."'</script>";
	}
} else {
	echo "<script>window.location='index.php?msg=".urlencode('O Email ou senha não conferem. Por favor tente novamente.')."'</script>";
}