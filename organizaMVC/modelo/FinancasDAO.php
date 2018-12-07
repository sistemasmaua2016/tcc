<?php

include_once 'conexao/Conexao.php';

class FinancasDAO {

    public $pdo = null;
    private $mes_num = array(
        'Jan' => '1',
        'Feb' => '2',
        'Mar' => '3',
        'Apr' => '4',
        'May' => '5',
        'Jun' => '6',
        'Jul' => '7',
        'Aug' => '8',
        'Nov' => '11',
        'Sep' => '9',
        'Oct' => '10',
        'Dec' => '12'
    );

    function __construct() {
        $this->pdo = Conexao::getConexao();
    }

    public function getTotalDespezasMesAtual($usuario_id, $mes, $tipo = 'despesa') {
        try {
            $sql = "SELECT * FROM `financas` WHERE `usuario_id` = :usuarioId AND `tipo` = :tipo AND `data` "
                    . "BETWEEN :dtInicio AND :dtFinal ";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue("usuarioId", $usuario_id);
            $stm->bindValue("dtInicio", date('Y-' . $this->mes_num["$mes"] . '-1'));
            $stm->bindValue("dtFinal", date('Y-' . $this->mes_num["$mes"] . '-31'));
            $stm->bindValue("tipo", $tipo);
            $stm->execute();
            $financas = $stm->fetchAll(PDO::FETCH_OBJ);
            $total = 0;
            foreach ($financas as $financa) {
                $total += $financa->valor;
            }
            return $total;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getContasProximasAoVencimento($id, $mes) {


        $data = date('Y-' . $this->mes_num["$mes"] . '-d');
        if (date('d') < 10) {
            $data2 = date('Y-' . $this->mes_num["$mes"] . '-10');
        }
        if (date('d') > 10 and date('d') < 20) {
            $data2 = date('Y-' . $this->mes_num["$mes"] . '-20');
        }
        if (date('d') > 20 and date('d') < 30) {
            $data2 = date('Y-' . $this->mes_num["$mes"] . '-30');


            $sql = "SELECT * FROM `financas` WHERE usuario_id=:id and `categoria`!= 'paga' and `categoria`!= 'recebida'"
                    . " and `categoria`!= 'vencida' and data_venc BETWEEN :data AND :data2";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue("id", $id);
            $stm->bindValue("data", $data);
            $stm->bindValue("data2", $data2);
            $stm->execute();
            $vencimentos = $stm->fetchAll(PDO::FETCH_OBJ);

            return $vencimentos;
        }
        try {
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getTotalPorAno($id, $tipo = 'despesa', $date1, $date2) {
        try {
            $sql = "SELECT * FROM `financas` WHERE usuario_id=:id AND tipo = :tipo AND data_venc BETWEEN :data AND :data2";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue("id", $id);
            $stm->bindValue("tipo", $tipo);
            $stm->bindValue("data", $date1);
            $stm->bindValue("data2", $date2);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            $total = 0;
            foreach ($result as $r) {
                $total = $total + $r->valor;
            }
            return $total;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getDespesaAVencerPorData($id, $date) {
        try {
            $sql = "SELECT * FROM `financas` WHERE usuario_id=:id AND tipo = 'despesa'  AND categoria =  'a vencer' AND data= :data";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue("id", $id);
            $stm->bindValue("data", $date);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_OBJ);

            return $result;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getReceitaAVencerPorData($id, $date, $tipo) {
        try {
            var_dump($date);
            $sql = "SELECT * FROM `financas` WHERE usuario_id=:id AND tipo =:tipo  AND categoria =  'a receber' AND data= :data";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue("id", $id);
            $stm->bindValue("data", $date);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_OBJ);

            return $result;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function getDespesaAVencerPorPeriodo($id, $tipo, $categoria, $date1, $date2) {
        try {
            
            $sql = "SELECT * FROM `financas` WHERE usuario_id=:id AND tipo =:tipo  AND categoria = :categoria AND data_venc BETWEEN :data AND :data2";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue("id", $id);
            $stm->bindValue("tipo", $tipo);
            $stm->bindValue("categoria", $categoria);
            $stm->bindValue("data", $date1);
            $stm->bindValue("data2", $date2);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_OBJ);

            return $result;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    public function despesaAVencerPeriodo($id, $categoria) {
        try {
            $sql = "SELECT * FROM financas WHERE usuario_id =:id AND categoria =:categoria";
            $stm = $this->pdo->prepare($sql);
            $stm->bindValue("id", $id);
            $stm->bindValue("categoria", $categoria);
            $stm->execute();

            $result = $stm->fetchAll(PDO::FETCH_OBJ);

            return $result;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

}
