<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CidadeDAO
 *
 * @author Matheus Gaspar
 */

namespace DAO;
use PDO;

class PessoaDAO {

    private $db;
    private $tabela;
    private $crud;

    public function __construct($db) {
        $this->db = $db;
        $this->tabela = "pessoa";
        $this->crud = new CRUD($this->tabela, $this->db);
    }
    
    public function listar($params = NULL) {
        $where = "";
        $limite = 10;
        $pagina = 1;
        $order = NULL;
        if(isset($params['empresa'])){
            $where = "WHERE empresa={$params['empresa']}";
        }
        if(isset($params["limite"])){
            $limite = (int)$params["limite"];
        }
        if(isset($params["pagina"])){
            $pagina = (int)$params["pagina"];
        }
        if(isset($params["order"])){
            $order = $params["order"];
        }
        try{
            $query = $this->db->query("SELECT COUNT(*) 'total' FROM {$this->tabela} {$where};");
            $total = (int)$query->fetch()["total"];
            $paginacao = new \Helper\Paginacao($this->tabela, $total, $limite);
            $order = array(
                ["nome", $paginacao::$ORDER_ASC],
                ["sobrenome", $paginacao::$ORDER_ASC]
            );
            $paginacao->run($pagina, $where, $order);
            
            $query = $this->db->query($paginacao->getSql());
            
            $paginacao->setTotal_pagina($query->rowCount());
            $paginacao->setData($query->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, \Model\Pessoa::class));
            $paginacao->setSucesso(TRUE);
            return $paginacao;
        } catch (\PDOException $ex){
            return array('error' => TRUE, 'message' => $ex->getMessage());
        }
    }
    public function buscar($id) {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE id = :id;");
            $query->bindParam(":id", $id, PDO::PARAM_INT);
            $query->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, \Model\Pessoa::class);
            $query->execute();
            $p = $query->fetch();
            $p->setMotorista(boolval($p->getMotorista()));
            $p->setInspetor(boolval($p->getInspetor()));
            $p->setPassageiro(boolval($p->getPassageiro()));
            $p->setAtivo(boolval($p->getAtivo()));
            return array('sucesso' => TRUE, 'data' => $p);
        } catch (\PDOException $ex){
            return array('error' => TRUE, 'message' => $ex->getMessage());
        }
    }
    public function buscarNome($nome, $empresa) {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE nome LIKE '%:nome%' AND empresa=:empresa;");
            $query->bindParam(":nome", $nome, PDO::PARAM_STR);
            $query->bindParam(":empresa", $empresa, PDO::PARAM_INT);
            return $query->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, \Model\Cidade::class);
        } catch (\PDOException $excecao) {
            return $excecao->getMessage();
        }
    }
    public function login($email = NULL) {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE email = :email;");
            $query->bindParam(":email", $email, PDO::PARAM_INT);
            $query->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, \Model\Pessoa::class);
            $query->execute();
//            print_r($query->fetch());
            $p = $query->fetch();
//            $p->setEndereco(new \Model\Endereco($p->getLogradouro(), $p->getNumero(), $p->getBairro(), $p->getCep(), $p->getCidade()));
            return array('sucesso' => TRUE, 'data' => $p);
        } catch (\PDOException $ex){
            return array('error' => TRUE, 'message' => $ex->getMessage());
        }
    }
    public function criar($input) {
        $input["dataAtualizado"] = date("Y-m-d H:i:s");
        $input["ativo"] = TRUE;
        $input["senha"] = criptografar($input["senha"]);
        $crud = $this->crud->insert($input);
        try{
            $sth = $this->db->prepare($crud["sql"]);
            if ($sth->execute($crud["params"]) && $sth->rowCount() > 0) {
                return ['sucesso' => true, 'message' => "Criado com sucesso!", 'id' => $this->db->lastInsertId()];
            } else {
                return ['error' => true, 'message' => "Falha na criação!"];
            }
        }catch(\PDOException $e){
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }
    public function editar($input) {
        if(isset($input["senha"])){
            $input["senha"] = criptografar($input["senha"]);
        }
        $input["dataAtualizado"] = date("Y-m-d H:i:s");
        $crud = $this->crud->update($input, "id");
        try {
            $operacao = $this->db->prepare($crud["sql"]);
            if ($operacao->execute($crud["params"]) && $operacao->rowCount() > 0) {
                return ['sucesso' => true, 'message' => "Alterado com sucesso!"];
            } else {
                return ['error' => true, 'message' => "Falha na alteração!"];
            }
        } catch (PDOException $excecao) {
            return $excecao->getMessage();
        }
    }
    public function deletar($input) {
        $crud = $this->crud->delete($input);
        try {
            $operacao = $this->db->prepare($crud["sql"]);
            if ($operacao->execute($crud["params"]) && $operacao->rowCount() > 0) {
                return ['sucesso' => true, 'message' => "Excluído com sucesso!"];
            } else {
                return ['error' => true, 'message' => "Falha na exclusão!"];
            }
        } catch (PDOException $excecao) {
            return $excecao->getMessage();
        }
    }

}
