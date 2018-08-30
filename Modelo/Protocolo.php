<?php
/**
 * Created by PhpStorm.
 * User: guild
 * Date: 8/19/2018
 * Time: 11:37 PM
 */

class Protocolo{
    private $funcionario;
    private $cliente;
    private $categoria;
    private $data;
    private $tempoDuracao;
    private $idProtocolo;
    private $detalhes;

    /**
     * Protocolo constructor.
     * @param $funcionario
     * @param $cliente
     * @param $data
     * @param $tempoDuracao
     * @param $idProtocolo
     * @param $detalhes
     */
    public function __construct(Funcionario $funcionario = null,Cliente $cliente = null, $data = null, $tempoDuracao = null, $idProtocolo = null, $detalhes = null, Categoria $categoria = null)
    {
        $this->funcionario = $funcionario;
        $this->cliente = $cliente;
        $this->data = $data;
        $this->tempoDuracao = $tempoDuracao;
        $this->idProtocolo = $idProtocolo;
        $this->detalhes = $detalhes;
        $this->categoria = $categoria;
    }

    /**
     * @return Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param Categoria $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function toArray(){
        return array("fk_idFuncionario" => $this->funcionario->getId(), "fk_idCliente" => $this->cliente->getId(), "idProtocolo" => $this->getIdProtocolo(),
                     "data" => $this->data, "tempoDuracao" => $this->tempoDuracao, "detalhes" => $this->getDetalhes(), "fk_idCategoria" => $this->getCategoria()->getId());
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

    /**
     * @return mixed
     */
    public function getcliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     */
    public function setcliente($cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $Data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getTempoDuracao()
    {
        return $this->tempoDuracao;
    }

    /**
     * @param mixed $tempoDuracao
     */
    public function setTempoDuracao($tempoDuracao)
    {
        $this->tempoDuracao = $tempoDuracao;
    }

    /**
     * @return mixed
     */
    public function getIdProtocolo()
    {
        return $this->idProtocolo;
    }

    /**
     * @param mixed $idProtocolo
     */
    public function setIdProtocolo($idProtocolo)
    {
        $this->idProtocolo = $idProtocolo;
    }

    /**
     * @return mixed
     */
    public function getDetalhes()
    {
        return $this->detalhes;
    }

    /**
     * @param mixed $detalhes
     */
    public function setDetalhes($detalhes)
    {
        $this->detalhes = $detalhes;
    }

    public function __toString()
    {
        return "Dados Funcionário: <br> {$this->funcionario->__toString()} <br>
                Dados Cliente: <br> {$this->cliente->__toString()} <br>
                Data: {$this->data} <br> Tempo duração: {$this->tempoDuracao} <br>
                Id Protocolo: {$this->idProtocolo} <br> Detalhes: {$this->detalhes} <br> ";
    }


}
?>