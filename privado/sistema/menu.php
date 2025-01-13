
<?php
function buscaSubmenu($id) {
	$submenu = array();
	$stSubMenu = Conexao::chamar()->prepare("SELECT controle_menu.* 
											   FROM controle_menu_usuario 
										  LEFT JOIN controle_menu ON controle_menu.id = controle_menu_usuario.id_menu 
											  WHERE controle_menu_usuario.id_usuario = :id_usuario
												AND controle_menu.id_menu = :id_menu
												AND controle_menu.status_registro = :status_registro
										   ORDER BY controle_menu.ordem, controle_menu.id");
	$stSubMenu->execute(array("id_menu" => $id, "id_usuario" => $_COOKIE["id_usuario"], "status_registro" => "A"));

	$qrySubMenu = $stSubMenu->fetchAll(PDO::FETCH_ASSOC);
	foreach ( $qrySubMenu as $sub) {
		$sub['menu'] = buscaSubMenu($sub['id']);
		array_push($submenu, $sub);
	}
	return $submenu;
}

$menuPrincipal = array();

$stMenu = Conexao::chamar()->prepare("SELECT *
										FROM controle_menu
									   WHERE id_menu IS NULL
										 AND status_registro = :status_registro
									ORDER BY ordem");
$stMenu->execute(array("status_registro" => "A"));
$qryMenu = $stMenu->fetchAll(PDO::FETCH_ASSOC);

foreach ($qryMenu as $menu) {
	$menu['menu'] = buscaSubMenu($menu['id']);
	array_push($menuPrincipal, $menu);
}


?>

<nav id="sidebar">
	<div class="sidebar-header text-center">
			<a href="<?= $publicoSistema ?>/inicio.php" >
				<img style="padding-top: 30px; padding-bottom: 30px; margin:0 auto" src="<?= $caminhoImg ?>/logo_inga.png" alt="Sistema" />
			</a>
	</div>
	<div>
		<?php foreach ($menuPrincipal as $indice => $item) {
		if(count($item['menu'])) {
		?>
		<a data-toggle="collapse" href="#ul_lista_<?= $indice ?>">
			<p class="indice-menu-personalizado">
				<i class="<?= $item['icone'] ?> pull-left" style="font-size: 20px;"></i>
				<?php echo $item['descricao'] ?>
			</p>
		</a>
		<ul class="list-unstyled components collapse submenu-lateral" id="ul_lista_<?= $indice ?>">
			<?php foreach ($item['menu'] as $item2) { ?>
				<?php 	$link = "inicio.php?&tela=" . $item2['id'] . "&time=" . time(); ?>
				<?php if(count($item2['menu']) > 0) { ?>
					<li>
					<a href="#" class="a-menu" data-target="#menu_<?= $item2['id'] ?>" data-toggle="collapse">
						<i class="<?= $item2['icone'] ?> a-menu-i"></i> <?= $item2['descricao'] ?> 
					</a>
						<ul class="collapse list-unstyled" id="menu_<?= $item2['id'] ?>">
							<?php
								foreach ($item2['menu'] as $item3) {
								$link3 = "inicio.php?&tela=" . $item3['id'] . "&time=" . time(); 
							?>
								<li class="submenu-lateral">
									<a href="<?=$link3?>">
										<i class="<?= $item3['icone'] ?>"></i>
										<?= $item3['descricao'] ?>
										
									</a>
								</li>
							<?php } ?>
						</ul>
					</li>
				<?php } else { ?>
					<li>
						<a href="<?=$link?>">
							<i class="<?= $item2['icone'] ?>"></i>
							<?= $item2['descricao'] ?>
						</a>
					</li>
				<?php } ?>
			<?php } ?>
		<?php } else {	?>
			<ul class="list-unstyled components collapse" id="ul_lista_<?= $indice ?>">
				<li><a href="<?="inicio.php?&tela=" . $item['id'] . "&time=" . time(); ?>"><?= $item['descricao'] ?></a></li>
			</ul>
		<?php } ?>
		</ul>
		<?php } ?>

		<p  class="indice-menu-personalizado">
		<i class="fa fa-sign-out pull-left" style="font-size: 20px;"></i>
		<a href="#" class="sair-sistema" onclick="logoff()">Sair do Sistema</a>
		</p>
	</div>
		
</nav>