<?php
    include 'C:/Users/guild/PhpstormProjects/Helpdesk Back-End/Controle/config.php';
    $json = file_get_contents("php://input");
    $obj = json_decode($json, true);
    $table = $obj['table'];
    if(strcmp($table, "funcionario")==0){
        echo json_encode(DBRead("hel_funcionario as f, hel_pessoa as p", "WHERE p.idPessoa = f.idFuncionario", "p.nomePessoa, p.idPessoa"));
    }
    else if(strcmp($table, "cliente")==0){
        echo json_encode(DBRead("hel_pessoa as p, hel_cliente as c", "WHERE p.idPessoa = c.idCliente", "nomePessoa, idPessoa"));
    }
    else if(strcmp($table, "categoria")==0){
        echo json_encode(DBRead(DB_PREFIX .'_'. $table, null, "nome, idCategoria"));
    }
?>