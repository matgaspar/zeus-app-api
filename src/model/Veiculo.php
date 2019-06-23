<?php

/*
 * Copyright (C) 2019 Matheus Gaspar
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Description of Veiculo
 *
 * @author Matheus Gaspar
 */

namespace Model;

class Veiculo implements \JsonSerializable{
    private $id;
    private $empresa;
    private $marca;
    private $modelo;
    private $ano;
    private $chassi;
    private $renavam;
    private $placa;
    private $uf;
    private $dataCadastro;
    private $dataAtualizado;
    private $ativo;
    
    function __construct($empresa = NULL, $marca = NULL, $modelo = NULL, $ano = NULL, $placa = NULL, $uf = NULL, $ativo = TRUE) {
        $this->empresa = $empresa;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->ano = $ano;
        $this->placa = $placa;
        $this->uf = $uf;
        $this->ativo = $ativo;
    }

    function getId() {
        return $this->id;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }

    function getAno() {
        return $this->ano;
    }

    function getChassi() {
        return $this->chassi;
    }

    function getRenavam() {
        return $this->renavam;
    }

    function getPlaca() {
        return $this->placa;
    }

    function getUf() {
        return $this->uf;
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

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    function setAno($ano) {
        $this->ano = $ano;
    }

    function setChassi($chassi) {
        $this->chassi = $chassi;
    }

    function setRenavam($renavam) {
        $this->renavam = $renavam;
    }

    function setPlaca($placa) {
        $this->placa = $placa;
    }

    function setUf($uf) {
        $this->uf = $uf;
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
