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

class CidadeDAO {

    private $db;
    private $tabela;

    public function __construct($db) {
        $this->db = $db;
        $this->tabela = "cidade";
    }
    public function listar($estado = NULL) {
        $where = "";
        if(!is_null($estado)){
            $where = "WHERE estado={$estado}";
        }
        try{
            $query = $this->db->query("SELECT * FROM {$this->tabela} {$where};");
            return $query->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, \Model\Cidade::class);
        } catch (\PDOException $ex){
            return $ex->getMessage();
        }
    }
    public function buscar($id) {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE id = :id;");
            $query->bindParam(":id", $id, PDO::PARAM_INT);
            $query->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, \Model\Cidade::class);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $excecao) {
            return $excecao->getMessage();
        }
    }    
    public function buscarIbge($ibge) {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE ibge = :ibge;");
            $query->bindParam(":ibge", $ibge, PDO::PARAM_INT);
            $query->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, \Model\Cidade::class);
            $query->execute();
            return $query->fetch();
        } catch (PDOException $excecao) {
            return $excecao->getMessage();
        }
    }    
    public function buscarNome($nome) {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE nome = :nome;");
            $query->bindParam(":nome", $nome, PDO::PARAM_INT);
            return $query->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, \Model\Cidade::class);
        } catch (PDOException $excecao) {
            return $excecao->getMessage();
        }
    }
    public function criar($objeto) {
        $nome = $objeto->getNome();
        $estado = $objeto->getEstado();  
        $ibge = $objeto->getIbge();       
        $sql = "INSERT INTO {$this->tabela} (nome, estado, ibge) VALUES (:nome, :estado, :ibge)";
        try {
            $operacao = $this->db->prepare($sql);
            $operacao->bindValue(":nome", $nome, PDO::PARAM_STR);
            $operacao->bindValue(":estado", $estado->getId(), PDO::PARAM_INT);
            $operacao->bindValue(":ibge", $ibge, PDO::PARAM_INT);
            if ($operacao->execute() && $operacao->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $excecao) {
            return $excecao->getMessage();
        }
    }
    public function editar($objeto) {
        $id = $objeto->getId();
        $nome = $objeto->getNome();
        $estado = $objeto->getEstado();         
        $ibge = $objeto->getIbge();   
        $sql = "UPDATE {$this->tabela} SET nome=:nome, estado=:estado, ibge=:ibge WHERE id=:id";
        try {
            $operacao = $this->db->prepare($sql);
            $operacao->bindValue(":id", $id, PDO::PARAM_INT);
            $operacao->bindValue(":nome", $nome, PDO::PARAM_STR);
            $operacao->bindValue(":estado", $estado->getId(), PDO::PARAM_INT);
            $operacao->bindValue(":ibge", $ibge, PDO::PARAM_INT);
            if ($operacao->execute() && $operacao->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $excecao) {
            return $excecao->getMessage();
        }
    }
    public function deletar($id) {
        $sql = "DELETE FROM {$this->tabela} WHERE id=:id";
        try {
            $operacao = $this->db->prepare($sql);
            $operacao->bindValue(":id", $id, PDO::PARAM_INT);
            if ($operacao->execute() && $operacao->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $excecao) {
            return $excecao->getMessage();
        }
    }

}
