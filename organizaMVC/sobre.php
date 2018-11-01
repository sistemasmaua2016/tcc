<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sobre</title>
<style type="text/css">
@import url(http://fonts.googleapis.com/css?family=Bree+Serif);
</style>
<?php
session_start();
if($_SESSION['logado'] != "SIM"){
	header('location:index.php');
}
?>
</head>

<body>
<div id="imagem" style="position: absolute; top: 10%; left: 38%;">
<img src="imagens/logo3.png" width="200" height="200"/>
</div>
<div id="texto" style="position: absolute; top: 50%; left: 28%; text-align:center;">
<?php echo '<font style="font-family: Bree Serif, serif; font-size: 18px; color: #333333"; text-align: center;">Organiza v1.0<br /><br />Copyright© 2017<br />Organiza é um sistema de controle de gastos online <br /><br />na Faculdade Mauá de Águas Lindas de Goiás<br />orientado pelo coordenador Wander</font>';
?>
</body>
</html>