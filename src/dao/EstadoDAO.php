<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstadoDAO
 *
 * @author Matheus Gaspar
 */

namespace DAO;
use PDO;

require_once BASE_PATH_DAO."iDAO.php";

class EstadoDAO {

    private $db;
    private $tabela;

    public function __construct($db) {
        $this->db = $db;
        $this->tabela = "estado";
    }

    public function listar() {
        $estados = [];
        $consulta = $this->db->query("SELECT * FROM estado;");
        while ($e = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $paisDAO = new \Medicamental\DAO\PaisDAO;
            $estado = new \Medicamental\Model\Estado($e["nome"], $e["uf"], $e["ibge"], $paisDAO->buscar($e["pais"]), $e["ddd"]);
            $estado->setId($e["id"]);
            array_push($estados, $estado);
        }
        return $estados;
    }

    public function buscar($id) {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE id = :id;");
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->execute();
            $e = $query->fetch();            
            $paisDAO = new \Medicamental\DAO\PaisDAO;
            $estado = new \Medicamental\Model\Estado($e["nome"], $e["uf"], $e["ibge"], $paisDAO->buscar($e["pais"]), $e["ddd"]);
            $estado->setId($e["id"]);
            return $estado;
        } catch (PDOException $excecao) {
            echo $excecao->getMessage();
        }
    }

    public function criar($objeto) {
        $nome = $objeto->getNome();
        $uf = $objeto->getUf();
        $ibge = $objeto->getIbge();
        $pais = $objeto->getPais();        
        $ddd = $objeto->getDdd();
        $sql = "INSERT INTO {$this->tabela} (nome, uf, ibge, pais, ddd) VALUES (:nome, :uf, :ibge, :pais :ddd)";
        try {
            $operacao = $this->db->prepare($sql);
            $operacao->bindValue(":nome", $nome, PDO::PARAM_STR);
            $operacao->bindValue(":uf", $uf, PDO::PARAM_STR);
            $operacao->bindValue(":ibge", $ibge, PDO::PARAM_INT);
            $operacao->bindValue(":pais", $pais->getId(), PDO::PARAM_INT);
            $operacao->bindValue(":ddd", $ddd, PDO::PARAM_STR);
            if ($operacao->execute() && $operacao->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $excecao) {
            echo $excecao->getMessage();
        }
    }

    public function editar($objeto) {
        $id = $objeto->getId();
        $nome = $objeto->getNome();
        $uf = $objeto->getUf();
        $ibge = $objeto->getIbge();
        $pais = $objeto->getPais();        
        $ddd = $objeto->getDdd(); 
        $sql = "UPDATE {$this->tabela} SET nome=:nome, uf=:uf, ibge=:ibge, pais=:pais, ddd=:ddd WHERE id=:id";
        try {
            $operacao = $this->db->prepare($sql);
            $operacao->bindValue(":id", $id, PDO::PARAM_INT);
            $operacao->bindValue(":nome", $nome, PDO::PARAM_STR);
            $operacao->bindValue(":uf", $uf, PDO::PARAM_STR);
            $operacao->bindValue(":ibge", $ibge, PDO::PARAM_INT);
            $operacao->bindValue(":pais", $pais->getId(), PDO::PARAM_INT);
            $operacao->bindValue(":ddd", $ddd, PDO::PARAM_STR);
            if ($operacao->execute() && $operacao->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $excecao) {
            echo $excecao->getMessage();
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
            echo $excecao->getMessage();
        }
    }

}
