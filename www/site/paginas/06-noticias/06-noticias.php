<div class="fundo_noticias">
    <div class="container container_noticas">
        <div class="div_titulo_noticias">
            <h1 class="titulo_noticias acessibilidade">
                NOT&Iacute;CIAS
            </h1>
            <div class="barra"></div>
        </div>

        <div class="controle_noticias">
            <div class="destaque">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100 img_noticia_destaque" src="<?= $CAMINHO ?>assets/images/noticia1.png" alt="First slide">
                            <div class="carousel-caption d-md-block titulo_img">
                                <p class="acessibilidade titulo_destaque">Porto Rico, Estado do Paraná, Cidades Turísticas do Brasil</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="controle_ultimas">
                <div class="ultima_noticias">
                    <img src="<?= $CAMINHO ?>assets/images/noticia2.png" alt="" class="img_ultima">
                    <div class="carousel-caption2">
                        <p class="acessibilidade titulo_ultimas">Porto Rico, Estado do Paraná, Cidades Turísticas do Brasil</p>
                    </div>


                </div>
                <div class="ultima_noticias">
                    <img src="<?= $CAMINHO ?>assets/images/noticia3.png" alt="" class="img_ultima">
                    <div class="carousel-caption2">
                        <p class="acessibilidade titulo_ultimas">Porto Rico, Estado do Paraná, Cidades Turísticas do Brasil2</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-ver-todas">
            <a class="btn_noticias" href="<?= $CAMINHO ?>noticias" target="_blank" onclick="playClickSound2()">
                <span class="t-btn acessibilidade">VER TODAS AS NOT&Iacute;CIAS</span>
            </a>
        </div>

    </div>
</div>
<audio id="clickSound2" src="<?= $CAMINHO ?>/assets/images/click5.mp3"></audio>
<script>
    function playClickSound2() {
        const clickSound = document.getElementById('clickSound2');
        clickSound.play();
    }
</script>