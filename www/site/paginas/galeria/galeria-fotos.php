<div class="fundo_fotos">
    <div class="container container_fotos">
        <div class="div_titulo_fotos">
            <h1 class="titulo_fotos acessibilidade">
               GALERIA DE FOTOS
            </h1>
            <div class="barra_foto"></div>
        </div>
        <div class="items-fotos">
            <div  class="owl-carousel owl-drag owl-fotos owl-theme owl-loaded">
                <div class="item-fotos">
                    <img class="img_fotos" src="<?= $CAMINHO ?>assets/images/noticia1.png" alt="">
                    <p class="titulo_galeria acessibilidade">Aliquam ultricies odio eget eros convallis, maximus tristique neque suscipit.</p>
                </div>
                <div class="item-fotos">
                    <img class="img_fotos" src="<?= $CAMINHO ?>assets/images/noticia2.png" alt="">
                    <p class="titulo_galeria acessibilidade">Aliquam ultricies odio eget eros convallis, maximus tristique neque suscipit.</p>
                </div>
                <div class="item-fotos">
                    <img class="img_fotos" src="<?= $CAMINHO ?>assets/images/noticia3.png" alt="">
                    <p class="titulo_galeria acessibilidade">Aliquam ultricies odio eget eros convallis, maximus tristique neque suscipit.</p>
                </div>
                <div class="item-fotos">
                    <img class="img_fotos" src="<?= $CAMINHO ?>assets/images/noticia2.png" alt="">
                    <p class="titulo_galeria acessibilidade">Aliquam ultricies odio eget eros convallis, maximus tristique neque suscipit.</p>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .owl-nav {
        margin-top: 0 !important;
        position: relative;
        bottom: 155px;
    }

    .owl-prev {
        position: absolute;
        right: 103%;
    }

    .owl-next {
        position: absolute;
        left: 103%;
    }

   
   
</style>

<script>
    $(document).ready(function() {
        $(".owl-fotos").owlCarousel({
            items: 4,
            navText: ["<img class='img_seta' src='assets/images/seta1.svg' aria-hidden='true'>", "<img class='img_seta' src='assets/images/seta2.svg' aria-hidden='true'>"],
            autoplay: true,
            dots: false,
            margin: 30,
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
                items: 3,
              
            },
            1200: {
                items: 4
            }
        }
        });
    });
</script>