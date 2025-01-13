<?php

	$queryPopup = Conexao::chamar()->prepare("SELECT id_cliente.*
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
 WHERE status_registro = 'A'
   AND id_cliente = '$idCliente') AS id_cliente
ORDER BY id ASC
 LIMIT 3");
  $queryPopup->execute();
  $lista_po = $queryPopup->fetchAll(PDO::FETCH_ASSOC);
	$lista_popup = array();

	foreach ($lista_po as $popup) {
		$confData = true;
  		if (!empty($popup['data_inicial']) && !empty($popup['hora_inicial']) && $popup['data_inicial'] == date("Y-m-d") && $horaInicio > $horaAtual) $confData = false;
  		if (!empty($popup['data_limite']) && !empty($popup['hora_limite']) && $popup['data_limite'] == date("Y-m-d") && $horaLimite < $horaAtual) $confData = false;
   		if (count($lista_po) > 0 && $confData == true) {               
      		$lista_popup[$contador] = $popup;
      		$contador++;
    		}
  } 

if(count($lista_popup) > 0){
		$contador_popup = 0;
		foreach ($lista_popup as $valor_popup) {
?>
    	<div id="popup-modal_<?= $contador_popup ?> popup" class="modal fade show" tabindex="-1" role="dialog"  aria-hidden="true" style="background: rgba(0,0,0,.6); display:flex;">
        	<div class="modal-dialog">
          		<div class="modal-content" style="border: none; box-shadow: none;background: transparent; text-align: center;">
    			  	<button  style=" font-size: 35px;
                              color: red;
                              border: none;
                              opacity: 1;
                              background-color: transparent;
                              border-radius: 20px;
                              width: 35px;
                              height: 35px;
                              margin-top: 2px;
                              text-shadow: none;
                              position: absolute;
                              top: 0;
                              right: 20px;
                              z-index: 100;" 
                        class="close" data-dismiss="modal">&times;</button>
            		<div class="modal-body" style="padding: 0;">
              			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no_padding">
                			<a href="<?= $valor_popup['url'] != "" ? $valor_popup['url'] : "#" ?>" target="_blank">
                  				<img src="<?= $CAMINHOIMG ?>/<?= $valor_popup['foto'] ?>" class="img-responsive" style="width: 100%; padding-top: 0px;">
                			</a>
              			</div>
    				    </div>
        		</div>
      		</div>
    	</div>
  	<?php
	  $contador_popup++;
    }
}
?>


<script type="text/javascript">

  $(document).ready(function() {

    <?php
    $cont = 0;  
    foreach ($lista_popup as $item) { 
    ?>
    if($('#popup-modal_<?= $cont?>').length != 0){
        $('#popup-modal_<?= $cont?>').modal('show');
    }
    <?php
      $cont++; 
      } 
    ?>
  });
  
    function example(){
      this.classList.remove('show');
      this.style.display = "none";
    }

    $('div[id^=popup]').click(example);

</script>
