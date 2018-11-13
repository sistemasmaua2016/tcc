<?php

include_once 'conexao/conexao.php';
include_once 'contas.php';

class contasDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::getConexao();
    }

    public function getInserirConta($id) {

        try {
            $sql = "INSERT INTO `financas` (titulo, descricao, valor, tipo, categoria, data, hora, usuario_id, data_venc) "
                    . "VALUES (:titulo, :descricao, :valor, :tipo, :categoria, :data, :hora, :usuario_id, :data_venc)";

            $stm = $this->pdo->prepare($sql);

            $stm->bindValue("titulo", $id->getTitulo());
            $stm->bindValue("descricao", $id->getDescricao());
            $stm->bindValue("valor", $id->getValor());
            $stm->bindValue("tipo", $id->getTipo());
            $stm->bindValue("categoria", $id->getCategoria());
            $stm->bindValue("data", $id->getData());
            $stm->bindValue("hora", $id->getHora());
            $stm->bindValue("usuario_id", $id->getUsuario_id());
            $stm->bindValue("data_venc", $id->getData_venc());

            return $stm->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}
