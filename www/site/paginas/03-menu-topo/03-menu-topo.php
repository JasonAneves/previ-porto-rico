<div class="container-fluid menu-topo no-padding">
  <div class="container no-padding menu-center">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <nav class="navbar navbar-expand-lg navbar-light bg-light sidebarNavigation" data-sidebarClass="navbar-light bg-light">
      <div class="container-fluid no-padding">
        <div class="collapse navbar-collapse" id="navbarMenu">
          <ul class="nav navbar-nav nav-flex-icons ml-auto">
            <a class="navbar-brand" href="<?= $CAMINHO ?>"><img src="<?= $CAMINHO ?>assets/images/homepage.svg" alt=""></a>
            <button class="navbar-toggler rightNavbarToggler" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <li class="nav-item dropdown">
              <a class="nav-link acessibilidade" href="#" id="institucional" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                INSTITUCIONAL
              </a>
              <div class="dropdown-menu" aria-labelledby="institucional">
                <?php
                $qryInstitucional = Conexao::chamar()->prepare("SELECT id, titulo FROM institucional WHERE id_cliente = :id_cliente AND status_registro = :status_registro");
                $qryInstitucional->bindValue(":status_registro", "A", PDO::PARAM_STR);
                $qryInstitucional->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
                $qryInstitucional->execute();
                $qryInstitucional = $qryInstitucional->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php foreach ($qryInstitucional as $institucional): ?>
                  <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>institucional/<?= $institucional['id'] ?>"><?= $institucional['titulo'] ?></a>
                <?php endforeach; ?>
                <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>eventos">Eventos</a>
                <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>galeria_fotos">Galeria de Fotos</a>
                <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>videos">Galeria de V&iacute;deos</a>
              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link acessibilidade" href="#" id="estrutura" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ESTRUTURA
              </a>
              <div class="dropdown-menu" aria-labelledby="estrutura">

                <?php
                $qryEstrutura = Conexao::chamar()->prepare("SELECT id, titulo FROM estrutura WHERE id_cliente = :id_cliente AND status_registro = :status_registro ORDER BY titulo");
                $qryEstrutura->bindValue(":status_registro", "A", PDO::PARAM_STR);
                $qryEstrutura->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
                $qryEstrutura->execute();
                $sqlEstrutura = $qryEstrutura->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php foreach ($sqlEstrutura as $estrutura): ?>
                  <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>estrutura/<?= $estrutura['id'] ?>"><?= $estrutura['titulo'] ?></a>
                <?php endforeach; ?>
                <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>organograma">Organograma</a>
              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link acessibilidade" href="#" id="convenios" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                AVALIAÇÃO ATUARIAL </a>
              <div class="dropdown-menu" aria-labelledby="convenios">
                <?php
                $qryConvenios = Conexao::chamar()->prepare("SELECT id, descricao FROM convenio_categoria WHERE id_cliente = :id_cliente AND status_registro = :status_registro ORDER BY descricao");
                $qryConvenios->bindValue(":status_registro", "A", PDO::PARAM_STR);
                $qryConvenios->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
                $qryConvenios->execute();
                $sqlConvenios = $qryConvenios->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php if (empty($sqlConvenios)) { ?>
                  <p>Sem cadastro</p>
                <?php } else { ?>
                  <?php foreach ($sqlConvenios as $convenios) { ?>
                    <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>convenios/<?= $convenios['id'] ?>"><?= $convenios['descricao'] ?></a>
                  <?php } ?>
                <?php } ?>


              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link acessibilidade" href="#" id="investimento" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                INVESTIMENTOS
              </a>
              <div class="dropdown-menu" aria-labelledby="investimento">
                <?php
                $qryInvestimentos = Conexao::chamar()->prepare("SELECT id, descricao FROM investimento_categoria WHERE id_cliente = :id_cliente AND status_registro = :status_registro ORDER BY descricao");
                $qryInvestimentos->bindValue(":status_registro", "A", PDO::PARAM_STR);
                $qryInvestimentos->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
                $qryInvestimentos->execute();
                $sqlInvestimentos = $qryInvestimentos->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php if (empty($sqlInvestimentos)) { ?>
                  <p>Sem cadastro</p>
                <?php } else { ?>
                  <?php foreach ($sqlInvestimentos as $investimentos) { ?>
                    <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>investimento/<?= $investimentos['id'] ?>"><?= $investimentos['descricao'] ?></a>
                  <?php } ?>
                <?php } ?>


              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link acessibilidade" href="#" id="previdencia" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                PREVID&Ecirc;NCIA
              </a>
              <div class="dropdown-menu" aria-labelledby="previdencia">
                <?php
                $qryPrevidencia = Conexao::chamar()->prepare("SELECT id, descricao FROM previdencia_categoria WHERE id_cliente = :id_cliente AND status_registro = :status_registro ORDER BY descricao");
                $qryPrevidencia->bindValue(":status_registro", "A", PDO::PARAM_STR);
                $qryPrevidencia->bindValue("id_cliente", $idCliente, PDO::PARAM_STR);
                $qryPrevidencia->execute();
                $sqlPrevidencia = $qryPrevidencia->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php if (empty($sqlPrevidencia)) { ?>
                  <p>Sem cadastro</p>
                <?php } else { ?>
                  <?php foreach ($sqlPrevidencia as $previdencia) { ?>
                    <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>previdencia/<?= $previdencia['id'] ?>"><?= $previdencia['descricao'] ?></a>
                  <?php } ?>
                <?php } ?>


              </div>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link acessibilidade" href="#" id="previdencia" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                SERVI&Ccedil;OS
              </a>
              <div class="dropdown-menu" aria-labelledby="previdencia">

                <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>servico/censo">Censo</a>
                <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>servico/controle_social">Controle Social</a>
                <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>downloads">Download</a>
                <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>informativo">Informativos</a>
                <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>perguntas">Perguntas Frequentes</a>
                <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>pesquisa_satisfacao">Pesquisa</a>
                <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>planejamento">Planejamento</a>
                <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>programas">Programas</a>

              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link acessibilidade" href="<?= $CAMINHO ?>contato/">
                FALE CONOSCO
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>

<script>
  window.onload = function() {
    if (window.jQuery) {
      $(document).ready(function() {
        $(".sidebarNavigation .navbar-collapse")
          .hide().clone().appendTo("body").removeAttr("class").addClass("sideMenu").show();
        $("body").append("<div class='overlay'></div>");
        $(".navbar-toggle, .navbar-toggler").on("click", function() {
          $(".sideMenu").addClass($(".sidebarNavigation").attr("data-sidebarClass"));
          $(".sideMenu, .overlay").toggleClass("open");
          $(".overlay").on("click", function() {
            $(this).removeClass("open");
            $(".sideMenu").removeClass("open")
          })
        });
        $("body").on("click", ".sideMenu.open .nav-item", function() {
          if (!$(this).hasClass("dropdown")) {
            $(".sideMenu, .overlay").toggleClass("open")
          }
        });
        $(window).resize(function() {
          if ($(".navbar-toggler").is(":hidden")) {
            $(".sideMenu, .overlay").hide()
          } else {
            $(".sideMenu, .overlay").show()
          }
        })
      })
    } else {
      console.log("sidebarNavigation Requires jQuery")
    }
  }
</script>