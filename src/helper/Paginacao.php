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

namespace Helper;

/**
 * Description of Paginacao
 *
 * @author Matheus Gaspar
 */
class Paginacao implements \JsonSerializable{
    
    public static $ORDER_ASC = 1;
    public static $ORDER_DESC = 2;
    
    private $tabela;
    private $pagina_atual;
    private $pagina_anterior;
    private $pagina_proxima;
    private $pagina_ultima;
    private $limite;
    private $total;
    private $total_pagina;
    private $total_paginas;
    private $exibindo;
    private $sql;
    private $sucesso;
    private $data;
    
    function __construct($tabela = NULL, $total = NULL, $limite = NULL) {
        $this->tabela = $tabela;
        $this->total = $total;
        $this->limite = $limite;
    }
    
    function run($pagina = NULL, $where = NULL, $order = NULL){
        $this->total_paginas = ceil($this->total/$this->limite);
        $this->pagina_ultima = $this->total_paginas;
        
        if (is_null($pagina) || $pagina <= 1) {
            $this->pagina_atual = 1;
            $this->pagina_proxima = ($this->pagina_atual + 1);
        }elseif($pagina <= $this->total_paginas){
            $this->pagina_atual = $pagina;
            if($this->pagina_atual > 1 && $this->pagina_atual < $this->total_paginas){
                $this->pagina_anterior = ($this->pagina_atual - 1);
                $this->pagina_proxima = ($this->pagina_atual + 1);
            }else{
                $this->pagina_anterior = ($this->pagina_atual - 1);
            }
        }else{
            $this->pagina_atual = $this->total_paginas;
            if($this->pagina_atual > 1 && $this->pagina_atual < $this->total_paginas){
                $this->pagina_anterior = ($this->pagina_atual - 1);
                $this->pagina_proxima = ($this->pagina_atual + 1);
            }else{
                $this->pagina_anterior = ($this->pagina_atual - 1);
            }
        }
        
        if(is_null($where)){
            $where = "";
        }
        
        if(is_null($order)){
            $order = array(["id", $this::$ORDER_ASC]);
        }
        $orderSql = $this->getSqlOrder($order);
        
        $this->exibindo = $this->limite;
        
        $inicio_limite = ($this->pagina_atual-1)*$this->limite;
        $this->sql  = "SELECT * FROM {$this->tabela} {$where} ORDER BY {$orderSql} LIMIT {$inicio_limite}, {$this->limite}";
    }
    
    private function getSqlOrder($order){
        $str = [];
        foreach ($order as $v) {
            array_push($str, $v[0]." ".$this->getMethodOrder($v[1]));
        }
        return implode(", ", $str);
    }   
    private function getMethodOrder($method){
        switch($method){
            case 1:
                return "ASC";
            case 2:
                return "DESC";
            default:
                return "ASC";
        }
    }
    
    function getData() {
        return $this->data;
    }
    function getTabela() {
        return $this->tabela;
    }
    function getPagina_atual() {
        return $this->pagina_atual;
    }
    function getPagina_anterior() {
        return $this->pagina_anterior;
    }
    function getPagina_proxima() {
        return $this->pagina_proxima;
    }
    function getPagina_ultima() {
        return $this->pagina_ultima;
    }
    function getLimite() {
        return $this->limite;
    }
    function getTotal() {
        return $this->total;
    }
    function getTotal_pagina() {
        return $this->total_pagina;
    }
    function getTotal_paginas() {
        return $this->total_paginas;
    }
    function getExibindo() {
        return $this->exibindo;
    }
    function getSucesso() {
        return $this->sucesso;
    }
    function getSql() {
        return $this->sql;
    }    
    function setData($data) {
        $this->data = $data;
    }
    function setTabela($tabela) {
        $this->tabela = $tabela;
    }
    function setPagina_atual($pagina_atual) {
        $this->pagina_atual = $pagina_atual;
    }
    function setPagina_anterior($pagina_anterior) {
        $this->pagina_anterior = $pagina_anterior;
    }
    function setPagina_proxima($pagina_proxima) {
        $this->pagina_proxima = $pagina_proxima;
    }
    function setPagina_ultima($pagina_ultima) {
        $this->pagina_ultima = $pagina_ultima;
    }
    function setLimite($limite) {
        $this->limite = $limite;
    }
    function setTotal($total) {
        $this->total = $total;
    }
    function setTotal_pagina($total_pagina) {
        $this->total_pagina = $total_pagina;
    }
    function setTotal_paginas($total_paginas) {
        $this->total_paginas = $total_paginas;
    }
    function setExibindo($exibindo) {
        $this->exibindo = $exibindo;
    }
    function setSql($sql) {
        $this->sql = $sql;
    }
    function setSucesso($sucesso) {
        $this->sucesso = $sucesso;
    }
    
    public function jsonSerialize() {
        $vars = get_object_vars($this);
        return $vars;
    }
}
