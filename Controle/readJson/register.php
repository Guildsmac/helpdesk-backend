<?php
    include 'C:/Users/guild/PhpstormProjects/Helpdesk Back-End/Controle/config.php';
    $json = file_get_contents("php://input");
    $obj = json_decode($json, true);
    $table = $obj["table"];
    $isEdit = $obj["edit"];

    if($table){
        if(strcmp($table, "funcionario")==0) {
            $data["nomePessoa"] = $obj["nomePessoa"];
            $data["cpfPessoa"] = $obj["cpfPessoa"];
            $data["salarioFuncionario"] = $obj["salarioFuncionario"];
            $data["senha"] = hash('sha256', $obj["senha"]);

            $id = "";
            if ($data["nomePessoa"] & $data["cpfPessoa"] & $data["salarioFuncionario"] & $data["senha"]) {

                if(!$isEdit) {
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


                    } else {
                        echo json_encode("CPF já está cadastrado");
                    }
                }
                else{
                    $tempId = $obj["idPessoa"];
                    $personData["nomePessoa"] = $data["nomePessoa"];
                    $personData["cpfPessoa"] = $data["cpfPessoa"];
                    $funcionarioData["salarioFuncionario"] = $data["salarioFuncionario"];
                    $funcionarioData["senha"] = $data["senha"];
                    DBUpdate("pessoa", $personData, "idPessoa = '$tempId'");
                    DBUpdate("funcionario", $funcionarioData, "idFuncionario = '$tempId'");
                    echo json_encode("Funcionário editado com sucesso");
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
                if(!$isEdit) {
                    $tempCpf = $data['cpfPessoa'];
                    if (!DBRead("hel_pessoa", "WHERE cpfPessoa = '$tempCpf'")) {
                        $return = DBRead("hel_cliente", null, "idCliente");
                        if ($return) {
                            end($return);
                            $key = key($return);
                            $data["idPessoa"] = "CLI" . getId($return[$key]["idCliente"]);

                        } else
                            $data["idPessoa"] = "CLI01";
                        $data["idCliente"] = $data["idPessoa"];
                        $c = new Cliente($data["nomePessoa"], $data["cpfPessoa"], $data["idPessoa"], $data["email"], $data["endereco"]);
                        DBInsert("cliente", $c->toArray());
                        echo json_encode("Cliente cadastrado com sucesso");

                    } else
                        echo json_encode("CPF já está cadastrado");
                }else{
                    $tempId = $obj["idPessoa"];

                    $personData["nomePessoa"] = $data["nomePessoa"];
                    $personData["cpfPessoa"] = $data["cpfPessoa"];
                    $clienteData["email"] = $data["email"];
                    $clienteData["endereco"] = $data["endereco"];
                    DBUpdate("pessoa", $personData, "idPessoa = '$tempId'");
                    DBUpdate("cliente", $clienteData, "idCliente = '$tempId'");
                    echo json_encode("Cliente editado com sucesso");
                }

            }else
                echo json_encode("Preencha todos os campos");
        }
        else if(strcmp($table, "categoria")==0){
            $data["nome"] = $obj["nome"];
            $data["descricao"] = $obj["descricao"];
            $id = "";
            if($data["nome"] & $data["descricao"]){
                if(!$isEdit) {
                    $tempNome = $data["nome"];
                    if (!DBRead("hel_categoria", "WHERE nome = '$tempNome'")) {
                        $return = DBRead("hel_categoria", null, "idCategoria");
                        if ($return) {
                            end($return);
                            $key = key($return);
                            $data["idCategoria"] = "CAT" . getId($return[$key]["idCategoria"]);
                        } else {
                            $data["idCategoria"] = "CAT01";
                        }
                        $c = new Categoria($data["idCategoria"], $data["nome"], $data["descricao"]);
                        DBInsert("categoria", $c->toArray());
                        echo json_encode("Categoria cadastrada com sucesso");
                    } else {
                        echo json_encode("Categoria já existente");
                    }
                }else{
                    $tempId = $obj["idCategoria"];
                    DBUpdate("categoria", array("nome" => $data["nome"], "descricao" => $data["descricao"]), "idCategoria = '$tempId'");
                    echo json_encode("Categoria editada com sucesso");
                }
            }else
                echo json_encode("Preencha todos os campos");
        }

        else if(strcmp($table, "protocolo")==0){
            $data["date"] = getFormattedDate($obj["date"]);
            $data["duracao"] = $obj["duracao"];
            $data["detalhes"] = $obj["detalhes"];
            $data["idFuncionario"] = $obj["idFuncionario"];
            $data["idCliente"] = $obj["idCliente"];
            $data["idCategoria"] = $obj["idCategoria"];
            $fun = null;
            $cli = null;
            $cat = null;
            $tempId = $data["idFuncionario"];
            $funcInfo = DBRead("hel_pessoa as p, hel_funcionario as f", "WHERE p.idPessoa = '$tempId' and p.idPessoa = f.idFuncionario", "p.*, f.salarioFuncionario, f.senha")[0];
            if($funcInfo) {
                $fun = new Funcionario($funcInfo["nomePessoa"], $funcInfo["cpfPessoa"], $funcInfo["idPessoa"], $funcInfo["salarioFuncionario"], $funcInfo["senha"]);
            }
            else
                echo json_encode("Erro: Não existe Pessoa Funcionário");


            $tempId = $data["idCliente"];
            $clientInfo = DBRead("hel_pessoa as p, hel_cliente as c", "WHERE p.idPessoa = '$tempId' and p.idPessoa = c.idCliente", "p.*, c.email, c.endereco")[0];
            if($clientInfo)
                $cli = new Cliente($clientInfo["nomePessoa"], $clientInfo["cpfPessoa"], $clientInfo["idPessoa"], $clientInfo["email"], $clientInfo["endereco"]);
            else
                echo json_encode("Erro: Não existe Pessoa Cliente");


            $tempId = $data["idCategoria"];
            $categoriaInfo = DBRead("hel_categoria", "WHERE idCategoria = '$tempId'")[0];
            if($categoriaInfo)
                $cat = new Categoria($categoriaInfo["idCategoria"], $categoriaInfo["nome"], $categoriaInfo["descricao"]);
            else
                echo json_encode("Erro: Não existe Categoria");
            if($data['date'] & $data['duracao'] & $data['detalhes']){
                if(!$isEdit) {
                    $return = DBRead("hel_protocolo", null, "idProtocolo");
                    if ($return) {
                        end($return);
                        $key = key($return);
                        $data["idProtocolo"] = "PRO" . getId($return[$key]["idProtocolo"]);
                        $test = getId($return[$key]["idProtocolo"]);
                    } else
                        $data["idProtocolo"] = "PRO01";
                }else{
                    $data["idProtocolo"] = $obj["idProtocolo"];
                }

            }else
                json_encode("Preencha todos os campos");
            $pro = new Protocolo($fun, $cli, $data["date"], !$isEdit ? $data["duracao"] . "Mins" : $data["duracao"], $data["idProtocolo"], $data["detalhes"], $cat);
            if(!$isEdit) {
                DBInsert("protocolo", $pro->toArray());
                echo json_encode("Protocolo inserido com sucesso");

            }else{
                $r = $pro->toArray();
                //echo json_encode($r["fk_idFuncionario"] . " --- " . $r["fk_idCliente"] . " --- " .$r["data"] . " --- " .$r["tempoDuracao"] . " --- " .$r["detalhes"] . " --- " .$r["idProtocolo"] . " --- " .$r["fk_idCategoria"]);

                $tempId = $obj["idProtocolo"];

                DBUpdate($table, $r, "idProtocolo = '$tempId'");
                echo json_encode("Protocolo editado com sucesso");

            }
        }
    }else{
        echo json_encode("Tabela não válida");
    }

    function getFormattedDate($date){
        $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        $pos = false;
        $monthNumber=0;
        foreach($months as $i){
            $pos = strpos($date, $i);
            $monthNumber++;
            if($pos)
                break;

        }
        if($pos) {
            $r = str_replace($months[$monthNumber - 1], $monthNumber < 10 ? '0' . $monthNumber : $monthNumber, str_replace(' ', '-', substr($date, $pos, 11)));
            return substr($r, 6, strlen($r)) . '-' . substr($r, 0, 2) . '-' . substr($r, 3, 2);
        }
        else return $date;
    }

    function getId($string){
        $r = (int)substr($string, 3, 5)+1;
        if($r<10)
            $r = '0' . $r;
        return $r;
    }
?>