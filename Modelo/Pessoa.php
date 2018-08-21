<?php

class Pessoa{
    private $nome;
    private $cpf;
    private $id;

    public function __construct($nome = null, $cpf = null, $id = null){
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->id = $id;

    }
    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    public function toArray(){
        return array(
            "idPessoa" => $this->id,
            "nomePessoa" => $this->nome,
            "cpfPessoa" => $this->cpf

        );
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function __toString()
    {
        return "Nome: {$this->nome} <br> CPF: {$this->cpf} <br> ID: {$this->id} <br>" ;
    }
}
?>