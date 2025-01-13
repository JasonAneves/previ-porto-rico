<?php
  $idExcluir = isset($_REQUEST['id_excluir']);
  $tb_nivel_1 = "transparencia_categoria_nivel1";

  if($idExcluir) {
    include_once "$root/privado/sistema/classes/includes/excluir.php";
    excluir($_REQUEST['id_excluir'], $tb_nivel_1);
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

      if ($_POST) {
        $descricao = filter_var($_POST['descricao']);
        $statusRegistro = filter_var($_POST['status_registro']);
			}

      if($_GET['descricao'] != ''){
        $descricao = filter_var($_GET['descricao']);
      }

			try {
				$sql = "SELECT *
						      FROM $tb_nivel_1
						     WHERE status_registro = :status_registro
                   AND id_cliente = $idCliente ";

          if ($descricao != "") {
          $sql .= "AND ".$tb_nivel_1.".descricao LIKE :descricao ";
					$vetor['descricao'] = "%$descricao%";
					$link .= "&descricao=" . urlencode($descricao);
				}

        if ($idUsuarioMaster && $statusRegistro == "I") {
          $vetor["status_registro"] = "I";
          $link .= "&status_registro=I";
        } else $vetor["status_registro"] = "A";

				$stRow = Conexao::chamar()->prepare($sql);
				$stRow->execute($vetor);
				$qryRow = $stRow->fetchAll(PDO::FETCH_ASSOC);
				$row = count($qryRow);

        $selectCadastrosFilhos = "SELECT *
                             FROM transparencia_arquivo
                             WHERE id_nivel1 IN (
                                 SELECT id
                                 FROM $tb_nivel_1
                                 WHERE id_cliente = $idCliente
                                 AND status_registro = 'A'
                             )
                             AND status_registro = 'A'";

        $stCadastrosFilhos = Conexao::chamar()->prepare($selectCadastrosFilhos);
        $stCadastrosFilhos->execute();
        $qryCadastrosFilhos = $stCadastrosFilhos->fetchAll(PDO::FETCH_ASSOC);
        $totalCadastrosFilhos = count($qryCadastrosFilhos);

        $selectCategoria_1Filhos = "SELECT *
                                       FROM transparencia_categoria_nivel2
                                       WHERE id_nivel1 IN (
                                           SELECT id 
                                           FROM transparencia_categoria_nivel1
                                           WHERE id_cliente = $idCliente
                                           AND status_registro = 'A'
                                       )
                                       AND status_registro = 'A'";

        $stCategoria_1Filhos = Conexao::chamar()->prepare($selectCategoria_1Filhos);
        $stCategoria_1Filhos->execute();
        $qryCategoria_1Filhos = $stCategoria_1Filhos->fetchAll(PDO::FETCH_ASSOC);
        $totalCategoria_1Filhos = count($qryCategoria_1Filhos);

        $selectCategoria_2Filhos = "SELECT *
                                       FROM transparencia_categoria_nivel3
                                       WHERE id_nivel2 IN (
                                           SELECT id 
                                           FROM transparencia_categoria_nivel2
                                           WHERE id_cliente = $idCliente
                                           AND status_registro = 'A'
                                       )
                                       AND status_registro = 'A'";

        $stCategoria_2Filhos = Conexao::chamar()->prepare($selectCategoria_2Filhos);
        $stCategoria_2Filhos->execute();
        $qryCategoria_2Filhos = $stCategoria_2Filhos->fetchAll(PDO::FETCH_ASSOC);
        $totalCategoria_2Filhos = count($qryCategoria_2Filhos);

        $totalRegistrosFilhos = $totalCadastrosFilhos + $totalCategoria_1Filhos + $totalCategoria_2Filhos;

				if (empty($sort)) $sort = "id";
				if (empty($direction)) $direction = "DESC";

				$sql .= " ORDER BY $sort $direction LIMIT $firstPage, $max";
				$stObject = Conexao::chamar()->prepare($sql);
				$stObject->execute($vetor);
				$qryObject = $stObject->fetchAll(PDO::FETCH_ASSOC);

				include "includes/02-grid.php";
				if (count($qryObject) < 1) {
					echo alerta("warning", "<i class=\"fa fa-warning\"></i> Nenhum registro localizado.");
				}

				$link = $link . "&sort=$sort&direction=$direction";
				include_once "../../../privado/sistema/classes/includes/paginacao.php";
				paginacao($page, $row, $max, $link);
			} catch (PDOException $e) {
				echo alerta("danger", "<i class=\"fa fa-ban\"></i> Não foi possível carregar os registros.");
				echo "<script>console.log('Erro: " . addslashes($e->getMessage()) . "')</script>";
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