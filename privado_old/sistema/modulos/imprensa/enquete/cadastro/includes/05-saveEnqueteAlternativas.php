<?php
    $arrayAlternativas  = [];
    $descricao          = $_POST['descricao'];
    $idBanco            = $_POST['idBanco'];
    $votos              = $_POST['votos'];
    $foto               = $_POST['foto'];
    $i                  = 0;
    foreach ($_POST['descricao'] as $alternativa) {
        array_push($arrayAlternativas, [
            'id_banco'  => $idBanco[$i],
            'descricao' => $descricao[$i],
            'votos'     => $votos[$i],
            'foto'      => $foto[$i]
        ]);
        $i++;
    }

    $stExcluiAlternativas = Conexao::chamar()->prepare("DELETE FROM enquete_alternativa 
                                                                    WHERE id_enquete = :id");
    $stExcluiAlternativas->bindParam("id", $id, PDO::PARAM_INT);
    $stExcluiAlternativas->execute();

    foreach($arrayAlternativas as $indice => $alternativa) {
        $stAlternativa = Conexao::chamar()->prepare("INSERT INTO enquete_alternativa
                                                            SET id_enquete  = :id_enquete,
                                                                descricao   = :descricao,
                                                                votos       = :votos,
                                                                foto        = :foto");
        $stAlternativa->bindParam("id_enquete", $id, PDO::PARAM_INT);
        $stAlternativa->bindParam("descricao", $alternativa['descricao'], PDO::PARAM_STR);
        $stAlternativa->bindParam("votos", $alternativa['votos'], PDO::PARAM_STR);
        $stAlternativa->bindParam("foto", $alternativa['foto'], PDO::PARAM_STR);
        $stAlternativa->execute();
    }
