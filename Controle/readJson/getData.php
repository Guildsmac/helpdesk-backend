<?php
    include 'C:/Users/guild/PhpstormProjects/Helpdesk Back-End/Controle/config.php';
    $json = file_get_contents("php://input");
    $obj = json_decode($json, true);
    $table = $obj['table'];
    $isSpecified = $obj['isSpecified'];

    if(!$isSpecified) {
        if (strcmp($table, "funcionario") == 0)
            echo json_encode(DBRead("hel_funcionario as f, hel_pessoa as p", "WHERE p.idPessoa = f.idFuncionario", "p.nomePessoa, p.idPessoa, p.cpfPessoa"));

        else if (strcmp($table, "cliente") == 0)
            echo json_encode(DBRead("hel_pessoa as p, hel_cliente as c", "WHERE p.idPessoa = c.idCliente", "nomePessoa, idPessoa, p.cpfPessoa"));

        else if (strcmp($table, "categoria") == 0)
            echo json_encode(DBRead(DB_PREFIX . '_' . $table, null, "nome, descricao, idCategoria"));

        else if (strcmp($table, "protocolo") == 0)
            echo json_encode(DBRead("hel_pessoa as peOne, hel_pessoa as peTwo, hel_protocolo as pr, hel_categoria as c",
                "WHERE peOne.idPessoa = pr.fk_idFuncionario and peTwo.idPessoa = pr.fk_idCliente and c.idCategoria = pr.fk_idCategoria",
                "peOne.nomePessoa as nomeFuncionario, peTwo.nomePessoa as nomeCliente,pr.idProtocolo, pr.data, pr.tempoDuracao, pr.detalhes, c.nome"));
    }else{

        $idToSearch = $obj['idToSearch'];
        if (strcmp($table, "funcionario") == 0)
            echo json_encode(DBRead("hel_funcionario as f, hel_pessoa as p", "WHERE p.idPessoa = f.idFuncionario and p.idPessoa = '$idToSearch'", "p.*, f.salarioFuncionario, f.senha"));

        else if (strcmp($table, "cliente") == 0)
            echo json_encode(DBRead("hel_pessoa as p, hel_cliente as c", "WHERE p.idPessoa = c.idCliente and p.idPessoa = '$idToSearch'", "p.*, c.email, c.endereco"));

        else if (strcmp($table, "categoria") == 0)
            echo json_encode(DBRead(DB_PREFIX . '_' . $table, "WHERE idCategoria = '$idToSearch'"));


        else if (strcmp($table, "protocolo") == 0)
            echo json_encode(DBRead("hel_pessoa as peOne, hel_pessoa as peTwo, hel_protocolo as pr, hel_categoria as c",
                "WHERE peOne.idPessoa = pr.fk_idFuncionario and peTwo.idPessoa = pr.fk_idCliente and c.idCategoria = pr.fk_idCategoria and idProtocolo = '$idToSearch'",
                "peOne.nomePessoa as nomeFuncionario, peOne.idPessoa as idFuncionario,
                       peTwo.nomePessoa as nomeCliente, peTwo.idPessoa as idCliente,
                       pr.idProtocolo, pr.data, pr.tempoDuracao, pr.detalhes, c.nome as nomeCategoria, c.idCategoria"));

        else{
            echo json_encode("Erro");
        }
    }

?>