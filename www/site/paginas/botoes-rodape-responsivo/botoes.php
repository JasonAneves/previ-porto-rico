<div class="bloco-btns-responsivo">
  <div class="btn-responsivo">
    <div class="busca-responsivo">
      <a href="<?=$CAMINHO?>">
        <button type="submit" class="btn" id="home">
          <span>
            <img src="<?=$CAMINHO?>assets/images/homepage.svg" alt="Home">
          </span>
        </button>
      </a>
    </div>
  </div>
  <div class="btn-responsivo">
    <div class="busca-responsivo">
      <button type="submit" class="btn" data-toggle="modal" data-target="#exampleModal">
        <span>
          <img src="<?=$CAMINHO?>assets/images/lupa.svg" alt="Botão Busca">
        </span>
      </button>
    </div>
  </div>
  <div class="btn-responsivo">
    <nav class="navbar navbar-expand-lg navbar-light bg-light sidebarNavigation" data-sidebarClass="navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?=$CAMINHO?>"><img src="<?=$CAMINHO?>assets/images/ico_home.svg" alt=""></a>
        <button class="navbar-toggler rightNavbarToggler" type="button" data-toggle="collapse" data-target="#navbarMenu"
            aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
              <li class="nav-item dropdown">
                <a class="nav-link acessibilidade" href="#" id="institucional" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">INSTITUCIONAL</a>
                <div class="dropdown-menu" aria-labelledby="institucional">
                  <?php
                    $queryInst = Conexao::chamar()->prepare("SELECT id, titulo FROM institucional WHERE id_cliente = '$idCliente' AND status_registro = :status_registro");
                    $queryInst->bindValue(":status_registro", "A", PDO::PARAM_STR);
                    $queryInst->execute();
                    $sql = $queryInst->fetchAll(PDO::FETCH_ASSOC);
                  ?>
                    
                  <?php foreach($sql as $inst): ?>
                    <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>institucional/<?= $inst['id'] ?>"><p style="white-space: normal;"><?= $inst['titulo'] ?></p></a>                               
                  <?php endforeach; ?>
                </div>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link acessibilidade" href="#" id="estrutura" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">ESTRUTURA</a>
                <div class="dropdown-menu" aria-labelledby="estrutura">
                  <?php
                    $queryInst = Conexao::chamar()->prepare("SELECT id, titulo FROM estrutura WHERE id_cliente = '$idCliente' AND status_registro = :status_registro");
                    $queryInst->bindValue(":status_registro", "A", PDO::PARAM_STR);
                    $queryInst->execute();
                    $sql = $queryInst->fetchAll(PDO::FETCH_ASSOC);
                  ?>
              
                  <?php foreach($sql as $inst): ?>
                    <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>estrutura/<?= $inst['id'] ?>"><p style="white-space: normal;"><?= $inst['titulo'] ?></p></a>                               
                  <?php endforeach; ?>
                </div>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link acessibilidade" href="#" id="convenios" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  CONV&Ecirc;NIOS
                </a>
                <div class="dropdown-menu" aria-labelledby="convenios">
                  <?php
                    $queryInst = Conexao::chamar()->prepare("SELECT id, nome FROM convenio_instituicao WHERE id_cliente = '$idCliente' AND status_registro = :status_registro");
                    $queryInst->bindValue(":status_registro", "A", PDO::PARAM_STR);
                    $queryInst->execute();
                    $sql = $queryInst->fetchAll(PDO::FETCH_ASSOC);
                  ?>
                
                  <?php foreach($sql as $inst): ?>
                    <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>convenios/<?= $inst['id'] ?>"><p style="white-space: normal;"><?= $inst['nome'] ?></p></a>                               
                  <?php endforeach; ?>
                </div>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link acessibilidade" href="#" id="investimento" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  INVESTIMENTOS
                </a>
                <div class="dropdown-menu" aria-labelledby="investimento">
                  <?php
                    $queryInst = Conexao::chamar()->prepare("SELECT id, descricao FROM investimento_categoria WHERE id_cliente = '$idCliente' AND status_registro = :status_registro");
                    $queryInst->bindValue(":status_registro", "A", PDO::PARAM_STR);
                    $queryInst->execute();
                    $sql = $queryInst->fetchAll(PDO::FETCH_ASSOC);
                  ?>
              
                  <?php foreach($sql as $inst): ?>
                    <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>investimento/<?= $inst['id'] ?>"><p style="white-space: normal;"><?= $inst['descricao'] ?></p></a>                              
                  <?php endforeach; ?>
                </div>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link acessibilidade" href="#" id="previdencia" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  PREVID&Ecirc;NCIA
                </a>
                <div class="dropdown-menu" aria-labelledby="previdencia">
                  <?php
                    $queryInst = Conexao::chamar()->prepare("SELECT id, titulo FROM previdencia WHERE id_cliente = '$idCliente' AND status_registro = :status_registro");
                    $queryInst->bindValue(":status_registro", "A", PDO::PARAM_STR);
                    $queryInst->execute();
                    $sql = $queryInst->fetchAll(PDO::FETCH_ASSOC);
                  ?>
              
                  <?php foreach($sql as $inst): ?>
                    <a class="dropdown-item acessibilidade" href="<?= $CAMINHO ?>previdencia/<?= $inst['id'] ?>"><p style="white-space: normal;"><?= $inst['titulo'] ?></p></a>                               
                  <?php endforeach; ?>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link acessibilidade" href="<?= $CAMINHO ?>contato/"> FALE CONOSCO </a>
              </li>
            </ul>
        </div>
      </div>
    </nav>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="custom-search-input">
        <div class="input-group">
        <form action="<?=$CAMINHO?>pesquisa" method="post" class="busca-topo-form">
          <input type="text" name="busca" class="search-query form-control" value="" required="required" title="busca" placeholder="Busca">
          <button type="submit" ><span><img src="<?=$CAMINHO?>assets/images/lupa.svg" alt="Botão Busca"></span></button>
        </form>
        </div>
      </div>
      </div>
      </div>
    </div>
  </div>
</div>