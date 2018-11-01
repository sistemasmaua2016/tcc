
<?php

date_default_timezone_set("America/Sao_Paulo");
include_once'../modelo/conexao/Conexao.php';
include_once '../modelo/LoginDAO.php';


$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$loginDAO = new LoginDAO();
$usuario = $loginDAO->login($usuario, $senha);

if(!empty($usuario)){
    
session_start();
$_SESSION["MVC"] = TRUE;
$_SESSION["idUsuario"] = $idUsuario->idUsuario;
$_SESSION["usuario"] = $usuario->email;
$_SESSION["nome"] = $usuario->nome;
header('Location:../visao/painel.php');

$arquivo = fopen("../logs/log_de_acesso_" . date("d_m_Y") . ".txt", 'a');
    $conteudolog = "O usuario: " . $_SESSION["usuario"] . ", acessou o sistema na data" . date("d/m/y H:i:s") . ".\n";
    fwrite($arquivo, $conteudolog);
    fclose($arquivo);

} else {
    echo '<script type="text/javascript">
var ok = alert("Email e/ou Senha inválidos! ou o Usuário não está cadastrado!");
if (ok) {
	location.href="index.php#openModal";
}
else {
	location.href="index.php#openModal";
}
</script>';
}
?>
</body>
</html>
