<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//PT" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />

        <title>Contas pagas</title>
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
                        <h3>&nbsp;&nbsp;Contas recebidas</h3>
                    </div>
                    <div class="col-sm-6 text-right h2"><table width="507" border="0" style="position: absolute; right: 4%; width: 199%; height: 10%; top: 40px;">
                            <tr>
                                <td width="220" valign="bottom"><form id="form" name="form" method="POST"><input type="text" id="datepicker" name="datepicker" class="input-group-sm" style="width: 68%; border: solid 1px; border-radius: 5px; height: 34px;"/></td>
                                <td width="95" align="right"><a href="#" class="btn btn-info" onclick="javascript:document.form.submit();">Pesquisar</a></form></td><td width="1310"></td>
                                <td width="140"></td>
                                <td width="89" align="right"><a class="btn btn-default" onclick="atualizaiframerecb()"><i class="fa fa-refresh"></i>Atualizar</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </header>
            <?php
            $id = $_SESSION['id'];
            include_once('../modelo/conexao/Conexao.php');
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
                //$result = mysql_query("SELECT * FROM `financas` WHERE `usuario_id` = '$id' AND `categoria`='recebida' AND `data` = '$pesq'");
            }
            if ($i == 1) {

                $result = $finacasDAO->despesaAVencerPeriodo($_SESSION['id'], $categoria = 'recebida');

               // $result = mysql_query("SELECT * FROM `financas` WHERE `usuario_id` = '$id' and `categoria` = 'recebida'");
            }
            ?>
            <hr>
                <table class="table table-hover" style="font-family: 'Bree Serif', serif;">
                    <thead>
                        <tr>
                            <th width="6%">ID</th>
                            <th width="15%">Título</th>
                            <th width="10%">Valor</th>
                            <th width="25%">Descrição</th>
                            <th width="14%">Data do cadastro</th>
                            <th width="15%">Data do recebimento</th>
                            <th width="15%">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;

                        $noresult = FALSE;
                        if (empty($result)) {
                            $totresult = true;
                        }
                        ?>
                        <?php if ($result): ?>
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
                                    <td class="actions text-right"><a onclick="document.getElementById('paga').value = '<?php echo $r->id; ?>';
                                            location.href = '#ModalPaga';
                                            document.getElementById('postapag').style.visibility = 'visible';
                                            document.getElementById('cancpag').style.visibility = 'visible'" class="btn btn-sm btn-success">Pagar</a>&nbsp;<a onclick="document.getElementById('idalt').value = '<?php echo $r->id; ?>';
                                                    document.getElementById('tituloalt').value = '<?php echo $r->titulo; ?>';
                                                    document.getElementById('valoralt').value = '<?php echo 'R$ ' . number_format($r->valor, 2, ',', '.'); ?>';
                                                    document.getElementById('descricaoalt').value = '<?php echo $r->descricao; ?>';
                                                    document.getElementById('categoriaalt').value = '<?php echo $r->categoria; ?>';
                                                    document.getElementById('datavencalt').value = '<?php
                                                                      $datvenc = $r->data_venc;
                                                                      echo date('d/m/Y', strtotime($datvenc));
                                                                      ?>';
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
                    <div class="divdados" style="width: 24%; height: 15%; padding: 1%  0 0 1.5%; left: 35%; top: 10%;">
                        <a href="#close" class="close">X</a>
                        <form id="del" method="post">
                            <input type="hidden" name="idd" id="idd" value="" />
                            <?php
                            $situacao = 0;
                            if (isset($_POST['idd'])) {
                                $idd = $_POST['idd'];
                                $apaga = Conexao::getConexao()->exec("DELETE FROM `financas` WHERE `id` = '$idd'");
                            }
                            if (!empty($apaga)) {
                                $situacao = 1;
                            }
                            if ($situacao == 1) {
                                echo '<font style="float: left;">' . 'Conta ' . $idd . ' excluída com sucesso!' . '</font>';
                            } else {
                                echo '<font style="float: left;">' . 'Tem certeza que deseja excluir esta conta?' . '</font>';
                            }
                            ?>
                            <div id="cancela" style="width:27%; height:32%; visibility: hidden; position:absolute; top: 50%; left: 28%" class="btn btn-danger" onclick="location.href = '#close';
                                    atualizaiframerecb()">Cancelar</div>
                            <div id="fecha" style="width:20%; height:32%; visibility: visible; position:absolute; top: 50%; left: 7%" class="btn btn-primary" onclick="location.href = '#close'; atualizaiframerecb()">OK</div>
                            <div id="posta" style="width:20%; height:32%; visibility:hidden; position:absolute; top: 50%; left: 7%" class="btn btn-primary" onclick="document.getElementById('del').submit()">OK</div>
                        </form>
                    </div>
                </div>
                <!--FIM DO MODAL DE EXCLUSÃO DE REGISTRO-->

                <!--MODAL DE EDIÇÃO DE REGISTR0-->
                <div id="ModalEdit" class="modalDialog" style="background: rgba(0,0,0,0);">
                    <div class="divdados" style="height: 20%;"><a href="#close" title="Close" class="close">X</a><div id="query" style="position:absolute; top: 23%; font-size:16px;"><?php
                            if (isset($_POST['tituloalt']) and isset($_POST['descricaoalt']) and isset($_POST['valoralt']) and isset($_POST['categoriaalt']) and isset($_POST['datavencalt']) and isset($_POST['idalt'])) {
                                $idalt = $_POST['idalt'];
                                $titulo = $_POST['tituloalt'];
                                $descricao = $_POST['descricaoalt'];
                                $valor = $_POST['valoralt'];
                                $muda = array(",", ".", "R$ ");
                                $valor = str_replace($muda, "", $valor);
                                $vq1 = substr($valor, -2);
                                $vq2 = substr($valor, 0, -2);
                                $valor = $vq2 . '.' . $vq1;
                                $tipo = 'receita';
                                $categoria = $_POST['categoriaalt'];
                                $datacad = date('Y-m-d');
                                $horacad = date('Y-m-d H:i:s');
                                $datavenc = $_POST['datavencalt'];
                                $expldvc = explode('/', $datavenc);
                                $dfinalvenc = $expldvc['2'] . '-' . $expldvc['1'] . '-' . $expldvc['0'];
                                $atualiza = mysql_query("UPDATE financas SET titulo='$titulo', descricao='$descricao', valor='$valor', tipo='$tipo', categoria='$categoria', data='$datacad', hora='$horacad', data_venc='$dfinalvenc' WHERE ID = '$idalt'");
                                if ($atualiza) {
                                    echo 'Conta editada com sucesso!';
                                } else {
                                    echo 'Ocorreu um erro ao editar esta conta!';
                                }
                            }
                            ?></div><div id="tab" style="visibility:hidden">
                            <form id="formaltdados" name="formaltdados" method="post">
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
                                        <td><input type="text" name="categoriaalt"  id="categoriaalt" maxlength="15" required="required" class="input" readonly="readonly" /></td>
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
                        <div id="okat" style="width:20%; height:23%; position:absolute; top: 60%; left: 6.5%" class="btn btn-primary" onclick="location.href = '#close';
                                atualizaiframerecb()">OK</div><div style="float:right">
                            <div id="fechaat" style="width:20%; height:23%; position:absolute; top: 70%; left: 28%; visibility:hidden;" class="btn btn-danger" onclick="location.href = '#close'; atualizaiframerecb()">Cancelar</div>
                            <div id="atualizacad" style="width:20%; height:23%; position:absolute; top: 70%; left: 6.5%; visibility: hidden;" class="btn btn-primary" onclick="document.getElementById('formaltdados').submit()">Salvar</div><div style="float:right">
                            </div>
                        </div>
                        <!--FIM DO MODAL DE EDIÇÃO-->
                    </div>
                    </body>
                    </html>