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
                if (!DBRead("pessoa", "WHERE cpfPessoa = '$tempCpf'")) {
                    $return = DBRead("pessoa", null, 'idPessoa');
                    if ($return) {
                        end($return);
                        $key = key($return);
                        $data["idPessoa"] = "FUN" . getId($return[$key]["idPessoa"]);

                    } else
                        $data["idPessoa"] = "FUN01";
                    $data["idFuncionario"] = $data["idPessoa"];


                }else{
                    echo json_encode("CPF já está cadastrado");
                }
                $f = new Funcionario($data["nomePessoa"], $data["cpfPessoa"], $data["idPessoa"], $data["salarioFuncionario"], $data["senha"]);
                DBInsert("funcionario", $f->toArray());
                echo json_encode("ok");
            }else{
                echo json_encode("Preencha todos os campos");
            }
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