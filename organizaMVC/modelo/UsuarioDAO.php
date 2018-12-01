<?php

include_once 'conexao/Conexao.php';
include_once 'Usuario.php';

class UsuarioDAO {

    public $pdo = null;

    function __construct() {
        $this->pdo = Conexao::getConexao();
    }
	
	public function insertUsuario(Usuario $user){
		var_dump($user);
		try {
            $sql = "INSERT INTO `usuario` (nome, email, senha, dica, usuario_id) "
                    . "VALUES (:nome, :email, :senha, :dica, :usuario_id)";

            $stm = $this->pdo->prepare($sql);
            $stm->bindValue("nome", $user->getNome());
            $stm->bindValue("email", $user->getEmail());
            $stm->bindValue("senha", $user->getSenha());
            $stm->bindValue("dica", $user->getDica());
            $stm->bindValue("usuario_id", $user->getUsuario_id());

            return $stm->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
	}

    public function getUsuario($id) {
        try {
            $sql = "SELECT 'id', 'nome', 'email', 'senha', 'usuario_id' FROM `usuario` WHERE id=:id";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue("id", $id);
            $stm->execute();
            $usuario = $stm->fetch(PDO::FETCH_OBJ);
            return $usuario;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function verificarEmail($email) {
        try {
            $stm = $this->pdo->prepare("SELECT count(*) FROM `usuario` WHERE email=:email");
            $stm->bindValue("email", $email);
            $stm->execute();
            $result =  $stm->fetchColumn();
			if($result > 0){
				return true;
			} else {
				return false;
			}
		} catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function recuperarSenha($email, $dica) {
		
		try {
            $sql = "SELECT * FROM `usuario` WHERE email=:email AND dica=:dica";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue("email", $email);
			$stm->bindValue("dica", $dica);
            $stm->execute();
            $usuario = $stm->fetchAll(PDO::FETCH_OBJ);
            return $usuario;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
          
    }
 }
    


