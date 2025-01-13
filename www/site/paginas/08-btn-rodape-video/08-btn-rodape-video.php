<div class="fundo_icon_rodape">
  <div class="container container_icon_rodape">
    <div class="controle_icon_rodape">
      <a href="http://www.portorico.pr.gov.br/" class="link_iconRodape" target="_blank" onclick="playClickSound()">
        <img src="<?= $CAMINHO ?>/assets/images/prefeitura.svg" alt="" class="img_iconRodape">
        <p class="titulo_iconRodape acessibilidade">Prefeitura</p>
      </a>
      <a href="https://www1.tce.pr.gov.br/" class="link_iconRodape" target="_blank" onclick="playClickSound()">
        <img src="<?= $CAMINHO ?>/assets/images/tribunal.svg" alt="" class="img_iconRodape">
        <p class="titulo_iconRodape acessibilidade">Tribunal de Contas</p>
      </a>
      <a href="https://www.camaraportorico.pr.gov.br/" class="link_iconRodape" target="_blank" onclick="playClickSound()">
        <img src="<?= $CAMINHO ?>/assets/images/camara.svg" alt="" class="img_iconRodape">
        <p class="titulo_iconRodape acessibilidade">Câmara</p>
      </a>
      <a href="https://www.ingadigital.com.br/transparencia/?id_cliente=12139&sessao=e2a0dc6b0fdwe2" class="link_iconRodape" target="_blank" onclick="playClickSound()">
        <img src="<?= $CAMINHO ?>/assets/images/doc_2015.svg" alt="" class="img_iconRodape">
        <p class="titulo_iconRodape acessibilidade">Documentação até 2015</p>
      </a>
      <a href="http://177.52.255.217:8081/portaltransparencia/" class="link_iconRodape" target="_blank" onclick="playClickSound()">
        <img src="<?= $CAMINHO ?>/assets/images/intra.svg" alt="" class="img_iconRodape">
        <p class="titulo_iconRodape acessibilidade">Intranet</p>
      </a>
      <a href="https://www.ingadigital.com.br/transparencia/?id_cliente=12139&sessao=44476a5cb3uv44" class="link_iconRodape" target="_blank" onclick="playClickSound()">
        <img src="<?= $CAMINHO ?>/assets/images/ouvidoria_icon.svg" alt="" class="img_iconRodape">
        <p class="titulo_iconRodape acessibilidade">Ouvidoria</p>
      </a>
    </div>
  </div>
</div>
<div class="video" title="CLIQUE PARA PAUSAR" onclick="playClickSound()">
  <video id="vid" width="100%" autoplay loop muted>
    <source src="<?= $CAMINHO ?>/assets/images/portorico.mp4" type="video/mp4" loading="lazy">
  </video>
</div>

<script>
  const video = document.getElementById('vid');

  video.addEventListener('click', function() {
    if (video.paused) {
      video.play();
    } else {
      video.pause();
    }
  });
</script>


<audio id="clickSound" src="<?= $CAMINHO ?>/assets/images/click4.mp3"></audio>
<script>
  function playClickSound() {
    const clickSound = document.getElementById('clickSound');
    clickSound.play();
  }
</script>