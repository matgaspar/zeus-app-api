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

class RotaPessoa implements \JsonSerializable{
    private $id;
    private $rota;
    private $pessoa;
    private $dataCadastro;
    private $dataAtualizado;
    private $ativo;
    
    function __construct($rota = NULL, $pessoa = NULL, $ativo = TRUE) {
        $this->rota = $rota;
        $this->pessoa = $pessoa;
        $this->ativo = $ativo;
    }
    
    function getId() {
        return $this->id;
    }

    function getRota() {
        return $this->rota;
    }

    function getPessoa() {
        return $this->pessoa;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getDataAtualizado() {
        return $this->dataAtualizado;
    }

    function getAtivo() {
        return $this->ativo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setRota($rota) {
        $this->rota = $rota;
    }

    function setPessoa($pessoa) {
        $this->pessoa = $pessoa;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setDataAtualizado($dataAtualizado) {
        $this->dataAtualizado = $dataAtualizado;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}
