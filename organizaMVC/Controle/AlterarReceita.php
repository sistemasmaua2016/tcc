<?php

session_start();

require_once '../modelo/contas.php';
require_once '../modelo/contasDAO.php';

$usuario_id = $_SESSION['id'];
$titulo = $_POST['tituloalt'];
$descricao = $_POST['descricaoalt'];
$valor = $_POST['valoralt'];
$id = $_POST['idalt'];
$tipo = 'receita';
$categoria = $_POST['categoriaalt'];
$data = date('Y-m-d');
$hora = date('Y-m-d H:i:s');
$data_venc = $_POST['datavencalt'];

// TRATAMENTOS
$day = substr($data_venc, 0, 2);
$month = substr($data_venc, 3, 2);
$year = substr($data_venc, 6, 4);

$data_venc = date('' . $year . '-' . $month . '-' . $day);

$valor = substr($valor, 3);
$valor = str_replace('.', '', $valor);
$valor = str_replace(',', '.', $valor);

$contaAtualizada = new contas($titulo, $descricao, $valor, $tipo, $categoria, $data, $hora, $usuario_id, $data_venc);
$contaAtualizada->setId($id);
$contaAtualizada->setTitulo($titulo);
$contaAtualizada->setDescricao($descricao);
$contaAtualizada->setValor($valor);
$contaAtualizada->setTipo($tipo);
$contaAtualizada->setCategoria($categoria);
$contaAtualizada->setData($data);
$contaAtualizada->setHora($hora);
$contaAtualizada->setData_venc($data_venc);

$contaAtualizadasDAO = new contasDAO();

$sucesso = $contaAtualizadasDAO->Atualizar($contaAtualizada);

if ($sucesso) {
    $msg = "Conta atualizada com sucesso!";
    header("Location:../visao/receitas.php?msg=" . $msg);
} else {
    $msg = "Erro ao Atualizar!";
    header("Location:../visao/receitas.php?msg=" . $msg);
}
