<?php

// funcao que envia email fica apenas nesse arquivo a baixo para facilitar alteração
//include "/var/inga/controlemunicipal.com.br/privado/inga/sistema/classes/envia_email.php";

class GoogleRecaptcha {
    
        /* Google recaptcha API url */
        private $google_url = "https://www.google.com/recaptcha/api/siteverify";
        private $secret = '6LfMpy8UAAAAAB3NA3qMFDaowJQg_NuKgYLQ3UK4';
    
        public function VerifyCaptcha($response) {
    
            $url = $this->google_url."?secret=".$this->secret."&response=".$response;
    
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_TIMEOUT, 15);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            $curlData = curl_exec($curl);
    
            curl_close($curl);
    
            $res = json_decode($curlData, TRUE);
            
            if($res['success'] == 'true')
                return TRUE;
            else
                return FALSE;
        }
    
    };

function verifica($valor) {

    if (get_magic_quotes_gpc()) $valor = stripslashes($valor);
    return str_replace("&quot;", '"', $valor);
}

function secure($campo){

    $txt = array("ftp://", "include", "require", "<?", "<?php", "<?=", "SELECT", "DELETE", "UPDATE", "INSERT", "DROP", "TRUNCATE", "UNION",
        "º", "–", "ª", "á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ã", "õ", "Ã", "õ", "à", "À", "ç", "Ç", "â",
        "ê", "ô", "Â", "Ê", "Ô", "'", "`", "‘", "~");

    $txttroca = array("", "", "", "", "", "", "", "", "", "", "", "", "",
        "&ordm;", "-", "&ordf;", "&aacute;", "&eacute;", "&iacute;", "&oacute;", "&uacute;", "&Aacute;", "&Eacute;", "&Iacute;",
        "&Oacute;", "&Uacute", "&atilde;", "&otilde;", "&Atilde;", "&Otilde;", "&agrave;", "&Agrave;", "&ccedil;", "&Ccedil;", "&acirc;",
        "&ecirc;", "&ocirc;", "&Acirc;", "&Ecirc;", "&Ocirc;", "&prime;", "&prime;", "&prime;", "&prime;", "");

    $str = str_replace($txt,$txttroca,$campo);

    if (!is_numeric($str)) {
        $str = get_magic_quotes_gpc() ? stripslashes($str) : $str;
    }

    return $str;
}

function validaCPF($cpf) {

    $cpf = str_replace(".", "", $cpf);
    $cpf = str_replace("-", "", $cpf);

    if (!is_numeric($cpf) || $cpf == "") {

        return false;
    } else {

        //VERIFICA
        if (($cpf == '11111111111') || ($cpf == '22222222222') ||
                ($cpf == '33333333333') || ($cpf == '44444444444') ||
                ($cpf == '55555555555') || ($cpf == '66666666666') ||
                ($cpf == '77777777777') || ($cpf == '88888888888') ||
                ($cpf == '99999999999') || ($cpf == '00000000000')) {
            $status = false;
        } else {
            //PEGA O DIGITO VERIFIACADOR
            $dv_informado = substr($cpf, 9, 2);

            for ($i = 0; $i <= 8; $i++) {
                $digito[$i] = substr($cpf, $i, 1);
            }

            //CALCULA O VALOR DO 10º DIGITO DE VERIFICAÇÂO
            $posicao = 10;
            $soma = 0;

            for ($i = 0; $i <= 8; $i++) {
                $soma = $soma + $digito[$i] * $posicao;
                $posicao = $posicao - 1;
            }

            $digito[9] = $soma % 11;

            if ($digito[9] < 2) {
                $digito[9] = 0;
            } else {
                $digito[9] = 11 - $digito[9];
            }

            //CALCULA O VALOR DO 11º DIGITO DE VERIFICAÇÃO
            $posicao = 11;
            $soma = 0;

            for ($i = 0; $i <= 9; $i++) {
                $soma = $soma + $digito[$i] * $posicao;
                $posicao = $posicao - 1;
            }

            $digito[10] = $soma % 11;

            if ($digito[10] < 2) {
                $digito[10] = 0;
            } else {
                $digito[10] = 11 - $digito[10];
            }

            //VERIFICA SE O DV CALCULADO É IGUAL AO INFORMADO
            $dv = $digito[9] * 10 + $digito[10];
            if ($dv != $dv_informado) {
                return false;
            } else
                return true;
        }//FECHA ELSE
    }
}

function validaCNPJ($str) {

    if (!preg_match('|^(\d{2,3})\.?(\d{3})\.?(\d{3})\/?(\d{4})\-?(\d{2})$|', $str, $matches))
        return false;

    array_shift($matches);

    $str = implode('', $matches);
    if (strlen($str) > 14)
        $str = substr($str, 1);

    $sum1 = 0;
    $sum2 = 0;
    $sum3 = 0;
    $calc1 = 5;
    $calc2 = 6;

    for ($i = 0; $i <= 12; $i++) {
        $calc1 = $calc1 < 2 ? 9 : $calc1;
        $calc2 = $calc2 < 2 ? 9 : $calc2;

        if ($i <= 11)
            $sum1 += $str[$i] * $calc1;

        $sum2 += $str[$i] * $calc2;
        $sum3 += $str[$i];
        $calc1--;
        $calc2--;
    }

    $sum1 %= 11;
    $sum2 %= 11;

    return ($sum3 && $str[12] == ($sum1 < 2 ? 0 : 11 - $sum1) && $str[13] == ($sum2 < 2 ? 0 : 11 - $sum2)) ? $str : false;
}

function formataArtigo($a) {

    return preg_replace("/&quot;/", "'", $a);
}

function formata_data($data)
  {

      if (!empty($data)) {

          $dat = explode("-", $data);
          $dt = $dat[2] . "/" . $dat[1] . "/" . $dat[0];

      } else {

          $dt = "";

      }

      return $dt;
  }


function formata_data_banco($data)
  {

      $data = trim($data);

      if ($data != "") {

          $dat = explode("/", $data);
          $dt = $dat[2] . "-" . $dat[1] . "-" . $dat[0];
      }

      return $dt;
  }

function formata_data_hora($data_hora){

    if(!empty($data_hora)) {

        $quebra = explode(" ", $data_hora);

        $dat = explode ("-", $quebra[0]);
        $dt = $dat[2]."/".$dat[1]."/".$dat[0];
        $data = $dt." ".$quebra[1];

    } else {

        $data = "";

    }

    return $data;
}

function getCoresBotoes() {
    return array("#337ab7", "#c34c9d", "#59b576", "#bab530", "#5b768e", "#6f787f", "#8b735e", "#757575");
}

function pr($arr, $echo = "") {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    if ($echo != "") {
        exit();
    }
}

function idVideo($video) {
    parse_str(parse_url($video, PHP_URL_QUERY), $array);
    return $array['v'];
}

function video($link) {

    //Por: Jonathan Rodrigues Carvalho - 03/03/2014
    $url = parse_url($link);
    if($url['host'] == "vimeo.com") {

        $id = preg_replace('#[^0-9]#', '', $url['path']);
        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));
        $img = $hash[0]['thumbnail_medium'];
        $title = $hash[0]['title'];
        $embed = "//player.vimeo.com/video/$id?byline=0&amp;portrait=0&amp;badge=0";

    } else {

        $id = idVideo($link);

        $hash = file_get_contents("http://youtube.com/get_video_info?video_id=$id");
        parse_str($hash, $arr);
        if(!empty($arr['iurl'])) $img = $arr['iurl'];
        else if(!empty($id)) $img = "http://i1.ytimg.com/vi/$id/default.jpg";
        else $img = "";
        //$title = $arr['title'];
        $embed = "http://www.youtube.com/embed/$id";

    }

    //return array("img" => $img, "title" => $title, "embed" => $embed);
    return array("img" => $img, "embed" => $embed);
}

function resumo($t, $n) {
    return substr($t, 0, isset($n) && is_numeric($n) ? $n : strlen($t));
}

function verificaNum($x) {
    $x = preg_replace("/[^0-9,.]/", "", $x);
    if (is_numeric($x))
        return trim($x);
    else
        return false;
}

function pag($d) {
    $ar = array("institucional" => "institucional/lista.php",
        "artigos" => "artigos/lista.php",
        "eventos" => "eventos/lista.php",
        "evento" => "evento/lista.php",
        "noticias" => "noticias/lista.php",
        "diretoria" => "diretoria/diretoria.php",
        "institucional" => "institucional/institucional.php",
        "transparencia" => "transparencia/transparencia.php",
        "contato" => "contato/contato.php",
        "ouvidoria" => "ouvidoria/ouvidoria.php",
        "pesquisa" => "pesquisa/busca.php",
        "estrutura" => "estrutura/lista.php",
        "historia" => "historia/lista.php",
        "galeria_fotos" => "galeria_fotos/lista.php",
        "videos" => "videos/lista.php",
        "atividade" => "atividade/lista.php",
        "sportapp" => "sportapp/lista.php",
        "modalidade" => "modalidade/lista.php",
        "planejamento" => "planejamento/lista.php",
        "mapasite" => "mapasite/mapasite.php",
        "censo" => "censo/lista.php",
        "legislacao" => "legislacao/lista.php",
        "controle_social" => "controle_social/lista.php",
        "previdencia" => "previdencia/lista.php",
        "perguntas" => "perguntas/perguntas.php",
        "programas" => "programas/lista.php",
        "investimento" => "investimento/lista.php",
        "convenios" => "convenios/lista.php",
        "informativo" => "informativo/lista.php",
        "ata" => "ata/lista.php",
        "projetos" => "projetos/lista.php",
        "como_doar" => "como_doar/lista.php",
        "voluntariado" => "voluntariado/lista.php",
        "obra_unida" => "obra_unida/lista.php",
        "pesquisa_satisfacao" => "pesquisa_satisfacao/lista.php",
        "beneficios" => "beneficios/lista.php",
        "links" => "links/lista.php",
        "organograma" => "organograma/lista.php",
        "telefones" => "telefones/lista.php",
        "fale" => "fale/contato.php",
        "servico" => "servico/lista.php",
        "downloads" => "downloads/lista.php",
        "recadastramento" => "recadastramento/lista.php",
        "enquete" => "enquete/lista.php",
        "votar" => "enquete/votar.php"
    );
    if (array_key_exists(trim($d), $ar)) {
        return $ar[$d];
    } else {
        return false;
    }
}


function paginaPersonalizada($valor) {
    
    $paginas = array("cadastro","login","recuperar");
    if (in_array($valor, $paginas)) return false;
    else return true;
}

function resumo_artigo($texto, $c) {
    $artigo = strip_tags($texto);
    $resumo = substr($artigo, '0', $c);
    $last = strrpos($resumo, " ");
    $resumo = substr($resumo, 0, $last);
    $artigo = (strlen($artigo) < $c ? $artigo : $resumo . "...");
    return $artigo;
}

function banner($tela) {
    if (!empty($tela)) {

        $tela = is_numeric($tela) ? $tela : 0;
        if ($tela == 0)
            return false;

        $queryBanner = Conexao::chamar()->prepare("SELECT banner.* 
                                                     FROM banner 
                                                     WHERE id_cliente = '$idCliente' 
                                                     AND (IF(banner.data_inicial <= CURRENT_DATE(), IF(banner.data_inicial = CURRENT_DATE(), IF(banner.hora_inicial <= CURRENT_TIME(), true, IF(banner.hora_inicial IS NULL, true, false)), true), IF(banner.data_inicial IS NULL, true, false))) 
                                                      AND (IF(banner.data_limite >= CURRENT_DATE(), IF(banner.data_limite = CURRENT_DATE(), IF(banner.hora_limite >= CURRENT_TIME(), true, IF(banner.hora_limite IS NULL, true, false)), true), IF(banner.data_limite IS NULL, true, false)))
                                                      AND banner.status_registro = 'A'
                                                    GROUP BY banner.id;");
        $queryBanner->execute();
        $ret = $queryBanner->fetchAll(PDO::FETCH_ASSOC);
        return !empty($ret) ? $ret : false;
    } else
        return false;
}

function calculaFrete($cod_servico, $cep_origem, $cep_destino, $peso = "0", $altura = "0", $largura = "0", $comprimento = "0", $diametro = "0", $valor_declarado = "0", $usuario = "INGACOM", $senha = "j2tg9o") {

    ############################################
    # Código dos Serviços dos Correios
    # 41106 PAC sem contrato
    # 40010 SEDEX sem contrato
    # 40045 SEDEX a Cobrar, sem contrato
    # 40215 SEDEX 10, sem contrato
    # 40290 SEDEX Hoje
    ############################################

    $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=$usuario&sDsSenha=$senha&nCdServico=".$cod_servico."&sCepOrigem=".$cep_origem."&sCepDestino=".$cep_destino."&nVlPeso=".(empty($peso) ? "0" : $peso)."&nCdFormato=1&nVlComprimento=".(empty($comprimento) ? "0" : $comprimento)."&nVlAltura=".(empty($altura) ? "0" : $altura)."&nVlLargura=".(empty($largura) ? "0" : $largura)."&nVlDiametro=".(empty($diametro) ? "0" : $diametro)."&sCdMaoPropria=N&nVlValorDeclarado=".$valor_declarado."&sCdAvisoRecebimento=N&StrRetorno=xml";
    $xml = simplexml_load_file($correios);
    /*
    $curl = curl_init($correios);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $dados = curl_exec($curl);
    $xml = simplexml_load_string($dados);
    */
    $data = array();

    $i = 0;
    foreach($xml->cServico as $linhas) {

        if($linhas->Erro == 0) {

            $data[$i]['valor'] = $linhas->Valor;
            $data[$i]['prazo'] = $linhas->PrazoEntrega;

        } else {

          //echo "<script>alert('$linhas->MsgErro')</script>";

        }

        $i++;
    }

    //echo "<pre>" . print_r($data) . "</pre>";
    if(count($data) > 0) return $data;
    else return false;
}


function seems_utf8($str) {

    $length = strlen($str);
    for ($i=0; $i < $length; $i++) {
        $c = ord($str[$i]);
        if ($c < 0x80) $n = 0; # 0bbbbbbb
        elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
        elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
        elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
        elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
        elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
        else return false; # Does not match any model
        for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
            if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
                return false;
        }
    }
    return true;
}



function retira_acentos($string) {

    if ( !preg_match('/[\x80-\xff]/', $string) )
        return $string;

    if (seems_utf8($string)) {
        $chars = array(
            // Decompositions for Latin-1 Supplement
            chr(195).chr(128) => 'A', chr(195).chr(129) => 'A',
            chr(195).chr(130) => 'A', chr(195).chr(131) => 'A',
            chr(195).chr(132) => 'A', chr(195).chr(133) => 'A',
            chr(195).chr(134) => 'AE',chr(195).chr(135) => 'C',
            chr(195).chr(136) => 'E', chr(195).chr(137) => 'E',
            chr(195).chr(138) => 'E', chr(195).chr(139) => 'E',
            chr(195).chr(140) => 'I', chr(195).chr(141) => 'I',
            chr(195).chr(142) => 'I', chr(195).chr(143) => 'I',
            chr(195).chr(144) => 'D', chr(195).chr(145) => 'N',
            chr(195).chr(146) => 'O', chr(195).chr(147) => 'O',
            chr(195).chr(148) => 'O', chr(195).chr(149) => 'O',
            chr(195).chr(150) => 'O', chr(195).chr(153) => 'U',
            chr(195).chr(154) => 'U', chr(195).chr(155) => 'U',
            chr(195).chr(156) => 'U', chr(195).chr(157) => 'Y',
            chr(195).chr(158) => 'TH',chr(195).chr(159) => 's',
            chr(195).chr(160) => 'a', chr(195).chr(161) => 'a',
            chr(195).chr(162) => 'a', chr(195).chr(163) => 'a',
            chr(195).chr(164) => 'a', chr(195).chr(165) => 'a',
            chr(195).chr(166) => 'ae',chr(195).chr(167) => 'c',
            chr(195).chr(168) => 'e', chr(195).chr(169) => 'e',
            chr(195).chr(170) => 'e', chr(195).chr(171) => 'e',
            chr(195).chr(172) => 'i', chr(195).chr(173) => 'i',
            chr(195).chr(174) => 'i', chr(195).chr(175) => 'i',
            chr(195).chr(176) => 'd', chr(195).chr(177) => 'n',
            chr(195).chr(178) => 'o', chr(195).chr(179) => 'o',
            chr(195).chr(180) => 'o', chr(195).chr(181) => 'o',
            chr(195).chr(182) => 'o', chr(195).chr(182) => 'o',
            chr(195).chr(185) => 'u', chr(195).chr(186) => 'u',
            chr(195).chr(187) => 'u', chr(195).chr(188) => 'u',
            chr(195).chr(189) => 'y', chr(195).chr(190) => 'th',
            chr(195).chr(191) => 'y',
            // Decompositions for Latin Extended-A
            chr(196).chr(128) => 'A', chr(196).chr(129) => 'a',
            chr(196).chr(130) => 'A', chr(196).chr(131) => 'a',
            chr(196).chr(132) => 'A', chr(196).chr(133) => 'a',
            chr(196).chr(134) => 'C', chr(196).chr(135) => 'c',
            chr(196).chr(136) => 'C', chr(196).chr(137) => 'c',
            chr(196).chr(138) => 'C', chr(196).chr(139) => 'c',
            chr(196).chr(140) => 'C', chr(196).chr(141) => 'c',
            chr(196).chr(142) => 'D', chr(196).chr(143) => 'd',
            chr(196).chr(144) => 'D', chr(196).chr(145) => 'd',
            chr(196).chr(146) => 'E', chr(196).chr(147) => 'e',
            chr(196).chr(148) => 'E', chr(196).chr(149) => 'e',
            chr(196).chr(150) => 'E', chr(196).chr(151) => 'e',
            chr(196).chr(152) => 'E', chr(196).chr(153) => 'e',
            chr(196).chr(154) => 'E', chr(196).chr(155) => 'e',
            chr(196).chr(156) => 'G', chr(196).chr(157) => 'g',
            chr(196).chr(158) => 'G', chr(196).chr(159) => 'g',
            chr(196).chr(160) => 'G', chr(196).chr(161) => 'g',
            chr(196).chr(162) => 'G', chr(196).chr(163) => 'g',
            chr(196).chr(164) => 'H', chr(196).chr(165) => 'h',
            chr(196).chr(166) => 'H', chr(196).chr(167) => 'h',
            chr(196).chr(168) => 'I', chr(196).chr(169) => 'i',
            chr(196).chr(170) => 'I', chr(196).chr(171) => 'i',
            chr(196).chr(172) => 'I', chr(196).chr(173) => 'i',
            chr(196).chr(174) => 'I', chr(196).chr(175) => 'i',
            chr(196).chr(176) => 'I', chr(196).chr(177) => 'i',
            chr(196).chr(178) => 'IJ',chr(196).chr(179) => 'ij',
            chr(196).chr(180) => 'J', chr(196).chr(181) => 'j',
            chr(196).chr(182) => 'K', chr(196).chr(183) => 'k',
            chr(196).chr(184) => 'k', chr(196).chr(185) => 'L',
            chr(196).chr(186) => 'l', chr(196).chr(187) => 'L',
            chr(196).chr(188) => 'l', chr(196).chr(189) => 'L',
            chr(196).chr(190) => 'l', chr(196).chr(191) => 'L',
            chr(197).chr(128) => 'l', chr(197).chr(129) => 'L',
            chr(197).chr(130) => 'l', chr(197).chr(131) => 'N',
            chr(197).chr(132) => 'n', chr(197).chr(133) => 'N',
            chr(197).chr(134) => 'n', chr(197).chr(135) => 'N',
            chr(197).chr(136) => 'n', chr(197).chr(137) => 'N',
            chr(197).chr(138) => 'n', chr(197).chr(139) => 'N',
            chr(197).chr(140) => 'O', chr(197).chr(141) => 'o',
            chr(197).chr(142) => 'O', chr(197).chr(143) => 'o',
            chr(197).chr(144) => 'O', chr(197).chr(145) => 'o',
            chr(197).chr(146) => 'OE',chr(197).chr(147) => 'oe',
            chr(197).chr(148) => 'R',chr(197).chr(149) => 'r',
            chr(197).chr(150) => 'R',chr(197).chr(151) => 'r',
            chr(197).chr(152) => 'R',chr(197).chr(153) => 'r',
            chr(197).chr(154) => 'S',chr(197).chr(155) => 's',
            chr(197).chr(156) => 'S',chr(197).chr(157) => 's',
            chr(197).chr(158) => 'S',chr(197).chr(159) => 's',
            chr(197).chr(160) => 'S', chr(197).chr(161) => 's',
            chr(197).chr(162) => 'T', chr(197).chr(163) => 't',
            chr(197).chr(164) => 'T', chr(197).chr(165) => 't',
            chr(197).chr(166) => 'T', chr(197).chr(167) => 't',
            chr(197).chr(168) => 'U', chr(197).chr(169) => 'u',
            chr(197).chr(170) => 'U', chr(197).chr(171) => 'u',
            chr(197).chr(172) => 'U', chr(197).chr(173) => 'u',
            chr(197).chr(174) => 'U', chr(197).chr(175) => 'u',
            chr(197).chr(176) => 'U', chr(197).chr(177) => 'u',
            chr(197).chr(178) => 'U', chr(197).chr(179) => 'u',
            chr(197).chr(180) => 'W', chr(197).chr(181) => 'w',
            chr(197).chr(182) => 'Y', chr(197).chr(183) => 'y',
            chr(197).chr(184) => 'Y', chr(197).chr(185) => 'Z',
            chr(197).chr(186) => 'z', chr(197).chr(187) => 'Z',
            chr(197).chr(188) => 'z', chr(197).chr(189) => 'Z',
            chr(197).chr(190) => 'z', chr(197).chr(191) => 's',
            // Decompositions for Latin Extended-B
            chr(200).chr(152) => 'S', chr(200).chr(153) => 's',
            chr(200).chr(154) => 'T', chr(200).chr(155) => 't',
            // Euro Sign
            chr(226).chr(130).chr(172) => 'E',
            // GBP (Pound) Sign
            chr(194).chr(163) => '');

        $string = strtr($string, $chars);
    } else {
        // Assume ISO-8859-1 if not UTF-8
        $chars['in'] = chr(128).chr(131).chr(138).chr(142).chr(154).chr(158)
            .chr(159).chr(162).chr(165).chr(181).chr(192).chr(193).chr(194)
            .chr(195).chr(196).chr(197).chr(199).chr(200).chr(201).chr(202)
            .chr(203).chr(204).chr(205).chr(206).chr(207).chr(209).chr(210)
            .chr(211).chr(212).chr(213).chr(214).chr(216).chr(217).chr(218)
            .chr(219).chr(220).chr(221).chr(224).chr(225).chr(226).chr(227)
            .chr(228).chr(229).chr(231).chr(232).chr(233).chr(234).chr(235)
            .chr(236).chr(237).chr(238).chr(239).chr(241).chr(242).chr(243)
            .chr(244).chr(245).chr(246).chr(248).chr(249).chr(250).chr(251)
            .chr(252).chr(253).chr(255);

        $chars['out'] = "EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy";

        $string = strtr($string, $chars['in'], $chars['out']);
        $double_chars['in'] = array(chr(140), chr(156), chr(198), chr(208), chr(222), chr(223), chr(230), chr(240), chr(254));
        $double_chars['out'] = array('OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th');
        $string = str_replace($double_chars['in'], $double_chars['out'], $string);
    }
    return secure($string);
}

function nomear_pasta($string) {

    $string = retira_acentos($string);
    $string = strtolower($string);
    $string = str_replace(".", " ",$string);
    $string = preg_replace("/[^a-zA-Z0-9\s]/", "", $string);
    $string = str_replace(" ", "_",$string);
    return $string;
}

function statusPagseguro($status){
    $retorno = "";
    switch ($status) {
     case "0":
       $retorno = "Pendente";
        break;
     case "1":
       $retorno = "Aguardando pagamento";
        break;
     case "2":
       $retorno = "Em an&aacute;lise";
        break;
     case "3":
       $retorno = "Paga";
        break;
     case "4":
       $retorno = "Disponivel";
        break;
     case "5":
       $retorno = "Em disputa";
        break;
     case "6":
       $retorno = "Devolvida";
        break;
     case "7":
       $retorno = "Cancelada";
        break;
    }


  return $retorno;
}


function statusPedido($status){
    $retorno = "";
    switch ($status) {
     case "P":
       $retorno = "Pendente";
        break;
     case "F":
       $retorno = "Faturado";
        break;
     case "E":
       $retorno = "Enviado";
        break;
     case "C":
       $retorno = "Cancelado";
        break;
    
    }


  return $retorno;
}

function corStatus($status){
    $retorno = "";
    switch ($status) {
     case "P":
       $retorno = "warning";
        break;
     case "F":
       $retorno = "info";
        break;
     case "E":
       $retorno = "success";
        break;
     case "C":
       $retorno = "danger";
        break;
     case "0":
       $retorno = "warning";
        break;
     case "1":
       $retorno = "info";
        break;
     case "2":
       $retorno = "info";
        break;
     case "3":
       $retorno = "success";
        break;
     case "4":
       $retorno = "success";
        break;
     case "5":
       $retorno = "danger";
        break;
     case "6":
       $retorno = "danger";
        break;
     case "7":
       $retorno = "danger";
        break;
    
    }


  return $retorno;
}



function gerarHash($parametro){

    $constante = 'donahelena';
    
    $parametro = $parametro.date(DATE_ATOM,mktime());
    
    return hash('sha512', $contante . $parametro);
   

}

function formata_data_extenso($strDate)
  {

      // Array com os dia da semana em portugues;
      //$arrDaysOfWeek = array('Domingo', 'Segunda-feira', 'Terca-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado');
      // Array com os meses do ano em portugues;
      $arrMonthsOfYear = array(1 => 'Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
      // Descobre o dia da semana
      $intDayOfWeek = date('w', strtotime($strDate));
      // Descobre o dia do mes
      $intDayOfMonth = date('d', strtotime($strDate));
      // Descobre o mes
      $intMonthOfYear = date('n', strtotime($strDate));
      // Descobre o ano
      $intYear = date('Y', strtotime($strDate));
      // Formato a ser retornado
      return $intDayOfMonth . ' de ' . $arrMonthsOfYear[$intMonthOfYear] . ' de ' . $intYear;



  }



function valida_form($response) {

         $google_url = "https://www.google.com/recaptcha/api/siteverify";
         $secret = '6LfMpy8UAAAAAB3NA3qMFDaowJQg_NuKgYLQ3UK4';

        $url = $this->google_url."?secret=".$this->secret."&response=".$response;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        $curlData = curl_exec($curl);

        curl_close($curl);

        $res = json_decode($curlData, TRUE);
        
        if($res['success'] == 'true')
            return TRUE;
        else
            return FALSE;
    

}



function compartilhamento($arquivo , $id){
	$array = array();
	$tabela = "";
	if($id != ""){
		
		switch ($arquivo) {
			case 'noticias':
				$tabela = 'noticia';
				break;

			case 'eventos':
				$tabela = 'evento';
				break;

			case 'servico':
				$tabela = 'servico';
				break;

      case 'institucional':
          $tabela = "institucional";
          break;
		}


	if($tabela != ""){

	    $busca = Conexao::chamar()->prepare("SELECT id, titulo, artigo FROM {$tabela} WHERE id = :id AND status_registro = :status_registro LIMIT 1");
	    $busca->bindValue(":id", $id, PDO::PARAM_INT);
	    $busca->bindValue(":status_registro", "A", PDO::PARAM_STR);
	    $busca->execute();
	    $busca = $busca->fetch(PDO::FETCH_ASSOC);

	    if (count($busca) > 0) {

	    	$array['titulo'] = $busca['titulo'];
	    	$array['artigo'] = $busca['artigo'];

	        $foto = Conexao::chamar()->prepare("SELECT * FROM {$tabela}_foto WHERE id_{$tabela} = :id ORDER BY id DESC LIMIT 1");
	        $foto->bindValue(":id", $busca['id'], PDO::PARAM_INT);
	        $foto->execute();
	        $foto = $foto->fetch(PDO::FETCH_ASSOC);

	        if (count($foto['id']) > 0) $array['foto'] = $foto['foto'];
	             
	        else $array['foto'] = "";


		}

		
	}
	}
	return $array;
}