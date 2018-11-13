<?php

include_once 'conexao/conexao.php';
include_once 'Usuario.php';

class UsuarioDAO {

    public $pdo = null;

    function _construct() {
        $this->pdo = Conexao::getConexao();
    }

    public function getUsuario($id) {
        try {
            $sql = "SELECT 'id', 'nome', 'email', 'senha', 'usuario_id' FROM 'usuario' WHERE id=:id";
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
            $stm = $this->pdo->prepare("SELECT count(*) FROM 'usuario' WHERE email=:email");
            $stm->bindValue("email", $email);
            $stm->execute();
            return $stm->fetchColumn();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function recuperarSenha($email, $dica) {
       
           /* $sql = "SELECT * FROM ' usuario WHERE email =:email and dica=:dica";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue("email", $email);
            $stm->bindValue("dica", $dica); 
                       */
        
          $email = $_POST['email'];
          $dicar = $_POST['dica'];
          $pesquisa = mysql_query("SELECT * FROM `usuario` WHERE `email` = '$mail' AND `dica` = '$dicar'");
          $resultado = mysql_fetch_assoc($pesquisa);
          if ($resultado > 0) {
          echo 'Sua senha é ', '<font style="color:red;">', $resultado['senha'], '</font>';
          } else {
          echo 'Não existe uma conta com os dados informados ou um dos campos não correspodem';
          }
          
          
        }

          public function mostra() {
          $this->recuperar();
          }

          }

          $mostra = new recuperarsenha;
          $mostra->mostra();
         
    


