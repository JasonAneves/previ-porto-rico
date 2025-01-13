<?php
  $idExcluir = isset($_REQUEST['id_excluir']);
    $tb_nivel_1 = "transparencia_categoria_nivel1";
    $tb_nivel_2 = "transparencia_categoria_nivel2";
    $tb_nivel_3 = "transparencia_categoria_nivel3";
  if($idExcluir) {
    include_once "$root/privado/sistema/classes/includes/excluir.php";
    excluir($_REQUEST['id_excluir'], $tb_nivel_3);
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
        $id_nivel1 = filter_var($_POST['id_nivel1']);
        $id_nivel2 = filter_var($_POST['id_nivel2']);
        $descricao = filter_var($_POST['descricao']);
        $statusRegistro = filter_var($_POST['status_registro']);
			}

      if($_GET['id_nivel1'] != ''){
        $id_nivel1 = filter_var($_GET['id_nivel1']);
      }

      if($_GET['id_nivel2'] != ''){
        $id_nivel2 = filter_var($_GET['id_nivel2']);
      }

      if($_GET['descricao'] != ''){
        $descricao = filter_var($_GET['descricao']);
      }

			try { 
				$sql = "SELECT $tb_nivel_3.*,
                       $tb_nivel_1.descricao AS categoria,
                       $tb_nivel_2.descricao AS subcategoria
                  FROM $tb_nivel_3
             LEFT JOIN $tb_nivel_2 ON $tb_nivel_3.id_nivel2 = $tb_nivel_2.id
             LEFT JOIN $tb_nivel_1 ON $tb_nivel_2.id_nivel1 = $tb_nivel_1.id
                 WHERE $tb_nivel_3.status_registro = :status_registro ";

				if ($id_nivel1 != "") {
          $sql .= "AND ". $tb_nivel_3 .".id_nivel1 = :id_nivel1 ";
					$vetor['id_nivel1'] = $id_nivel1;
					$link .= "&id_nivel1=" . urlencode($id_nivel1);
				}

				if ($id_nivel2 != "") {
          $sql .= "AND ". $tb_nivel_3 .".id_nivel2 = :id_nivel2 ";
					$vetor['id_nivel2'] = $id_nivel2;
					$link .= "&id_nivel2=" . urlencode($id_nivel2);
				}
        
				if ($descricao != "") {
          $sql .= "AND ". $tb_nivel_3 .".descricao LIKE :descricao ";
					$vetor['descricao'] = "%$descricao%";
					$link .= "&descricao=" . urlencode($descricao);
				}

        if ($idUsuarioMaster && $statusRegistro == "I") {
          $vetor["status_registro"] = "I";
          $link .= "&status_registro=I";
        } else $vetor["status_registro"] = "A ";

				$stRow = Conexao::chamar()->prepare($sql);
				$stRow->execute($vetor);
				
				$qryRow = $stRow->fetchAll(PDO::FETCH_ASSOC);
				$row = count($qryRow);

        $selectCadastrosFilhos = "SELECT *
                                 FROM transparencia_arquivo
                                 WHERE id_nivel3 IN (
                                     SELECT id 
                                     FROM $tb_nivel_3
                                     WHERE id_cliente = $idCliente
                                     AND status_registro = 'A'
                                 )
                                 AND status_registro = 'A'";

        $stCadastrosFilhos = Conexao::chamar()->prepare($selectCadastrosFilhos);
        $stCadastrosFilhos->execute();
        $qryCadastrosFilhos = $stCadastrosFilhos->fetchAll(PDO::FETCH_ASSOC);
        $totalCadastrosFilhos = count($qryCadastrosFilhos);

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