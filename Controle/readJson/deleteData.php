<?php

    include 'C:/Users/guild/PhpstormProjects/Helpdesk Back-End/Controle/config.php';
    $json = file_get_contents("php://input");
    $obj = json_decode($json, true);
    $table = $obj["table"];
    $id = $obj["id"];

    if(strcmp($table, 'funcionario')===0 | strcmp($table, 'cliente')===0) {
        DBDelete("pessoa", "idPessoa = '$id'");
        echo json_encode("Pessoa deletada com sucesso");
    }
    else if(strcmp($table, 'categoria')===0) {
        DBDelete("categoria", "idCategoria = '$id'");
        echo json_encode("Categoria deletada com sucesso");
    }
    else if(strcmp($table, 'protocolo')===0) {
        DBDelete("protocolo", "idProtocolo = '$id'");
        echo json_encode("Protocolo deletada com sucesso");
    }

?>