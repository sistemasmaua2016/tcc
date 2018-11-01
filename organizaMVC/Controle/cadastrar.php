<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <strong><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Cadastrar</title></strong>
    </head>
    <body>
        <?php
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['csenha'];
        $dica = $_POST['dica'];
        $con = mysql_connect('localhost', 'root', '') or die("Sem conexão com o servidor");
        $select = mysql_select_db('controle_financeiro') or die("Sem acesso ao DB, Entre em contato com o Administrador.");
        $veremail = mysql_query("SELECT * FROM `usuario` WHERE `email` = '$email'");
        if (mysql_num_rows($veremail) > 0) {
            echo '<script type="text/javascript">
	var ok = alert("Já existe um usuário com o email informado!");	
if (ok) {
	location.href="index.php";
}
else {
	location.href="index.php";
}
</script>';
        } else {
            $sql = mysql_query("INSERT INTO `usuario` (nome,  email, senha, dica) VALUES ('$nome', '$email', '$senha', '$dica')") or die("Erro ao tentar cadastrar");
            $result = mysql_query("SELECT * FROM `usuario` WHERE `nome` = '$nome'");
            if (mysql_num_rows($result) > 0) {
                echo '<script type="text/javascript">
var ok = alert("Cliente cadastrado com sucesso!");
if (ok) {
	location.href="index.php";
}
else {
	location.href="index.php";
}
</script>';
            } else {
                echo '<script type="text/javascript">
alert("Erro ao tentar cadastrar o usuário!");
}
</script>';
            }
        }
        ?>
    </body>
</html>
