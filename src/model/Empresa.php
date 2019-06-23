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
 * Description of Empresa
 *
 * @author Matheus Gaspar
 */

namespace Model;

class Empresa implements \JsonSerializable{
    private $id;
    private $nome;
    private $rg;
    private $cpf;
    private $cnpj;
    private $email;
    private $senha;
    private $pFisica;
    private $pJuridica;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cep;
    private $cidade;
    private $dataCriado;
    private $dataAtualizado;
    private $ativo;
    
    function __construct($nome = NULL, $email = NULL, $senha = NULL, $ativo = TRUE) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->ativo = $ativo;
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getRg() {
        return $this->rg;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getCnpj() {
        return $this->cnpj;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function getPFisica() {
        return $this->pFisica;
    }

    function getPJuridica() {
        return $this->pJuridica;
    }

    function getLogradouro() {
        return $this->logradouro;
    }

    function getNumero() {
        return $this->numero;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getCep() {
        return $this->cep;
    }

    function getCidade() {
        return $this->cidade;
    }

    function getDataCriado() {
        return $this->dataCriado;
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

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setPFisica($pFisica) {
        $this->pFisica = $pFisica;
    }

    function setPJuridica($pJuridica) {
        $this->pJuridica = $pJuridica;
    }

    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setDataCriado($dataCriado) {
        $this->dataCriado = $dataCriado;
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
