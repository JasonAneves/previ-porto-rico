<?php
  $qryBeneficio = Conexao::chamar()->prepare("SELECT *
                                                FROM beneficios
                                              WHERE id_cliente = :cliente
                                                AND status_registro = :status_registro
                                              ORDER BY id DESC");
  $qryBeneficio->execute(array(":cliente" => $idCliente, ":status_registro" => "A"));
  $StBeneficios = $qryBeneficio->fetchAll(PDO::FETCH_ASSOC);

?>
      
<div class="container-fluid bg-beneficios">

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 titulo-beneficios">
    <span class="acessibilidade">BENEFÍCIOS</span>
  </div>

  <div class="container btns-beneficios">
    <div class="items">
      <?php foreach ($StBeneficios as $key => $beneficio):?>
      <a href="<?=$CAMINHO?>beneficios/<?=$beneficio['id']?>">
        <div class="btn-beneficio">
          <p class="firstWord acessibilidade"><?=mb_strtoupper($beneficio['titulo'])?></p>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('.items').slick({
      dots: true,
      infinite: true,
      speed: 800,
      autoplay: true,
      autoplaySpeed: 4000,
      slidesToShow: 4,
      slidesToScroll: 4,
      responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 586,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
          }
      }

      ]
    });
  });

  $(".firstWord").html(function(){ 
    var text= $(this).text().trim().split(" "); 
    var first = text.shift(); 
    return (text.length > 0 ? " <p class='wordthin'>" + first + "</p>" : first) + text.join(" ");
  }); 
</script>