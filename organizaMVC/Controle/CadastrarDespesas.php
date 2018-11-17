<?php

session_start();

require_once '../modelo/contas.php';
require_once '../modelo/contasDAO.php';




$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$tipo = 'despesa';
$categoria = $_POST['categoria'];
$data = date('Y-m-d');
$hora = date('Y-m-d H:i:s');
$usuario_id = $_SESSION['id'];
$data_venc = $_POST['datavenc'];

// TRATAMENTOS
$day = substr($data_venc, 0, 2);
$month = substr($data_venc, 3, 2);
$year= substr($data_venc, 6, 4);

$data_venc = date(''.$year.'-'.$month.'-'.$day);

$valor = substr($valor,3);
$valor = str_replace('.', '', $valor);
$valor = str_replace(',', '.', $valor);

echo $valor;

$contasDAO = new contasDAO();
$novaContas = new contas($titulo, $descricao, $valor, $tipo, $categoria, $data, $hora, $usuario_id, $data_venc);

$sucesso = $contasDAO->InserirConta($novaContas);

if ($sucesso) {
    $msg = "Conta cadastrada com sucesso!";
    header("Location:../visao/despesas.php?msg=" . $msg);
} else {
    $msg = "Conta ja cadatrada!";
	header("Location:../visao/despesas.php?msg=" . $msg);
} 