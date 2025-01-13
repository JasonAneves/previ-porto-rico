<?php
$idUsuario = $_COOKIE['id_usuario'];
$idMenu = secure($tela);
$servico = filter_input(INPUT_GET, 'servico');
$modulo = filter_input(INPUT_GET, 'modulo');

function nomeMenus($idMenu, $array) {
	$stNome = Conexao::chamar()->prepare("SELECT descricao, 
												 id_menu 
											FROM controle_menu 
										   WHERE id = :id_menu 
										     AND status_registro = :status_registro");
	$stNome->execute(array("id_menu" => $idMenu, "status_registro" => "A"));
	$nome = $stNome->fetch(PDO::FETCH_ASSOC);

	array_push($array, $nome['descricao']);

	if(!empty($nome['id_menu']))
		return nomeMenus($nome['id_menu'], $array);
	return $array;
}

if(empty($tela)) {
	include "..".DS."..".DS."..".DS."privado".DS."sistema".DS."home.php";
} else if($tela == "troca_sistema") {
    include "..".DS."..".DS."..".DS."privado".DS."sistema".DS."troca_sistema.php";
} else {
	$stMenu = Conexao::chamar()->prepare("SELECT controle_menu.* 
											FROM controle_menu_usuario   
									   LEFT JOIN controle_menu ON controle_menu_usuario.id_menu = controle_menu.id
										   WHERE controle_menu_usuario.id_menu = :id_menu
											 AND controle_menu_usuario.id_usuario = :id_usuario
										 	 AND status_registro = :status_registro");
	$stMenu->execute(array("id_menu" => secure($tela), "status_registro" => "A", "id_usuario" => $idUsuario ));
	$buscaMenu = $stMenu->fetch(PDO::FETCH_ASSOC);

	if(empty($servico)) {
		$caminhoArquivoInclude = "..".DS."..".DS."..".DS."privado".DS."sistema".DS."modulos".DS."$buscaMenu[pasta]".DS."lista".DS."listar.php";
	} else if($servico == 'cadastrar' || $servico == 'alterar') {
		$caminhoArquivoInclude = "..".DS."..".DS."..".DS."privado".DS."sistema".DS."modulos".DS."$buscaMenu[pasta]".DS."cadastro".DS."cadastrar.php";
	}

	if(file_exists($caminhoArquivoInclude)) {
		$stValidaAcesso = Conexao::chamar()->prepare("SELECT *
													    FROM controle_menu_usuario
													   WHERE id_menu = :id_menu
														 AND id_usuario = :id_usuario
													   LIMIT 1");
		$stValidaAcesso->execute(array("id_menu" => $idMenu , "id_usuario" => $idUsuario));

		$usuario_acesso = $stValidaAcesso->fetch(PDO::FETCH_ASSOC);
		$excluir = ($usuario_acesso['excluir'] == 'S') ? true : false;
		$cadastrar = ($usuario_acesso['cadastrar'] == 'S') ? true : false;

		$array = array();
		$listaMenu = array_reverse(nomeMenus($buscaMenu['id_menu'], $array));
		echo "<ol class='breadcrumb'>
		<i class='fa fa-arrow-right' aria-hidden='true'></i> ";

		foreach ($listaMenu as $itemLista) {
			echo "<li>$itemLista</li>";
		}
        echo "<li>" . $buscaMenu['descricao'] . "</li>";
        echo "</ol>";

		$caminhoTela = $publicoSistema . "/inicio.php?modulo=$modulo&tela=$tela&time=" . time();

		include $caminhoArquivoInclude;
	} else {
		include "..".DS."..".DS."..".DS."privado".DS."sistema".DS."404.php";
	}
}