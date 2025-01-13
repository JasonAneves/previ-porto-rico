<?php
  $idExcluir = isset($_REQUEST['id_excluir']);
    $tabela_arquivo = "transparencia_arquivo";
    $tb_nivel_1     = "transparencia_categoria_nivel1";
    $tb_nivel_2     = "transparencia_categoria_nivel2";
    $tb_nivel_3     = "transparencia_categoria_nivel3";
  if($idExcluir) {
    include_once "$root/privado/sistema/classes/includes/excluir.php";
    excluir($_REQUEST['id_excluir'], $tabela_arquivo);
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

      $statusRegistro = '';
      $descricao      = '';

      $id_nivel_1     = '';
      $categoria_1    = '';

      $id_nivel_2     = '';
      $categoria_2    = '';

      $id_nivel_3     = '';
      $categoria_3    = '';

      if ($_POST) {
        $id_nivel1 = filter_var($_POST['id_nivel1']);
        $id_nivel2 = filter_var($_POST['id_nivel2']);
        $id_nivel3 = filter_var($_POST['id_nivel3']);
        $descricao = filter_var($_POST['descricao']);
        $statusRegistro = filter_var($_POST['status_registro']);
			}

      if($_GET['id_nivel1'] != ''){
        $id_nivel1 = filter_var($_GET['id_nivel1']);
      }

      if($_GET['id_nivel2'] != ''){
        $id_nivel2 = filter_var($_GET['id_nivel2']);
      }

      if($_GET['id_nivel3'] != ''){
        $id_nivel3 = filter_var($_GET['id_nivel3']);
      }

      if($_GET['descricao'] != ''){
        $descricao = filter_var($_GET['descricao']);
      }
      
			try {
       $sql = "SELECT $tabela_arquivo.*,
                      $tb_nivel_1.descricao AS categoria_1,
                      $tb_nivel_2.descricao AS categoria_2,
                      $tb_nivel_3.descricao AS categoria_3
                 FROM $tabela_arquivo
            LEFT JOIN $tb_nivel_1 ON $tabela_arquivo.id_nivel1 = $tb_nivel_1.id
            LEFT JOIN $tb_nivel_2 ON $tabela_arquivo.id_nivel2 = $tb_nivel_2.id
            LEFT JOIN $tb_nivel_3 ON $tabela_arquivo.id_nivel3 = $tb_nivel_3.id
                WHERE $tabela_arquivo.status_registro = :status_registro ";

        if ($id_nivel1 != "") {
          $sql .= "AND transparencia_arquivo.id_nivel1 = :id_nivel1 ";
          $vetor['id_nivel1'] = $id_nivel1;
					$link .= "&id_nivel1=" . urlencode($id_nivel1);
				}
        
				if ($id_nivel2 != "") {
          $sql .= "AND transparencia_arquivo.id_nivel2 = :id_nivel2 ";
					$vetor['id_nivel2'] = $id_nivel2;
					$link .= "&id_nivel2=" . urlencode($id_nivel2);
				}
        
				if ($id_nivel3 != "") {
          $sql .= "AND transparencia_arquivo.id_nivel3 = :id_nivel3 ";
					$vetor['id_nivel3'] = $id_nivel3;
					$link .= "&id_nivel3=" . urlencode($id_nivel3);
				}
        
				if ($descricao != "") {
          $sql .= "AND transparencia_arquivo.descricao LIKE :descricao ";
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
				$row = count($qryRow);;

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
