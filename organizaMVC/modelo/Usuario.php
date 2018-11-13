<?php

class Usuario {

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $dica;
    private $usuario_id;
    function __construct($nome, $email, $senha, $dica, $usuario_id) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->dica = $dica;
        $this->usuario_id = $usuario_id;
    }

        function getid() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getSenha() {
        return $this->senha;
    }

    function getDica() {
        return $this->dica;
    }
    
        function getUsuario_id() {
        return $this->usuario_id;
    }

    function setid($id) {
        $this->Id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setDica($dica) {
        $this->dica = $dica;
    }
    
      function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

}