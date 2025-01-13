<?php
// include "../../../privado/sistema/conexao.php";
$busca = $_POST['busca'];

?>
<div class="row no-margin-left no-margin-right">
		<div class="container" style="padding: 20px 15px;min-height: 500px;">
			<h2 class="acessibilidade" style="color: #007CC2;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">Busca Avan&ccedil;ada</h2>
			<hr>

		<?php
		if(empty($busca)) {

			echo "<div class='acessibilidade alert alert-danger'>Nenhum termo informado para a pesquisa!</div>";

		} else {

			echo "<div class='acessibilidade alert alert-primary'>Resultados da busca para: <strong>{$busca}</strong></div>";

			$qryMenu = Conexao::chamar()->prepare("SELECT id
																	FROM controle_menu
																	WHERE status_registro = :status_registro
																	ORDER BY descricao ASC");

			$qryMenu->bindValue(":status_registro", "A", PDO::PARAM_STR);
			$qryMenu->execute();
			$buscaMenu = $qryMenu->fetchAll();
			echo "<div class='panel-group' id='accordion'>";
			foreach ($buscaMenu as $indice => $menu) {
				
				switch ($menu['id']) {

					case "5":
						$qryNoticia = Conexao::chamar()->prepare("SELECT * 
                                                      FROM noticia 
                                                      WHERE id_cliente = '$idCliente' 
                                                      AND (data_inicial IS NULL 
                                                      OR data_inicial <= CURRENT_DATE())
                                                      AND (data_limite IS NULL 
                                                      OR data_limite >= CURRENT_DATE())
                                                      AND status_registro = 'A' 
                                                      AND (chapeu LIKE '%{$busca}%' OR fonte LIKE '%{$busca}%' OR artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
						$qryNoticia->execute();
						$buscaNoticia = $qryNoticia->fetchAll(PDO::FETCH_ASSOC);
						if(count($buscaNoticia) > 0) {
							echo "<div class='panel panel-default'>
									
									<div style='background-color: #007CC2; color: #fff;padding: 5px 10px 1px 10px;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
										<h3 class='acessibilidade panel-title'>NOT&Iacute;CIAS <i style='color: #fff;margin-top: 5px;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
									</div>
									
									<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
										<div class='panel-body' style='border: 2px solid aliceblue;'>";
							foreach($buscaNoticia as $linkNoticia) {
									echo "<p style='padding:10px;'><a href='{$CAMINHO}noticias/{$linkNoticia['id']}'>".$linkNoticia['titulo']."</a></p>";
							}
								echo "</div>
									</div>
								</div>";
							echo "<p>&nbsp;</p>";
						} else {
              echo "<p style='padding:10px;'>Nenhum resultado encontrado.</p>";
            }
						break;

					// case "125":
					// 	$qryAta = Conexao::chamar()->prepare("SELECT * FROM ata WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryAta->execute();
					// 	$buscaAta = $qryAta->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaAta) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>ATAS <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaAta as $linkAta) {
					// 				echo "<p><a href='{$CAMINHO}ata/{$linkAta['id']}'>{$linkAta['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "110":
					// 	$qryCenso = Conexao::chamar()->prepare("SELECT * FROM censo WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryCenso->execute();
					// 	$buscaCenso = $qryCenso->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaCenso) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>CENSO PREVIDENCI&Aacute;RIO <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaCenso as $linkCenso) {
					// 				echo "<p><a href='{$CAMINHO}censo/{$linkCenso['id']}'>{$linkCenso['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "128":
					// 	$qryConvenio = Conexao::chamar()->prepare("SELECT * FROM convenio WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryConvenio->execute();
					// 	$buscaConvenio = $qryConvenio->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaConvenio) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>CONV&Ecirc;NIO PREVIDENCI&Aacute;RIO <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaConvenio as $linkConvenio) {
					// 				echo "<p><a href='{$CAMINHO}convenio/{$linkConvenio['id']}'>{$linkConvenio['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "122":
					// 	$qryControleSocial = Conexao::chamar()->prepare("SELECT * FROM controle_social WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryControleSocial->execute();
					// 	$buscaControleSocial = $qryControleSocial->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaControleSocial) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>CONTROLE SOCIAL <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaControleSocial as $linkControleSocial) {
					// 				echo "<p><a href='{$CAMINHO}controle_social/{$linkControleSocial['id']}'>{$linkControleSocial['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "94":
					// 	$qryEstrutura = Conexao::chamar()->prepare("SELECT * FROM estrutura WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryEstrutura->execute();
					// 	$buscaEstrutura = $qryEstrutura->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaEstrutura) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>ESTRUTURA <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaEstrutura as $linkEstrutura) {
					// 				echo "<p><a href='{$CAMINHO}estrutura/{$linkEstrutura['id']}'>{$linkEstrutura['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "95":
					// 	$qryGaleriaFoto = Conexao::chamar()->prepare("SELECT * FROM galeria_foto WHERE status_registro = 'A' AND (linha_fina LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryGaleriaFoto->execute();
					// 	$buscaGaleriaFoto = $qryGaleriaFoto->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaGaleriaFoto) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>GALERIA DE FOTOS <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaGaleriaFoto as $linkGaleriaFoto) {
					// 				echo "<p><a href='{$CAMINHO}galeria_foto/{$linkGaleriaFoto['id']}'>{$linkGaleriaFoto['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "93":
					// 	$qryHistoria = Conexao::chamar()->prepare("SELECT * FROM historia WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryHistoria->execute();
					// 	$buscaHistoria = $qryHistoria->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaHistoria) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>HIST&Oacute;RIA <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaHistoria as $linkHistoria) {
					// 				echo "<p><a href='{$CAMINHO}historia/{$linkHistoria['id']}'>{$linkHistoria['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "101":
					// 	$qryInformativo = Conexao::chamar()->prepare("SELECT * FROM informativo WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR edicao LIKE '%{$busca}%' OR ano LIKE '%{$busca}%')");
					// 	$qryInformativo->execute();
					// 	$buscaInformativo = $qryInformativo->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaInformativo) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>INFORMATIVO <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaInformativo as $linkInformativo) {
					// 				echo "<p><a href='{$CAMINHO}informativo/{$linkInformativo['id']}'>{$linkInformativo['edicao']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "10":
					// 	$qryInstitucional = Conexao::chamar()->prepare("SELECT * FROM institucional WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryInstitucional->execute();
					// 	$buscaInstitucional = $qryInstitucional->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaInstitucional) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>INSTITUCIONAL <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaInstitucional as $linkInstitucional) {
					// 				echo "<p><a href='{$CAMINHO}institucional/{$linkInstitucional['id']}'>{$linkInstitucional['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "119":
					// 	$qryInvestimento = Conexao::chamar()->prepare("SELECT * FROM investimento WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryInvestimento->execute();
					// 	$buscaInvestimento = $qryInvestimento->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaInvestimento) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>INVESTIMENTO <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaInvestimento as $linkInvestimento) {
					// 				echo "<p><a href='{$CAMINHO}investimento/{$linkInvestimento['id']}'>{$linkInvestimento['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "104":
					// 	$qryLegislativo = Conexao::chamar()->prepare("SELECT * FROM legislativo WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryLegislativo->execute();
					// 	$buscaLegislativo = $qryLegislativo->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaLegislativo) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>LEGISLATIVO <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaLegislativo as $linkLegislativo) {
					// 				echo "<p><a href='{$CAMINHO}legislativo/{$linkLegislativo['id']}'>{$linkLegislativo['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "142":
					// 	$qryPesquisaSatisfacao = Conexao::chamar()->prepare("SELECT * FROM pesquisa WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryPesquisaSatisfacao->execute();
					// 	$buscaPesquisaSatisfacao = $qryPesquisaSatisfacao->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaPesquisaSatisfacao) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>PESQUISA DE SATISFAÇÃO <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaPesquisaSatisfacao as $linkPesquisaSatisfacao) {
					// 				echo "<p><a href='{$CAMINHO}pesquisa_satisfacao/{$linkPesquisaSatisfacao['id']}'>{$linkPesquisaSatisfacao['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;
					// case "107":
					// 	$qryPlanejamento = Conexao::chamar()->prepare("SELECT * FROM planejamento WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryPlanejamento->execute();
					// 	$buscaPlanejamento = $qryPlanejamento->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaPlanejamento) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>PLANEJAMENTO <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaPlanejamento as $linkPlanejamento) {
					// 				echo "<p><a href='{$CAMINHO}planejamento/{$linkPlanejamento['id']}'>{$linkPlanejamento['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "107":
					// 	$qryPrevidencia = Conexao::chamar()->prepare("SELECT * FROM previdencia WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
					// 	$qryPrevidencia->execute();
					// 	$buscaPrevidencia = $qryPrevidencia->fetchAll(PDO::FETCH_ASSOC);
					// 	if(count($buscaPrevidencia) > 0) {
					// 		echo "<div class='panel panel-default'>
									
					// 				<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
					// 					<h3 class='acessibilidade panel-title'>PREVID&Ecirc;NCIA SOCIAL <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
					// 				</div>
									
					// 				<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
					// 					<div class='panel-body'>";
					// 		foreach($buscaPrevidencia as $linkPrevidencia) {
					// 				echo "<p><a href='{$CAMINHO}previdencia/{$linkPrevidencia['id']}'>{$linkPrevidencia['titulo']}</a></p>";
					// 		}
					// 			echo "</div>
					// 				</div>
					// 			</div>";
					// 		echo "<p>&nbsp;</p>";
					// 	}
					// 	break;

					// case "116":
						$qryPrograma = Conexao::chamar()->prepare("SELECT * FROM programa WHERE status_registro = 'A' AND (artigo LIKE '%{$busca}%' OR titulo LIKE '%{$busca}%')");
						$qryPrograma->execute();
						$buscaPrograma = $qryPrograma->fetchAll(PDO::FETCH_ASSOC);
						if(count($buscaPrograma) > 0) {
							echo "<div class='panel panel-default'>
									
									<div style='background-color: #007CC2; color: #fff;' class='panel-heading' data-toggle='collapse' data-parent='#accordion' href='#collapse{$menu['id']}' >
										<h3 class='acessibilidade panel-title'>PROGRAMAS <i style='color: #fff;' class='fa fa-plus pull-right' aria-hidden='true'></i></h3>
									</div>
									
									<div id='collapse{$menu['id']}' class='panel-collapse collapse in'>
										<div class='panel-body'>";
							foreach($buscaPrograma as $linkPrograma) {
									echo "<p><a href='{$CAMINHO}programas/{$linkPrograma['id']}'>{$linkPrograma['titulo']}</a></p>";
							}
								echo "</div>
									</div>
								</div>";
							echo "<p>&nbsp;</p>";
						}
						break;
				}
			}	
			echo "</div>";
		}
		?>

	</div>
</div>