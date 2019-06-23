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

namespace DAO;

/**
 * Description of CRUD
 *
 * @author Matheus Gaspar
 */


class CRUD {
    
    const SELECT = 1;
    const INSERE = 2;
    const UPDATE = 3;
    const DELETE = 4;
    
    private $tabela;
    private $db;
    private $tag;
    
    function __construct($tabela = NULL, $db = NULL, $tag = ":") {
        $this->tabela = $tabela;
        $this->db = $db;
        $this->tag = $tag;
    }
    
    function getTabela() {
        return $this->tabela;
    }
    function setTabela($tabela) {
        $this->tabela = $tabela;
    }
    
    function getDb() {
        return $this->db;
    }
    function setDb($db) {
        $this->db = $db;
    }
    
    function getTag() {
        return $this->tag;
    }
    function setTag($tag) {
        $this->tag = $tag;
    }
    
    function select($input = NULL, $class= NULL, $where = NULL) {
        return $this->builder(CRUD::SELECT, $input, $where, $class);
    }
    
    function insert($data) {
        return $this->builder(CRUD::INSERE, $data);
    }

    function update($data, $where = NULL) {
        return $this->builder(CRUD::UPDATE, $data, $where);
    }

    function delete($data) {
        return $this->builder(CRUD::DELETE, $data);
    }
    
    private function builder($operacao, $data = NULL, $where = NULL, $class = NULL){
        $params = [];
        $sql = "";
        switch($operacao){
            case 1:
                $sql = "SELECT * FROM {$this->tabela};";
            break;
            case 2:
                $campos = [];
                $sql = "INSERT INTO {$this->tabela} SET ";
                foreach ($data as $i => $v) {
                    $param = $this->tag.$i;
                    array_push($campos, $i."=".$param);
                    $params[$param] = $v;
                }
                $sql .= implode(",", $campos) . ";";
            break;
            case 3:
                if(!is_null($where)){
                    $campos = [];
                    $sql = "UPDATE {$this->tabela} SET ";
                    $isArray = is_array($where);
                    $wh = [];
                    foreach ($data as $i => $v) {
                        $param = $this->tag.$i;
                        if($isArray && in_array($i, $where)){
                            array_push($wh, $i."=".$param);
                        }elseif($i === $where){
                            array_push($wh, $i."=".$param);
                        }else{
                            array_push($campos, $i."=".$param);
                        }
                        $params[$param] = $v;
                    }
                    $sql .= implode(",", $campos) . " WHERE " . implode(" AND ", $wh) . ";";
                }else{
                    $sql = "{indice=NULL}";
                }
            break;
            case 4:
                $campos = [];
                $sql = "DELETE FROM {$this->tabela} WHERE ";
                foreach ($data as $i => $v) {
                    $param = $this->tag.$i;
                    array_push($campos, $i."=".$param);
                    $params[$param] = $v;
                }
                $sql .= implode(" AND ", $campos) . ";";
            break;
        }
        return array("sql" => $sql, "params" => $params);
    }
}
