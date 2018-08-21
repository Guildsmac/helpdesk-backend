<?php

class Funcionario extends Pessoa{
    private $salario;
    private $senha;
    public function __construct($nome = null, $cpf = null, $id = null, $salario = null, $senha = null){
        parent::__construct($nome, $cpf, $id);
        $this->salario = $salario;

        $this->senha = hash('sha256', $senha);;

    }

    /**
     * @return null
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param null $senha
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getNome()
    {
        return parent::getNome(); // TODO: Change the autogenerated stub
    }

    public function setNome($nome)
    {
        parent::setNome($nome); // TODO: Change the autogenerated stub
    }

    public function toArray()
    {
        $r = parent::toArray(); // TODO: Change the autogenerated stub
        $r["salarioFuncionario"] = $this->salario;
        $r["idFuncionario"] = parent::getId();
        $r["senha"] = $this->getSenha();
        return $r;
    }

    public function __toString()
    {
        return parent::__toString() . "<br> Salário: {$this->salario} <br> Senha: {$this->senha} <br>"; // TODO: Change the autogenerated stub
    }

    public function getCpf()
    {
        return parent::getCpf(); // TODO: Change the autogenerated stub
    }

    public function setCpf($cpf)
    {
        parent::setCpf($cpf); // TODO: Change the autogenerated stub
    }

    public function getId()
    {
        return parent::getId(); // TODO: Change the autogenerated stub
    }

    public function setId($id)
    {
        parent::setId($id); // TODO: Change the autogenerated stub
    }

    /**
     * @return mixed
     */
    public function getSalario()
    {
        return $this->salario;
    }

    /**
     * @param mixed $salario
     */
    public function setSalario($salario)
    {
        $this->salario = $salario;
    }

}
?>