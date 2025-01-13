<?php
    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }
ini_set('date.timezone', 'America/Sao_Paulo');
ini_set('allow_url_fopen', true);
error_reporting(E_ALL & ~E_NOTICE);
define('DS', DIRECTORY_SEPARATOR);


$cookieIdCliente = filter_input(INPUT_COOKIE, 'id_cliente');
$cookieIdUsuario = filter_input(INPUT_COOKIE, 'id_usuario');

$idCliente = isset($cookieIdCliente) ? $cookieIdCliente : 0;
$idUsuario = $cookieIdUsuario ? $cookieIdUsuario : 0;

include "classes".DS."PHPMailer".DS."src".DS."Exception.php";
include "classes".DS."PHPMailer".DS."src".DS."PHPMailer.php";
include "classes".DS."PHPMailer".DS."src".DS."SMTP.php";
include "classes".DS."ImageManager.php";
include "classes".DS."Uploader.php";
include "classes".DS."funcoesPHP.php";

$CAMINHOCSS = $publicoSistema . "/configuracao/css";
$CAMINHOJS  = $publicoSistema . "/configuracao/js";
$caminhoImg = $publicoSistema . "/configuracao/images";

$classes              = $root . "/privado/sistema/classes";
$caminhoUploadImagem  = "$root/www/site/sistema/imagens";
$caminhoUploadArquivo = "$root/www/site/sistema/arquivos";

foreach ($_REQUEST as $campo => $valor) {
	$$campo = $valor;
}

$stCliente = Conexao::chamar()->prepare("SELECT cliente.*,
												municipio.nome municipio,
												estado.nome estado
										   FROM cliente
									  LEFT JOIN municipio ON cliente.id_municipio = municipio.id
									  LEFT JOIN estado ON municipio.id_estado = estado.id
										  WHERE cliente.id = :id_cliente");
$stCliente->execute(array("id_cliente" => $idCliente));
$buscaCliente = $stCliente->fetch(PDO::FETCH_ASSOC);

$stAdministrador = Conexao::chamar()->prepare("SELECT *
												 FROM usuario
												WHERE id = :id_usuario");
$stAdministrador->execute(array("id_usuario" => $idUsuario));
$buscaAdministrador = $stAdministrador->fetch(PDO::FETCH_ASSOC);

if($buscaAdministrador) {
	$idUsuarioMaster = false;
	if($buscaAdministrador["master"] == 'S') {
		$idUsuarioMaster = true;
	} 
}


$stPermissao = Conexao::chamar()->prepare("SELECT controle_menu_usuario.*
											 FROM controle_menu, controle_menu_usuario
											WHERE (controle_menu.id = controle_menu_usuario.id_menu OR controle_menu.id_menu = controle_menu_usuario.id_menu)
											  AND controle_menu_usuario.id_usuario = :id_usuario
											  AND controle_menu.id = :tela");

if(!(isset($tela)))$tela = '0';
$stPermissao->execute(array("id_usuario" => $idUsuario, "tela" => $tela));
$permissao = $stPermissao->fetch(PDO::FETCH_ASSOC);
$cadastrar = false;
$excluir   = false;

if($permissao) {
	if($permissao['cadastrar'] == 'S') {
		$cadastrar = true;
	}

	if($permissao['excluir'] == 'S') {
		$excluir = true;
	}
}

if($buscaAdministrador) {
	if($buscaAdministrador['master'] == 'S') {
		$cadastrar = true;
		$excluir   = true;
	}
}

class Conexao {
	private static $conexao = NULL;
	private static $destruir = false;
	const DB_HOST = "db.ingainformatica.com.br";
	const DB_NAME = "fundo_previdencia";
	const DB_USER = "ingaadmin";
	const DB_PASS = "4ab49d12daa0dcb73b36373555fa1def";

	private static function conectar(){
		if(empty(self::$conexao) && self::$destruir === false){
			try {
				self::$conexao = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME.';charset=utf8', self::DB_USER, self::DB_PASS);
				self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				if(!self::$conexao){
					echo "Houve um erro ao efetuar a conexao!";
					return NULL;
				}
			} catch(PDOException $e){
				echo "Nao foi possivel conectar ao banco de dados! ".$e->getMessage();
			}
		} else if(self::$destruir === true && isset(self::$conexao)){
			self::$conexao = NULL;
		}
		return self::$conexao instanceof PDO ? self::$conexao : NULL;
	}

	public static function chamar(){
		return self::conectar();
	}

	public static function desconectar(){
		self::$destruir = true;
		return self::conectar();
	}

	public static function reconectar(){
		self::$destruir = false;
		return self::conectar();
	}
}