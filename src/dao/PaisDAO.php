<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaisDAO
 *
 * @author Matheus Gaspar
 */

namespace DAO;
use PDO;

require_once BASE_PATH_DAO."iDAO.php";

class PaisDAO  {

    private $db;
    private $tabela;

    public function __construct($db) {
        $this->db = $db;
        $this->tabela = "pais";
    }

    public function listar() {
        $paises = [];
        $query = $this->db->query("SELECT * FROM {$this->tabela};");
        while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
            $pais = new \Medicamental\Model\Pais($p["nome"], $p["nome_en"], $p["sigla"], $p["bacen"]);
            $pais->setId($p["id"]);
            array_push($paises, $pais);
        }
        return $paises;
    }

    public function buscar($id) {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE id = :id;");
            $query->bindValue(":id", $id, PDO::PARAM_INT);
            $query->execute();
            $p = $query->fetch();
            $pais = new \Medicamental\Model\Pais($p["nome"], $p["nome_en"], $p["sigla"], $p["bacen"]);
            $pais->setId($p["id"]);
            return $pais;
        } catch (PDOException $excecao) {
            echo $excecao->getMessage();
        }
    }

    public function criar($objeto) {
        $nome = $objeto->getNome();
        $nome_en = $objeto->getNome_en();
        $sigla = $objeto->getSigla();
        $bacen = $objeto->getBacen();
        $sql = "INSERT INTO {$this->tabela} (nome, nome_en, sigla, bacen) VALUES (:nome, :nome_en, :sigla, :bacen)";
        try {
            $operacao = $this->db->prepare($sql);
            $operacao->bindValue(":nome", $nome, PDO::PARAM_STR);
            $operacao->bindValue(":nome_en", $nome_en, PDO::PARAM_STR);
            $operacao->bindValue(":sigla", $sigla, PDO::PARAM_STR);
            $operacao->bindValue(":bacen", $bacen, PDO::PARAM_INT);
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
        $nome_en = $objeto->getNome_en();
        $sigla = $objeto->getSigla();
        $bacen = $objeto->getBacen();
        $sql = "UPDATE {$this->tabela} SET nome=:nome, nome=:nome_en, sigla=:sigla, bacen=:bacen WHERE id=:id";
        try {
            $operacao = $this->db->prepare($sql);
            $operacao->bindValue(":id", $id, PDO::PARAM_INT);
            $operacao->bindValue(":nome", $nome, PDO::PARAM_STR);
            $operacao->bindValue(":nome_en", $nome_en, PDO::PARAM_STR);
            $operacao->bindValue(":sigla", $sigla, PDO::PARAM_STR);
            $operacao->bindValue(":bacen", $bacen, PDO::PARAM_INT);
            if ($operacao->execute() || $operacao->rowCount() > 0) {
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
