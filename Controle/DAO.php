<?php
const pessoas = array("hel_cliente", "hel_conjuge", "hel_dependente", "hel_funcionario");
function isPessoa($table){
    foreach(pessoas as $i){
        if($i==$table)
            return true;
    }
    return false;
}
function DBDelete($table, $where = null){
    $table = DB_PREFIX . '_' . $table;
    $where = ($where) ? " WHERE {$where}" : null;
    $query = "DELETE FROM {$table}{$where}";
    return DBExecute($query);
}

function DBUpdate($table, array $data, $where = null){
    $table = DB_PREFIX . '_' . $table;
    $where = ($where) ? " WHERE {$where}" : null;
    $fields = null;
    foreach($data as $key => $value){
        if($value)
            $fields[] = "{$key} = '{$value}'";
    }
    $fields = implode(', ', $fields);
    $query ="UPDATE {$table} SET {$fields}{$where}";
    return DBExecute($query);
}

function DBRead($table, $params = null, $fields = "*"){
    $params = ($params) ? " {$params}" : null;
    $query = "SELECT {$fields} FROM {$table}{$params}";
    $result = DBExecute($query);
    $data = null;
    if(!mysqli_num_rows($result))
        return false;
    else {
        while ($res=mysqli_fetch_assoc($result))
            $data[] = $res;
    }
    return $data;
}
function DBInsert($table, array $data){
    $r1 = true;
    $table = DB_PREFIX . "_" . $table;
    $data = DBEscape($data);
    if(isPessoa($table)){
        $tempTable = DB_PREFIX . "_pessoa";
        $tempArray["idPessoa"] = $data["idPessoa"];
        unset($data["idPessoa"]);
        $tempArray["nomePessoa"] = $data["nomePessoa"];
        unset($data["nomePessoa"]);
        $tempArray["cpfPessoa"] = $data["cpfPessoa"];
        unset($data["cpfPessoa"]);
        $fields = implode(', ', array_keys($tempArray));
        $values = "'".implode("', '", $tempArray)."'";
        $query = "INSERT INTO {$tempTable}({$fields}) VALUES ({$values})";
        $r1 = DBExecute($query);
    }
    $fields = implode(', ', array_keys($data));
    $values = "'".implode("', '", $data)."'";
    $query = "INSERT INTO {$table}({$fields}) VALUES ({$values})";
    $r2 = DBExecute($query);
    return $r1 && $r2;
}
function DBExecute($query){
    $link = DBConnect();
    $result = @mysqli_query($link, $query) or die(mysqli_error($link));
    DBClose($link);
    return $result;
}
?>