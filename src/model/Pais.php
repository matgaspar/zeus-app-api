<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pais
 *
 * @author Matheus Gaspar
 */

namespace Model;

class Pais implements \JsonSerializable{
    
    private $id;
    private $nome;
    private $nome_en;
    private $sigla;
    private $bacen;
    
    function __construct($nome = NULL, $nome_en = NULL, $sigla = NULL, $bacen = NULL) {
        $this->nome = $nome;
        $this->nome_en = $nome_en;
        $this->sigla = $sigla;
        $this->bacen = $bacen;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getNome_en() {
        return $this->nome_en;
    }

    function getSigla() {
        return $this->sigla;
    }

    function getBacen() {
        return $this->bacen;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setNome_en($nome_en) {
        $this->nome_en = $nome_en;
    }

    function setSigla($sigla) {
        $this->sigla = $sigla;
    }

    function setBacen($bacen) {
        $this->bacen = $bacen;
    }

    
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}
