<?php

session_start();

require_once '../modelo/contas.php';
require_once '../modelo/contasDAO.php';

$usuario_id = $_SESSION['id'];
$id = $_POST['paga'];
$server = $_POST['server'];
$categoria = 'paga';

$array = explode("/", $server);
$base = $array[3];
$path = $array[4];

$contaPaga = new contas();
$contaPaga->setId($id);
$contaPaga->setCategoria($categoria);

$contaPagaDAO = new contasDAO();
//$sucesso = $contaPagaDAO->pagar($contaPaga);
$sucesso = true;

if ($sucesso) {
    $msg = "Conta paga com sucesso!";
    header("Location:../".$base."/".$path."?msg=" . $msg);
} else {
    $msg = "Erro ao pagar!";
    header("Location:../".$base."/".$path."?msg=" . $msg);
}
    