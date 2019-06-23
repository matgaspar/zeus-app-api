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
 * Description of Rota
 *
 * @author Matheus Gaspar
 */

namespace Model;

class Rota implements \JsonSerializable{
    private $id;
    private $empresa;
    private $nome;
    private $veiculo;
    private $motorista;
    private $inspetor;
    private $orig_nome;
    private $orig_logradouro;
    private $orig_numero;
    private $orig_bairro;
    private $orig_cep;
    private $orig_cidade;
    private $dest_nome;
    private $dest_logradouro;
    private $dest_numero;
    private $dest_bairro;
    private $dest_cep;
    private $dest_cidade;
    private $dataCadastro;
    private $dataAtualizado;
    private $ativo;
    
    function __construct($empresa = NULL, $nome = NULL, $veiculo = NULL, $motorista = NULL, $orig_nome = NULL, $orig_cidade = NULL, $dest_nome = NULL, $dest_cidade = NULL, $ativo = TRUE) {
        $this->empresa = $empresa;
        $this->nome = $nome;
        $this->veiculo = $veiculo;
        $this->motorista = $motorista;
        $this->orig_nome = $orig_nome;
        $this->orig_cidade = $orig_cidade;
        $this->dest_nome = $dest_nome;
        $this->dest_cidade = $dest_cidade;
        $this->ativo = $ativo;
    }

    function getId() {
        return $this->id;
    }
    
    function getEmpresa() {
        return $this->empresa;
    }

    function getNome() {
        return $this->nome;
    }

    function getVeiculo() {
        return $this->veiculo;
    }

    function getMotorista() {
        return $this->motorista;
    }

    function getInspetor() {
        return $this->inspetor;
    }

    function getOrig_nome() {
        return $this->orig_nome;
    }

    function getOrig_logradouro() {
        return $this->orig_logradouro;
    }

    function getOrig_numero() {
        return $this->orig_numero;
    }

    function getOrig_bairro() {
        return $this->orig_bairro;
    }

    function getOrig_cep() {
        return $this->orig_cep;
    }

    function getOrig_cidade() {
        return $this->orig_cidade;
    }

    function getDest_nome() {
        return $this->dest_nome;
    }

    function getDest_logradouro() {
        return $this->dest_logradouro;
    }

    function getDest_numero() {
        return $this->dest_numero;
    }

    function getDest_bairro() {
        return $this->dest_bairro;
    }

    function getDest_cep() {
        return $this->dest_cep;
    }

    function getDest_cidade() {
        return $this->dest_cidade;
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

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setVeiculo($veiculo) {
        $this->veiculo = $veiculo;
    }

    function setMotorista($motorista) {
        $this->motorista = $motorista;
    }

    function setInspetor($inspetor) {
        $this->inspetor = $inspetor;
    }

    function setOrig_nome($orig_nome) {
        $this->orig_nome = $orig_nome;
    }

    function setOrig_logradouro($orig_logradouro) {
        $this->orig_logradouro = $orig_logradouro;
    }

    function setOrig_numero($orig_numero) {
        $this->orig_numero = $orig_numero;
    }

    function setOrig_bairro($orig_bairro) {
        $this->orig_bairro = $orig_bairro;
    }

    function setOrig_cep($orig_cep) {
        $this->orig_cep = $orig_cep;
    }

    function setOrig_cidade($orig_cidade) {
        $this->orig_cidade = $orig_cidade;
    }

    function setDest_nome($dest_nome) {
        $this->dest_nome = $dest_nome;
    }

    function setDest_logradouro($dest_logradouro) {
        $this->dest_logradouro = $dest_logradouro;
    }

    function setDest_numero($dest_numero) {
        $this->dest_numero = $dest_numero;
    }

    function setDest_bairro($dest_bairro) {
        $this->dest_bairro = $dest_bairro;
    }

    function setDest_cep($dest_cep) {
        $this->dest_cep = $dest_cep;
    }

    function setDest_cidade($dest_cidade) {
        $this->dest_cidade = $dest_cidade;
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
