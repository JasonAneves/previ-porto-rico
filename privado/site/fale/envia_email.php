<?php

setcookie("d-helena", 'clearAll');


function envia_email($mailDestino, $assunto, $mensagem, $fromName, $files = [], $source = 'default'){
	try {
       
        $source = 'funcao antiga -> '."//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] -> ".$source;
       
		$data = [
			"subject" => $assunto,
			"message" => utf8_encode($mensagem),
			"toArray" => $mailDestino,
            "fromName" => $fromName,
            "anexos" => $files,
            "caminho" => $source
		];
        $requisicao = callAPI("POST", "http://services.ingadigital.maringa.br/api/mail", $data);
		return $requisicao;

    } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
    }
}

function envia_email_aws($mailDestino, $assunto, $mensagem, $fromName, $files = [], $source = 'default'){
	try {
        $source = 'funcao nova -> '."//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI] -> ".$source;
		$data = [
			"subject" => $assunto,
            "message" => $mensagem,
			"toArray" => $mailDestino,
            "fromName" => $fromName,
            "anexos" => $files,
            "caminho" => $source
		];
        $requisicao = post("http://services.ingadigital.maringa.br/api/mail", $data);
		return $requisicao;

    } catch (Exception $e) {
        echo $e->getMessage(); //Boring error messages from anything else!
    }
}

function callAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data) {

                $payload = json_encode($data);

                // Attach encoded JSON string to the POST fields
                  
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
                
				// Set the content type to application/json
				curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			}
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}


/* Send a POST request without using PHP's curl functions.
 *
 * @param string $url The URL you are sending the POST request to.
 * @param array $postVars Associative array containing POST values.
 * @return string The output response.
 * @throws Exception If the request fails.
 */
function post($url, $postVars = array()){
    //Transform our POST array into a URL-encoded query string.
    $postStr = http_build_query($postVars);
    //Create an $options array that can be passed into stream_context_create.
    $options = array(
        'http' =>
            array(
                'method'  => 'POST', //We are using the POST HTTP method.
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postStr //Our URL-encoded query string.
            )
    );
    //Pass our $options array into stream_context_create.
    //This will return a stream context resource.
    $streamContext  = stream_context_create($options);
    //Use PHP's file_get_contents function to carry out the request.
    //We pass the $streamContext variable in as a third parameter.
    $result = file_get_contents($url, false, $streamContext);
    //If $result is FALSE, then the request has failed.
    if($result === false){
        //If the request failed, throw an Exception containing
        //the error.
        $error = error_get_last();
        throw new Exception('POST request failed: ' . $error['message']);
    }
    //If everything went OK, return the response.
    return $result;
}
?>