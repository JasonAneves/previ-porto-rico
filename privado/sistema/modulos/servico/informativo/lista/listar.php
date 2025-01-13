<?php
$idExcluir = isset($_REQUEST['id_excluir']);
$tabela = 'informativo';
if($idExcluir) {
	include_once "$root/privado/sistema/classes/includes/excluir.php";
	excluir($_REQUEST['id_excluir'], $tabela);
}
?>

<div class="conteudo">
	
	<?php include "includes/01-search.php" ?>

	<form id="form_lista" name="form_lista" action="<?= $caminhoTela ?>" method="POST" onsubmit="return excluirVarios();">
		<div class="card-list">
			<?php
			$page = isset($p) ? $p : 1;
			$max = 15;
			$firstPage = $max * ($page - 1);
			$link = $caminhoTela;
            if($_POST){
                $titulo = filter_var($_POST['titulo']);
            }
			if ($_POST) {
				$statusRegistro = filter_var($_POST['status_registro']);
			}
			try {
				$sql = "SELECT *
						  FROM $tabela
						 WHERE status_registro = :status_registro
						   AND id_cliente = :id_cliente ";
				
				$vetor['id_cliente'] = $idCliente;
				
				if($idUsuarioMaster && $statusRegistro == "I") {
					$vetor["status_registro"] = "I";
					$link .= "&status_registro=I";
				} else $vetor["status_registro"] = "A";
				
				if($titulo != "") {
					$sql .= "AND titulo LIKE :titulo ";
					$vetor['titulo'] = "%$titulo%";
					$link .= "&titulo=" . urlencode($titulo);
				}

				$stRow = Conexao::chamar()->prepare($sql);
				$stRow->execute($vetor);
				$qryRow = $stRow->fetchAll(PDO::FETCH_ASSOC);
				$row = count($qryRow);
				
				if(empty($sort)) $sort = "id";
				if(empty($direction)) $direction = "DESC";

				$sql .= " ORDER BY $sort $direction LIMIT $firstPage, $max";
				$stObject = Conexao::chamar()->prepare($sql);
				$stObject->execute($vetor);
				$qryObject = $stObject->fetchAll(PDO::FETCH_ASSOC);
			
				include "includes/02-grid.php";
				if(count($qryObject) < 1) {
					echo alerta("warning", "<i class=\"fa fa-warning\"></i> Nenhum registro localizado.");
				}
				
				$link = $link . "&sort=$sort&direction=$direction";
				include_once "../../../privado/sistema/classes/includes/paginacao.php";
				paginacao($page, $row, $max, $link);

			} catch (PDOException $e) {
				echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível carregar os registros.");
				echo "<script>console.log('Erro: ".addslashes($e->getMessage())."')</script>";
			}
			?>
		</div>
	<?php
	include "includes/03-button.php";
	include "includes/04-javaScript.php";
	?>
	</form>
</div>
<script>

	var checks = document.querySelectorAll(".check");
	var max = 2;
	for (var i = 0; i < checks.length; i++)
		checks[i].onclick = selectiveCheck;

	function selectiveCheck(event) {
		var checkedChecks = document.querySelectorAll(".check:checked");
		if (checkedChecks.length >= max + 1)
		return false;}
</script> 
