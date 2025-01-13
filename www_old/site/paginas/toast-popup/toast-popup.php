<?php
  $queryInst = Conexao::chamar()->prepare("SELECT id_cliente.*
    FROM (
    SELECT popup.*,
    IF (data_inicial < CURRENT_DATE() 
    OR (data_inicial = CURRENT_DATE()
    AND (hora_inicial IS NULL 
    OR CAST(hora_inicial AS time) <= CURRENT_TIME())), 'S', 'N') AS inicio,
    IF (data_limite IS NULL 
    OR (data_limite > CURRENT_DATE() 
    OR (data_limite = CURRENT_DATE() 
    AND (hora_limite IS NULL 
    OR CAST(hora_limite AS time) >= CURRENT_TIME()))), 'S', 'N') AS fim 
    FROM popup
    WHERE status_registro = :status_registro
    AND id_cliente = :id_cliente) AS id_cliente
    ORDER BY id ASC
    LIMIT 3");
  $queryInst->bindValue(":status_registro", "A", PDO::PARAM_STR);
  $queryInst->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
  $queryInst->execute();
  $sql = $queryInst->fetchAll(PDO::FETCH_ASSOC);
?>

<div aria-live="polite" aria-atomic="true" style="position: relative;">
  <!-- Posição do toast -->
  <div class="msgs-popup">

  <!-- Bloco da mensagem -->
  <?php 
    $iToast = count($sql);
    $primeira = true;
    foreach($sql as $toast): 
    if($toast['inicio'] == 'S' && $toast['fim'] == 'S') { ?>
   
      <div type="button" class="toast" id="toast<?=$iToast?>" role="alert" aria-live="assertive" aria-atomic="true" style="display:none;" data-toggle="modal" data-target="#popup-modal-<?=$toast['id']?>" data-id="<?=$toast['id']?>" data-title="<?=$toast['titulo']?>">
        <div class="toast-header" style="display: flex;">
          <a data-toggle="lightbox" data-gallery="gallery" data-title="<?= $toast['titulo'] ?>" <? if (!$primeira) echo'style = "display:none"'; ?> href="<?= $CAMINHOIMG ?>/<?= $toast['foto']; ?>" title="<?= $toast['titulo']; ?> - <? echo "<br /><a href='$CAMINHOIMG/$toast[foto]' target='_blank'>Baixar Imagem</a>"; ?>"> 
            <img class="img-thumbnail" style="width: 50px; object-fit: contain;" src="<?= $CAMINHOIMG ?>/<?= $toast['foto']; ?>" />                        
          </a>
          <div style="display: flex;flex-direction: column;">
            <strong class="mr-auto">Novo aviso!</strong>
            <small class="text-muted"><?=formata_data($toast['data_inicial'])?></small>
          </div>
          <!-- <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> -->
        </div>
        <div class="toast-body">
        <?=$toast['titulo']?>
        </div>
      </div>
    <?php } ?>

      <?php $iToast--; 
    endforeach; ?>
  </div>
</div>

<div style="position: relative;" >
  <div class="popup-box">
    <div class="popup-count popupToggle" style="display: none;"><?= count($sql) ?></div>
      <div class="popup-circle popupToggle" onclick="popupOnOff()" style="display: none;">
        <h1>!</h1>
      </div>
  </div>
</div>

<script>

$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
}); 

  // exibir notificações
function popupOnOff() {
  $(".popupToggle").fadeOut('fast');

  function mostarPopups(){
    setTimeout(function() {
      $(document).ready(function(){
        $("#toast1").fadeIn(1000);
      });
    }, 500);

    setTimeout(function() {
      $(document).ready(function(){
        $("#toast2").fadeIn(1000);
      });
    }, 1000);

    setTimeout(function() {
      $(document).ready(function(){
        $("#toast3").fadeIn(1000);
      });
    }, 1500);
  } mostarPopups();

  // ocultar notificações
  function ocultarPopups(){
    setTimeout(function() {
      $(document).ready(function(){
        $('#toast1').fadeOut('slow');
      });
    }, 10000);
    setTimeout(function() {
      $(document).ready(function(){
        $('#toast2').fadeOut('slow');
      });
    }, 10500);

    setTimeout(function() {
      $(document).ready(function(){
        $('#toast3').fadeOut('slow');
      });
    }, 11000);
  } ocultarPopups();

  setTimeout(function() {
    $(".popupToggle").fadeIn('fast');
    }, 12000);
} popupOnOff();
</script>