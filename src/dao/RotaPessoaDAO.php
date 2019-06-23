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

class RotaPessoaDAO {

    private $db;
    private $tabela;
    private $crud;

    public function __construct($db) {
        $this->db = $db;
        $this->tabela = "rota_pessoa";
        $this->crud = new CRUD($this->tabela);
    }
    
    public function listar($empresa = NULL) {
        $where = "";
        if(!is_null($empresa)){
            $where = "WHERE r.empresa={$empresa}";
        }
        try{
            $query = $this->db->query("SELECT rp.* FROM {$this->tabela} rp "
                . "INNER JOIN rota r on r.id = rp.rota "
                . "INNER JOIN empresa e on e.id = r.empresa "
                . "{$where};");
            $data = $query->fetchAll(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, \Model\RotaPessoa::class);
            return array('sucesso' => TRUE, 'data' => $data);
        } catch (\PDOException $ex){
            return array('error' => TRUE, 'message' => $ex->getMessage());
        }
    }
    public function buscar($id) {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->tabela} WHERE id = :id;");
            $query->bindParam(":id", $id, PDO::PARAM_INT);
            $query->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, \Model\RotaPessoa::class);
            $query->execute();
            return array('sucesso' => TRUE, 'data' => $query->fetch());
        } catch (PDOException $ex) {
            return array('error' => TRUE, 'message' => $ex->getMessage());
        }
    }
    public function criar($input) {
        $input["dataAtualizado"] = date("Y-m-d H:i:s");
        $input["ativo"] = TRUE;
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
