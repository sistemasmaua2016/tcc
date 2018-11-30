<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//PT" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />

        <title>Receitas</title>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/funcoes.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <style type="text/css">
                body {
                    background: #f3f3f3;
                }
            </style>
            <?php
            session_start();
            if ($_SESSION['logado'] != "SIM") {
                header('location:index.php');
            }
            ?>
    </head>
    <body style="overflow-x: hidden;">
        <div id="all">
            <header>
                <div class="row" style="font-family: 'Bree Serif', serif;">
                    <div class="col-sm-6">
                        <h3>&nbsp;&nbsp;Receitas</h3>
                    </div>
                    <div class="col-sm-6 text-right h2"><table width="507" border="0" style="position: absolute; right: 4%; width: 199%; height: 10%; top: 40px;">
                            <tr>
                                <td width="220" valign="bottom"><form id="form" name="form" method="POST"><input type="text" id="datepicker" name="datepicker" class="input-group-sm" style="width: 68%; border: solid 1px; border-radius: 5px; height: 34px;"/></td>
                                <td width="95" align="right"><a href="#" class="btn btn-info" onclick="javascript:document.form.submit();">Pesquisar</a></form></td><td width="1310"></td>
                                <td width="140"><a class="btn btn-primary" href="#Modal"><i class="fa fa-plus"></i>Novo Registro</a></td>
                                <td width="89" align="right"><a class="btn btn-default" onclick="atualizaIframerec()"><i class="fa fa-refresh"></i>Atualizar</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </header>
            <?php
            $id = $_SESSION['id'];
            include_once '../modelo/conexao/Conexao.php';
            include_once '../modelo/FinancasDAO.php';
            $finacasDAO = new FinancasDAO();
            $i = 1;
            if (isset($_POST['datepicker'])) {
                $dpesq = $_POST['datepicker'];
                $i = 0;
            }
            if ($i == 0) {
                $expld = explode('/', $dpesq);
                $pesq = $expld['2'] . '-' . $expld['1'] . '-' . $expld['0'];
                $result = $finacasDAO->getDespesaAVencerPorData($_SESSION['id'], $pesq);


                // $result = mysql_query("SELECT * FROM `financas` WHERE `usuario_id` = '$id' AND `tipo`='receita' AND `categoria`='a receber' AND `data` = '$pesq'");
            }
            $data1 = date('Y-m-1');
            $data2 = date('Y-m-31');
            if ($i == 1) {
                $result = $finacasDAO->getDespesaAVencerPorPeriodo($_SESSION['id'], $tipo = 'receita', $categoria = 'a receber', $data1, $data2);

                //$result = mysql_query("SELECT * FROM `financas` WHERE `usuario_id` = '$id' AND `tipo` = 'receita' AND `categoria`='a receber' AND `data_venc` BETWEEN ('$data1') AND ('$data2')");
            }
            ?>
            <hr>
                <table class="table table-hover" style="font-family: 'Bree Serif', serif;">
                    <thead>
                        <tr>
                            <th width="6%">ID</th>
                            <th width="15%">Título</th>
                            <th width="9%">Valor</th>
                            <th width="24%">Descrição</th>
                            <th width="14%">Data do cadastro</th>
                            <th width="15%">Data do recebimento</th>
                            <th width="20%">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;

                        $noresult = false;
                        if (empty($result)) {
                            $totresult = true;
                        }
                        ?>
                        <?php if ($result) : ?>
                            <?php foreach ($result as $row) : ?>
                                <tr><?php $total += $row->valor; ?>
                                    <td><?php echo $row->id; ?></td>
                                    <td><?php echo $row->titulo; ?></td>
                                    <td><?php echo 'R$ ' . number_format($row->valor, 2, ',', '.'); ?></td>
                                    <td><?php echo $row->descricao; ?></td>
                                    <td><?php
                                        $data = $row->data;
                                        echo date('d/m/Y', strtotime($data));
                                        ?></td>
                                    <td><?php
                                        $datvenc = $row->data_venc;
                                        echo date('d/m/Y', strtotime($datvenc));
                                        ?></td>
                                    <td class="actions text-right"><a onclick="document.getElementById('recebe').value = '<?php echo $r->id; ?>';
											document.getElementById('server').value = '<?php echo $_SERVER['REQUEST_URI']; ?>';
                                            location.href ='#ModalRecebe' ;
                                            document.getElementById('postarec').style.visibility = 'visible';
                                            document.getElementById('cancrec').style.visibility = 'visible'" class="btn btn-sm btn-success">Receber</a>&nbsp;<a onclick="document.getElementById('idalt').value = '<?php echo $r->id; ?>';
                                                    document.getElementById('tituloalt').value = '<?php echo $r->titulo; ?>';
                                                    document.getElementById('valoralt').value = '<?php echo 'R$ ' . number_format($r->valor, 2, ',', '.'); ?>';
                                                    document.getElementById('descricaoalt').value = '<?php echo $r->descricao; ?>';
                                                    document.getElementById('categoriaalt').value = '<?php echo $r->categoria; ?>';
                                                    document.getElementById('datavencalt').value = '<?php $datvenc = $r->data_venc; echo date('d/m/Y', strtotime($datvenc));?>';
                                                                      
                                                    modificamodal()" href="#ModalEdit" class="btn btn-sm btn-warning">Editar</a>
                                        <a onclick="document.getElementById('idd').value = '<?php echo $r->id; ?>';
                                                location.href = '#ModalDel';
                                                document.getElementById('posta').style.visibility = 'visible';
                                                document.getElementById('cancela').style.visibility = 'visible'" class="btn btn-sm btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif; ?>
                        <?php if ($noresult) : ?>
                            <tr>
                                <td colspan="6">Nenhum registro encontrado.</td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Total</td>
                            <td></td>
                            <td><?php echo 'R$ ' . number_format($total, 2, ",", "."); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> 
                    </tbody>
                </table>
                <!--FIM DA TABELA DE EXIBIÇÃO DE REGISTROS-->

                <!--MODAL DE EXCLUSÃO DE REGISTRO-->
                <div id="ModalDel" class="modalDialog" style="background: rgba(0,0,0,0);">
                    <div id="mmodal2" class="divdados" style="width: 24%; height: 15%; padding: 1%  0 0 1.5%; left: 35%; top: 10%;">
                        <a href="#close" class="close">X</a>
                        <form action="../Controle/ExcluirConta.php" id="del" method="post">
                            <input type="hidden" name="idd" id="idd" value="" />
                            <?php
                            echo 'Deseja excluir essa receita?';
                            ?>
                            <div id = "cancela" style = "width:27%; height:35%; visibility: hidden; position:absolute; top: 50%; left: 28%" class = "btn btn-danger" onclick = "location.href = '#close';
                                    atualizaIframepag()">Cancelar</div>
                            <div id = "fecha" style = "width:20%; height:35%; visibility: visible; position:absolute; top: 50%; left: 7%" class = "btn btn-primary" onclick = "location.href = '#close';
                                    atualizaIframepag()">OK</div>
                            <div id = "posta" style = "width:20%; height:35%; visibility:hidden; position:absolute; top: 50%; left: 7%" class = "btn btn-primary" onclick = "document.getElementById('del').submit()">OK</div>
                        </form>
                    </div>
                </div>
                <!--FIM DO MODAL DE EXCLUSÃO DE REGISTRO-->

                <!--MODAL DE ADIÇÃO DE REGISTRO-->
                <div id="Modal" class="modalDialog" style="background: rgba(0,0,0,0);">
                    <div class="divdados"> <a href="#close" title="Close" class="close">X</a>
                        <form action="../Controle/AlterarDespesas.php" id="formdados" name="formdados" method="post">
                            <h2>Cadastrar receita</h2>
                            <table>
                                <tr>
                                    <td width="0">&nbsp;</td>
                                    <td>Título:</td>
                                    <td width="180">Valor:</td>
                                    <td width="0">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="text" name="titulo" maxlength="20" required="required" class="input" /></td>
                                    <script type="text/javascript" src="js/mascaras.js"></script> 

                                    <td><input type="text" name="valor" id="valor" maxlength="20" required="required" class="input" onkeypress="mascara(this, mreais)"/></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Desrição:</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><input type="text" name="descricao" maxlength="20" required="required" class="email" style="width: 100%;" /></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Categoria:</td>
                                    <td><p>Data de recebimento:</p></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="text" name="categoria"  maxlength="15" required="required" class="input" value="a receber" readonly="readonly"/></td>
                                    <td><input type="text" id="datavenc" name="datavenc" maxlength="10" required="required" class="input" /></td>
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
                                    <td colspan="2"><div id="fechacad" style="width:20%; height:13%; position:absolute; top: 82%; left: 28%" class="btn btn-danger" onclick="location.href = '#close';
                                            atualizaIframerec()">Sair</div>
                                        <div id="postacad" style="width:20%; height:13%; position:absolute; top: 82%; left: 6.5%" class="btn btn-primary" onclick="document.getElementById('formdados').submit()">Salvar</div><div style="float:right">

                                        </div></td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <!--FIM DO MODAL DE ADIÇÃO DE REGISTRO-->

                <!--MODAL DE MUDAR ESTADO REGISTRO PARA RECEBIDO-->
                <div id="ModalPaga" class="modalDialog" style="background: rgba(0,0,0,0);">
                    <div id="mmodal" class="divdados" style="width: 27%; height: 15%; padding: 1%  0 0 1.5%; left: 35%; top: 10%;">
                        <a href="#close" class="close">X</a>
                        <form action="../Controle/MudarEstado.php" id="fpaga" method="post">
                            <input type="hidden" id="paga" name="paga" />
							<input type="hidden" id="server" name="server" />
                            <?php echo 'Antecipar o recebimento ?'; ?>

                            <div id="cancpag" style="width:27%; height:35%; visibility: hidden; position:absolute; top: 50%; left: 28%" class="btn btn-danger" onclick="location.href = '#close';
                                    atualizaIframepag()">Cancelar</div>
                            <div id="fechapag" style="width:20%; height:35%; visibility: visible; position:absolute; top: 50%; left: 7%" class="btn btn-primary" onclick="location.href = '#close';
                                    atualizaIframepag()">OK</div>
                            <div id="postapag" style="width:20%; height:35%; visibility:hidden; position:absolute; top: 50%; left: 7%" class="btn btn-primary" onclick="document.getElementById('fpaga').submit()">OK</div>
                        </form>
                    </div>
                </div>
                <!--FIM DO FORM DE MUDAR ESTADO PARA RECEBIDO-->


                <!--MODAL DE EDIÇÃO DE REGISTR0-->
                <div id="ModalEdit" class="modalDialog" style="background: rgba(0,0,0,0);">
                    <div class="divdados" style="height: 20%;"><a href="#close" title="Close" class="close">X</a><div id="query" style="position:absolute; top: 23%; font-size:16px;">

                        </div><div id="tab" style="visibility:hidden">
                            </div><div id="tab" style="visibility:hidden"></div>
                            <form   action="../Controle/AlterarReceita.php id="formaltdados" name="formaltdados" method="post">
                            <h2>Editar conta</h2>
                            <table>
                                <tr>
                                    <td width="0">&nbsp;</td>
                                    <td>Título:</td>
                                    <td width="180">Valor:</td>
                                    <td width="0">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="text" name="tituloalt"  id="tituloalt" maxlength="20" required="required" class="input" /></td>
                                    <td><input type="text" name="valoralt"  id="valoralt" maxlength="20" required="required" class="input" /></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Desrição:</td>
                                    <td></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><input type="text" name="descricaoalt" id="descricaoalt" maxlength="20" required="required" class="email" style="width: 100%;" /></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>Categoria:</td>
                                    <td><p>Data de recebimento:</p></td>
                                    <td>&nbsp;</td>	
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="text" name="categoriaalt"  id="categoriaalt" maxlength="15" required="required" class="input" readonly="readonly"/></td>
                                    <td><input type="text" id="datavencalt" name="datavencalt" maxlength="10" required="required" class="input" /></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><input type="hidden" id="idalt" name="idalt"/></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2">
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </form></div>
                    <div id="okat" style="width:20%; height:23%; position:absolute; top: 60%; left: 6%" class="btn btn-primary" onclick="location.href = '#close';
                                atualizaIframerec()">OK</div><div style="float:right">
                        <div id="fechaat" style="width:20%; height:23%; position:absolute; top: 70%; left: 27%; visibility:hidden;" class="btn btn-danger" onclick="location.href = '#close';
                                    atualizaIframerec()">Cancelar</div>
                        <div id="atualizacad" style="width:20%; height:23%; position:absolute; top: 70%; left: 6%; visibility: hidden;" class="btn btn-primary" onclick="document.getElementById('formaltdados').submit()">Salvar</div><div style="float:right">
                        </div>
                    </div>
                    <!--FIM DO MODAL DE EDIÇÃO-->
                </div>
                </body>
                </html>