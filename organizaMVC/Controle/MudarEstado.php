<?php

session_start();

require_once '../modelo/contas.php';
require_once '../modelo/contasDAO.php';
$ipaga = 0;
if (isset($_POST['paga'])) {
    $paga = $_POST['paga'];
    Conexao::getConexao()->exec("UPDATE financas SET categoria='paga' WHERE  id='$paga'");
}
if (!empty($paga)) {
    $ipaga = 1;
}
if ($ipaga == 1) {
    $msg = "Conta atualizada com sucesso!";
    header("Location:../visao/despesas.php?msg=" . $msg);
} else {
    $msg = "Erro ao Atualizar!";
header("Location:../visao/despesas.php?msg=" . $msg);

}
    