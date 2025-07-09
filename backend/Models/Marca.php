<?php

class Marca
{
    private $id;
    private $nome;
    private $anofundacao;
    private $pais;
    private $ativo;

    public function __construct($nome, $anofundacao, $pais, $ativo)
    {
        $this->nome = $nome;
        $this->anofundacao = $anofundacao;
        $this->pais = $pais;
        $this->ativo = $ativo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getAnoFundacao()
    {
        return $this->anofundacao;
    }

    public function setAnoFundacao($anofundacao)
    {
        $this->anofundacao = $anofundacao;
    }

    public function getPais()
    {
        return $this->pais;
    }

    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }
}
