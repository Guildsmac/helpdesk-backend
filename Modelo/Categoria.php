<?php
/**
 * Created by PhpStorm.
 * User: guild
 * Date: 8/19/2018
 * Time: 11:37 PM
 */

class Categoria{
    private $id;
    private $nome;
    private $descricao;

    /**
     * Categoria constructor.
     * @param $id
     * @param $nome
     * @param $descricao
     */
    public function __construct($id = null, $nome = null, $descricao = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
    }

    public function toArray(){
        return array("idCategoria" => $this->getId(), "nome" => $this->getNome(), "descricao" => $this->getDescricao());
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

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
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
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function __toString()
    {
        return "Id categoria: {$this->id} <br> Nome: {$this->nome} <br> Descricao: {$this->descricao} <br>";

    }


}
?>