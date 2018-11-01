<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$dbserver = 'localhost';
$dbuser = 'root';
$dbpass = '';
$db = "controle_financeiro";
$con = mysql_connect($dbserver, $dbuser, $dbpass) or die ("Sem conexão com o servidor");
$select = mysql_select_db($db) or die("Sem acesso ao DB, Entre em contato com o Administrador");
?>
</body>
</html>