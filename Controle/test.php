<?php
    require 'config.php';
    $f = new Funcionario("João da Silva", "123456", "FUN01", "1200", "123");
    DBInsert("funcionario", $f->toArray());
    $f = new Funcionario("Pedro Costa", "654321", "FUN02", "1500", "321");
    DBInsert("funcionario", $f->toArray());