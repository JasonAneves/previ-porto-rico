<style>
.titulo {
  display: grid;
  justify-items: center;
  width: 100%;
  margin: 20px 0;
}
.titulo h1 {
  text-align: center;
  font: normal normal 900 32px/47px Oswald;
  letter-spacing: 4.32px;
  color: #000000;
  opacity: 1;
}
.tracoTitulo {
  border-bottom: 4px solid #007CC2;
  margin-bottom: 20px;
  width: 94px;
}
.identidade{
    background-color: #007CC2;
    display: flex;
    align-items: center;
    height: 60px;
}
.identidade h2 {
    text-align: left;
    font: normal normal bold 22px/29px Roboto;
    letter-spacing: 0px;
    color: #FFFFFF;
    opacity: 1;
    margin-left: 220px;
    margin-top: 8px;
}
.identidade img {
    border-radius: 50%;
    object-fit: cover;
    position: absolute;
    width: 120px;
    height: 120px;
    margin-left: 40px;
}
.cargo {
    display: flex;
    border-bottom: solid 1px #707070;
    height: 70px;
    align-items: center;
    margin-bottom: 65px;
    padding-left: 15px;
}
.cargo h2 {
  margin-left: 205px;
  width: -webkit-fill-available;
  font-size: 22px;
}
.cargo-email{
    display: flex;
    justify-content: flex-end;
    align-items: center;
    width: 100%;
    margin-right: 25px;
}
.cargo-email img {
  padding: 0 13px;
}
.email{
    text-align: left;
    font: normal normal 300 18px/22px Roboto;
    letter-spacing: 2.99px;
    color: #000000;
    opacity: 1;
}
a:hover{
    text-decoration: none;
}


  @media (max-width: 991px){
    .row {
      display: flex;
      justify-content: center;
    }
    .cargo-email img {
      width: 50px;
    }
    .email {
    font: normal normal 300 13px/22px Roboto;
    letter-spacing: 1.99px;
  }
}

  @media (max-width: 767px) {

  .identidade {
  height: 40px;
  }
  .identidade h2 {
    margin-left: auto;
    margin-right: 10px;
  }
  .identidade img {
    width: 100px;
    height: 100px;
  }
  .cargo {
    display: flex;
    flex-direction: column;
    border-bottom: solid 1px #707070;
    height: 70px;
    align-items: center;
    margin-bottom: 65px;
    padding-left: 2px;
    margin-top: 10px;
  }
  .cargo h2 {
    margin-left: auto;
    text-align: right;
  }
  .cargo-email {
    margin-right: 0;
  }
}

@media (max-width: 427px) {
  .cargo h2 {
    margin-left: 0;
    text-align: right;
  }
  .cargo-email {
    margin-right: 0;
  }
  .identidade img {
    width: 80px;
    height: 80px;
    margin-left: 10px;
  }
  .identidade h2 {
    font-size: 15px;
    margin-left: auto;
    margin-right: 10px;
  }
}

@media (max-width: 320px) {
  .cargo-email img {
    display: none;
  }
}
</style>

<?php
    $codObra = explode('/', $_GET['cod'])[1];

		$qryCat = Conexao::chamar()->prepare("SELECT * FROM diretoria WHERE status_registro = 'A' AND id_obra_unida = '$codObra'");
		$qryCat->execute();
		$BuscaCat = $qryCat->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="row">
    <div class="container">
        <div class="col-md-12">
            <div class="titulo">
                <h1 class="acessibilidade">DIRETORIA</h1>
                <div class="tracoTitulo"></div>
            </div>
            <br>
            <?php foreach($BuscaCat as $cat): ?>
            <div>
                <div class="identidade">
                    <img src="<?=$CAMINHO ?>/sistema/imagens/<?= $cat["id_cliente"]?>/<?= $cat["foto"]?>" style="padding: 0 13px;border-radius: 129px;
                    width: 120px;">
                    <h2>
                        <?= $cat["nome_diretoria"]?>
                    </h2>
                </div>
                <div class="cargo">
                    <h2>
                        <?= $cat["cargo"]?>
                    </h2>
                    <div class="cargo-email">
                        <img src="<?=$CAMINHO ?>/assets/images/ico_email.svg" style="padding: 0 13px; ">
                        <p class="email">
                            <?= $cat["email"]?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

