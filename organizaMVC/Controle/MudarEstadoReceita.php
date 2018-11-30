<?php

session_start();

require_once '../modelo/contas.php';
require_once '../modelo/contasDAO.php';

$usuario_id = $_SESSION['id'];
$id = $_POST['recebe'];
$categoria = 'recebida';

$receitaRecebida = new contas();
$receitaRecebida->setId($id);
$receitaRecebida->setCategoria($categoria);

$$receitaRecebidaDAO = new contasDAO();

$sucesso = $$receitaRecebidaDAO->receber($receitaRecebida);

if ($sucesso) {
    $msg = "Conta recebida com sucesso!";
    header("Location:../visao/recebidas.php?msg=" . $msg);
} else {
    $msg = "Erro ao receber a receita!";
    header("Location:../visao/receitas.php?msg=" . $msg);
}
    