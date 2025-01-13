<?php
    include "../../../../privado/sistema/conexao.php";

    $up = new Uploader('mFoto');
    $up->setDirectory("$caminhoUploadImagem/$idCliente/");
    $foto = $up->uploadImage();
    echo $foto;