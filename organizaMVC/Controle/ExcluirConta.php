<?php

session_start();

include_once '../modelo/contasDAO.php';

$id = $_POST["idd"];
$contaDAO = new contasDao();
$sucesso = $contaDAO->excluir($id);


if ($sucesso){
   $msg = "Conta excluida com sucesso!"; 
}else{
   $msg = "Erro ao excluir a conta!";  
}

header('Location: ../visao/despesas.php?&msg='.$msg);