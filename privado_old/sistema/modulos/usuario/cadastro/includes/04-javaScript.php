<script>
	$("#login").on("change", function(){
		$("#mostra_login").load("ajax/busca_login.php", { login: $("#login").val() }, function(){
			$("#mostra_login").val("");
		});
	});

	$("#senha").on("keyup", function(){
		$("#mostra_senha").removeClass("hidden");
		var forca = 0;
		var senha = $("#senha").val();
		var mostra = $("#progresso_senha");
		var texto = $("#texto_senha");

		if((senha.length >= 4) && (senha.length <= 7)){
			forca += 10;
		} else if(senha.length>7){
			forca += 25;
		}
		if(senha.match(/[a-z]+/)){
			forca += 10;
		}
		if(senha.match(/[A-Z]+/)){
			forca += 20;
		}
		if(senha.match(/\d+/)){
			forca += 20;
		}
		if(senha.match(/\W+/)){
			forca += 25;
		}

		mostra.html(forca + "%");
		mostra.css({ width: forca + "%" });
		if(forca < 30) {
			mostra.removeClass('progress-bar-warning progress-bar-success');
			mostra.addClass('progress-bar-danger');
			texto.removeClass('text-warning text-primary text-success');
			texto.addClass('text-danger');
			texto.html('Muito Fraca, misture letras e n&uacute;meros');
		} else if((forca >= 30) && (forca < 60)){
			mostra.removeClass('progress-bar-danger progress-bar-success');
			mostra.addClass('progress-bar-warning');
			texto.removeClass('text-danger text-primary text-success');
			texto.addClass('text-warning');
			texto.html('Ainda Fraca, utilize alguns s&iacute;mbolos, como ! @ # % * _ + =');
		} else if((forca >= 60) && (forca < 85)){
			mostra.removeClass('progress-bar-danger progress-bar-success progress-bar-warning');
			texto.removeClass('text-danger text-warning text-success');
			texto.addClass('text-primary');
			texto.html('Fraca, misture letras mai&uacute;sculas e min&uacute;sculas');
		} else if(senha.length < 8) {
			mostra.removeClass('progress-bar-danger progress-bar-success progress-bar-warning');
			texto.removeClass('text-danger text-warning text-success');
			texto.addClass('text-primary');
			texto.html('A senha deve conter pelo menos 8 caracteres');
		} else {
			mostra.removeClass('progress-bar-danger progress-bar-warning');
			mostra.addClass('progress-bar-success');
			texto.removeClass('text-danger text-warning text-primary');
			texto.addClass('text-success');
			texto.html('Senha Segura - Envie agora');
		}
	});

	$("#alterar_senha").on("change", function(){
		if ($("#alterar_senha").is(":checked")) {
			$("#div-alterar-sernha").show();
			$("#email").removeAttr('disabled');
			$("#senha_atual").removeAttr('disabled');
			$("#senha").removeAttr('disabled');
			$("#confirma_senha").removeAttr('disabled');
		} else {
			$("#div-alterar-sernha").hide();
			$("#email").attr('disabled', 'disabled');
			$("#senha_atual").attr('disabled', 'disabled');
			$("#senha").attr('disabled', 'disabled');
			$("#confirma_senha").attr('disabled', 'disabled');
		}
	});

	function marcaDesmarcaModulo(id) {
		if ($("#id_menu_"+id).is(":checked")){
			$(".marcar_"+id).each(function(){
				$(this).prop("checked", true);
			});
		} else {
			$(".marcar_"+id).each(function(){
				$(this).prop("checked", false);
			});
		}
	}

	function marcaDesmarcaMenu(id) {
		if ($("#id_menu_"+id).is(":checked")){
			$(".marcar_"+id).each(function(){
				$(this).prop("checked", true);
			});
		} else {
			$(".marcar_"+id).each(function(){
				$(this).prop("checked", false);
			});
		}
	}

	$("#marcar_desmarcar").on("change", function(){
		if($(this).is(":checked")) {
			$(".marcar").prop("checked", true);
		} else {
			$(".marcar").prop("checked", false);
		}
	});
</script>