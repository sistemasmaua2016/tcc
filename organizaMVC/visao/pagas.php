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
                        <h3>&nbsp;&nbsp;Contas pagas</h3>
                    </div>
                    <div class="col-sm-6 text-right h2"><table width="507" border="0" style="position: absolute; right: 4%; width: 199%; height: 10%; top: 40px;">
                            <tr>
                                <td width="220" valign="bottom"><form id="form" name="form" method="POST"><input type="text" id="datepicker" name="datepicker" class="input-group-sm" style="width: 68%; border: solid 1px; border-radius: 5px; height: 34px;"/></td>
                                <td width="95" align="right"><a href="#" class="btn btn-info" onclick="javascript:document.form.submit();">Pesquisar</a></form></td><td width="1310"></td>
                                <td width="140"></td>
                                <td width="89" align="right"><a class="btn btn-default" onclick="atualizaIframep()"><i class="fa fa-refresh"></i>Atualizar</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </header>
            <?php
            $id = $_SESSION['id'];
            include_once('../modelo/conexao/conexao.php');
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

                //$result = mysql_query("SELECT * FROM `financas` WHERE `usuario_id` = '$id' AND `categoria`='paga' AND `data` = '$pesq'");
            }
            if ($i == 1) {
                $result = $finacasDAO->despesaAVencerPeriodo($_SESSION['id'], $categoria='paga');

                //$result = mysql_query("SELECT * FROM `financas` WHERE `usuario_id` = '$id' and `categoria` = 'paga'");
            }
            ?>
            <hr>
                <table class="table table-hover" style="font-family: 'Bree Serif', serif;">
                    <thead>
                        <tr>
                            <th width="6%">ID</th>
                            <th width="15%">Título</th>
                            <th width="10%">Valor</th>
                            <th width="15%">Descrição</th>
                            <th width="15%">categoria</th>
                            <th width="14%">Data do cadastro</th>
                            <th width="15%">Data do pagamento</th>
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
                        <?php if ($result) : ?>
                            <?php foreach ($result as $r) : ?>
                                <tr><?php $total += $r->valor; ?>
                                    <td><?php echo $r->id; ?></td>
                                    <td><?php echo $r->titulo; ?></td>
                                    <td><?php echo 'R$ ' . number_format($r->valor, 2, ',', '.'); ?></td>
                                    <td><?php echo $r->descricao; ?></td>
                                    <td><?php echo $r->categoria; ?></td>
                                    <td><?php
                                        $data = $r->data;
                                        echo date('d/m/Y', strtotime($data));
                                        ?></td>
                                    <td><?php
                                        $datvenc = $r->data_venc;
                                        echo date('d/m/Y', strtotime($datvenc));
                                        ?></td>
                                    <td class="actions text-right"><a onclick="document.getElementById('paga').value = '<?php echo $r->id; ?>';"></a>
                                       </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif; ?>
                        <?php if ($noresult == 0) : ?>
                            
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
                <!--FIM DA TABELA DE EXIBIÇÃO DE REGISTROS-->
                
                    </div>
                    </body>
                    </html>