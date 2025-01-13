<?php

if($id){
	
	$registro = Conexao::chamar()->prepare("SELECT * FROM {$tabela} WHERE id = :id AND status_registro = :status_registro LIMIT 1");
	$registro->bindValue(":id", $id, PDO::PARAM_INT);
	$registro->bindValue(":status_registro", "A", PDO::PARAM_STR);
	$registro->execute();
	$registro = $registro->fetch(PDO::FETCH_ASSOC);
	
	if(isset($registro['id'])){
	
		$fotoArtigo = Conexao::chamar()->prepare("SELECT * FROM {$tabela}_foto WHERE id_artigo = :id_artigo ORDER BY ordem ASC, id DESC LIMIT 1");
		$fotoArtigo->bindValue(":id_artigo", $registro['id'], PDO::PARAM_INT);
		$fotoArtigo->execute();
		$fotoArtigo = $fotoArtigo->fetch(PDO::FETCH_ASSOC);
	
		
		if(isset($fotoArtigo['id'])){
			
			$img = @getimagesize($CAMINHOIMG."/".$fotoArtigo['foto']) ? $CAMINHOIMG."/".$fotoArtigo['foto'] : $CAMINHOIMGCSS."/semfoto.jpg";
			$img_light = @getimagesize($CAMINHOIMG."/".$fotoArtigo['foto']) ? $CAMINHOIMG."/".$fotoArtigo['foto'] : $CAMINHOIMGCSS."/semfoto.jpg";
		}
		
	?>
		<div class="box-visualizacao">

      <div style='display: block;width: 100%;'>
        <h1 class="acessibilidade" style=" color: #0aab60;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">projetos / <?=$registro['titulo']?></h1>
      </div>
			<div class="acessibilidade artigo-completo">
				<?php if(isset($fotoArtigo['id'])){ ?>
				<a href="<?=$img_light?>" data-toggle="lightbox" data-gallery="quem_somos_fotos" data-title="<?=$fotoArtigo['legenda']?>">
					<img style="width: 100%;height: 360px; object-fit: contain; margin: 0 auto 15px auto; display: block; padding: 4px; background-color: #fff; border: 1px solid #ddd; border-radius: 4px;" src="<?=$img?>"/>
				</a>
				<?php } ?>
				<?=$registro['artigo']?>
			</div>
			<?php 
			
			$fotoArtigo['id'] = isset($fotoArtigo['id']) ? $fotoArtigo['id'] : 0;
			$verificaFotos = Conexao::chamar()->query("SELECT count(*) FROM {$tabela}_foto WHERE id_artigo = $registro[id] AND id != $fotoArtigo[id] ORDER BY ordem, id ASC")->fetchColumn();
			if($verificaFotos < 0){
			?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="acessibilidade panel-title">Galeria de Fotos</div>
				</div>
				<div class="panel-body">
					<?php 
					$fotos = Conexao::chamar()->query("SELECT * FROM {$tabela}_foto WHERE id_artigo = $registro[id] AND id != $fotoArtigo[id] ORDER BY ordem ASC, id DESC");
					
					foreach($fotos->fetchAll(PDO::FETCH_ASSOC) as $foto){

						$img = getimagesize($CAMINHOIMG."/".$foto['foto']) ? $CAMINHOIMG."/".$foto['foto'] : $CAMINHOIMGCSS."/sem_foto.jpg";
		
					?>
					<a href="<?=$img?>" data-toggle="lightbox" data-gallery="quem_somos_fotos" data-title="<?=$foto['legenda']?>">
						<img src="<?=$img?>" class="img-thumbnail foto-galeria" alt="<?=$foto['legenda']?>"/>
					</a>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
			<?php 
			$verificaVideos = Conexao::chamar()->query("SELECT count(*) FROM {$tabela}_video WHERE id_artigo = $registro[id]")->fetchColumn();
			if($verificaVideos > 0){
			?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="acessibilidade panel-title">Galeria de V&iacute;deos</div>
				</div>
				<div class="panel-body">
					<?php 
					$videos = Conexao::chamar()->query("SELECT * FROM {$tabela}_video WHERE id_artigo = $registro[id] ORDER BY ordem ASC, id DESC");
					foreach($videos->fetchAll(PDO::FETCH_ASSOC) as $video){

						$link = video($video['link']);
					?>
					<a href="<?=$link['embed']?>" data-toggle="lightbox" data-gallery="quem_somos_videos" data-title="<?=$link['title']?>">
						<img src="<?=$link['img']?>" class="img-thumbnail foto-galeria" style="width: 20%;"/>
					</a>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
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
						<span class="acessibilidade"><?=utf8_encode($anexo['descricao'])?></span>
					</a>
					<?php } ?>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php 
		$outros = Conexao::chamar()->query("SELECT count(*) FROM {$tabela} WHERE id != $id AND status_registro = 'A'")->fetchColumn();
		if($outros > 0){
			$outros = Conexao::chamar()->query("SELECT * FROM {$tabela} WHERE id != $id AND status_registro = 'A' ORDER BY RAND() LIMIT 4");
		?>
		<div class="outros_artigos">
			<h2>
				Veja Tamb&eacute;m
				<a href="<?=$CAMINHO?>/projetos" class="btn btn-padrao-verde pull-right"> <span style="color: #fff;" class="hidden-xs">VER TODOS</span></a>
			</h2>
			<?php 
			foreach($outros->fetchAll(PDO::FETCH_ASSOC) as $outros){
			?>
			<a href="<?=$CAMINHO?>projetos/<?=$outros['id']?>" class="linha">
				<div class="titulo"><?=$outros['titulo']?></div>	
				<div class="artigo"><?= resumo($outros['artigo'], 500)?></div>
			</a>
			<?php } ?>
		</div>
		<?php } ?>
	<?php 
	
	} else {
		
		echo "<script>location.href='".$CAMINHO."/projetos'</script>";
	}
	
} else {

	echo "<script>location.href='".$CAMINHO."/projetos'</script>";
}
				 