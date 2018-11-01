<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Organiza! - Plataforma de Controle de Gastos</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/funcoes.js"></script>
<?php
include ('conexao.php');
session_start(); //inicia sessão
if (isset($_GET['logout'])){ //script de logout
if ($_GET['logout']==1){
	session_destroy();
	header('location:index.php');
}
}
if ((!empty($_SESSION['logado'])) != "SIM"){ // script para evitar que acesse a página sem estar logado
echo '<script type="text/javascript">
var ok = alert("É preciso estar logado para acessar esta página!");
if (ok) {
	location.href="index.php";
}
else {
	location.href="index.php";
}
</script>';
}
//atualiza banco de dados se as contas estiverem vencidas
$data = date('Y-m-d');
$vencida = mysql_query("UPDATE financas SET categoria='vencida' WHERE data_venc < '$data'");
mysql_close($con);
?>
</head>
<body onload="diminuimodal()">
<!-- DIV BANNER -->
<div id="top" class="topo">
<!-- IMAGEM -->
<img src="imagens/logo2.png" width="220" height="51"style="padding: 10px"/>
<!-- TABELA COM OS LINKS DE ALTERAR E LOGOUT -->
<table border="0" style="float: right; padding: 5px 5px 10px 10px;">
  <tr>
    <td><?php
echo '<font style="font-family: Bree Serif, serif; font-size: 14px; color: #009999; float: right;">','Seja bem vindo ',$_SESSION['nome'],'</font><br />';?></td>
  </tr>
  <tr>
    <td><p><a href="#openModal" style="float:right; text-decoration:none; font-size:12px; color: #06F;">Editar dados</a></p></td>
  </tr>
  <tr>
    <td><p><a href="?logout=1" style="float:right; text-decoration:none; font-size:12px; color: #06F;">Sair</a></p></td>
  </tr>
</table>
</div>
<!-- FIM BANNER -->

<!-- IFRAME -->
<div id="corpo" class="corpo">
<iframe id="pframe" name="pframe" src="inicio.php" align="center" style="border:0px; padding: 1px; width: 100%; height:100%"></iframe>
</div>
<!-- FIM DO IFRAME -->

<!-- MENU -->
<div id="menu" class="menu">
<nav class="navigation">
  <ul class="mainmenu">
    <li><a href="">Início</a></li>
    <ul class="submenu"></ul>
    <li><a href="">Contas</a>
      <ul class="submenu">
        <li><a href="despesas.php" target="pframe"> Despesas</a></li>
        <li><a href="receitas.php" target="pframe">Receitas</a></li>
        <li><a href="vencidas.php" target="pframe">Vencidas</a></li>
        <li><a href="pagas.php" target="pframe">Pagas</a></li>
        <li><a href="recebidas.php" target="pframe">Recebidas</a></li>
      </ul>
    </li>
    <li><a href="sobre.php" target="pframe">Sobre</a></li>
  </ul>
</nav>
</div>
<!-- FIM MENU -->

<!-- MODAL DE EDIÇÃO DE REGISTRO -->
<div id="openModal" class="modalDialog">
	<div id="ed" class="div">
		<a href="#close" title="Close" class="close">X</a>
<form id="form" name="form" method="post">
		<h2>Editar dados</h2>
		<table width="413" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td width="6">&nbsp;</td>
		    <td width="200">Nome:</td>
		    <td width="201">&nbsp;</td>
		    <td width="10">&nbsp;</td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td colspan="2"><input type="text" name="nome" maxlength="20" required="required" width="180" class="email" value="<?php echo $_SESSION['nome']; ?>"/></td>
		    <td>&nbsp;</td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>Email:</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td colspan="2"><input type="text" name="email" maxlength="50" required="required" width="340" class="email" onblur="JavaScript:confere()" value="<?php echo $_SESSION['email']; ?>"/></td>
		    <td>&nbsp;</td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>Senha:</td>
		    <td>Nova senha:</td>
		    <td>&nbsp;</td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td><input type="text" name="vsenha" maxlength="15" required="required" class="input"  value="<?php echo $_SESSION['senha']; ?>" readonly="readonly"/></td>
		    <td><input type="password" name="csenha" maxlength="20" required="required" class="input" onblur="JavaScript:verificaSenha()"/></td>
		    <td>&nbsp;</td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>Dica de senha:</td>
		    <td>Repita senha:</td>
		    <td>&nbsp;</td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td><input type="text" name="dica" maxlength="20" required="required" class="input" value="<?php echo $_SESSION['dica'];?>" /></td>
		    <td><input type="password" name="rsenha" maxlength="20" required="required" class="input" onblur="JavaScript:verificaSenha2()"/></td>
		    <td>&nbsp;</td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
	      </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>
		        <input type="submit" name="cadastrar" id="cadastrar" value="Salvar" class="reg" /></td>
		    <td><?php
			include('conexao.php');
            if (isset($_POST['nome']) and isset($_POST['email']) and isset($_POST['csenha']) and isset($_POST['dica'])){
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['csenha'];
$dica = $_POST['dica'];
$altera = mysql_query("UPDATE usuario SET nome='$nome', email='$email', senha='$senha', dica='$dica'");
if ($altera){
echo 'Dados alterados com sucesso!';
}
else{
echo 'Erro ao editar dados!';
}
}
mysql_close($con);
?>			</td>
		    <td>&nbsp;</td>
	      </tr>
	  </table>
		
        </form>
	</div>
</div>
<!-- FIM MODAL DE EDIÇÃO DE REGISTRO -->
</body>
</html>