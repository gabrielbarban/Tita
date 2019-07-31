<?php  
//validando a session
session_start();
$nome_usuario = $_SESSION["nome_usuario"];
$username_usuario = $_SESSION["username_usuario"];
$usuario_id = $_SESSION["usuario_id"];
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
                $usuario_id: 1
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

      <!-- Sidebar -->
     <?php
     include("../model/config.php");
        $config = new Config();
        
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

      <div id="content-wrapper" style="margin-left: 15px">
        <div style="float: right; width: 40% !important">
            <a class="btn btn-primary" href="crm.php" ><i class="fas fa-fw fa fa-paper-plane"></i>
            <span>Campanhas e relacionamento</span></a><br><br>

            <a class="btn btn-primary" href="config-entrega.php" ><i class="fas fa-fw fa fa-bicycle"></i>
            <span>Configurar formas de entrega</span></a><br><br>

            <a class="btn btn-primary" href="config-etiqueta-individual.php" ><i class="fas fa-fw fa fa  fa-cube"></i>
            <span>Configurar etiqueta individual</span></a><br><br>

            <a class="btn btn-primary" href="config-etiqueta-pimaco.php" ><i class="fas fa-fw fa fa  fa-cubes"></i>
            <span>Configurar etiqueta PIMACO</span></a><br><br>

            <a class="btn btn-primary" href="config_documentos.php" ><i class="fas fa-fw fa fa-sticky-note"></i>
            <span>Configurar documentos</span></a><br><br>

            <a class="btn btn-primary" href="exporta.php" ><i class="fa fa-download"></i>
            <span>Exportar dados</span></a><br><br>

            <a class="btn btn-primary" href="config_logo.php" ><i class="fas fa-fw fa fa-image"></i>
            <span>Alterar Logo</span></a><br><br>

            <a class="btn btn-primary" href="configuracoes.php" ><i class="fas fa-fw fa fa  fa fa-reply"></i>
            <span>Voltar</span></a>
        </div>
          <?php
            session_start();
            $empresa_id = $_SESSION["empresa_id"];

            $data = array();
            $data=$config->pega_empresa($empresa_id);
          
          foreach ($data as $row) {
       ?>

       <div style="float: left; width: 60% !important">
       <h3><i class="fas fa fa fa-industry"></i> Companhia</h3><Br>
       <form action="../controller/editar_companhia.php" method="POST">
          <input type="hidden" value='<?=$row['id']?>' name="id">
          Nome: <input type="text" style="width: 70% !important;" class="form-control" value='<?=$row['nome']?>' name="nome" required="required"><br>
          Razão Social: <input type="text" style="width: 70% !important;" class="form-control" value='<?=$row['razao_social']?>' name="razao_social" required="required"><br>
          CNPJ: <input type="text" style="width: 70% !important;" class="form-control" value='<?=$row['cnpj']?>' name="cnpj" ><br>
          E-mail: <input type="text" style="width: 70% !important;" class="form-control" value='<?=$row['email']?>' name="email" required="required"><br>
          Celular: <input type="text" style="width: 70% !important;" class="form-control" value='<?=$row['celular']?>' name="celular" required="required"><br>
          Telefone: <input type="text" style="width: 70% !important;" class="form-control" value='<?=$row['telefone']?>' name="telefone" required="required"><br>
          Responsável: <input type="text" style="width: 70% !important;" class="form-control" value='<?=$row['responsavel']?>' name="responsavel" required="required">

          <br>
          <input type="submit" style="width: 70% !important; background-color: #ced4da;" class="form-control" value="Salvar">
        </form> 
      </div>
    <?php } ?>


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

    <script type="text/javascript">
      window.onload = function () {
        setInterval("verifica_chat();", 500);
      }
    </script>

  </body>

</html>
