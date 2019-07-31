<?php  
//validando a session
session_start();
$nome_usuario = $_SESSION["nome_usuario"];
$usuario_id = $_SESSION["usuario_id"];
$empresa_id = $_SESSION["empresa_id"];
$username_usuario = $_SESSION["username_usuario"];
if(!$nome_usuario)
header('Location: ../index.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <script type="text/javascript">
      function verifica_chat()
      {
        $.ajax({
                url: "../controller/verifica_chat.php",
                dataType: "json",
                data: {
                $usuario_id: <?= $usuario_id ?>
            },
                success: function(data)
                {
                  if(data[0]['lido'] == '0')
                  {
                    $id =  Number(data[0]['id_usuario']) +  15920 - 350; //salto
                    document.getElementById('canto').innerHTML = "<b><i class='fas fa-envelope'></i> "+data[0]['nome_usuario']+" </b><a href='chat_conversa.php?id="+$id+"'><br><center><i class='fas fa-eye'></i>Visualizar</a></center>";
                  }
                }
          });
      }
    </script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php
            include("../model/config.php");
            $config = new Config();

            //valores do gráfico ANUAL
            $valores1=$config->dashboardAnual($empresa_id);
            $valor_entrada1 = $valores1[0];
            $valor_saida1 = $valores1[1];

            //valores do gráfico MENSAL
            $valores2=$config->dashboardMensal($empresa_id);
            $valor_entrada2 = $valores2[0];
            $valor_saida2 = $valores2[1];

            //qtd do gráfico ANUAL
            $valores3=$config->dashboardAnual_registros($empresa_id);
            $valor_entrada3 = $valores3[0];
            $valor_saida3 = $valores3[1];

            //qtd do gráfico MENSAL
            $valores4=$config->dashboardMensal_registros($empresa_id);
            $valor_entrada4 = $valores4[0];
            $valor_saida4 = $valores4[1];
?>

<script type="text/javascript">
      
      google.load('visualization', '1', {'packages':['corechart']});
       google.setOnLoadCallback(desenhaGraficoMensal);
       google.setOnLoadCallback(desenhaGraficoAnual);
       google.setOnLoadCallback(desenhaGraficoMensal_registros);
       google.setOnLoadCallback(desenhaGraficoAnual_registros);





       function desenhaGraficoAnual(){
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Mês');
            data.addColumn('number', 'Receitas totais em R$');
            data.addColumn('number', 'Despesas totais em R$');

            data.addRows(3);

            data.setValue(0, 1, <?= $valor_entrada1 ?>);
            data.setValue(0, 2, <?= $valor_saida1 ?>);

            var options = {
            width: 100,
            height: 340,
            title: 'Toppings I Like On My Pizza',
            colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
          };           
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_anual'));
                chart.draw(data);
      }





      function desenhaGraficoMensal(){
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Mês');
            data.addColumn('number', 'Receitas totais em R$');
            data.addColumn('number', 'Despesas totais em R$');

            data.addRows(3);

            data.setValue(0, 1, <?= $valor_entrada2 ?>);
            data.setValue(0, 2, <?= $valor_saida2 ?>);

            var options = {
            width: 200,
            height: 340,
            legend: 'left',
            title: 'Toppings I Like On My Pizza',
            colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
          };           
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_mensal'));
                chart.draw(data);
      }





      function desenhaGraficoAnual_registros(){
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Mês');
            data.addColumn('number', '');
            data.addColumn('number', '');

            data.addRows(3);

            data.setValue(0, 1, <?= $valor_entrada3 ?>);
            data.setValue(0, 2, <?= $valor_saida3 ?>);

            var options = {
            width: 100,
            height: 340,
            title: 'Toppings I Like On My Pizza',
            colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
          };           
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_anual_registros'));
                chart.draw(data);
      }





      function desenhaGraficoMensal_registros(){
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Mês');
            data.addColumn('number', '');
            data.addColumn('number', '');

            data.addRows(3);

            data.setValue(0, 1, <?= $valor_entrada4 ?>);
            data.setValue(0, 2, <?= $valor_saida4 ?>);

            var options = {
            width: 200,
            height: 340,
            legend: 'left',
            title: 'Toppings I Like On My Pizza',
            colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6']
          };           
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div_mensal_registros'));
                chart.draw(data);
      }



</script>



    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SBG</title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="#">SBG<br><span style="font-size: 12px;"><b><?= $nome_usuario ?></b></span></a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          <div class="input-group-append">  
          </div>
        </div>
      </form>


      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <div id="canto" style="border-radius: 8px; float: right; background-color: #FFFFFF"></div>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="tutoriais.php"><i class="fas fa-question-circle" title="Central de ajuda"></i></a>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="chat.php"><i class="fas fa-envelope" title="Chat"></i></a>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="alterar_cadastro.php">Alterar cadastro</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair <i class="fas fa fa-power-off fa-fw"></i></a>
          </div>
        </li>
      </ul>

    </nav>
    <div id="wrapper">


      <?php
        $permissao1=$config->verifica_permissao($usuario_id, 1); //registros
        $permissao2=$config->verifica_permissao($usuario_id, 2); //dashboard
        $permissao3=$config->verifica_permissao($usuario_id, 3); //relatorios
        $permissao4=$config->verifica_permissao($usuario_id, 4); //clientes
        $permissao5=$config->verifica_permissao($usuario_id, 5); //monitor
        $permissao11=$config->verifica_permissao($usuario_id, 11); //financas
      ?>


      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <?php if($permissao2){ ?>
        <li class="nav-item active">
          <a class="nav-link" href="inicial.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
      <?php } ?>

        <?php if($permissao5){ ?>
        <li class="nav-item active">
          <a class="nav-link" href="monitor.php">
            <i class="fas fa-fw fa fa-desktop"></i>
            <span>Monitor</span>
          </a>
        </li>
        <?php } ?>

        <?php if($permissao1){ ?>
        <li class="nav-item">
          <a class="nav-link" href="registros.php">
            <i class="fas fa-fw fa fa-check"></i>
            <span>Registros</span></a>
        </li>
        <?php } ?>

        <?php if($permissao4){ ?>
        <li class="nav-item">
          <a class="nav-link" href="clientes.php">
            <i class="fas fa-fw   fa  fa fa-child"></i>
            <span>Clientes</span></a>
        </li>
        <?php } ?>

        <?php if($permissao11){ ?>
        <li class="nav-item">
          <a class="nav-link" href="financas.php">
            <i class="fas fa-fw fa fa-cart-plus"></i>
            <span>Saídas</span></a>
        </li>
        <?php } ?>

        <?php if($permissao3){ ?>
        <li class="nav-item">
          <a class="nav-link" href="relatorios.php">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Relatórios</span></a>
        </li>
        <?php } ?>

        <li class="nav-item">
          <a class="nav-link" href="configuracoes.php">
            <i class="fas fa-fw fa fa fa-cogs"></i>
            <span>Configurações</span></a>
        </li>

      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>
          <!-- Icon Cards-->

          <?php
          $mes_atual = date('M');
          $ano_atual = date('Y');
          //echo $mes_atual."/".$ano_atual."<br><br>";


            $data1 = array();
            $data1 = $config->lista_registros_ativos($empresa_id);

            $data2 = array();
            $data2 = $config->lista_empresas_ativas($empresa_id);

            $data3 = array();
            $data3 = $config->dashboard($empresa_id);
          ?>

          <div class="row">

            <!-- TOTAL REGISTROS ATIVOS -->
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-primary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa fa-bolt"></i>
                  </div>
                  <div class="mr-5">
                    <?php
                    foreach($data1 as $data){
                      echo $data['qtd']." Registro(s) ativos<br>(".$mes_atual."/".$ano_atual.")";
                    }
                    ?>
                  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="novo_registro.php">
                  <span class="float-left"><b><i class="fas fa-fw fa fa fa-plus-square"></i> Cadastrar novo registro</b></span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>

            <!-- VALOR TOTAL DOS REGISTROS ATIVOS -->
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-success o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa fa fas fa-dollar-sign"></i>
                  </div>
                  <div class="mr-5">
                  <?php
                      $saldo = $data3[0] - $data3[1];
                  echo "Saldo dos registros: <br>R$ ".number_format($saldo, 2)."<br>(".$mes_atual."/".$ano_atual.")";
                  ?>
                  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="relatorios.php">
                  <span class="float-left"><b><i class="fas fa-fw fa fa fa-cubes"></i> Visualizar relatórios</b></span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>

            <!-- USUARIOS CADASTRADOS -->
            <div class="col-xl-4 col-sm-6 mb-3">
              <div class="card text-white bg-secondary o-hidden h-100">
                <div class="card-body">
                  <div class="card-body-icon">
                    <i class="fas fa-fw fa fa fa  fa-handshake"></i>
                  </div>
                  <div class="mr-5">
                    <?php
                    foreach($data2 as $data){
                      echo $data['qtd']. " parceiros ativos na plataforma";
                    }
                    ?>
                  </div>
                </div>
                <a class="card-footer text-white clearfix small z-1" href="nova_parceria.php">
                  <span class="float-left"><b><i class='fas fa fa fa-check-circle'></i> Cadastrar nova parceria</b></span>
                  <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <br>

          <div>
          <center><b>Entradas x Saídas (em R$)</b></center>
          <div style="width: 480px;" id="chart_div_mensal"></div>
          <span style="margin-left: 200px"><b><?= $mes_atual."/".$ano_atual ?></b></span>

          <div style="width: 480px; float: right; margin-top: -200px" id="chart_div_anual"></div>
          <span style="margin-left: 550px"><b><?= $ano_atual ?></b></span>
          </div>

          <br><br><br><br><br>

          <div>
          <center><b>Entradas x Saídas (em Registros)</b></center>
          <div style="width: 480px;" id="chart_div_mensal_registros"></div>
          <span style="margin-left: 200px"><b><?= $mes_atual."/".$ano_atual ?></b></span>

          <div style="width: 480px; float: right; margin-top: -200px" id="chart_div_anual_registros"></div>
          <span style="margin-left: 550px"><b><?= $ano_atual ?></b></span>
          </div>

        <!-- <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Registros cadastrados no mês atual</div>
            <div class="card-body">
              <canvas id="myAreaChart" width="100%" height="30"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div> -->
          <!-- DataTables Example -->

        </div>
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Barban 2019</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sair</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Tem certeza que deseja sair?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
            <a class="btn btn-primary" href="../controller/sair.php">Sim</a>
          </div>
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../js/demo/datatables-demo.js"></script>


    <script type="text/javascript">
      window.onload = function () {
        setInterval("verifica_chat();", 500);
      }
    </script>
  </body>
</html>
