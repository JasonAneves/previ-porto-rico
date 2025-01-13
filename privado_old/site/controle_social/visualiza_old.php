<?php

if($id){
	
	$registro = Conexao::chamar()->prepare("SELECT * FROM {$tabela} WHERE id = :id AND status_registro = :status_registro LIMIT 1");
	$registro->bindValue(":id", $id, PDO::PARAM_INT);
	$registro->bindValue(":status_registro", "A", PDO::PARAM_STR);
	$registro->execute();
	$registro = $registro->fetch(PDO::FETCH_ASSOC);
	
	if(count($registro['id']) > 0){
		
	?>
		<div class="box-visualizacao">

      <div style='display: block;width: 100%;'>
        <h1 class="acessibilidade" style=" color: #0aab60;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;"><?=$titulo?> / <?=$registro['titulo']?></h1>
      </div>
			<div class="acessibilidade artigo-completo">
				<?=$registro['artigo']?>
			</div>

			<?php 
			$verificaAnexos = Conexao::chamar()->query("SELECT count(*) FROM {$tabela}_anexo WHERE id_artigo = $registro[id]")->fetchColumn();
			if($verificaAnexos > 0){
			?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="acessibilidade panel-title">Galeria de Anexos</div>
				</div>
				<div class="panel-body" style="display: flex; flex-direction: column;">
					<?php 
					$anexos = Conexao::chamar()->query("SELECT * FROM {$tabela}_anexo WHERE id_artigo = $registro[id] ORDER BY ordem ASC, id DESC");
					foreach($anexos->fetchAll(PDO::FETCH_ASSOC) as $anexo){
					?>
					<a class="item-anexo" href="<?=$CAMINHOANEXO?>/<?= $cliente?>/<?=$anexo['arquivo']?>" target="_blank">
						<i class="fa fa-download"></i>
						<span class="acessibilidade"><?=$anexo['descricao']?></span>
					</a>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
	<?php 
	
	} else {
		
		echo "<script>location.href='".$CAMINHO."/institucional'</script>";
	}
	
} else {

	echo "<script>location.href='".$CAMINHO."/institucional'</script>";
}
				 