
<?php
$path = $_SERVER["DOCUMENT_ROOT"];
define("SEP", DIRECTORY_SEPARATOR);
require(".." . SEP . ".." . SEP . ".." . SEP . ".." . SEP . "privado" . SEP . "sistema" . SEP . "conexao.php");
//$stConf = Conexao::chamar()->query("SELECT *
//									  FROM chave_seguranca
//									 WHERE id_cliente = '$idCliente'");
//
//$conf = $stConf->fetch(PDO::FETCH_ASSOC);
$stRecupera = Conexao::chamar()->prepare("UPDATE $tabela SET status_registro = :status_registro WHERE id = :id");
$recupera = $stRecupera->execute(array("status_registro" => "A", "id" => $id));
if($recupera) {
	logAcesso("R", $tela, $id);
	echo "sucesso";
} else {
    echo "erro";
}