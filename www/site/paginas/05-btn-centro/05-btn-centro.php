<div class="fundo_icones_centro">
  <div class="container container_icones">
    <div class="control_icones">
      <a href="https://portorico.eloweb.net/portaltransparencia/1/" class="link_bt" target="_blank" onclick="playClickSound()">
        <img src="<?= $CAMINHO ?>/assets/images/transparencia.svg" alt="" class="img_btn"></img>
        <p class="tiutlo_btn acessibilidade">TRANSPARÊNCIA</p>

      </a>
      <a href="https://leismunicipais.com.br/prefeitura/pr/porto-rico;" class="link_bt" target="_blank" onclick="playClickSound()">
        <img src="<?= $CAMINHO ?>/assets/images/legislacao.svg" alt="" class="img_btn"></img>
        <p class="tiutlo_btn acessibilidade">LEGISLAÇÃO</p>
      </a>
      <a href="https://www.ingadigital.com.br/transparencia/?id_cliente=12023&sessao=b0546033683mb0" class="link_bt" target="_blank" onclick="playClickSound()">
        <img src="<?= $CAMINHO ?>/assets/images/licitacao.svg" alt="" class="img_btn"></img>
        <p class="tiutlo_btn acessibilidade">LICITAÇÃO</p>
      </a>
      <a href="" class="link_bt" target="_blank" onclick="playClickSound()">
        <img src="<?= $CAMINHO ?>/assets/images/atas.svg" alt="" class="img_btn"></img>
        <p class="tiutlo_btn acessibilidade">ATAS DA DIRETORIA</p>
      </a>
      <a href="https://funpremportorico.eloweb.net/WebEloPortalRH/" class="link_bt" target="_blank" onclick="playClickSound()">
        <img src="<?= $CAMINHO ?>/assets/images/portal_rh.svg" alt="" class="img_btn"></img>
        <p class="tiutlo_btn acessibilidade">PORTAL RH</p>
      </a>
      <a href="http://www.portorico.pr.gov.br/index.php?sessao=b054603368d1b0" class="link_bt" target="_blank" onclick="playClickSound()">
        <img src="<?= $CAMINHO ?>/assets/images/diario.svg" alt="" class="img_btn"></img>
        <p class="tiutlo_btn acessibilidade">DI&Aacute;RIO OFICIAL</p>
      </a>
    </div>
  </div>
</div>
<audio id="clickSound" src="<?= $CAMINHO ?>/assets/images/click4.mp3"></audio>
<script>
  function playClickSound() {
    const clickSound = document.getElementById('clickSound');
    clickSound.play();
  }
</script>