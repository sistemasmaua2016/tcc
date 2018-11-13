<?php

class contas {

    private $id;
    private $titulo;
    private $descricao;
    private $valor;
    private $tipo;
    private $categoria;
    private $data;
    private $hora;
    private $usuario_id;
    private $data_venc;
    
    
    function __construct($titulo, $descricao, $valor, $tipo, $categoria, $data, $hora, $usuario_id, $data_venc) {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->valor = $valor;
        $this->tipo = $tipo;
        $this->categoria = $categoria;
        $this->data = $data;
        $this->hora = $hora;
        $this->usuario_id = $usuario_id;
        $this->data_venc = $data_venc;
    }

    
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getValor() {
        return $this->valor;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function getData() {
        return $this->data;
    }

    function getHora() {
        return $this->hora;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getData_venc() {
        return $this->data_venc;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setData_venc($data_venc) {
        $this->data_venc = $data_venc;
    }
    
    
}