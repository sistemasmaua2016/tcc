<?php

class LoginDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::getConexao();
    }

    public function login($email, $senha) {

        try {
            $sql = "SELECT * FROM usuario WHERE email=:email AND senha=:senha";
            //echo $sql;
            //var_dump($this->pdo);
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue("email", $email);
            $stm->bindValue("senha", $senha);
            $stm->execute();
            $usuario = $stm->fetch(PDO::FETCH_OBJ);
            return $usuario;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}
