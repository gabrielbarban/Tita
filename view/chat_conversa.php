<?php  
//validando a session
session_start();
$nome_usuario = $_SESSION["nome_usuario"];
$empresa_id = $_SESSION["empresa_id"];
$username_usuario = $_SESSION["username_usuario"];
$usuario_id = $_SESSION["usuario_id"];
if(!$nome_usuario)
header('Location: ../index.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>

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

     <div id='content-wrapper' style='margin-left: 15px'>
        <?php
            $id_usuario = $_GET['id'];
            //salto =  + 15920 - 350
            $id_usuario = $id_usuario - 15920 + 350;
            $dados = $config->pega_usuario($id_usuario);
            $nome_usuario = $dados[0]['nome'];
        ?>
        <h3><?= $nome_usuario ?> <i class='fas fa fa-comment' ></i></h3><br>
        <font size='1'><i><div id="digitando"></div></i></font>
        <form action="../controller/nova_mensagem.php" method="POST">
          <input class="form-control" type="text" name="texto" id="texto" onfocus="digitando()" onblur="naoDigitando()" placeholder="Digite sua mensagem aqui...">
          <input type="hidden" name="usuario2" value="<?= $id_usuario ?>">
          <input type="submit" class="form-control" value="Enviar" style="background-color: #ced4da; width: 150px">
        </form>
        <br><br>
        <div id="mensagens"></div>


      <script>
        window.onload = function () {
        setInterval("puxa_chat();", 100);
      }





      function digitando()
      {
        $.ajax({
                url: "../controller/altera_flag_digitando.php",
                dataType: "json",
                data: {
                usuario1: <?= $usuario_id ?>,
                flag: '1'
            },
                success: function(data) {
                  console.log('Digitando...');                  
                }
            });
      }








      function naoDigitando()
      {
        $.ajax({
                url: "../controller/altera_flag_digitando.php",
                dataType: "json",
                data: {
                usuario1: <?= $usuario_id ?>,
                flag: '0'
            },
                success: function(data) {
                  console.log('Não está digitando...');                  
                }
            });
      }








      function puxa_chat()
      {
          var usuario1= <?= $usuario_id ?>;
          var usuario2= <?= $id_usuario ?>;

          var usuario_id= <?= $usuario_id ?>;
          var id_usuario= <?= $id_usuario ?>;




          //VENDO SE O OUTRO USUÁRIO ESTÁ DIGITANDO
          $.ajax({
                url: "../controller/flag_digitando.php",
                dataType: "json",
                data: {
                usuario2: <?= $id_usuario ?>
            },
                success: function(data) {
                  var codigo = '';

                  if(data[0]['flag_digitando'] == 1)
                  {
                    codigo = 'Digitando...'
                    document.getElementById('digitando').innerHTML = codigo;
                  }

                  if(data[0]['flag_digitando'] == 0)
                  {
                    codigo = ''
                    document.getElementById('digitando').innerHTML = codigo;
                  }
                  
                }
            });






          //LISTANDO AS CONVERSAS DO CHAT
          $.ajax({
                url: "../controller/chat_json.php",
                dataType: "json",
                data: {
                usuario1: <?= $usuario_id ?>,
                usuario2: <?= $id_usuario ?>
            },
                success: function(data) {

                    var codigo = "";

                    for(i=0 ; i<data.length ; i++)
                    {
                      if(usuario_id == data[i]['usuario1'] && id_usuario == data[i]['usuario2']) //se o usuario1 é o usuario logado
                      {
                        codigo += "<span style='float: right; color: #800000'><b>"+data[i]['nome_usuario1']+"</b>: "; 
                        codigo += data[i]['texto'];
                        codigo += "         <font size='1'><i>("+data[i]['data_cadastro']+")</i></font></span><br>";
                      }

                      if(id_usuario == data[i]['usuario1'] && usuario_id == data[i]['usuario2']) //se o usuario2 é o usuario logado
                      {
                        codigo += "<span style='float: left; color:   #6A5ACD'><b>"+data[i]['nome_usuario1']+"</b>: "; 
                        codigo += data[i]['texto'];
                        codigo += "         <font size='1'><i>("+data[i]['data_cadastro']+")</i></font></span><br>";
                      }
                    }
                  document.getElementById('mensagens').innerHTML = codigo;
                  //$("#mensagens").val(codigo);
                }
          });






          //ALTERANDO AS MENSAGENS, MARCANDO COMO LIDAS
          $.ajax({
                url: "../controller/atualiza_chat.php",
                dataType: "json",
                data: {
                $usuario_id: <?= $usuario_id ?>
            },
                success: function(data)
                {
                  console.log("Mensagem lida");
                }
          });
      }




      </script>


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

  </body>

</html>
