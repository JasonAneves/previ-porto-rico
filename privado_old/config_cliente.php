<!-- </?php
  $dominioAbsoluto = "prevmunhoz";
  $dominioPublico = "institutoprevidenciamunhoz.com.br";
  $idCliente = 12244;
  $iii = 3;
  $ii = 2;
  $i = 1;
  $url = $_SERVER['REQUEST_URI'];
  $url = explode("/", $url);
  $CAMINHO = "http://institutoprevidenciamunhoz.com.br/";
  $URL_ARQUIVO_PRODUCAO = $CAMINHO."sistema/";
  $CAMINHOSIS = $CAMINHO."sistema/";
  $CAMINHOIMG = $URL_ARQUIVO_PRODUCAO . "imagens/" . $idCliente;
  $CAMINHOANEXO = $URL_ARQUIVO_PRODUCAO . "arquivos/" . $idCliente;
  $caminhoUploadArquivo = "/home/".$dominioAbsoluto."/public_html/www/site/sistema/arquivos/";
  $publicoSistema = $CAMINHOSIS;
  $caminhoSite = $CAMINHO;
  $root = '/home/'.$dominioAbsoluto.'/public_html/';
?> -->

<?php
//Produção

// const DB_HOST = "db.ingainformatica.com.br";
// const DB_NAME = "db_portal_turismo";
// const DB_USER = "ingaadmin";
// const DB_PASS = "4ab49d12daa0dcb73b36373555fa1def";
    
// //Application Config
// $idCliente = 12063;
// const IDCLIENTE = 12063;
// $dominioAbsoluto = "carlopolisprgov";
// $dominioPublico = "carlopolis.pr.gov.br";
// $iii = 3;
// $ii = 2;
// $i = 1;
// $url = $_SERVER['REQUEST_URI'];
// $url = explode("/", $url);
// $CAMINHO = "http://turismo." . $dominioPublico . "/";
// $CAMINHOFRUTFEST = "http://frutfest.". $dominioPublico ."/";
// $URL_ARQUIVO_PRODUCAO = "http://turismo." . $dominioPublico . "/sistema/";
// $cliente = $idCliente;
// $CAMINHOSIS = $CAMINHO . "sistema/";
// $CAMINHOIMG = $URL_ARQUIVO_PRODUCAO . "imagens/" . $idCliente;
// $CAMINHOANEXO = $URL_ARQUIVO_PRODUCAO . "arquivos" . $idCliente;
// $caminhoUploadArquivo = "/home/" . $dominioAbsoluto . "/public_html/turismo/portal-turismo/www/site/sistema/arquivos/". $idCliente;
// $caminhoUploadImagem = "/home/" . $dominioAbsoluto . "/public_html/turismo/portal-turismo/www/site/sistema/imagens/". $idCliente;
// $publicoSistema = $CAMINHOSIS;
// $caminhoSite = $CAMINHO;
// $CAMINHOCSS = $publicoSistema . "/configuracao/css";
// $CAMINHOJS = $publicoSistema . "/configuracao/js";
// $caminhoImg = $publicoSistema . "/configuracao/images";
// $root = '/home/' . $dominioAbsoluto . '/public_html/turismo/portal-turismo';
?>

<?php
//Localhost

//Application Config

$baseUrl = "http://localhost";
$dominioAbsoluto = "FundoPrevidencia";
$dominioPublico = $baseUrl . "/FundoPrevidencia";
$idCliente = 122;
$iii = 6;
$ii = 5;
$i = 4;
$url = $_SERVER['REQUEST_URI'];
$url = explode("/", $url);
$CAMINHO = $baseUrl . "/FundoPrevidencia/www/site/";
$URL_ARQUIVO_PRODUCAO = $CAMINHO."sistema/";
$CAMINHOSIS = $CAMINHO."sistema/";
$CAMINHOIMG = $URL_ARQUIVO_PRODUCAO . "imagens/" . $idCliente;
$CAMINHOANEXO = $URL_ARQUIVO_PRODUCAO . "arquivos/" . $idCliente;
$caminhoUploadArquivo = "/home/".$dominioAbsoluto."/public_html/www/site/sistema/arquivos/";
// $caminhoUploadArquivo = "/home/" . $dominioAbsoluto . "/www/site/sistema/arquivos/";

$publicoSistema = $CAMINHOSIS;
$caminhoSite = $CAMINHO;
$root = '/home/'.$dominioAbsoluto.'/public_html/';

// $idCliente = 122;
// $baseUrl = "http://localhost";
// $dominioAbsoluto = "FundoPrevidencia";
// $dominioPublico = $baseUrl . "/FundoPrevidencia";
// $iii = 6;
// $ii = 5;
// $i = 4;
// $url = $_SERVER['REQUEST_URI'];
// $url = explode("/", $url);
// $CAMINHO = $baseUrl . "/FundoPrevidencia/www/site/";
// $URL_ARQUIVO_PRODUCAO = $CAMINHO . "/sistema";
// $cliente = $idCliente;
// $CAMINHOSIS = $CAMINHO . "/sistema";
// $CAMINHOIMG = $URL_ARQUIVO_PRODUCAO . "/imagens/" . $idCliente;
// $CAMINHOANEXO = $URL_ARQUIVO_PRODUCAO . "/arquivos/" . $idCliente;
// $caminhoUploadArquivo = "/home/" . $dominioAbsoluto . "/www/site/sistema/arquivos/";
// $caminhoUploadImagem = "/home/" . $dominioAbsoluto . "/www/site/sistema/imagens/";
// $publicoSistema = $CAMINHOSIS;
// $caminhoSite = $CAMINHO;
// $CAMINHOCSS = $publicoSistema . "/configuracao/css";
// $CAMINHOJS = $publicoSistema . "/configuracao/js";
// $caminhoImg = $publicoSistema . "/configuracao/images";

// $root = "/var/www/html/php/FundoPrevidencia";
// $root = "C:/xampp/htdocs/FundoPrevidencia";
?>


<?php
// Docker Localhost
// Database Config
// const DB_HOST = "database-portal-turismo";
// const DB_NAME = "db_portal_turismo";
// const DB_USER = "root";
// const DB_PASS = "root";

//Application Config
// $idCliente = 1003;
// const IDCLIENTE = 1003;
// $baseUrl = "http://localhost:4500";
// $dominioAbsoluto = "portal-turismo";
// $dominioPublico = $baseUrl . "/portal-turismo";
// $iii = 6;
// $ii = 5;
// $i = 4;
// $url = $_SERVER['REQUEST_URI'];
// $url = explode("/", $url);
// $CAMINHO = $baseUrl . "/portal-turismo/www/site";
// $URL_ARQUIVO_PRODUCAO = $CAMINHO . "/sistema";
// $cliente = $idCliente;
// $CAMINHOSIS = $CAMINHO . "/sistema";
// $CAMINHOIMG = $URL_ARQUIVO_PRODUCAO . "/imagens/" . $idCliente;
// $CAMINHOANEXO = $URL_ARQUIVO_PRODUCAO . "/arquivos/" . $idCliente;
// $caminhoUploadArquivo = "/home/" . $dominioAbsoluto . "/www/site/sistema/arquivos/";
// $caminhoUploadImagem = "/home/" . $dominioAbsoluto . "/www/site/sistema/imagens/";
// $publicoSistema = $CAMINHOSIS;
// $caminhoSite = $CAMINHO;
// $CAMINHOCSS = $publicoSistema . "/configuracao/css";
// $CAMINHOJS = $publicoSistema . "/configuracao/js";
// $caminhoImg = $publicoSistema . "/configuracao/images";

// $root = "/app/portal-turismo";
?>