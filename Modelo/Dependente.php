<?php

class Dependente extends Pessoa{
    private $funcionario;
    public function __construct($nome = null, $cpf = null, $id = null, $funcionario = null){
        parent::__construct($nome, $cpf, $id);
        $this->funcionario = $funcionario;
    }

    public function getNome()
    {
        return parent::getNome(); // TODO: Change the autogenerated stub
    }

    public function toArray()
    {
        $r = parent::toArray(); // TODO: Change the autogenerated stub
        $r["idDependente"] = parent::getId();
        $r["fk_idFuncionario"] = $this->funcionario->getId();
        return $r;
    }

    /**
     * @return mixed
     */
    public function getfuncionario()
    {
        return $this->funcionario;
    }

    /**
     * @param mixed $funcionario
     */
    public function setfuncionario($funcionario)
    {
        $this->funcionario = $funcionario;
    }

    public function setNome($nome)
    {
        parent::setNome($nome); // TODO: Change the autogenerated stub
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

    public function __toString()
    {
        return parent::__toString() . "<br> Funcionário a que depende: <br> {$this->funcionario->toString()} <br>"; // TODO: Change the autogenerated stub
    }

}
?>