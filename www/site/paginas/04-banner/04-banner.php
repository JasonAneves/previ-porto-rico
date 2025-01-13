<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>

  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="img_banner" src="<?= $CAMINHO ?>assets/images/banner1.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="img_banner" src="<?= $CAMINHO ?>assets/images/teste-banner.jpg" alt="Second slide">
    </div>
    <div class="carousel-item ">
      <img class="img_banner" src="<?= $CAMINHO ?>assets/images/banner1.png" alt="First slide">
    </div>


  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="next">
    <img src="<?= $CAMINHO ?>assets/images/seta_esquerda.svg" alt="">
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <img src="<?= $CAMINHO ?>assets/images/seta_direita.svg" alt="">
  </a>
</div>


<style>
  .carousel-control-prev {
    left: 15%;
    background: #F2F2F2;
    opacity: 1;
    width: 53px;
    height: 41px;
    top: 46%;
  }

  .carousel-control-next {
    right: 15%;
    background: #F2F2F2;
    opacity: 1;
    width: 53px;
    height: 41px;
    top: 46%;
  }

  .carousel-indicators .active {
    background-color: #fff0;
    border: solid #fff 3px;
    border-radius: 50%;
    width: 22px;
    height: 22px;
  }

  .carousel-indicators {
    position: absolute;
    right: 0;
    bottom: 10px;
    left: 0;
    z-index: 15;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding-left: 0;
    margin-right: 15%;
    margin-left: 15%;
    list-style: none;
    align-items: center;
    justify-content: center;
    gap: 2rem;
  }


  .carousel-indicators li {
    position: relative;
    -webkit-box-flex: 0;
    -ms-flex: 0 1 auto;
    flex: 0 1 auto;
    width: 8px;
    height: 8px;
    margin-right: 3px;
    margin-left: 3px;
    text-indent: -999px;
    background-color: rgb(255 255 255);
    border-radius: 50%;
  }
</style>