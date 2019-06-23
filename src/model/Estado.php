<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estado
 *
 * @author Matheus Gaspar
 */

namespace Model;

class Estado implements \JsonSerializable{
    private $id;
    private $nome;
    private $uf;
    private $ibge;
    private $pais;
    private $ddd;

    function __construct($nome = NULL, $uf = NULL, $ibge = NULL, $pais = NULL, $ddd = NULL) {
        $this->nome = $nome;
        $this->uf = $uf;
        $this->ibge = $ibge;
        $this->pais = $pais;
        $this->ddd = $ddd;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getUf() {
        return $this->uf;
    }

    function getIbge() {
        return $this->ibge;
    }

    function getPais() {
        return $this->pais;
    }

    function getDdd() {
        return $this->ddd;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setUf($uf) {
        $this->uf = $uf;
    }

    function setIbge($ibge) {
        $this->ibge = $ibge;
    }

    function setPais($pais) {
        $this->pais = $pais;
    }

    function setDdd($ddd) {
        $this->ddd = $ddd;
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }

}
