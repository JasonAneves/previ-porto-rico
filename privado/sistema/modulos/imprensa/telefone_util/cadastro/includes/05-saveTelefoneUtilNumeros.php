<?php
    $stExcluiFoto = Conexao::chamar()->prepare("DELETE FROM telefone_util_numero WHERE id_telefone_util = :id");
    $stExcluiFoto->bindParam("id", $id, PDO::PARAM_INT);
    $stExcluiFoto->execute();

    foreach($_POST['numeros'] as $indice => $numero) {
        $stImagem = Conexao::chamar()->prepare("INSERT INTO telefone_util_numero
                                                        SET id_telefone_util = :id,
                                                            numero = :numero");

        $stImagem->bindParam("id", $id, PDO::PARAM_INT);
        $stImagem->bindParam("numero", $_POST['numeros'][$indice], PDO::PARAM_STR);
        $stImagem->execute();
    }
