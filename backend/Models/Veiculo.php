<?php

class Veiculo
{
    private $id;
    private $marca;
    private $modelo;
    private $placa;
    private $ano;
    private $cor;
    private $tipo;
    private $status;

    public function __construct($marca, $modelo, $placa, $ano, $cor, $tipo, $status)
    {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->placa = $placa;
        $this->ano = $ano;
        $this->cor = $cor;
        $this->tipo = $tipo;
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    public function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }

    public function getPlaca()
    {
        return $this->placa;
    }

    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }

    public function getAno()
    {
        return $this->ano;
    }

    public function setAno($ano)
    {
        $this->ano = $ano;
    }

    public function getCor()
    {
        return $this->cor;
    }

    public function setCor($cor)
    {
        $this->cor = $cor;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}
