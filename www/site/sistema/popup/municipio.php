<?php
include "../../../../privado/sistema/conexao.php";

$pagina = isset($pagina) ? $pagina : 1;
$max = 10;
$inicio = $max * ($pagina - 1);
$busca = filter_input(INPUT_GET, 'busca');

$link = "popup/municipio.php?tela=$tela";

if(empty($sort)) $sort = "nome";
if(empty($direction)) $direction = "ASC";

?>

<script>
	function retorna(id, nome) {
		$('#id_municipio').val(id);
		$('#municipio').val(nome);
		$('#modal').modal('hide');
	}
</script>

<div class="table-responsive">
	<table class="table table-striped table-hover table-bordered table-condensed">
		<tr class="active">
			<th style="width: 90px;">
				<a href="#" onclick="$('#modal_corpo').load('<?= $link ?>&pagina=<?= $pagina ?>&sort=municipio.id&direction=<?= empty($direction) || $direction == "DESC" ? "ASC" : "DESC" ?>&time='+$.now()); return false;">
					Código
				</a>
				<?php if($sort == "municipio.id" && $direction == "ASC") { ?><i class="fa fa-caret-up"></i><?php } ?>
				<?php if($sort == "municipio.id" && $direction == "DESC") { ?><i class="fa fa-caret-down"></i><?php } ?>
			</th>
			<th>
				<a href="#" onclick="$('#modal_corpo').load('<?= $link ?>&pagina=<?= $pagina ?>&sort=municipio.nome&direction=<?= empty($direction) || $direction == "DESC" ? "ASC" : "DESC" ?>&time='+$.now()); return false;">
					Município
				</a>
				<?php if($sort == "municipio.nome" && $direction == "ASC") { ?><i class="fa fa-caret-up"></i><?php } ?>
				<?php if($sort == "municipio.nome" && $direction == "DESC") { ?><i class="fa fa-caret-down"></i><?php } ?>
			</th>
			<th>
				<a href="#" onclick="$('#modal_corpo').load('<?= $link ?>&pagina=<?= $pagina ?>&sort=estado&direction=<?= empty($direction) || $direction == "DESC" ? "ASC" : "DESC" ?>&time='+$.now()); return false;">
					Estado
				</a>
				<?php if($sort == "estado" && $direction == "ASC") { ?><i class="fa fa-caret-up"></i><?php } ?>
				<?php if($sort == "estado" && $direction == "DESC") { ?><i class="fa fa-caret-down"></i><?php } ?>
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
		$sql = "SELECT municipio.*,
					   estado.nome estado
                  FROM municipio 
			 LEFT JOIN estado ON municipio.id_estado = estado.id
                 WHERE municipio.status_registro = :status_registro ";

		$vetor["status_registro"] = "A";

		if(isset($busca)) {
			$sql .= "AND municipio.nome LIKE :nome ";
			$vetor['nome'] = "%$busca%";
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
				$retornoDescricao = $object["nome"];
		?>
		<tr>
			<td class="text-right"><a href="#" class="text-muted" onclick="retorna('<?= $retornoId ?>', '<?= $retornoDescricao ?>'); return false;"><?= $object["id"] ?></a></td>
			<td><a href="#" class="text-muted" onclick="retorna('<?= $retornoId ?>', '<?= $retornoDescricao ?>'); return false;"><?= $object["nome"] ?></a></td>
			<td><a href="#" class="text-muted" onclick="retorna('<?= $retornoId ?>', '<?= $retornoDescricao ?>'); return false;"><?= $object["estado"] ?></a></td>
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