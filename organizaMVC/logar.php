<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Logar</title>
    </head>
    <body>
        <?php
        session_start();
        include('conexao.php');
        if (isset($_POST['usuario']) and isset($_POST['senha'])) {
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];
            $result = mysql_query("SELECT * FROM `usuario` WHERE `email` = '$usuario' AND `senha`= '$senha'");
            while ($exibe = mysql_fetch_assoc($result)) {
                $nome = $exibe['nome'];
                $email = $exibe['email'];
                $senha = $exibe['senha'];
                $dica = $exibe['dica'];
                $id = $exibe['id'];
            }
            if (mysql_num_rows($result) > 0) {
                $_SESSION['email'] = $usuario;
                $_SESSION['senha'] = $senha;
                $_SESSION['logado'] = "SIM";
                $_SESSION['dica'] = $dica;
                $_SESSION['id'] = $id;
                $_SESSION['nome'] = $nome;
                header('location:painel.php');
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
        }
        mysql_close($con);
        ?>
    </body>
</html>
