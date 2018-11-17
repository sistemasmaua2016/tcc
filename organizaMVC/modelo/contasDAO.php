<?php

include_once 'conexao/conexao.php';
include_once 'contas.php';

class contasDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::getConexao();
    }

    public function inserirConta(contas $novaConta) {

        try {
            $sql = "INSERT INTO `financas` (titulo, descricao, valor, tipo, categoria, data, hora, usuario_id, data_venc) "
                    . "VALUES (:titulo, :descricao, :valor, :tipo, :categoria, :data, :hora, :usuario_id, :data_venc)";

            $stm = $this->pdo->prepare($sql);
			
            $stm->bindValue("titulo", $novaConta->getTitulo());
            $stm->bindValue("descricao", $novaConta->getDescricao());
            $stm->bindValue("valor", $novaConta->getValor());
            $stm->bindValue("tipo", $novaConta->getTipo());
            $stm->bindValue("categoria", $novaConta->getCategoria());
            $stm->bindValue("data", $novaConta->getData());
            $stm->bindValue("hora", $novaConta->getHora());
            $stm->bindValue("usuario_id", $novaConta->getUsuario_id());
            $stm->bindValue("data_venc", $novaConta->getData_venc());

            return $stm->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}
