<?php


class Login {
 
    public $pdo = null;
    
    
    
    public function verificarLogin($param) {


    if (isset($_GET['logout'])) { //script de logout
            if ($_GET['logout'] == 1) {
                session_destroy();
                header('location:index.php');
            }
        }
        if ((!empty($_SESSION['logado'])) != "SIM") { // script para evitar que acesse a página sem estar logado
            echo '<script type="text/javascript">
var ok = alert("É preciso estar logado para acessar esta página!");
if (ok) {
	location.href="../index.php";
}
else {
	location.href="index.php";
}
</script>';
        }
} }
