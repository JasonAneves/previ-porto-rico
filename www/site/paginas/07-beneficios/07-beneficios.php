<?php
$qryBeneficio = Conexao::chamar()->prepare("SELECT *
                                                FROM beneficios
                                              WHERE id_cliente = :cliente
                                                AND status_registro = :status_registro
                                              ORDER BY id DESC");
$qryBeneficio->execute(array(":cliente" => $idCliente, ":status_registro" => "A"));
$StBeneficios = $qryBeneficio->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="fundo_beneficios">
  <div class="container container_beneficios">

    <div class="div_titulo_beneficios">
      <h1 class="acessibilidade titulo-beneficios ">Servi&ccedil;os mais Procurados</h1>
      <div class="barra_beneficios"></div>
    </div>


    <div class="owl-carousel owl-bene">
      <?php foreach ($StBeneficios as $key => $beneficio): ?>
        <div class="items">
          <a style="text-decoration: none;" href="<?= $CAMINHO ?>beneficios/<?= $beneficio['id'] ?>">
            <div class="btn_beneficio">
              <p class="firstWord1 acessibilidade"><?= mb_strtoupper($beneficio['titulo']) ?></p>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {
    $('.owl-carousel').owlCarousel({
      items: 4,
      navText: ["<img class='img_seta_esquerda' src='assets/images/seta_b2.svg' aria-hidden='true'>", "<img class='img_seta_direita' src='assets/images/seta_b1.svg' aria-hidden='true'>"],
      autoplay: false,
      dots: false,
      margin: 65,
      loop: true,
      responsive: {
            0: {
                items: 1
            },
            280: {
                items: 1
            },
            400: {
                items: 1
            },
            550: {
                items: 2
            },
            768: {
                items: 2
            },
            991: {
                items: 2
            },
            1200: {
                items: 4
            }
        }

    });
  });

  $(".firstWord1").html(function() {
  var text = $(this).text().trim().split(" ");
  var first = text.shift();

  // Verificação se 'first' é undefined ou vazio
  if (!first) return "";

  return (text.length > 0 ? "<span class='wordthin1'>" + first + "</span> " : first) + text.join(" ");
});

</script>