<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Organiza! - Plataforma de Controle de Gastos</title>
        <link href="css/style.css" rel="stylesheet" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
        <script type="text/javascript" src="js/funcoes.js"></script>
        </style>
        <?php
		include_once('modelo/UsuarioDAO.php');
		$usuario = new UsuarioDAO();
        session_start();
        if (isset($_SESSION['logado']) && $_SESSION['logado'] == "SIM") {
            header('location:visao/painel.php');
        }
        ?>
    </head>
    <div id="all">
        <body onload="JavaScript:diminuir()">
            <div id="logo" align="center"><img src="imagens/logo.png" width="320" height="300"/>
            </div>

            <div id="wrapper">
                <div class="user-icon"></div>
                <div class="pass-icon"></div>
                <form name="formu" class="formu" id="login-form" method="POST" action="Controle/logar.php">
                    <div class="header">
                        <h1>Acesso ao sistema</h1>
                        <span>Utilize seu email e senha para logar-se.</span>
                    </div>
                    <div class="content">
                        <input name="usuario" id="usuario" type="text" class="input username" value="email" onfocus="this.value = ''" required="required" />
                        <input name="senha" id="senha" type="password" class="input password" value="senha" onfocus="this.value = ''" required="required" />
                    </div>
                    <div class="footer">
                        <input type="submit" name="submit" value="Logar" class="button" />
                        <a href="#openModal"><input type="button" name="cadastrar" value="Registrar" class="register" /></a>
                        <p><a href="#openModal2" class="esqueci">Esqueci a senha</a></p>
                    </div>
                </form>
            </div>


            <div id="openModal" class="modalDialog">
                <div id="cadastro" class="div">
                    <a href="#close" title="Close" class="close">X</a>
                    <form id="form" name="form" method="post" action="Controle/cadastrar.php">
                        <h2>Cadastre-se</h2>
                        <table width="413" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>&nbsp;</td>
                                <td>Nome:</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2"><input type="text" name="nome" id="nome" maxlength="20"  required="required" width="300" class="input" onblur="validanome();"/></td>
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
                                <td colspan="2"><input type="text" name="email" id="email" maxlength="50" required="required" width="340" class="email" onblur="valida(); confere()"/></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>Senha:</td>
                                <td>Repita senha:</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="password" name="csenha" id="csenha" maxlength="15" required="required" class="input"/></td>
                                <td><input type="password" name="rsenha" maxlength="20" required="required" class="input" onblur="verificasenha()"/></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>Dica de senha:</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="text" name="dica" id="dica" maxlength="20" required="required" class="input" onblur="validadica()"/></td>
                                <td><input type="text" id="aviso" name="aviso" style="visibility:hidden" /></td>
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
                                <td><blockquote>
                                        <p>
                                            <input type="button" name="cadastrar" id="cadastrar" value="Cadastrar" class="reg" onclick="validaform()"/>
                                        </p>
                                    </blockquote></td>
                                <td><input type="reset" id="reset" value="Limpar" class="limp"/></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
						<p id="erro" style="color: red" hidden="true">Campos obrigatorios não preenchidos</p>
                    </form>
                </div>
            </div>
            <form id="valida" method="post">
                <input type="hidden" id="validaemail" name="validaemail" />
                <input type="hidden" id="gnome" name="gnome" />
            </form>
            <?php
            //include('conexao.php');
            if (isset($_POST['validaemail']) and isset($_POST['gnome'])) {
                $email = $_POST['validaemail'];
                $nome = $_POST['gnome'];
				
				$result = $usuario->verificarEmail($email);
				/*
                $verifica = mysql_query("SELECT * FROM `usuario` WHERE `email`='$email'");
                if (mysql_num_rows($verifica) > 0) {
                    echo '<script type="text/javascript">
                    alert("Já existe uma conta cadastrada com este email");</script>';
                }
				*/
            }
            ?>
            <script type="text/javascript">
                document.getElementById('nome').value = '<?php echo $nome; ?>';
                document.getElementById('email').value = '<?php echo $email; ?>'
                document.form.email.style.borderColor = '#009900';
                document.getElementById('csenha').focus();
            </script>
            <div id="openModal2" class="modalDialog">
                <div id="recuperar" class="div">
                    <a href="#close" title="Close" class="close">X</a>
                    <form id="form2" method="post">
                        <h2>Recuperar senha</h2>
                        <table width="413" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td height="19">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td width="6" height="19">&nbsp;</td>
                                <td width="200">Email:</td>
                                <td width="201">&nbsp;</td>
                                <td width="10">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td colspan="2"><input type="text" name="mail" maxlength="50" required="required" width="340" class="email"/></td>
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
                                <td>Dica de senha:</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="text" name="dicar" maxlength="20" required="required" class="input"/></td>
                                <td>&nbsp;</td>
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
                                <td colspan="2">
								<?php
								$usuario = new UsuarioDAO();

								if (isset($_POST['mail']) and isset($_POST['mail'])) {
									$mail = $_POST['mail'];
									$dicar = $_POST['dicar'];
									$recuperado = $usuario->recuperarSenha($mail, $dicar);
									if(count($recuperado) > 0){
										echo 'Sua senha é ', '<font style="color:red;">', $recuperado[0]->senha, '</font>';
									} else {
										echo 'Não existe uma conta com os dados informados ou um dos campos não correspodem';
									}
								}
						?>
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
                                    <p>
                                        <input type="submit" id="recuperar" value="Recuperar" class="reg" />
                                    </p>
                                </td>
                                <td></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
    </div>
</body>
</html>