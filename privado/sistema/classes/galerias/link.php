<nav class="pull-right hidden-xs hidden-sm">
	<button 
		type="button" 
		name="adicionar_link" 
		class="btn btn-success" 
		onclick="maisLink()">
		<i class="fa fa-globe"></i> Adicionar Link
	</button>
</nav>

<nav class="visible-xs visible-sm">
	<button 
		type="button" 
		name="adicionar_link" 
		class="btn btn-success btn-block" 
		onclick="maisLink()">
		<i class="fa fa-globe"></i> Adicionar Link
	</button>
</nav>

<p class="clearfix" id="mais-link"></p>

<?php
$stLink = Conexao::chamar()->query("SELECT *
									  FROM $tabelaLink
									 WHERE id_$relacionamentoTabelaLink = '$id'
								  ORDER BY ordem ASC, id DESC");
$qryLink = $stLink->fetchAll(PDO::FETCH_ASSOC);

if(count($qryLink)) {
?>
	<ol id="<?= $tabelaLink ?>" class="galeriaSortable">
		<?php
		foreach ($qryLink as $buscaLink) {
		?>
			<li id="item_<?=$buscaLink['id'] ?>">
				<? if($buscaLink['titulo'] != "") { ?>
				<span class="item_descricao"><?= $buscaLink['titulo'] ?></span>
				<? } ?>
				<img 
					data-toggle="tooltip" 
					src="<?= $caminhoImg ?>/ico_link.png" 
					title="Arraste para alterar a ordem" />
				<input 
					type="hidden" 
					name="descricao_link_alterar[]" 
					id="descricao_link_alterar_<?= $buscaLink['id'] ?>" 
					value="<?= $buscaLink['titulo'] ?>" />
				<input 
					type="hidden" 
					name="link_link_alterar[]" 
					id="link_link_alterar_<?= $buscaLink['id'] ?>" 
					value="<?= $buscaLink['link'] ?>" />
				<input 
					type="hidden" 
					name="id_link[]" 
					value="<?= $buscaLink['id'] ?>" />
				<a href="<?= $buscaLink['link'] ?>"
					class="btn btn-success btn-xs" 
					data-toggle="tooltip"  
					target="_blank" 
					style="position: absolute; bottom: 1px; right: 48px;" 
					title="Abrir Link">
					<i class="fa fa-search"></i>
				</a>
				<button 
					type="button" 
					class="btn btn-primary btn-xs" 
					data-toggle="tooltip" 
					onclick="editarGaleriaLink('<?= $buscaLink['id'] ?>')" 
					style="position: absolute; bottom: 1px; right: 24px;" 
					title="Editar Descrição">
					<i class="fa fa-pencil"></i>
				</button>
				<button 
					type="button" 
					class="btn btn-danger btn-xs" 
					data-toggle="tooltip" 
					onclick="jQuery(this).parent().fadeOut('slow', function(){jQuery(this).remove();})" 
					style="position: absolute; bottom: 1px; right: 1px;" 
					title="Excluir Link">
					<i class="fa fa-trash"></i>
				</button>
			</li>
		<?php } ?>
	</ol>
<?php } ?>