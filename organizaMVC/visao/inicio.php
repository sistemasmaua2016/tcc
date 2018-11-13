<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="chart/chart.min.js"></script>
        <!--<script type="text/javascript" src="js/app.js"></script>-->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/funcoes.js"></script>
        <link href="css/style.css" rel="stylesheet" />
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <title>Untitled Document</title>
        <style type="text/css">
            /* importa a fonte */
           @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
        </style>
    </head>

    <body style="overflow:hidden;" onload="diminuimodaldata()">
        <div id="data" style="font-family: 'Bree Serif', serif; color: #444; font-size:16px;" align="center">
            <?php
            session_start(); //inicia sessão
            $id = $_SESSION['id']; //pega o id da sessão
            $ip = (!empty($_SERVER['REMOTE_HOST'])); // IP da internet
            $query = unserialize(file_get_contents('http://ip-api.com/php/' . $ip)); //Pesquisa sua localização
//formata data
            $data = date('D');
            if (isset($_POST['mes']) > 0) {
                $mes = $_POST['mes'];
            } else {
                $mes = date('M');
            }
            $dia = date('d');
            $ano = date('Y');
            $mes_cal = date('M');
            $semana = array(
                'Sun' => 'Domingo',
                'Mon' => 'Segunda-Feira',
                'Tue' => 'Terca-Feira',
                'Wed' => 'Quarta-Feira',
                'Thu' => 'Quinta-Feira',
                'Fri' => 'Sexta-Feira',
                'Sat' => 'Sábado'
            );

            $mes_extenso = array(
                'Jan' => 'Janeiro',
                'Feb' => 'Fevereiro',
                'Mar' => 'Março',
                'Apr' => 'Abril',
                'May' => 'Maio',
                'Jun' => 'Junho',
                'Jul' => 'Julho',
                'Aug' => 'Agosto',
                'Nov' => 'Novembro',
                'Sep' => 'Setembro',
                'Oct' => 'Outubro',
                'Dec' => 'Dezembro'
            );
            $mes_num = array(
                'Jan' => '1',
                'Feb' => '2',
                'Mar' => '3',
                'Apr' => '4',
                'May' => '5',
                'Jun' => '6',
                'Jul' => '7',
                'Aug' => '8',
                'Nov' => '11',
                'Sep' => '9',
                'Oct' => '10',
                'Dec' => '12'
            );
//exibe local em que está, a data por extenso e em português
            echo $ip . $query['city'] . ', ', $semana["$data"] . " - $dia de " . $mes_extenso["$mes_cal"] . " de $ano";
            ?>
        </div>
        <!-- FOMULÁRIO PARA PESQUISAR PELO MÊS -->
        <form id="fmes" method="post" action="#close">
            <input type="hidden" id="mes" name="mes" />
        </form>
        <!-- FIM DO FORMULÁRIO -->
        <?php
        include_once '../modelo/FinancasDAO.php';
//pesquisa os registros para exibi-los
        $finacasDAO = new FinancasDAO();
        $totalapag = $finacasDAO->getTotalDespezasMesAtual($_SESSION['id'], $mes, 'despesa');
        $totalarec = $finacasDAO->getTotalDespezasMesAtual($_SESSION['id'], $mes, 'receita');
        ?>
        </div>
        <!-- INPUT PARA PASSAR OS DADOS PARA O GRÁFICO 1 -->
        <input type="hidden" value="<?php echo $totalapag ?>" id="totalapag"/>
        <input type="hidden" value="<?php echo $totalarec ?>" id="totalarec"/>
        <!-- FIM INPUTS -->

        <!-- DIV GRÁFICO 1 -->
        <div id="grafico" style="width: 30%; height: 30%; position: absolute; padding: 1% 1%; left: 15%;">
            <table width="0" border="0" cellspacing="0" cellpadding="0" style="width: 100%; height: 100%">
                <tr>
                    <td width="63" align="center"><?php echo '<font style="font-family: Bree Serif, Serif;">Gráfico mês de ' . $mes_extenso["$mes"] . '</font>'; ?></td>
                </tr>
                <tr>
                    <td align="center"><canvas id="myChart" style="font-family:'Bree Serif', serif; color:#333; width: 75%; height: 75%"></canvas></td>
                </tr>
            </table>
        </div>

        <!--GRÁFICO 1 GERADO COM O CHART.JS-->
        <script>
            var totalpag = document.getElementById('totalapag').value;
            var totalrec = document.getElementById('totalarec').value;
            var saldo = totalrec - totalpag;
            if (saldo < 0) {
            saldo = 0;
            var data = {
            labels: [
                    "Despesas",
                    "Receitas",
                    "Saldo"
            ],
                    datasets: [
                    {
                    data: [totalpag, totalrec, saldo],
                            backgroundColor: [
                                    "#CD3333",
                                    "#36A2EB",
                                    "#CD8500"
                            ],
                            hoverBackgroundColor: [
                                    "#CD3333",
                                    "#36A2EB",
                                    "#CD8500"
                            ]
                    }]
            };
            } else {
            var data = {
            labels: [
                    "Despesas",
                    "Receitas",
                    "Saldo"
            ],
                    datasets: [
                    {
                    data: [totalpag, totalrec, saldo],
                            backgroundColor: [
                                    "#CD3333",
                                    "#36A2EB",
                                    "#32CD32"
                            ],
                            hoverBackgroundColor: [
                                    "#CD3333",
                                    "#36A2EB",
                                    "#32CD32"
                            ]
                    }]
            };
            }
            var ctx = document.getElementById("myChart").getContext('2d');
            ctx.canvas.width = 275;
            ctx.canvas.height = 275;
            var myChart = new Chart(ctx, {
            type: 'doughnut',
                    data: data,
                    options: {
                    animation: {
                    animateScale: true,
                            responsive: true,
                            maintainAspectRatio: false;
                    }
                    }
            });
        </script>
        </div>
        <!-- FIM GRÁFICO 1 -->

        <!-- TABELA DE RESUMO DO MÊS -->

        <div id="lista" style="float: right; width: 50%; height: 50%; position: absolute; left: 46%; top: 8%; 
             font-family: 'Bree Serif', serif; font-size: 16px; color: #444;">
            <table width="437" border="0">
                <tr>
                    <td colspan="4" align="center"><?php echo 'Resumo para o mês de '; ?><a href="#ModalMes"><?php echo $mes_extenso["$mes"]; ?></a></td>
                </tr>
                <tr>
                    <td colspan="2">Total Receitas</td>
                    <td colspan="2" align="right"><?php echo 'R$ ' . number_format($totalarec, 2, ",", "."); ?></td>
                </tr>
                <tr>
                    <td colspan="2">Total Despesas</td>
                    <td colspan="2" align="right"><?php echo 'R$ ' . number_format($totalapag, 2, ",", "."); ?></td>
                </tr>
                <tr>
                    <td colspan="2">Saldo</td>
                    <td colspan="2" align="right"><?php echo 'R$ ' . number_format($totalarec - $totalapag, 2, ",", "."); ?></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4" align="center">Contas próximas do vencimento</td>
                </tr>
                <tr>
                    <?php
                    $finacasDAO = new FinancasDAO();
                    $contasProximasVecimento = $finacasDAO->getContasProximasAoVencimento($id, $mes);
                    ?>
                    <?php if ($contasProximasVecimento) { ?>
                        <?php foreach ($contasProximasVecimento as $conta) { ?>
                            <td width="38" align="left"><?php
                                $d = $conta->data_venc;
                                echo date('d/m/Y', strtotime($d));
                                ?></td>
                            <td width="111" align="right"><?php echo $conta->tipo; ?></td>
                            <td width="110" align="right"><?php echo 'R$ ' . number_format($conta->valor, 2, ",", "."); ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <td><?php
                        echo 'Nenhum registro encontrado!';
                    }
                    ?></td>
            </table>
        </div>
        <!-- FIM DA TABELA DE RESUMO -->

        <!-- DIV GRÁFICO 2 -->
        <?php
        $d3 = date('Y-01-01');
        $d4 = date('Y-12-31');
        $resu3 = mysql_query("SELECT * FROM `financas` WHERE `usuario_id` = '$id' AND `tipo` = 'despesa' AND `data` BETWEEN ('$d3') AND ('$d4')");
        $totalapagano = 0;
        if ($resu3) {
            while ($rows = mysql_fetch_assoc($resu3)) {
                $totalapagano = $totalapagano + $rows['valor'];
            }
        }
        $resu4 = mysql_query("SELECT * FROM `financas` WHERE `usuario_id` = '$id' AND `tipo` = 'receita' AND `data` BETWEEN ('$d3') AND ('$d4')");
        $totalarecano = 0;
        if ($resu4) {
            while ($rows = mysql_fetch_assoc($resu4)) {
                $totalarecano = $totalarecano + $rows['valor'];
            }
        }
        ?>
        <input type="hidden" value="<?php echo $totalapagano ?>" id="totalapagano"/>
        <input type="hidden" value="<?php echo $totalarecano ?>" id="totalarecano"/>
        <div id="grafico2" style="width: 30%; height: 30%; float: left; padding: 1% 1%; position: absolute; left: 15%; top: 52%;">
            <table width="0" border="0" cellspacing="0" cellpadding="0" style="width: 100%; height:100%">
                <tr>
                    <td align="center"><?php echo '<font style="font-family: Bree Serif, Serif;">Gráfico ano de ' . $ano . '</font>'; ?></td>
                </tr>
                <tr>
                    <td align="center"><canvas id="myChart2" style="font-family:'Bree Serif', serif; color:#333; width: 75%; height: 75%"></canvas></td>
                </tr>
            </table>
        </div>
        <!-- FIM DIV GRÁFICO 2 -->

        <!--GRÁFICO 2 GERADO COM O CHART.JS-->
        <script>
            var totalpgano = document.getElementById('totalapagano').value;
            var totalrcano = document.getElementById('totalarecano').value;
            var saldoano = totalrcano - totalpgano;
            if (saldoano < 0) {
            saldoano = 0;
            var data = {
            labels: [
                    "Despesas",
                    "Receitas",
                    "Saldo"
            ],
                    datasets: [
                    {
                    data: [totalpgano, totalrcano, saldoano],
                            backgroundColor: [
                                    "#CC6699",
                                    "#FFCC00",
                                    "#CD8500"
                            ],
                            hoverBackgroundColor: [
                                    "#CD3333",
                                    "#FFCC00",
                                    "#CD8500"
                            ]
                    }]
            };
            } else {
            var data = {
            labels: [
                    "Despesas",
                    "Receitas",
                    "Saldo"
            ],
                    datasets: [
                    {
                    data: [totalpgano, totalrcano, saldoano],
                            backgroundColor: [
                                    "#CC6699",
                                    "#FFCC00",
                                    "#32CD32"
                            ],
                            hoverBackgroundColor: [
                                    "#CC6699",
                                    "#FFCC00",
                                    "#32CD32"
                            ]
                    }]
            };
            }
            var ctx2 = document.getElementById("myChart2").getContext('2d');
            ctx2.canvas.width = 275;
            ctx2.canvas.height = 275;
            var myChart2 = new Chart(ctx2, {
            type: 'doughnut',
                    data: data,
                    options: {
                    animation: {
                    animateScale: true,
                            responsive: true,
                            maintainAspectRatio: false;
                    }
                    }
            });
        </script>
        </div>
        <!-- FIM DIV GRÁFICO 2 -->

        <!-- LISTA RESUMO ANO -->
        <div id="lista" style="float: right; width: 50%; height: 50%; position: absolute; left: 46%; top: 75%; font-family: 'Bree Serif', serif; font-size: 16px; color: #444;">
            <table width="437" border="0">
                <tr>
                    <td colspan="4" align="center"><?php echo 'Resumo para o ano de ' . $ano; ?></td>
                </tr>
                <tr>
                    <td colspan="2">Total Receitas</td>
                    <td colspan="2" align="right"><?php echo 'R$ ' . number_format($totalarecano, 2, ",", "."); ?></td>
                </tr>
                <tr>
                    <td colspan="2">Total Despesas</td>
                    <td colspan="2" align="right"><?php echo 'R$ ' . number_format($totalapagano, 2, ",", "."); ?></td>
                </tr>
                <tr>
                    <td colspan="2">Saldo</td>
                    <td colspan="2" align="right"><?php echo 'R$ ' . number_format($totalarecano - $totalapagano, 2, ",", "."); ?></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="4" align="center">&nbsp;</td>
                </tr>
                <td>&nbsp;</td>
            </table>
        </div>
        <!-- FIM LISTA RERUMO ANO -->

        <!-- MODAL ESCOLHER MÊS -->
        <div id="ModalMes" class="modalDialog" style="background: rgba(0,0,0,0);">
            <div id="mmodal" class="divdados" style="width: 27%; height: 21%; padding: 1%  0 0 1.5%; left: 35%; top: 2%;">Selecione o mês
                <a href="#close" class="close">X</a>
                <table width="0" border="0" cellspacing="0" cellpadding="0" align="center" style="height: 77%;">
                    <tr>
                        <td><a onclick="document.getElementById('mes').value = 'Jan';
                            document.getElementById('fmes').submit()" class="btn btn-primary" style="width: 95%;">Janeiro</a></td>
                        <td><a onclick="document.getElementById('mes').value = 'Feb';
                            document.getElementById('fmes').submit()" class="btn btn-primary" style="width: 95%;">Fevereiro</a></td>
                        <td><a onclick="document.getElementById('mes').value = 'Mar'; document.getElementById('fmes').submit()" class="btn btn-primary" style="width: 95%;">Março</a></td>
                        <td><a onclick="document.getElementById('mes').value = 'Apr'; document.getElementById('fmes').submit()" class="btn btn-primary" style="width: 95%;">Abril</a></td>
                    </tr>
                    <tr>
                        <td><a onclick="document.getElementById('mes').value = 'May'; document.getElementById('fmes').submit()" class="btn btn-primary" style="width: 95%;">Maio</a></td>
                        <td><a onclick="document.getElementById('mes').value = 'Jun';
                            document.getElementById('fmes').submit()" class="btn btn-primary" style="width: 95%;">Junho</a></td>
                        <td><a onclick="document.getElementById('mes').value = 'Jul';
                            document.getElementById('fmes').submit()" class="btn btn-primary" style="width: 95%;">Julho</a></td>
                        <td><a onclick="document.getElementById('mes').value = 'Aug';
                            document.getElementById('fmes').submit()" class="btn btn-primary" style="width: 95%;">Agosto</a></td>
                    </tr>
                    <tr>
                        <td><a onclick="document.getElementById('mes').value = 'Sep';
                            document.getElementById('fmes').submit()" class="btn btn-primary" style="width: 95%;">Setembro</a></td>
                        <td><a onclick="document.getElementById('mes').value = 'Oct';
                            document.getElementById('fmes').submit()" class="btn btn-primary" style="width: 95%;">Outubro</a></td>
                        <td><a onclick="document.getElementById('mes').value = 'Nov';
                            document.getElementById('fmes').submit()" class="btn btn-primary" style="width: 95%;">Novembro</a></td>
                        <td><a onclick="document.getElementById('mes').value = 'Dec';
                            document.getElementById('fmes').submit()" class="btn btn-primary" style="width: 95%;">Dezembro</a></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- FIM MODAL ESCOLHER MÊS -->
    </body>
</html>