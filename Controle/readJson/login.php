<?php
    include 'C:/Users/guild/PhpstormProjects/Helpdesk Back-End/Controle/config.php';

    $json = file_get_contents('php://input');
    $obj = json_decode($json, true);
    $cpf = $obj['cpfPessoa'];
    $passwd = $obj['senha'];
    $passwd = hash('sha256', $passwd);
    if($obj['cpfPessoa'] != "") {
        $res = DBRead("hel_pessoa as p, hel_funcionario as f", "WHERE p.cpfPessoa = '{$cpf}' and f.senha = '{$passwd}' and p.idPessoa = f.idFuncionario", "p.*, f.salarioFuncionario");
        if($res){
            echo json_encode($res[0]);
        }else
            echo json_encode('error');
    }else{
        echo json_encode('error');
    }

?>