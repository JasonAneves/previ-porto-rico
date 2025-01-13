<?php
  // include "paginas/04-banner/04-banner.php";
  include "paginas/05-btn-centro/05-btn-centro.php";
  include "paginas/06-noticias/06-noticias.php";
  include "paginas/galeria/galeria-fotos.php";
  // include "paginas/07-beneficios/07-beneficios.php";
  include "paginas/08-btn-rodape-video/08-btn-rodape-video.php";

  $qryEnquete = Conexao::chamar()->prepare("SELECT*
  FROM enquete
  WHERE id_cliente = '$idCliente'
  AND status_registro = 'A'");
  $qryEnquete->execute();
  $buscaEnquete = $qryEnquete->fetchAll(PDO::FETCH_ASSOC);

  if(count($buscaEnquete) > 0){include "paginas/enquete/enquete.php";}
  
?>