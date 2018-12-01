
<?php
		include_once '../modelo/UsuarioDAO.php';
		include_once '../modelo/Usuario.php';

		$usuarioDAO = new UsuarioDAO();
		
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['csenha'];
        $dica = $_POST['dica'];
		
		$veremail = $usuarioDAO->verificarEmail($email);
		if($veremail){
			
			echo '
			<script type="text/javascript">
				var ok = alert("Já existe um usuário com o email informado!");	
				if (ok) {
					location.href="../index.php";
				}
				else {
					location.href="../index.php";
				}
			</script>';
			
		} else {
			$usuario = new Usuario($nome, $email, $senha, $dica, rand(0, 9999));
			$bool = $usuarioDAO->insertUsuario($usuario);
			echo '<script type="text/javascript">
				var ok = alert("Cliente cadastrado com sucesso!");
				if (ok) {
					location.href="../index.php";
				}
				else {
					location.href="../index.php";
				}
			</script>';		
			
		}
		
		/*
		
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
		*/
?>
