<nav class="pull-right hidden-xs hidden-sm">
	<button type="button" name="upload_normal" class="btn btn-success" onclick="maisAlternativa()"><i class="fa fa-plus"></i> Adicionar Alternativa</button>
</nav>

<nav class="visible-xs visible-sm">
	<button type="button" name="upload_normal" class="btn btn-success btn-block" onclick="maisAlternativa()"><i class="fa fa-plus"></i> Adicionar Alternativa</button>
</nav>

<p class="clearfix"></p>


<p class="clearfix" id="mais-alternativa"></p>

<?php
$stAlternativa = Conexao::chamar()->query("SELECT *
									   FROM $tabelaAlternativa
									  WHERE $relacionamentoTabelaAlternativa = '$id'
								   ORDER BY ordem ASC, id DESC");
$stAlternativa->execute();
$qryAlternativa = $stAlternativa->fetchAll(PDO::FETCH_ASSOC);
$id_cliente = $buscaAdministrador['id_cliente'];

if(count($qryAlternativa)) {
?>
<ol id="<?= $tabelaAlternativa ?>" class="galeriaSortable">
	<?php
	foreach ($qryAlternativa as $buscaAlternativa) {

	if(file_exists("$caminhoUploadImagem/$id_cliente/gd_" . $buscaAlternativa['foto'])) {

		$imgTb = "tb_" . $buscaAlternativa['foto'];
		$imgGd = "gd_" . $buscaAlternativa['foto'];

	} else {

		$imgTb = $buscaAlternativa['foto'];
		$imgGd = $buscaAlternativa['foto'];

	}
	?>
	<li id="item_<?=$buscaAlternativa['id'] ?>">

		<span class="item_descricao" id="span_foto_<?=$buscaAlternativa['id'] ?>"><?= $buscaAlternativa['descricao'] ?></span>
		
		<img data-toggle="tooltip" src="<?= $CAMINHO ?>/imagens/<?=$id_cliente ?>/<?= $imgTb ?>" title="Arraste para alterar a ordem" />
	
		<!--<input type="hidden" name="credito_alterar[]" id="credito_alterar_<?= $buscaAlternativa['id'] ?>" value="<?= $buscaAlternativa['credito'] ?>" />
		<input type="hidden" name="legenda_alterar[]" id="legenda_alterar_<?= $buscaAlternativa['id'] ?>" value="<?= $buscaAlternativa['legenda'] ?>" />-->
		
		<input type="hidden" name="id_foto[]" value="<?= $buscaAlternativa['id'] ?>" />

		<a class="btn btn-success btn-xs" href="<?= $CAMINHO ?>/imagens/<?=$id_cliente ?>/<?= $imgGd ?>" data-toggle="lightbox" data-gallery="quem_somos_fotos" data-title="<?=$buscaAlternativa['descricao']?>" style="position: absolute; bottom: 1px; left: 1px;" title="Ampliar Imagem">
			<i class="fa fa-search"></i>
		</a>
		
		<button type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" onclick="editarGaleriaFoto('<?= $buscaAlternativa['id'] ?>')" style="position: absolute; bottom: 1px; right: 24px;" title="Editar Descri&ccedil;&atilde;o">
			<i class="fa fa-pencil"></i>
		</button>
		
		<button type="button" class="btn btn-danger btn-xs" data-toggle="tooltip" onclick="jQuery(this).parent().fadeOut('slow', function(){jQuery(this).remove();})" style="position: absolute; bottom: 1px; right: 1px;" title="Excluir Imagem">
			<i class="fa fa-trash"></i>
		</button>

	</li>
	<?php } ?>
</ol>
<?php } ?>