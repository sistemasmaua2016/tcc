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
	
    public function __construct($titulo, $descricao, $valor, $tipo, $categoria, $data, $hora, $usuario_id, $data_venc) {
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

    
    
    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getData() {
        return $this->data;
    }

    public function getHora() {
        return $this->hora;
    }

    public function getUsuario_id() {
        return $this->usuario_id;
    }

    public function getData_venc() {
        return $this->data_venc;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setHora($hora) {
        $this->hora = $hora;
    }

    public function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    public function setData_venc($data_venc) {
        $this->data_venc = $data_venc;
    }
    
    
}