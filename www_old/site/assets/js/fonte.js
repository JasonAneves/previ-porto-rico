function fonte(e) {

  var elemento = $(".acessibilidade");
  var fonte = parseInt(elemento.css('font-size'));

  var body = $("body");
  const fonteNormal = parseInt(body.css('font-size'));


  if (e == 'a') {
    fonte++;
  }
  if (e == 'd') {
    fonte--;
  }
  if (e == 'n') {
    fonte = fonteNormal;
  }

  elemento.css("fontSize", fonte);

}

function alto_contraste(url) {

  if (localStorage.alto_contraste_ativo == 't') {
    $('head').append("<link rel='stylesheet' id='link' type='text/css' href='" + url + "'>");
    localStorage.setItem('alto_contraste_ativo', 'f');
  } else {
    $('#link').remove();
    localStorage.setItem('alto_contraste_ativo', 't');
  }
}

// var $z = jQuery.noConflict();

// $z(document).ready(function () {
//   $z("#aumentar-fonte").click(function () {
//     var size = $z(".acessibilidade").css('font-size');

//     size = size.replace('px', '');
//     size = parseInt(size) + 2;

//     $z(".acessibilidade").animate({ 'font-size': size + 'px' });
//     return false;
//   });

//   $z("#diminuir-fonte").click(function () {
//     var size = $z(".acessibilidade").css('font-size');

//     size = size.replace('px', '');
//     size = parseInt(size) - 2;

//     $z(".acessibilidade").animate({ 'font-size': size + 'px' });
//     return false;
//   });
// });