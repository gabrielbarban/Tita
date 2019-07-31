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


    <script>
      function setDadosModal(valor) {
         $('#id_registro').val(valor);
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


        if(!$permissao1)
        {
          session_start();
          $url = $_SESSION["url_inicial"];

          echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.alert('Você não tem permissão para acessar essa funcionalidade.')
                window.location.href='../view/".$url.".php';
                </SCRIPT>");
        }

        
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
        <br>
        <a class="btn btn-primary" href="novo_registro.php" >Cadastrar novo registro&nbsp;&nbsp;&nbsp;<i class="fa fa fa-bolt"></i></a>
        <br><br><br>

        <input class="form-control" type="text" name="busca" id="busca" placeholder="Digite o código do registro">
        <button  class="form-control" style="background-color: #ced4da;" onclick="busca_registro()">Buscar</button>

        <br><br>
        <h3>Lista de registros ativos:</h3>

        <div class="container-fluid">
          <div class="table-responsive" id="tabela_de_busca">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th>Cliente</th>
                      <!-- <th>Valor</th> -->
                      <th>Data</th>
                      <th>Descrição</th>
                      <th>Status</th>
                      <th>Empresa</th>
                    </tr>
                  </thead>
          <?php

            $lista_formas = array();
            $lista_status = array();
            $lista_formas = $config->lista_formas_pagamento($empresa_id);
            $lista_status = $config->lista_status($empresa_id);
            $lista_documentos = $config->lista_documentos($empresa_id);

            $data = array();
            $data=$config->lista_registros($empresa_id, 1);
            $cont=0;

            foreach ($data as $row) {
              echo "<tbody><tr><td>".$row['nome_cliente']."</td>";
              //echo "<td>R$ ".$row['valor']."</td>";
              echo "<td>".date('d/m/Y H:i', strtotime($row['data_cadastro']))."</td>";
              echo "<td>".$row['descricao']."</td>";
              echo "<td>".$row['nome_status']."</td>";
              echo "<td>".$row['nome_empresa']."</td>";
              //salto =  + 15920 - 350
              $id = $row['id'] + 15920 - 350;
              echo "<td>
                <a target='_blank' href='etiqueta-individual.php?id=".$id."'><i class='fas fa fa fa-cube' title='Etiqueta Individual'></i></a>
                <a target='_blank' href='etiqueta-pimaco.php?id=".$id."'><i class='fas fa fa fa-cubes' title='Etiqueta PIMACO'></i></a>
                <a href='ficha_registro.php?id=".$id."' target='_blank'><i class='fas fa fa   fa fa-barcode' title='Ficha de Registro'></i></a>
                <a href='#' data-toggle='modal' data-target='#documentoModal' target='_blank' onclick='setDadosModal(".$row['id'].")'><i class='fas fa fa  fa-sticky-note' title='Documentos'></i></a>
                <a href='../controller/editar_cliente.php?id=".$row['id_cliente']."' target='_blank'><i class='fas fa fa fa-child' title='Dados do cliente'></i></a>
                <a href='editar_registro.php?id=".$id."'><i class='fas fa fa-edit' title='Editar'></i></a>
                <a href='apagar_registro.php?id=".$id."'><i class='fas fa fa-times' title='Excluir'></i></a>
              </td></tr></tbody>";
              $cont++;
            }
          ?>
                </table>
                <!-- <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#filtroModal">Filtrar &nbsp;&nbsp;&nbsp;<i class="fa fa  fa fa-database"></i></a> -->
            </div>
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





    
    <!-- MODAL DOCUMENTO-->
    <div class="modal fade" id="documentoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Documentos&nbsp;&nbsp;<i class='fas fa fa  fa-sticky-note'></i></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <!-- Modal Body !-->
          <div class="modal-body">       
            <form action="gera_documento.php" method="POST">
            <input type="hidden" name="id_registro" id="id_registro" value="">
            Selecione:
            <select class="form-control" name="documento" placeholder="Status" >
              <?php
                foreach ($lista_documentos as $data) {
                  echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
                }
              ?>
            </select><br>

            <input type="submit" class="form-control" value="Carregar" style="background-color: #ced4da;">
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>





    <script type="text/javascript">
      function busca_registro() 
      {
        //requisição json para buscar pelo ID do registro figitado pelo usuário... deve funcionar utilizando o method
            var busca = $("#busca").val();
            $.ajax({
                type: 'POST',
                url: "../controller/busca_registro.php",
                dataType: "json",
                data: {
                busca: busca
            },
                success: function(data) {
                  document.getElementById('tabela_de_busca').innerHTML = "";


                  $('#tabela_de_busca').append("<table class='table table-bordered' id='dataTable' width='100%'' cellspacing='0'>");
                  $('#dataTable').append("<thead><tr><th>Cliente</th><th>Data</th><th>Descrição</th><th>Status</th> <th>Empresa</th></tr></thead>");

                  if(data.length == 0)
                  document.getElementById('tabela_de_busca').innerHTML = "<br><i>Não existem registros com esse código</i>";

                  //$('#dataTable').append("<tbody><tr><td>");
                  $('#dataTable').append("<td>"+data[0]['nome_cliente']+"</td>");
                  $('#dataTable').append("<td>"+data[0]['data_cadastro']+"</td>");
                  $('#dataTable').append("<td>"+data[0]['descricao']+"</td>");
                  $('#dataTable').append("<td>"+data[0]['nome_status']+"</td>");
                  $('#dataTable').append("<td>"+data[0]['nome_empresa']+"</td>");

                  //salto =  + 15920 - 350
                  $id = +data[0]['id']+ + 15920 - 350;
                  $('#dataTable').append("<td><a target='_blank' href=etiqueta-individual.php?id="+$id+"><i class='fas fa fa fa-cube' title='Etiqueta Individual'></i></a>  <a target='_blank' href=etiqueta-pimaco.php?id="+$id+"><i class='fas fa fa fa-cubes' title='Etiqueta PIMACO'></i></a>  <a href=ficha_registro.php?id="+$id+" target='_blank'><i class='fas fa fa   fa fa-barcode' title='Ficha de Registro'></i></a>  <a href='#' data-toggle='modal' data-target='#documentoModal' target='_blank' onclick='setDadosModal("+data[0]['id']+")'><i class='fas fa fa  fa-sticky-note' title='Documentos'></i></a>  <a href='../controller/editar_cliente.php?id="+data[0]['id_cliente']+"' target='_blank'><i class='fas fa fa fa-child' title='Dados do cliente'></i></a>  <a href='editar_registro.php?id="+$id+"'><i class='fas fa fa-edit' title='Editar'></i></a>  <a href='apagar_registro.php?id="+$id+"'><i class='fas fa fa-times' title='Excluir'></i></a>  </td></tr></tbody></table></div>");

                }
            });
      }
    </script>





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
    <script src="https://cdn.jsdelivr.net/jsbarcode/3.6.0/JsBarcode.all.min.js"></script>

    <script type="text/javascript">
      window.onload = function () {
        setInterval("verifica_chat();", 500);
      }
    </script>
    
  </body>

</html>
