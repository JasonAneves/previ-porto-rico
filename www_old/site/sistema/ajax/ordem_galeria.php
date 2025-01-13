<?php

$path = $_SERVER["DOCUMENT_ROOT"];

define("SEP", DIRECTORY_SEPARATOR);

require($path . SEP . ".." . SEP . ".." . SEP . "privado" . SEP . "sistema" . SEP . "conexao.php");

parse_str($_POST['sort'], $sort1);

try {
	
	foreach($sort1['item'] as $key => $value) {
		
		$ordem = $key + 1;
		
		$st = Conexao::chamar()->prepare("UPDATE $tabela
											 SET ordem = :ordem
										   WHERE id = :id");

		$st->execute(array("ordem" => $ordem, "id" => $value));

	}

} catch (PDOException $e) {

	echo $e->getMessage();

}