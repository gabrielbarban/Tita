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
        <h3><i class="fas fa-fw   fa  fa fa-child"></i> Clientes</h3><br>
        
        <div id="dados_cliente"></div>
        <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#registroModal">Clique aqui para buscar&nbsp;&nbsp;&nbsp;<i class="fa fa-search"></i></a>
        <br><br>
            <div id="principal">
              <div id="info"></div><br>
              <!-- <span>Voltar</span></a>
              <a class="btn btn-primary" href="novo_usuario.php" >Novo cliente</a> -->
              <div id="dados_historico"></div>
            </div>

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




    <!-- modal cadastro-->
    <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cliente</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">

            <b>Busque o nome do cliente:</b>
              <input type="text" class="form-control" id="nome_busca" name="nome_busca" placeholder="Digite o nome do cliente" required="required">
            <button  class="form-control" style="background-color: #ced4da;" onclick="showUser()">Buscar <i class="fa fa-search"></i></button>
            <div id="texto">
              <div id="txtHint"></div>
            </div>
            

          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>




    <div class="modal fade" id="atualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Excluir usuário</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Tem certeza que deseja excluir?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
            <a class="btn btn-primary" href="../controller/sair.php">Sim</a>
          </div>
        </div>
      </div>
    </div>

    <!-- tentativa de criar um modal para cadastrar usuário !-->
    <div class="modal fade" id="novoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Novo Usuário</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form name="cadastro" id="cadastro" method="post" action="">
              <input style="border-radius: 8px" type="text" name="nome" placeholder="Nome">(*)<br>
              <input style="border-radius: 8px" type="text" name="username" placeholder="Username">(*)<br>
              <input style="border-radius: 8px" type="text" name="email" placeholder="E-mail"><br>
              <input style="border-radius: 8px" type="password" name="senha" placeholder="Senha"><br>
              <input style="border-radius: 8px" type="password" name="senha2" placeholder="Senha novamente"><br>
              <input style="border-radius: 8px" type="submit" value="Salvar">
            </form>
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>

      <script type="text/javascript">
            function impressao()
            {
              document.getElementById('editar_info').style.visibility = "hidden"; 
              document.getElementById('imprimir').style.visibility = "hidden"; 
              var conteudo = document.getElementById('principal').innerHTML,
              tela_impressao = window.open('about:blank');

              tela_impressao.document.write(conteudo);
              tela_impressao.window.print();
              tela_impressao.window.close();  

              document.getElementById('editar_info').style.visibility = "visible"; 
              document.getElementById('imprimir').style.visibility = "visible"; 
            }
      </script>

      <script>

        function puxarHistorico()
        {
          var id = $("#id_cliente").val();
          $.ajax({
                url: "../controller/historico_cliente.php",
                dataType: "json",
                data: {
                id: id
            },
                success: function(data) {
                  var nome_cliente = data[0]["nome_cliente"];
                  if(data[0]["data_nasc"]) var data_nasc = data[0]["data_nasc"]; else var data_nasc = '';
                  if(data[0]["rg"]) var rg = data[0]["rg"]; else var rg = '';
                  if(data[0]["cpf"]) var cpf = data[0]["cpf"]; else var cpf = '';
                  if(data[0]["telefone"]) var telefone = data[0]["telefone"]; else var telefone = '';
                  if(data[0]["celular"]) var celular = data[0]["celular"]; else var celular = '';
                  if(data[0]["email"]) var email = data[0]["email"]; else var email = '';
                  if(data[0]["endereco"]) var endereco = data[0]["endereco"]; else var endereco = '';

                  document.getElementById('info').innerHTML = "<b>Nome: </b>"+nome_cliente+"<br><b>RG: </b>"+rg+"<br><b>CPF: </b>"+cpf+"<br><b>Nascimento: </b>"+data_nasc+"<br><b>Telefone: </b>"+telefone+"<br><b>Celular: </b>"+celular+"<br><b>E-mail: </b>"+email+"<br><b>Endereço: </b>"+endereco+"<br><br> <a class='btn btn-primary' id='editar_info' href='edita_cliente.php'>Editar informações&nbsp;&nbsp;<i class='fa   fa fa-bars'></i></a><br><br><a class='btn btn-primary' id='imprimir' onclick='impressao()'>Imprimir&nbsp;&nbsp;&nbsp;<i class='fa fa fa-print'></i></a>";

                  var i=0;
                  document.getElementById('dados_historico').innerHTML = "<h4><center>Prontuário&nbsp;&nbsp;<i class='fa  fa fa-folder-open'></i></center></h4><br><div class='table-responsive'><table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'><thead><tr><th>Descrição</th><th>Data</th><th>Empresa</th><th>Status</th><th>Ativo?</th><th> </th></tr></thead>";
                  
                  for(i=0 ; i<data.length ; i++){

                    if(data[i]["ativo"] == '1') data[i]["ativo"] = "Sim";
                    if(data[i]["ativo"] == '0') data[i]["ativo"] = "Não";

                    id_registro = (parseInt(data[i]['id']) + 15920) - 350;

                    document.getElementById('dataTable').innerHTML += "<tbody><tr><td>"+data[i]['descricao']+"</td><td>"+data[i]['data_cadastro']+"</td><td>"+data[i]['nome_empresa']+"</td><td>"+data[i]['nome_status']+"</td><td>"+data[i]['ativo']+"</td><td><a target='_blank' href='etiqueta-individual.php?id="+id_registro+"'><i class='fas fa fa fa-cube' title='Etiqueta Individual'></i></a></td></tr></tbody>";
                  }
                  document.getElementById('dados_historico').innerHTML += "</table></div>";
                  if(data.length == 0)
                    document.getElementById('dataTable').innerHTML += "<br><i>Nenhum registro desse cliente.</i>";
                }
            });
        }


      function showUser() 
      {
          //REQUISIÇÃO JSON VALIDADA E FUNCIONANDO
          var str = document.getElementById("nome_busca").value;
          $.ajax({
            url: "../controller/busca_cliente.php",
            dataType: "json",
            data: {
            nome: str
          },
            success: function(data) {

              if(data.length == 0){
                document.getElementById('txtHint').innerHTML = "<br>Esse cliente não existe.";
              }

              //a
              if(data.length == 1){
              document.getElementById('txtHint').innerHTML = "<br><input id='a1nome' type='text' size=30 disabled='disabled' value='"+data[0]['nome']+"' id='a1nome'/><input id='a1id' type='hidden' value='"+ data[0]['id']+"'/><input type='text' disabled='disabled' size=10 value='"+data[0]['data_nasc']+"'/><input type='button' onclick='adda1()' value='Ir' />";
              }


              //b
              if(data.length == 2){
               document.getElementById('txtHint').innerHTML = "<br><input id='b1nome' type='text' size=30 disabled='disabled' value='"+data[0]['nome']+"' id='b2nome'/><input id='b1id' type='hidden' value='"+ data[0]['id']+"'/><input type='text' disabled='disabled' size=10 value='"+data[0]['data_nasc']+"'/><input type='button' onclick='addb1()' value='Ir' />";
               document.getElementById('txtHint').innerHTML += "<br><input id='b2nome' type='text' size=30 disabled='disabled' value='"+data[1]['nome']+"' id='b2nome'/><input id='b2id' type='hidden' value='"+ data[1]['id']+"'/><input type='text' disabled='disabled' size=10 value='"+data[1]['data_nasc']+"'/><input type='button' onclick='addb2()' value='Ir' />";
              }


              //c
              if(data.length == 3){
              document.getElementById('txtHint').innerHTML = "<br><input id='c1nome' type='text' size=30 disabled='disabled' value='"+data[0]['nome']+"' id='c1nome'/><input id='c1id' type='hidden' value='"+ data[0]['id']+"'/><input type='text' disabled='disabled' size=10 value='"+data[0]['data_nasc']+"'/><input type='button' onclick='addc1()' value='Ir' />";
              document.getElementById('txtHint').innerHTML += "<br><input id='c2nome' type='text' size=30 disabled='disabled' value='"+data[1]['nome']+"' id='c2nome'/><input id='c2id' type='hidden' value='"+ data[1]['id']+"'/><input type='text' disabled='disabled' size=10 value='"+data[1]['data_nasc']+"'/><input type='button' onclick='addc2()' value='Ir' />";
              document.getElementById('txtHint').innerHTML += "<br><input id='c3nome' type='text' size=30 disabled='disabled' value='"+data[2]['nome']+"' id='c3nome'/><input id='c3id' type='hidden' value='"+ data[2]['id']+"'/><input type='text' disabled='disabled' size=10 value='"+data[2]['data_nasc']+"'/><input type='button' onclick='addc3()' value='Ir' />";
              }


              //d
              if(data.length == 4){
              document.getElementById('txtHint').innerHTML = "<br><input id='d1nome' type='text' size=30 disabled='disabled' value='"+data[0]['nome']+"' id='d1nome'/><input id='d1id' type='hidden' value='"+ data[0]['id']+"'/><input type='text' disabled='disabled' size=10 value='"+data[0]['data_nasc']+"'/><input type='button' onclick='addd1()' value='Ir' />";
              document.getElementById('txtHint').innerHTML += "<br><input id='d2nome' type='text' size=30 disabled='disabled' value='"+data[1]['nome']+"' id='d2nome'/><input id='d2id' type='hidden' value='"+ data[1]['id']+"'/><input type='text' disabled='disabled' size=10 value='"+data[1]['data_nasc']+"'/><input type='button' onclick='addd2()' value='Ir' />";
              document.getElementById('txtHint').innerHTML += "<br><input id='d3nome' type='text' size=30 disabled='disabled' value='"+data[2]['nome']+"' id='d3nome'/><input id='d3id' type='hidden' value='"+ data[2]['id']+"'/><input type='text' disabled='disabled' size=10 value='"+data[2]['data_nasc']+"'/><input type='button' onclick='addd3()' value='Ir' />";
              document.getElementById('txtHint').innerHTML += "<br><input id='d4nome' type='text' size=30 disabled='disabled' value='"+data[3]['nome']+"' id='d4nome'/><input id='d4id' type='hidden' value='"+ data[3]['id']+"'/><input type='text' disabled='disabled' size=10 value='"+data[3]['data_nasc']+"'/><input type='button' onclick='addd4()' value='Ir' />";
              }


            }
          });
      }


      function adda1() 
      {
        var nome = document.getElementById("a1nome").value;
        var id = document.getElementById("a1id").value;
        document.getElementById('dados_cliente').innerHTML = "<input type='hidden' id='id_cliente'n ame='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
        puxarHistorico()
      }

      function addb1() 
      {
        var nome = document.getElementById("b1nome").value;
        var id = document.getElementById("b1id").value;
        document.getElementById('dados_cliente').innerHTML = "<input type='hidden' id='id_cliente' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
        puxarHistorico()
      }

      function addb2() 
      {
        var nome = document.getElementById("b2nome").value;
        var id = document.getElementById("b2id").value;
        document.getElementById('dados_cliente').innerHTML = "<input type='hidden' id='id_cliente' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
        puxarHistorico()
      }

      function addc1() 
      {
        var nome = document.getElementById("c1nome").value;
        var id = document.getElementById("c1id").value;
        document.getElementById('dados_cliente').innerHTML = "<input type='hidden' id='id_cliente' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
        puxarHistorico()
      }

      function addc2() 
      {
        var nome = document.getElementById("c2nome").value;
        var id = document.getElementById("c2id").value;
        document.getElementById('dados_cliente').innerHTML = "<input type='hidden' id='id_cliente' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
        puxarHistorico()
      }

      function addc3() 
      {
        var nome = document.getElementById("c3nome").value;
        var id = document.getElementById("c3id").value;
        document.getElementById('dados_cliente').innerHTML = "<input type='hidden' id='id_cliente' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
        puxarHistorico()
      }

      function addd1() 
      {
        var nome = document.getElementById("d1nome").value;
        var id = document.getElementById("d1id").value;
        document.getElementById('dados_cliente').innerHTML = "<input type='hidden' id='id_cliente' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
        puxarHistorico()
      }

      function addd2() 
      {
        var nome = document.getElementById("d2nome").value;
        var id = document.getElementById("d2id").value;
        document.getElementById('dados_cliente').innerHTML = "<input type='hidden' id ='id_cliente' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
        puxarHistorico()
      }

      function addd3() 
      {
        var nome = document.getElementById("d3nome").value;
        var id = document.getElementById("d3id").value;
        document.getElementById('dados_cliente').innerHTML = "<input type='hidden' id='id_cliente' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
        puxarHistorico()
      }

      function addd4() 
      {
        var nome = document.getElementById("d4nome").value;
        var id = document.getElementById("d4id").value;
        document.getElementById('dados_cliente').innerHTML = "<input type='hidden' id='id_cliente' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
        puxarHistorico()
      }



      </script>
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
