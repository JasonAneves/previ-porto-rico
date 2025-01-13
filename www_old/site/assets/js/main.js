$(document).ready(function() {
	'use strict';

	$('.gallery').flashy({
		prevShowClass: 'fx-bounceInLeft',
		nextShowClass: 'fx-bounceInRight',
		prevHideClass: 'fx-bounceOutRight',
		nextHideClass: 'fx-bounceOutLeft'
	});

	$('.custom').flashy({
		showClass: 'fx-fadeIn',
		hideClass: 'fx-fadeOut'
	});
});


function validaBusca(){
    if($("#ipt-pesquisa").val()==""){ 
        alertify.alert('<img style="margin:0 auto; max-height:60px" src="http://www.iretama.pr.gov.br/images/logo.png" class="img-responsive"/>','O campo pesquisa est&aacute; vazio');
        return false;
    }
}

$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
}); 

$('.lightbox').attr({
 'data-toggle': 'lightbox'
});

function centerModal() {
    $(this).css('display', 'block');
    var $dialog = $(this).find(".modal-dialog");
    var offset = ($(window).height() - $dialog.height()) / 2;
    $dialog.css("margin-top", 50);
}

$('.modal').on('show.bs.modal', centerModal);

$(window).on("resize", function () {
    $('.modal:visible').each(centerModal);
});

$(document).ready(function() {
    if($('#popup-modal_1').length != 0){
        $('#popup-modal_1').modal('show');
    }
    if($('#popup-modal_2').length != 0){
        $('#popup-modal_2').modal('show');
    }    
});

// $(document).ready(() => {
//     $('.owl-carousel').owlCarousel({
//       loop:true,
//       margin:10,
//       nav:true,
//       dots: false,
//       responsive:{
//         0:{
//             items:1
//         }
//       }
//     });
//   });

$(document).ready(function(){
  $(".owl-noticias").owlCarousel({
      navigation: true,
      nav: true,
      navText: ["<img class='img-responsive' src='assets/images/seta3.svg' aria-hidden='true'>", "<img class='img-responsive' src='assets/images/seta4.svg' aria-hidden='true'>"],
      autoplay:false,
      autoWidth: false,
      slideBy: 1,
      dots:false,
      margin: 0,
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
              items: 1
          },  
          768: {
              items: 1
          },
          993: {
              items: 1
          },
          1201: {
              items: 1
          }
      }
  });
});

$(document).ready(function(){
    $(".owl-links").owlCarousel({
        navigation: true,
        nav: true,
        navText: ["<img class='img-responsive' src='assets/images/seta1.svg' aria-hidden='true'>", "<img class='img-responsive' src='assets/images/seta2.svg' aria-hidden='true'>"],
        autoplay:false,
        autoWidth: false,
        slideBy: 1,
        dots:false,
        margin: 0,
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
                items: 4
            },
            993: {
                items: 6
            },
            1201: {
                items: 6
            }
        }
    });
});


function setMask(){
	
	$('.telefone').focusout(function() {
		
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if (phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
   }).trigger('focusout');
	$('.analytics').focusout(function() {
		var codigo, element;
		element = $(this);
		element.unmask();
		codigo = element.val().replace(/\D/g, '');
		if (codigo.length > 11) {
			element.mask("aa-99999999-?99");
		} else {
			element.mask("aa-99999999-9?9");
		}
	}).trigger('focusout');
   $(".cpf").mask("999.999.999-99");
   $(".cpf2").mask("999.999.999-99");
   $(".cnpj").mask("99.999.999/9999-99");
   $(".cnpj2").mask("99.999.999/9999-99");
   $(".cep").mask("99999-999");
   $(".ano").mask("9999");
   $(".data").mask("99/99/9999");
   $(".mes").mask("99");
   $(".hora").mask("99:99");
   $(".placa").mask("aaa-9999");
   $(".cnj").mask("9999999-99-9999-9-99-9999");
   $(".uf").mask("aa");
   
}

function unsetMask(){

	$(".telefone").unmask();
   	$(".cpf").unmask();
   	$(".cnpj").unmask();
   	$(".cep").unmask();
   	$(".ano").unmask();
   	$(".data").unmask();
   	$(".hora").unmask();
   	$(".placa").unmask();
    $(".cnj").unmask();
    $(".uf").mask();   
}

$(setMask);


function alerta(link, mensagem, tipo) {
  
  noty({
    
    text: mensagem,
    type: tipo ? tipo : 'alert',
    buttons: [{
      
      addClass: 'btn btn-primary', text: 'OK', onClick: function($noty) {
        
        window.location = link;
      }
    }]
  });
  
}

function codificarHtml(texto){
    var htmlCodigo = { 
                  'á' : {'code' : '&aacute;'},
                  'Á' : {'code' : '&Aacute;'},
                  'ã' : {'code' : '&atilde;'},
                  'Ã' : {'code' : '&Atilde;'},
                  'à' : {'code' : '&agrave;'},
                  'À' : {'code' : '&Agrave;'},                       
                  'é' : {'code' : '&eacute;'},
                  'É' : {'code' : '&Eacute;'},
                  'í' : {'code' : '&iacute;'},
                  'Í' : {'code' : '&Iacute;'},
                  'ó' : {'code' : '&oacute;'},
                  'Ó' : {'code ': '&Oacute;'}, 
                  'õ' : {'code' : '&otilde;'},
                  'Õ' : {'code' : '&Otilde;'},
                  'ú' : {'code' : '&uacute;'},
                  'Ú' : {'code' : '&Uacute;'},
                  'ç' : {'code' : '&ccedil;'},
                  'Ç' : {'code' : '&Ccedil;'}                      };
    var acentos = ['á', 'Á', 'ã', 'Ã', 'à', 'À', 'é', 'É', 'í', 'Í', 'ó', 'Ó', 'õ', 'Õ', 'ú', 'Ú', 'ç', 'Ç'];
    
    for(var i=0; i<acentos.length; i++){
        if(htmlCodigo [acentos[i]] != undefined){
            texto = texto.replaceAll(acentos[i], htmlCodigo[acentos[i]].code );
        }
    }
    
    return texto;
}

$(document).ready(function(){
    $(".owl-banner").owlCarousel({
        navigation: true,
        nav: true,
        navText: ["<img class='img-responsive' src='assets/images/setaBannerEsquerda.svg' aria-hidden='true'>", "<img class='img-responsive' src='assets/images/setaBannerDireita.svg' aria-hidden='true'>"],
        autoplay:true,
        autoWidth: false,
        slideBy: 1,
        dots:true,
        margin: 0,
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
                items: 1
            },
            768: {
                items: 1
            },
            993: {
                items: 1
            },
            1201: {
                items: 1
            }
        }
    });
  });