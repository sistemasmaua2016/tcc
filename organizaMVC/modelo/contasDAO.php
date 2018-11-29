<?php

include_once 'conexao/conexao.php';
include_once 'contas.php';

class contasDAO {

    public $pdo = null;

    public function __construct() {
        $this->pdo = Conexao::getConexao();
    }

    public function inserir(contas $novaConta) {

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

    public function Atualizar(contas $contaAtualizada) {
        try {
            $sql = ("UPDATE `financas` SET titulo=:titulo, descricao=:descricao, valor=:valor, tipo=:tipo, categoria=:categoria, data=:data, hora=:hora, data_venc=:data_venc, usuario_id=:usuario_id"
                    . " WHERE id =:id");
            $stm = $this->pdo->prepare($sql);

            $stm->bindValue("titulo", $contaAtualizada->getTitulo());
            $stm->bindValue("descricao", $contaAtualizada->getDescricao());
            $stm->bindValue("valor", $contaAtualizada->getValor());
            $stm->bindValue("tipo", $contaAtualizada->getTipo());
            $stm->bindValue("categoria", $contaAtualizada->getCategoria());
            $stm->bindValue("data", $contaAtualizada->getData());
            $stm->bindValue("hora", $contaAtualizada->getHora());
            $stm->bindValue("data_venc", $contaAtualizada->getData_venc());
            $stm->bindValue("usuario_id", $contaAtualizada->getUsuario_id());
            $stm->bindValue("id", $contaAtualizada->getId());

            return $stm->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function pagar(contas $contaPaga) {
        try {
            $sql = ("UPDATE `financas` set categoria=:categoria where id=:id");

            $stm = $this->pdo->prepare($sql);

            $stm->bindValue("categoria", $contaPaga->getCategoria());
            $stm->bindValue("id", $contaPaga->getId());

            return $stm->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function excluir($contaExcluida) {
        try {
            $stm = $this->pdo->prepare("DELETE FROM `financas` WHERE id=:id");
            $stm->bindValue("id", $contaExcluida);
            return $stm->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function receber($receitaRecebida) {
        try {
            $sql = ("UPDATE `financas`set categoria=:categoria WHERE id=:id");

            $stm = $this->pdo->prepare($sql);

            $stm->bindvalue("categoria", $receitaRecebida->getCategoria());
            $stm->bindvalue("id", $receitaRecebida->getId());

            return $stm->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function atualizarBanco($atualizarBanco) {

        try {

            $sql = ("UPDATE `financas` set categoria=:categoria where data_venc < '$data'");

            $stm = $this->pdo->prepare($sql);

            $stm->bindValue("categoria", $atualizarBanco->getCategoria());

            return $stm->execute();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
    
}
    