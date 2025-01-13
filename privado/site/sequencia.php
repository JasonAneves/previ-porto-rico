<?php

if (empty($url[$i]) || $url[$i] === "index.php") {

    include "inicio.php";

}else {
    if ($page = pag($url[$i])) {

        if (isset($page) && file_exists("../../privado/site/" . $page)) {

            require_once $page;

        } else {
            
            include "404.php";

        }

    } else {
        
        include "404.php";

    }

}





