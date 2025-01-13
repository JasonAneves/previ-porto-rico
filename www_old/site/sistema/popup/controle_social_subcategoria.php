<?php
include "../../../../privado/sistema/conexao.php";

$pagina = isset($pagina) ? $pagina : 1;
$max = 10;
$inicio = $max * ($pagina - 1);
$busca = filter_input(INPUT_GET, 'busca');

$link = "popup/controle_social_subcategoria.php?tela=$tela";

if(empty($sort)) $sort = "descricao";
if(empty($direction)) $direction = "ASC";

if(empty($id_categoria)) {
	echo "<script>$('#id_categoria, #categoria').addClass('error');</script>";
	echo alerta("danger", "<i class=\"fa fa-ban\"></i> A Categoria não foi informada!");
}
?>

<script>
	function retorna(id, nome) {
		$('#id_subcategoria').val(id);
		$('#subcategoria').val(nome);
		$('#modal').modal('hide');
	}
</script>

<div class="table-responsive">
	<table class="table table-striped table-hover table-bordered table-condensed">
		<tr class="active">
			<th style="width: 90px;">
				<a href="#" onclick="$('#modal_corpo').load('<?= $link ?>&pagina=<?= $pagina ?>&sort=id&direction=<?= empty($direction) || $direction == "DESC" ? "ASC" : "DESC" ?>&time='+$.now()); return false;">
					Código
				</a>
				<?php if($sort == "id" && $direction == "ASC") { ?><i class="fa fa-caret-up"></i><?php } ?>
				<?php if($sort == "id" && $direction == "DESC") { ?><i class="fa fa-caret-down"></i><?php } ?>
			</th>
			<th>
				<a href="#" onclick="$('#modal_corpo').load('<?= $link ?>&pagina=<?= $pagina ?>&sort=descricao&direction=<?= empty($direction) || $direction == "DESC" ? "ASC" : "DESC" ?>&time='+$.now()); return false;">
					Descrição
				</a>
				<?php if($sort == "descricao" && $direction == "ASC") { ?><i class="fa fa-caret-up"></i><?php } ?>
				<?php if($sort == "descricao" && $direction == "DESC") { ?><i class="fa fa-caret-down"></i><?php } ?>
				<form class="form-inline pull-right" action="" method="post" onsubmit="$('#modal_corpo').load('<?= $link ?>&busca=' + $('#busca').val() + '&time=' + $.now()); return false;">
					<div class="input-group">
						<input 
							type="search" 
							name="busca" 
							id="busca" 
							class="form-control input-sm input" 
							value="<?= $busca ?>" 
							placeholder="Pesquisar..." />
						<span class="input-group-btn">
							<button 
								class="btn btn-sm btn-warning input" 
								type="submit">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
                </form>
			</th>
		</tr>
	<?php
	try {
		$sql = "SELECT *
                  FROM controle_social_subcategoria 
                 WHERE status_registro = :status_registro
				   AND id_categoria = :id_categoria ";

		$vetor['id_categoria'] = $id_categoria;
		$vetor["status_registro"] = "A";

		if(isset($busca)) {
			$sql .= "AND descricao LIKE :descricao ";
			$vetor['descricao'] = "%$busca%";
			$link .= "&busca=" . urlencode($busca);
		}

		$stRow = Conexao::chamar()->prepare($sql);
		$stRow->execute($vetor);
		$qryRow = $stRow->fetchAll(PDO::FETCH_ASSOC);
		$row = count($qryRow);

		$sql .= "ORDER BY $sort $direction LIMIT $inicio, $max";

		$stObject = Conexao::chamar()->prepare($sql);
		$stObject->execute($vetor);
		$qryObject = $stObject->fetchAll(PDO::FETCH_ASSOC);

		if(count($qryObject)) {
			foreach($qryObject as $object) {
				$retornoId = $object["id"];
				$retornonome = $object["descricao"];
		?>
		<tr>
			<td class="text-right"><a href="#" class="text-muted" onclick="retorna('<?= $retornoId ?>', '<?= $retornonome ?>'); return false;"><?= $object["id"] ?></a></td>
			<td><a href="#" class="text-muted" onclick="retorna('<?= $retornoId ?>', '<?= $retornonome ?>'); return false;"><?= $object["descricao"] ?></a></td>
		</tr>
		<?php
		
			}
		}
	} catch (PDOException $e) {
		echo alerta("danger", "<i class=\"fa fa-ban\"></i> N&atilde;o foi poss&iacute;vel carregar os registros.");
		echo "<script>console.log('Erro: ".addslashes($e->getMessage())."')</script>";
	}
	?>
	</table>
</div>

<?php
$link = $link . "&sort=$sort&direction=$direction";

include_once "../../../../privado/sistema/classes/includes/paginacao.php";
paginacao_popup($pagina, $row, $max, $link);
?>
<p class="clearfix"></p>