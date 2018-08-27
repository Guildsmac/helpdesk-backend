<?php
    include 'C:/Users/guild/PhpstormProjects/Helpdesk Back-End/Controle/config.php';
    $json = file_get_contents("php://input");
    $obj = json_decode($json, true);
    $table = $obj["table"];

    if($table){
        if(strcmp($table, "funcionario")==0) {
            $data["nomePessoa"] = $obj["nomePessoa"];
            $data["cpfPessoa"] = $obj["cpfPessoa"];
            $data["salarioFuncionario"] = $obj["salarioFuncionario"];
            $data["senha"] = hash('sha256', $obj["senha"]);
            $id = "";
            if ($data["nomePessoa"] & $data["cpfPessoa"] & $data["salarioFuncionario"] & $data["senha"]) {
                $tempCpf = $data['cpfPessoa'];
                if (!DBRead("hel_pessoa", "WHERE cpfPessoa = '$tempCpf'")) {
                    $return = DBRead("hel_funcionario", null, 'idFuncionario');
                    if ($return) {
                        end($return);
                        $key = key($return);
                        $data["idPessoa"] = "FUN" . getId($return[$key]["idFuncionario"]);

                    } else
                        $data["idPessoa"] = "FUN01";
                    $data["idFuncionario"] = $data["idPessoa"];
                    $f = new Funcionario($data["nomePessoa"], $data["cpfPessoa"], $data["idPessoa"], $data["salarioFuncionario"], $data["senha"]);
                    DBInsert("funcionario", $f->toArray());
                    echo json_encode("Funcionário cadastrado com sucesso");

                }else{
                    echo json_encode("CPF já está cadastrado");
                }

            }else{
                echo json_encode("Preencha todos os campos");
            }
        }
        else if(strcmp($table, "cliente")==0){
            $data["nomePessoa"] = $obj["nomePessoa"];
            $data["cpfPessoa"] = $obj["cpfPessoa"];
            $data["endereco"] = $obj["endereco"];
            $data["email"] = $obj["email"];
            $id = "";
            if($data["nomePessoa"] & $data["cpfPessoa"] & $data["endereco"] & $data["email"]){
                $tempCpf = $data['cpfPessoa'];
                if(!DBRead("hel_pessoa", "WHERE cpfPessoa = '$tempCpf'")){
                    $return = DBRead("hel_cliente", null, "idCliente");
                    if($return){
                        end($return);
                        $key = key($return);
                        $data["idPessoa"] = "CLI" . getId($return[$key]["idCliente"]);

                    }else
                        $data["idPessoa"] = "CLI01";
                    $data["idCliente"] = $data["idPessoa"];
                    $c = new Cliente($data["nomePessoa"], $data["cpfPessoa"], $data["idPessoa"], $data["email"], $data["endereco"]);
                    DBInsert("cliente", $c->toArray());
                    echo json_encode("Cliente cadastrado com sucesso");
                }else
                    echo json_encode("CPF já está cadastrado");

            }else
                echo json_encode("Preencha todos os campos");
        }
        else if(strcmp($table, "categoria")==0){
            $data["nome"] = $obj["nome"];
            $data["descricao"] = $obj["descricao"];
            $id = "";
            if($data["nome"] & $data["descricao"]){
                $tempNome = $data["nome"];
                if(!DBRead("hel_categoria", "WHERE nome = '$tempNome'")){
                    $return = DBRead("hel_categoria", null, "idCategoria");
                    if($return){
                        end($return);
                        $key = key($return);
                        $data["idCategoria"] = "CAT" . getId($return[$key]["idCategoria"]);
                    }else{
                        $data["idCategoria"] = "CAT01";
                    }
                    $c = new Categoria($data["idCategoria"], $data["nome"], $data["descricao"]);
                    DBInsert("categoria", $c->toArray());
                    echo json_encode("Categoria cadastrada com sucesso");
                }else{
                    echo json_encode("Categoria já existente");
                }
            }else
                echo json_encode("Preencha todos os campos");
        }
    }else{
        echo json_encode("Tabela não válida");
    }

    function getId($string){
        $r = (int)substr($string, 3, 5)+1;
        if($r<10)
            $r = '0' . $r;
        return $r;
    }
?>