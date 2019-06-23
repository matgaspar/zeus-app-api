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
 * Description of Pessoa
 *
 * @author Matheus Gaspar
 */

namespace Model;

class Pessoa extends Endereco implements \JsonSerializable {
    private $id;
    private $empresa;
    private $nome;
    private $sobrenome;
    private $rg;
    private $cpf;
    private $email;
    private $senha;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cep;
    private $cidade;
    private $motorista;
    private $inspetor;
    private $passageiro;
    private $dataCriado;
    private $dataAtualizado;
    private $ativo;
    private $token;
        
    function __construct($empresa = NULL, $nome = NULL, $sobrenome = NULL, $rg = NULL, $cpf = NULL, $email = NULL, $senha = NULL, $cidade = NULL, $ativo = TRUE) {
        $this->empresa      = $empresa;
        $this->nome         = $nome;
        $this->sobrenome    = $sobrenome;
        $this->rg           = $rg;
        $this->cpf          = $cpf;
        $this->email        = $email;
        $this->senha        = $senha;
        $this->cidade        = $cidade;
        $this->ativo        = $ativo;
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

    function getSobrenome() {
        return $this->sobrenome;
    }

    function getRg() {
        return $this->rg;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
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

    function getEndereco() {
        return $this->endereco;
    }

    function getMotorista() {
        return $this->motorista;
    }

    function getInspetor() {
        return $this->inspetor;
    }

    function getPassageiro() {
        return $this->passageiro;
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

    function getToken() {
        return $this->token;
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

    function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
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

    function setMotorista($motorista) {
        $this->motorista = $motorista;
    }

    function setInspetor($inspetor) {
        $this->inspetor = $inspetor;
    }

    function setPassageiro($passageiro) {
        $this->passageiro = $passageiro;
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

    function setToken($token) {
        $this->token = $token;
    }
        
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}
