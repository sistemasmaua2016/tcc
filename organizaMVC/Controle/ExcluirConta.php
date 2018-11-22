<?php

session_start();

include_once '../modelo/contasDAO.php';

$usuario_id = $_SESSION['id'];
$id = $_POST['idd'];

$contaExcluidaDAO = new contasDAO();

$sucesso = $contaExcluidaDAO->excluir($id);

if ($sucesso) {
    $msg = "Conta exluida com sucesso!";
    header("Location:../visao/despesas.php?msg=" . $msg);
} else {
    $msg = "Erro ao excluir!";
    header("Location:../visao/despesas.php?msg=" . $msg);
}
