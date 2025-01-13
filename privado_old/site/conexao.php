<?php
error_reporting(E_ALL ^ E_WARNING ^E_NOTICE); 
session_start();

// $CAMINHOSIS = $dominioPublico."/sistema/";
// $CAMINHOSIS = "http://localhost/FundoPrevidencia/www/site/sistema/";
// $CAMINHOIMG = $CAMINHOSIS . "imagens/1";
// $CAMINHOANEXO = $CAMINHOSIS . "arquivos/1";
// $caminhoUploadArquivo = "/assets/images/";


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

require_once 'funcoes.php';
require_once 'modelo_email.php';

