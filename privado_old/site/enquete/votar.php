<?php
session_start();
include_once("../conexao.php");
$ip = $_SERVER['REMOTE_ADDR'];
$id_alternativa = $url[$ii];

$qryEnquete = Conexao::chamar()->prepare("SELECT * 
from enquete_alternativa
WHERE id = '$url[$ii]'");
$qryEnquete->execute();
$buscaEnquete = $qryEnquete->fetch(PDO::FETCH_ASSOC);

$id_enquete = $buscaEnquete['id_enquete'];

$qryVoto = Conexao::chamar()->prepare("SELECT DISTINCT enquete_alternativa.*, enquete_voto.*
FROM enquete_alternativa
LEFT JOIN enquete_voto ON enquete_voto.id_alternativa = enquete_alternativa.id
WHERE enquete_alternativa.id_enquete = '$id_enquete'
AND enquete_voto.ip = '$ip'");
$qryVoto->execute();
$buscaVoto = $qryVoto->fetchAll(PDO::FETCH_ASSOC);

  if (count($buscaVoto) == 0) {

    $stUpdate = Conexao::chamar()->prepare("UPDATE enquete_alternativa
    SET votos = votos + 1
    WHERE id ='$url[$ii]'");
    $update = $stUpdate->execute();

    
    if($update) {
      if($id_alternativa != 0) {
        $setIp = Conexao::chamar()->prepare("INSERT INTO enquete_voto SET id_enquete = '$id_enquete', id_alternativa = '$id_alternativa', ip = '$ip' , data = NOW() ");
        $setIp->execute();
      }
      $_SESSION['sim'] = "<div class='alert alert-success sumir'>Voto recebido com sucesso!</div>";
      echo "<script>history.back();</script>";
    } else {
      $_SESSION['erro'] = "<div class='alert alert-danger'>Erro ao votar!</div>";
      echo "<script>history.back();</script>";
    }

  } else {
    $_SESSION['nao'] = "<div class='alert alert-danger sumir'>Você já votou nessa enquete!</div>";
    echo "<script>history.back();</script>";

  }
?>



<div class="d-flex justify-content-center align-items-center" style="min-height:500px;">
  <h5>computando voto...</h5>
</div>