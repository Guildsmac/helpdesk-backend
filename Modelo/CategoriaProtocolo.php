<?php
/**
 * Created by PhpStorm.
 * User: guild
 * Date: 8/19/2018
 * Time: 11:45 PM
 */

class CategoriaProtocolo
{
    private $protocolo;
    private $categoria;

    /**
     * CategoriaProtocolo constructor.
     * @param $protocolo
     * @param $categoria
     */
    public function __construct(Protocolo $protocolo = null, Categoria $categoria = null)
    {
        $this->protocolo = $protocolo;
        $this->categoria = $categoria;
    }

    public function toArray(){
        return array("fk_idCategoria" => $this->categoria->getId(), "fk_idProtocolo" => $this->protocolo->getIdProtocolo());

    }

    /**
     * @return mixed
     */
    public function getprotocolo()
    {
        return $this->protocolo;
    }

    /**
     * @param mixed $protocolo
     */
    public function setprotocolo($protocolo)
    {
        $this->protocolo = $protocolo;
    }

    /**
     * @return mixed
     */
    public function getcategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setcategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function __toString()
    {
        return "Dados Protocolo: {$this->protocolo->__toString()} <br>
                Dados Categoria: {$this->categoria->__toString()}";
    }

}
?>