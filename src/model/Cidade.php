<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cidade
 *
 * @author Matheus Gaspar
 */

namespace Model;

class Cidade implements \JsonSerializable{
    private $id;
    private $nome;
    private $estado;
    private $ibge;
    
    function __construct($nome = NULL, $estado = NULL, $ibge = NULL) {
        $this->nome = $nome;
        $this->estado = $estado;
        $this->ibge = $ibge;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEstado() {
        return $this->estado;
    }

    function getIbge() {
        return $this->ibge;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setIbge($ibge) {
        $this->ibge = $ibge;
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}
