<?php

include 'envia_email.php';

if (!empty($_POST)) {

    if(empty($_POST['nome'])) {

        $mens = "Informe seu nome!";

    } else if(empty($_POST['email']) || filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {

        $mens = "Forne&ccedil;a um e-mail v&aacute;lido!";

    } else if(empty($_POST['telefone'])) {

        $mens = "Informe seu telefone!";

    } else if(empty($_POST['mensagem'])) {

        $mens = "Preencha o campo Mensagem!";

    } else {

        $to = $configuracao['email'];
        $subject = "Instituto de Previdência - Contato enviado pelo site";

        $html  = "<html><body>";
        $html .= "<p>" . date("d/m/Y H:i") . "</p>";
        $html .= "<p><strong>Nome: </strong>";
        $html .= "$_POST[nome]</p>";
        $html .= "<p><strong>Email: </strong>";
        $html .= "$_POST[email]</p>";
        $html .= "<p><strong>Telefone: </strong>";
        $html .= "$_POST[telefone]</p>";
        $html .= "<p><strong>Mensagem: </strong>";
        $html .= nl2br($_POST['mensagem']) . "</p>";
        $html .= "<p><strong>IP do remetente: </strong>";
        $html .= $_SERVER['REMOTE_ADDR'] . "</p>";
        $html .= "</body></html>";


        $headers = "Instituto de Previdência <$configuracao[email]>";

        $endereco = $dominioAbsoluto.'/privado/site/contato/contato.php';
        $mensagem = $html;
        $destino[0]['email'] = $to;
        $destino[0]['nome'] = "Contato";
        $vai = envia_email_aws($destino, $subject, $mensagem, $headers, $endereco);

        $destino2[0]['email'] = $_POST['email'];
        $destino2[0]['nome'] = "Contato";
        $vai = envia_email_aws($destino2, $subject, "Obrigado, recebemos sua mensagem em breve entraremos em contato", $headers, [], $endereco);

        if ($vai) {

            $mens = "Sua mensagem foi enviada com sucesso. Em breve entraremos em contato.";
            $_POST['email'] = "";
            $_POST['nome'] = "";
            $_POST['telefone'] = "";
            $_POST['mensagem'] = "";

        } else {

            $mens = "Erro ao enviar a mensagem! Tente novamente mais tarde!";

        }

    }

}

?>
<div class="row">
    <div class="container">
        <div class="col-md-12">
            <div style="display: block;width: 100%;margin: 20px; 0">
              <h2 style="color: #007CC2;font-size: 35px;font-weight: bold;font-family: 'Muli', sans-serif;">Fale Com o Presidente</h2>
                <!-- <div style="margin-bottom: 20px;margin: 0 0 0 45px;border-bottom: 4px solid #0AAB60;width: 94px;"></div> -->
            </div>
            <br>
            <?php
            if (!empty($_POST) && $mens != "") {

                if ($vai)
                    echo "<div class='alert alert-success' onclick='$(this).hide();'>{$mens}</div>";
                else
                    echo "<div class='alert alert-danger' onclick='$(this).hide();'>{$mens}</div>";
            }
            ?>
            <form class="form-horizontal" name="contato" action="" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                    <label for="nome" class="acessibilidade col-sm-2 control-label">Nome</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $_POST['nome'] ?>" placeholder="Informe seu nome" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefone" class="acessibilidade col-sm-2 control-label">Telefone</label>
                    <div class="col-sm-10">
                        <input type="tel" class="form-control telefone" id="telefone" name="telefone" value="<?= $_POST['telefone'] ?>" placeholder="Informe seu telefone" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="acessibilidade col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control email" id="email" name="email" value="<?= $_POST['email'] ?>" placeholder="Informe seu email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mensagem" class="acessibilidade col-sm-2 control-label">Mensagem</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="4" name="mensagem" id="mensagem" placeholder="Informe sua mensagem" required><?= $_POST['mensagem'] ?></textarea>
                    </div>
                </div>

                <div class="form-group" style="text-align: center;">
                    <div id="texto"></div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="reset" class="acessibilidade btn btn-warning">
                            <i class="fa fa-refresh"></i> Limpar
                        </button>
                        <button type="submit" class="acessibilidade btn btn-primary valida_enviar">
                            <i class="fa fa-send"></i> Enviar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<input type="hidden" name="valor_cidade" id="valor_cidade" value="<?php echo $CAMINHO ?>" />


<!--
<script type="text/javascript">

	function getCaptcha(str) {

		var url = $('#valor_cidade').val();

		if (str.length != 0) { 

			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					$('#texto').html(this.responseText);
				}
			};
			
			xmlhttp.open("GET", url+"/captcha/captcha.php?q="+str, true);
			xmlhttp.send();

		}
		
	}

	$( document ).ready(function() {
		getCaptcha(9);
		
	});

</script>
-->