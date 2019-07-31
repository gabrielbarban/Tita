<?php  
//validando a session
session_start();
$empresa_id = $_SESSION["empresa_id"];
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
        <div class="container-fluid">
          <br>
          <!-- <a class="btn btn-primary" href="javascript:history.back(1)" ><i class="fas fa-fw fa fa  fa fa-reply"></i>
            <span>Voltar</span></a>
             <br> <br><br> !-->
          <?php
            $lista_formas = array();
            $lista_status = array();
            $lista_empresas = array();
            $lista_formas = $config->lista_formas_pagamento($empresa_id);
            $lista_status = $config->lista_status($empresa_id);
            $lista_empresas = $config->lista_empresas($empresa_id, 1);
            $lista_parceiros = $config->lista_parceiros($empresa_id);
            $lista_entregas = $config->lista_entregas($empresa_id);
          ?>
          <h3><i class="fa fa  fa fa-bolt"></i> Novo Registro:</h3>
          <br>
          <form action="../controller/novo_registro.php" method="POST">
                   
            <!--
              serve para adicionar o id do cliente, usando o inner HTML
            -->
            <div id="dados_cliente1"></div>
            <div id="dados_cliente2"></div>
            <div id="dados_cliente3"></div>
            <div id="dados_cliente4"></div>
            <div id="dados_cliente5"></div>
            <div id="dados_pagamento"></div>
            

            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#registroModal">Inserir cliente <i class="fas fa-child"></i></a>
            <input type="text" style="width: 250px;" class="form-control" name="cliente" id="cliente" disabled="disabled" placeholder="Nome do cliente" required="required"><br>




            Valor 1: <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#empresaValorModal1">Inserir empresa/valor <i class="fas fa-dollar-sign"></i></a> <input type="text" id="info-valor1" name="info-valor1" size="10" disabled="disabled"><br>

            Valor 2: <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#empresaValorModal2">Inserir empresa/valor <i class="fas fa-dollar-sign"></i></a> <input type="text" id="info-valor2" name="info-valor2" size="10" disabled="disabled"><br> 

            Valor 3: <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#empresaValorModal3">Inserir empresa/valor <i class="fas fa-dollar-sign"></i></a> <input type="text" id="info-valor3" name="info-valor3" size="10" disabled="disabled"><br>

            Valor 4: <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#empresaValorModal4">Inserir empresa/valor <i class="fas fa-dollar-sign"></i></a> <input type="text" id="info-valor4" name="info-valor4" size="10" disabled="disabled"><br>

            Valor 5: <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#empresaValorModal5">Inserir empresa/valor <i class="fas fa-dollar-sign"></i></a> <input type="text" id="info-valor5" name="info-valor5" size="10" disabled="disabled">
            <br><br>
            Total: <input type="text" id="desc_valor" name="desc_valor" size="10" disabled="disabled">

            <br><br>

            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#FormaModal">Forma de pagamento <i class="fas fa-credit-card"></i></a>
            <input type="text" style="width: 250px;" class="form-control" name="status_forma" id="status_forma" disabled="disabled" required="required"><br>

            Descrição:<input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição" required="required"><br>

            <!-- parceiros !-->
            Parceiro:
            <select class="form-control" name="parceiro" placeholder="Parceiros" >
              <?php
                foreach ($lista_parceiros as $data) {
                  echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
                }
              ?>
            </select><br>

            <!-- status !-->
            Status:
            <select class="form-control" name="status" placeholder="Status" >
              <?php
                foreach ($lista_status as $data) {
                  echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
                }
              ?>
            </select><br>

            <!-- formas de entrega !-->
            Forma de entrega:
            <select class="form-control" name="entrega" placeholder="Forma de entrega" >
              <?php
                foreach ($lista_entregas as $data) {
                  echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
                }
              ?>
            </select><br>
            <br>

            <input type="submit" class="form-control" value="Salvar" style="background-color: #ced4da;">
          </form>
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
            <h5 class="modal-title" id="exampleModalLabel">Cliente <i class="fas fa-fw   fa  fa fa-child"></i></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">

            <b>Busque o nome do cliente já cadastrado:</b>
              <input type="text" class="form-control" id="nome_busca" name="nome_busca" placeholder="Digite o nome do cliente" required="required">
            <button  class="form-control" style="background-color: #ced4da;" onclick="showUser()">Clique aqui para buscar &nbsp;&nbsp;<i class="fa fa-search"></i></button>
            <div id="texto">
              <div id="txtHint"></div>
            </div>
            <br>
            ou...<br><br>

            <b>Novo cliente:</b>
              <input type="text" class="form-control" id="novo_nome" name="novo_nome" placeholder="Digite o nome do cliente" required="required">
              <input type="text" class="form-control" id="novo_nascimento" name="novo_nascimento" onkeyup="mascara_data(this, this.value)" placeholder="Digite a data de nascimento do cliente" required="required">
              <input type="text" class="form-control" id="rg" name="rg" placeholder="Digite o RG" required="required">
              <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite o CPF" required="required">
                <button  class="form-control" style="background-color: #ced4da;" onclick="novoUser()">Cadastrar</button>


          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>



    <!-- modal Empresa/Valor-->
    <div class="modal fade" id="empresaValorModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Empresa/Valor <i class="fas fa-dollar-sign"></i></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            Empresa:
            <select class="form-control" id="busca_id_empresa1" onchange="pega_empresa1();">
              <option>Selecione...</option>
              <?php
                foreach ($lista_empresas as $data) {
                  echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
                }
              ?>
            </select><br>
            <div id="busca-valores1"></div>       
            <br>
            <button  class="form-control" style="background-color: #ced4da;" onclick="Salva_Empresa_Valor1()">Salvar</button> 

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>










    <div class="modal fade" id="empresaValorModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Empresa/Valor <i class="fas fa-dollar-sign"></i></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            Empresa:
            <select class="form-control" id="busca_id_empresa2" onchange="pega_empresa2();">
              <option>Selecione...</option>
              <?php
                foreach ($lista_empresas as $data) {
                  echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
                }
              ?>
            </select><br>
            <div id="busca-valores2"></div>       
            <br>
            <button  class="form-control" style="background-color: #ced4da;" onclick="Salva_Empresa_Valor2()">Salvar</button> 

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>













    <div class="modal fade" id="empresaValorModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Empresa/Valor <i class="fas fa-dollar-sign"></i></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            Empresa:
            <select class="form-control" id="busca_id_empresa3" onchange="pega_empresa3();">
              <option>Selecione...</option>
              <?php
                foreach ($lista_empresas as $data) {
                  echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
                }
              ?>
            </select><br>
            <div id="busca-valores3"></div>       
            <br>
            <button  class="form-control" style="background-color: #ced4da;" onclick="Salva_Empresa_Valor3()">Salvar</button> 

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>













    <div class="modal fade" id="empresaValorModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Empresa/Valor <i class="fas fa-dollar-sign"></i></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            Empresa:
            <select class="form-control" id="busca_id_empresa4" onchange="pega_empresa4();">
              <option>Selecione...</option>
              <?php
                foreach ($lista_empresas as $data) {
                  echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
                }
              ?>
            </select><br>
            <div id="busca-valores4"></div>       
            <br>
            <button  class="form-control" style="background-color: #ced4da;" onclick="Salva_Empresa_Valor4()">Salvar</button> 

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>














    <div class="modal fade" id="empresaValorModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Empresa/Valor <i class="fas fa-dollar-sign"></i></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            Empresa:
            <select class="form-control" id="busca_id_empresa5" onchange="pega_empresa5();">
              <option>Selecione...</option>
              <?php
                foreach ($lista_empresas as $data) {
                  echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
                }
              ?>
            </select><br>
            <div id="busca-valores5"></div>       
            <br>
            <button  class="form-control" style="background-color: #ced4da;" onclick="Salva_Empresa_Valor5()">Salvar</button> 

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>













    <!-- modal forma de pagamento-->
    <div class="modal fade" id="FormaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Forma de pagamento <i class="fas fa-credit-card"></i></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            
            <!-- formas de pagamento !-->
            Forma de pagamento 1:
            <select class="form-control" name="forma1" id="forma1" placeholder="Forma de pagamento" onclick="recalcula1()">
              <option value="---">---</option>
              <?php
                foreach ($lista_formas as $data) {
                  echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
                }
              ?>
            </select>
            <input type="text" class="form-control" id="valor1" name="valor1" placeholder="Valor 1" onblur="recalcula1()" required="required">
            <br><br>
            Forma de pagamento 2:
            <select class="form-control" name="forma2" id="forma2" placeholder="Forma de pagamento" onclick="recalcula2()">
              <option value="---">---</option>
              <?php
                foreach ($lista_formas as $data) {
                  echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
                }
              ?>
            </select>
            <input type="text" class="form-control" id="valor2" name="valor2" placeholder="Valor 2" onblur="recalcula2()"required="required">
            <br><br><br>Resta:
            <input type="text" class="form-control" id="resto" name="resto" disabled="disabled" required="required">
            <br><br>
            <button  class="form-control" style="background-color: #ced4da;" onclick="salva_forma()">Salvar</button> 

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>



    <script type="text/javascript"> 

      function recalcula1()
      {
        valor_final = $('#desc_valor').val();
        valor1 = $('#valor1').val();
        calculo2 = (valor_final - valor1); //diferença
        calculo_final = 0;

        calculo2 = calculo2.toFixed(2);
        //calculo_final = calculo_final.toFixed(2);
        $('#valor2').val(calculo2);
        $('#resto').val(calculo_final);
      }

      function recalcula2()
      {
        valor_final = $('#desc_valor').val();
        valor2 = $('#valor2').val();
        calculo2 = (valor_final - valor2); //diferença
        calculo_final = 0;

        calculo2 = calculo2.toFixed(2);
        //calculo_final = calculo_final.toFixed(2);
        $('#valor1').val(calculo2);
        $('#resto').val(calculo_final);
      }

      function salva_forma()
      {
        valor1 = $('#valor1').val();
        valor2 = $('#valor2').val();
        forma1 = $('#forma1').val();
        forma2 = $('#forma2').val();

        document.getElementById('dados_pagamento').innerHTML = "<input type='hidden' name='forma-1' value='"+forma1+"' />";
        document.getElementById('dados_pagamento').innerHTML += "<input type='hidden' name='valor-1' value='"+valor1+"' />";
        document.getElementById('dados_pagamento').innerHTML += "<input type='hidden' name='forma-2' value='"+forma2+"' />";
        document.getElementById('dados_pagamento').innerHTML += "<input type='hidden' name='valor-2' value='"+valor2+"' />";
        $('#status_forma').val("Ok!");
        $("#FormaModal").modal('hide');
      }

      function mascara_data(campo, valor)
      {
        var mydata = '';
        mydata = mydata + valor;
        if (mydata.length == 2){
          mydata = mydata + '/';
          campo.value = mydata;
        }
        if (mydata.length == 5){
          mydata = mydata + '/';
          campo.value = mydata;
        }
      }


      function soma_total()
      {
        if( $('#valor_1').val() ) 
          valor1=$('#valor_1').val();
        else
          valor1=0;
        
        if( $('#valor_2').val() ) 
          valor2=$('#valor_2').val();
        else
          valor2=0;

        if( $('#valor_3').val() ) 
          valor3=$('#valor_3').val();
        else
          valor3=0;

        if( $('#valor_4').val() ) 
          valor4=$('#valor_4').val();
        else
          valor4=0;

        if( $('#valor_5').val() ) 
          valor5=$('#valor_5').val();
        else
          valor5=0;



        var soma_total = 0;
        soma_total = Number(valor1) + Number(valor2) + Number(valor3) + Number(valor4) + Number(valor5);              
        
        $('#valor1').val(soma_total);
        $('#desc_valor').val(soma_total);

        document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='valor_final' value='"+soma_total+"'/>";
      }



      function pega_empresa1()
      {
            //REQUISIÇÃO JSON VALIDADA E FUNCIONANDO
            var busca_id_empresa = document.getElementById("busca_id_empresa1").value;
            $.ajax({
                url: "../controller/pega_valores.php",
                dataType: "json",
                data: {
                id: busca_id_empresa
            },
                success: function(data) {


                  var i=0;
                  document.getElementById('busca-valores1').innerHTML = "Valor 1:<select class='form-control' id='busca_id_valor1' >";
                  for(i=0 ; i<data.length ; i++){
                    document.getElementById('busca_id_valor1').innerHTML += "<option value="+data[i]['id']+">"+data[i]['nome']+" - R$ "+data[i]['valor']+"</option>";
                  }
                  document.getElementById('busca_id_valor1').innerHTML += "</select>";
                  document.getElementById('busca-valores1').innerHTML += "Quantidade:<input class='form-control' id='quantidade1'>";

                }
            });
      }

      function Salva_Empresa_Valor1() 
      {
            var empresa = $("#busca_id_empresa1 option:selected").text();
            var str = $("#busca_id_valor1 option:selected").text();
            var palavras = str.split(" - R$ ");
            var nome = palavras[0];
            var valor = palavras[1];
            var qtd = $("#quantidade1").val();
            valor = (valor * qtd); 
            var id = $("#busca_id_valor1 option:selected").val();
            $("#info-valor1").attr("value", "OK!");
            $("#descricao").attr("value", nome);
            document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='id_valor1' value='"+id+"' />";
            document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='qtd1' value='"+qtd+"' />";
            document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' id='valor_1' name='valor1' value='"+valor+"' />";
            soma_total()
            $("#empresaValorModal1").modal('hide');
      }
















      function pega_empresa2()
      {
            //REQUISIÇÃO JSON VALIDADA E FUNCIONANDO
            var busca_id_empresa = document.getElementById("busca_id_empresa2").value;
            $.ajax({
                url: "../controller/pega_valores.php",
                dataType: "json",
                data: {
                id: busca_id_empresa
            },
                success: function(data) {


                  var i=0;
                  document.getElementById('busca-valores2').innerHTML = "Valor 1:<select class='form-control' id='busca_id_valor2' >";
                  for(i=0 ; i<data.length ; i++){
                    document.getElementById('busca_id_valor2').innerHTML += "<option value="+data[i]['id']+">"+data[i]['nome']+" - R$ "+data[i]['valor']+"</option>";
                  }
                  document.getElementById('busca_id_valor2').innerHTML += "</select>";
                  document.getElementById('busca-valores2').innerHTML += "Quantidade:<input class='form-control' id='quantidade2'>";

                }
            });
      }

      function Salva_Empresa_Valor2() 
      {
            var empresa = $("#busca_id_empresa2 option:selected").text();
            var str = $("#busca_id_valor2 option:selected").text();
            var palavras = str.split(" - R$ ");
            var nome = palavras[0];
            var valor = palavras[1];
            var qtd = $("#quantidade2").val();
            valor = (valor * qtd); 
            var id = $("#busca_id_valor2 option:selected").val();
            $("#info-valor2").attr("value", "OK!");
            document.getElementById('dados_cliente2').innerHTML = "<input type='hidden' name='id_valor2' value='"+id+"' />";
            document.getElementById('dados_cliente2').innerHTML += "<input type='hidden' name='qtd2' value='"+qtd+"' />";
            document.getElementById('dados_cliente2').innerHTML += "<input type='hidden' id='valor_2' name='valor2' value='"+valor+"' />";
            soma_total()
            $("#empresaValorModal2").modal('hide');
      }




















      function pega_empresa3()
      {
            //REQUISIÇÃO JSON VALIDADA E FUNCIONANDO
            var busca_id_empresa = document.getElementById("busca_id_empresa3").value;
            $.ajax({
                url: "../controller/pega_valores.php",
                dataType: "json",
                data: {
                id: busca_id_empresa
            },
                success: function(data) {


                  var i=0;
                  document.getElementById('busca-valores3').innerHTML = "Valor 1:<select class='form-control' id='busca_id_valor3' >";
                  for(i=0 ; i<data.length ; i++){
                    document.getElementById('busca_id_valor3').innerHTML += "<option value="+data[i]['id']+">"+data[i]['nome']+" - R$ "+data[i]['valor']+"</option>";
                  }
                  document.getElementById('busca_id_valor3').innerHTML += "</select>";
                  document.getElementById('busca-valores3').innerHTML += "Quantidade:<input class='form-control' id='quantidade3'>";

                }
            });
      }

      function Salva_Empresa_Valor3() 
      {
            var empresa = $("#busca_id_empresa3 option:selected").text();
            var str = $("#busca_id_valor3 option:selected").text();
            var palavras = str.split(" - R$ ");
            var nome = palavras[0];
            var valor = palavras[1];
            var qtd = $("#quantidade3").val();
            valor = (valor * qtd); 
            var id = $("#busca_id_valor3 option:selected").val();
            $("#info-valor3").attr("value", "OK!");
            document.getElementById('dados_cliente3').innerHTML = "<input type='hidden' name='id_valor3' value='"+id+"' />";
            document.getElementById('dados_cliente3').innerHTML += "<input type='hidden' name='qtd3' value='"+qtd+"' />";
            document.getElementById('dados_cliente3').innerHTML += "<input type='hidden' id='valor_3' name='valor3' value='"+valor+"' />";
            soma_total()
            $("#empresaValorModal3").modal('hide');
      }























      function pega_empresa4()
      {
            //REQUISIÇÃO JSON VALIDADA E FUNCIONANDO
            var busca_id_empresa = document.getElementById("busca_id_empresa4").value;
            $.ajax({
                url: "../controller/pega_valores.php",
                dataType: "json",
                data: {
                id: busca_id_empresa
            },
                success: function(data) {


                  var i=0;
                  document.getElementById('busca-valores4').innerHTML = "Valor 1:<select class='form-control' id='busca_id_valor4' >";
                  for(i=0 ; i<data.length ; i++){
                    document.getElementById('busca_id_valor4').innerHTML += "<option value="+data[i]['id']+">"+data[i]['nome']+" - R$ "+data[i]['valor']+"</option>";
                  }
                  document.getElementById('busca_id_valor4').innerHTML += "</select>";
                  document.getElementById('busca-valores4').innerHTML += "Quantidade:<input class='form-control' id='quantidade4'>";

                }
            });
      }

      function Salva_Empresa_Valor4() 
      {
            var empresa = $("#busca_id_empresa4 option:selected").text();
            var str = $("#busca_id_valor4 option:selected").text();
            var palavras = str.split(" - R$ ");
            var nome = palavras[0];
            var valor = palavras[1];
            var qtd = $("#quantidade4").val();
            valor = (valor * qtd); 
            var id = $("#busca_id_valor4 option:selected").val();
            $("#info-valor4").attr("value", "OK!");
            document.getElementById('dados_cliente4').innerHTML = "<input type='hidden' name='id_valor4' value='"+id+"' />";
            document.getElementById('dados_cliente4').innerHTML += "<input type='hidden' name='qtd4' value='"+qtd+"' />";
            document.getElementById('dados_cliente4').innerHTML += "<input type='hidden' id='valor_4' name='valor4' value='"+valor+"' />";
            soma_total()
            $("#empresaValorModal4").modal('hide');
      }































      function pega_empresa5()
      {
            //REQUISIÇÃO JSON VALIDADA E FUNCIONANDO
            var busca_id_empresa = document.getElementById("busca_id_empresa5").value;
            $.ajax({
                url: "../controller/pega_valores.php",
                dataType: "json",
                data: {
                id: busca_id_empresa
            },
                success: function(data) {


                  var i=0;
                  document.getElementById('busca-valores5').innerHTML = "Valor 1:<select class='form-control' id='busca_id_valor5' >";
                  for(i=0 ; i<data.length ; i++){
                    document.getElementById('busca_id_valor5').innerHTML += "<option value="+data[i]['id']+">"+data[i]['nome']+" - R$ "+data[i]['valor']+"</option>";
                  }
                  document.getElementById('busca_id_valor5').innerHTML += "</select>";
                  document.getElementById('busca-valores5').innerHTML += "Quantidade:<input class='form-control' id='quantidade5'>";

                }
            });
      }

      function Salva_Empresa_Valor5() 
      {
            var empresa = $("#busca_id_empresa5 option:selected").text();
            var str = $("#busca_id_valor5 option:selected").text();
            var palavras = str.split(" - R$ ");
            var nome = palavras[0];
            var valor = palavras[1];
            var qtd = $("#quantidade5").val();
            valor = (valor * qtd); 
            var id = $("#busca_id_valor5 option:selected").val();
            $("#info-valor5").attr("value", "OK!");
            document.getElementById('dados_cliente5').innerHTML = "<input type='hidden' name='id_valor5' value='"+id+"' />";
            document.getElementById('dados_cliente5').innerHTML += "<input type='hidden' name='qtd5' value='"+qtd+"' />";
            document.getElementById('dados_cliente5').innerHTML += "<input type='hidden' id='valor_5' name='valor5' value='"+valor+"' />";
            soma_total()
            $("#empresaValorModal5").modal('hide');
      }
























      function novoUser()
      {
            //REQUISIÇÃO JSON VALIDADA E FUNCIONANDO
            var nome = document.getElementById("novo_nome").value;
            var nascimento = document.getElementById("novo_nascimento").value;
            var rg = document.getElementById("rg").value;
            var cpf = document.getElementById("cpf").value;
            $.ajax({
                url: "../controller/novo_cliente.php",
                dataType: "json",
                data: {
                nome: nome,
                nascimento: nascimento,
                rg: rg,
                cpf: cpf
            },
                success: function(data) {
                  var id =data[0][0];
                  $('#cliente').val(nome);
                  document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='id_cliente' value='"+id+"' />";
                  $("#registroModal").modal('hide');
                }
            });
      }

      function adda1() 
      {
        var nome = document.getElementById("a1nome").value;
        var id = document.getElementById("a1id").value;
        $('#cliente').val(nome);
        document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
      }

      function addb1() 
      {
        var nome = document.getElementById("b1nome").value;
        var id = document.getElementById("b1id").value;
        $('#cliente').val(nome);
        document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
      }

      function addb2() 
      {
        var nome = document.getElementById("b2nome").value;
        var id = document.getElementById("b2id").value;
        $('#cliente').val(nome);
        document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
      }

      function addc1() 
      {
        var nome = document.getElementById("c1nome").value;
        var id = document.getElementById("c1id").value;
        $('#cliente').val(nome);
        document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
      }

      function addc2() 
      {
        var nome = document.getElementById("c2nome").value;
        var id = document.getElementById("c2id").value;
        $('#cliente').val(nome);
        document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
      }

      function addc3() 
      {
        var nome = document.getElementById("c3nome").value;
        var id = document.getElementById("c3id").value;
        $('#cliente').val(nome);
        document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
      }

      function addd1() 
      {
        var nome = document.getElementById("d1nome").value;
        var id = document.getElementById("d1id").value;
        $('#cliente').val(nome);
        document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
      }

      function addd2() 
      {
        var nome = document.getElementById("d2nome").value;
        var id = document.getElementById("d2id").value;
        $('#cliente').val(nome);
        document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
      }

      function addd3() 
      {
        var nome = document.getElementById("d3nome").value;
        var id = document.getElementById("d3id").value;
        $('#cliente').val(nome);
        document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
      }

      function addd4() 
      {
        var nome = document.getElementById("d4nome").value;
        var id = document.getElementById("d4id").value;
        $('#cliente').val(nome);
        document.getElementById('dados_cliente1').innerHTML += "<input type='hidden' name='id_cliente' value='"+id+"' />";
        $("#registroModal").modal('hide');
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
    <!-- Demo scripts for this page-->
    <script src="../js/demo/datatables-demo.js"></script>
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>


    <!-- Custom scripts for autocomplete in form cadastro cliente 
    <script src="../js/custom.js"></script>-->

    <script type="text/javascript">
      window.onload = function () {
        setInterval("verifica_chat();", 500);
      }
    </script>

  </body>
</html>
