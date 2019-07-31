<?php  
//validando a session
session_start();
$nome_usuario = $_SESSION["nome_usuario"];
$username_usuario = $_SESSION["username_usuario"];
$empresa_id = $_SESSION["empresa_id"];
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


    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

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

        if(!$permissao3)
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
        <div id="relatorios" style="float: left; border: solid 1px; width: 350; height: 170px; border-radius: 8px">
          <h3><i class="fas fa-fw fa-chart-line"></i> Relatórios</h3><Br>
            <select class='form-control' id="relatorio" onchange="pega_filtros();">
                <option value='---'>Selecione...</option>
                <option value='6'>Caixa</option>
                <option value='1'>Registros</option>
                <option value='3'>Saídas</option>
                <option value='2'>Empresas x valores</option>
                <option value='4'>Parceiros</option>
                <option value='5'>Registros por parceiro</option>
                <input type="button" class="form-control" value="Imprimir" onclick="impressao()" style="width: 100px; float: right;">
            <input type="button" class="form-control" value="Gerar" onclick="gera_relatorio()" style="width: 100px; float: right;">
            </select><br><br><br>
          <div id="filtros" style="float: left; border: solid 1px; border-radius: 8px; width: 350px; height: 420px;">
            <h3>Filtros</h3>
          </div>
        </div>
        <div id="resultado_relatorio" style="float: right;width: 680px; border: solid 1px; height: auto; border-radius: 8px">
          
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


    <script type="text/javascript">

      function impressao()
      {
        var conteudo = document.getElementById('resultado_relatorio').innerHTML,
        tela_impressao = window.open('about:blank');
        tela_impressao.document.write(conteudo);
        tela_impressao.window.print();
        tela_impressao.window.close();  
      }





      function gera_relatorio()
      {
        var relatorio = $("#relatorio").val();


        if(relatorio==6) 
        {
          var data_atual = $("#data").val();
          var forma_pagamento = $("#forma_pagamento").val();
          var empresa_id = <?= $empresa_id ?>;
          var total_receitas = 0;
          var total_despesas = 0;

          document.getElementById('resultado_relatorio').innerHTML = "<h3>Caixa: "+data_atual+"<img style='float: right; width: 60px;' src='../uploads/logo-"+empresa_id+".png'></h3><br>";

          //RECEITAS
          $.ajax({
                url: "../controller/relatorio_caixa1.php",
                dataType: "json",
                data: {
                data_atual: data_atual,
                forma_pagamento: forma_pagamento
            },
                success: function(data) {

                  $("#resultado_relatorio").append("<br>Receitas: <div class='table-responsive'><table class='table table-bordered' id='dataTable1' width='100%' cellspacing='0'> <thead><tr><th>Descrição</th><th>Cliente</th><th>Valor</th><th>Data</th><th>Forma de<br>Pagamento</th></tr></thead>");
                  
                  if(data.length == 0)
                  $("#resultado_relatorio").append("Nenhum registro.");
          
                  var i=0;
                  for(i=0 ; i<data.length ; i++){

                    $("#dataTable1").append("<tbody><tr><td>"+data[i]["descricao"]+"</td><td>"+data[i]["nome_cliente"]+"</td><td>R$ "+data[i]["valor"]+"</td><td>"+data[i]["data_cadastro"]+"</td><td>"+data[i]["nome_forma"]+"</td></tr></tbody>");

                    total_receitas = Number(total_receitas) + Number(data[i]["valor"]);
                  }

                  $("#resultado_relatorio").append("</table><b style='float: right'>Total de receitas: R$ "+total_receitas+"</b></div>");
                }
          });




          //DESPESAS
          $.ajax({
                url: "../controller/relatorio_caixa2.php",
                dataType: "json",
                data: {
                data_atual: data_atual,
                forma_pagamento: forma_pagamento
            },
                success: function(data) {

                  document.getElementById('resultado_relatorio').innerHTML += "<br><br><br><br>Despesas: <div class='table-responsive'><table class='table table-bordered' id='dataTable2' width='100%' cellspacing='0'> <thead><tr><th>Descrição</th><th>Empresa</th><th>Valor</th><th>Data</th><th>Forma de<br>Pagamento</th></tr></thead>";
                  
                  if(data.length == 0)
                  document.getElementById('resultado_relatorio').innerHTML += "Nenhuma saída";
          
                  var i=0;
                  for(i=0 ; i<data.length ; i++){

                    $("#dataTable2").append("<tbody><tr><td>"+data[i]["descricao"]+"</td><td>"+data[i]["nome_empresa"]+"</td><td>R$ "+data[i]["valor"]+"</td><td>"+data[i]["data_cadastro"]+"</td><td>"+data[i]["nome_forma"]+"</td></tr></tbody>");

                    total_despesas = Number(total_despesas) + Number(data[i]["valor"]);
                  }
                  $("#resultado_relatorio").append("</table><b style='float: right'>Total de despesas: R$ "+total_despesas+"</b></div>");

                  var saldo = Number(total_receitas) - Number(total_despesas);
                  saldo = saldo.toFixed(2);
                  document.getElementById('resultado_relatorio').innerHTML += "<br><br><br><br><b style='float: right'>Saldo: R$ "+saldo+"</b><br><br><div style='width: 480px; float: right;' id='chart_div_anual'></div></div>";
                }
          });


          
        }





















        if(relatorio==1) 
        {
          var ano = $("#ano").val();
          var mes = $("#mes").val();
          var nome_mes = $("#mes option:selected").text();
          var empresas = $("#empresas").val();
          var status = $("#status").val();
          var forma_pagamento = $("#forma_pagamento").val();
          var entrega = $("#entrega ").val();
          var empresa_id = <?= $empresa_id ?>;

          document.getElementById('resultado_relatorio').innerHTML = "<h3>Registros cadastrados em "+nome_mes+"/"+ano+"<img style='float: right; width: 60px;' src='../uploads/logo-"+empresa_id+".png'></h3><br>";

          $.ajax({
                url: "../controller/relatorio1.php",
                dataType: "json",
                data: {
                ano: ano,
                mes: mes,
                empresas: empresas,
                status: status,
                forma_pagamento: forma_pagamento,
                entrega: entrega
            },
                success: function(data) {
                  

                  $("#resultado_relatorio").append("<div class='table-responsive'><table class='table table-bordered' id='dataTable1' width='100%' cellspacing='0'> <thead><tr><th>Descrição</th><th>Cliente</th><th>Valor</th><th>Data</th><th>Status</th><th>Forma de<br>Pagamento</th><th>Empresa</th></tr></thead>");
                  
                  if(data.length == 0)
                  $("#resultado_relatorio").append("Nenhum registro.");
          
                  var i=0;
                  for(i=0 ; i<data.length ; i++){
                    if(data[i]["tipo"] == '1') data[i]["tipo"] = "Entrada";
                    if(data[i]["tipo"] == '0') data[i]["tipo"] = "Saída";

                    $("#dataTable1").append("<tbody><tr><td>"+data[i]["descricao"]+"</td><td>"+data[i]["nome_cliente"]+"</td><td>R$ "+data[i]["valor"]+"</td><td>"+data[i]["data_cadastro"]+"</td><td>"+data[i]["nome_status"]+"</td><td>"+data[i]["nome_forma"]+"</td><td>"+data[i]["nome_empresa"]+"</td></tr></tbody>");
                  }
                  $("#resultado_relatorio").append("</table></div>");
                }
          });
        }







        if(relatorio==2) 
        {
          var empresas = $("#empresas").val();
          var nome_empresas = $("#empresas option:selected").text();
          var empresa_id = <?= $empresa_id ?>;
          document.getElementById('resultado_relatorio').innerHTML = "<h3>Valores: "+nome_empresas+" <img style='float: right; width: 60px;' src='../uploads/logo-"+empresa_id+".png'></h3><br>";

          $.ajax({
                url: "../controller/pega_valores_json.php",
                dataType: "json",
                data: {
                empresas: empresas
            },
                success: function(data) {
                  

                  $("#resultado_relatorio").append("<div class='table-responsive'><table class='table table-bordered' id='dataTable1' width='100%' cellspacing='0'> <thead ><tr><th>Nome</th><th>Valor</th><th>Prazo (em dias)</th></tr></thead>");
                  
                  if(data.length == 0) //se nao retornar nada
                  $("#resultado_relatorio").append("<br>Nenhum valor.<br><br>");
          
                  var i=0;
                  for(i=0 ; i<data.length ; i++){
                    $("#dataTable1").append("<tbody><tr><td>"+data[i]["nome"]+"</td><td>R$ "+data[i]["valor"]+"</td><td>"+data[i]["tempo"]+"</td></tr></tbody>");
                  }
                  $("#resultado_relatorio").append("</table></div>");
                }
          });
        }





        if(relatorio==3) 
        {
          var ano = $("#ano").val();
          var mes = $("#mes").val();
          var nome_mes = $("#mes option:selected").text();
          var empresa = $("#empresas").val();
          var categoria = $("#categoria").val();

          var empresa_id = <?= $empresa_id ?>;

          document.getElementById('resultado_relatorio').innerHTML = "<h3>Saídas cadastradas em "+nome_mes+"/"+ano+"<img style='float: right; width: 60px;' src='../uploads/logo-"+empresa_id+".png'></h3><br>";

          $.ajax({
                url: "../controller/pega_saidas_json.php",
                dataType: "json",
                data: {
                ano: ano,
                mes: mes,
                categoria: categoria,
                empresa: empresa
            },
                success: function(data) {
                  $("#resultado_relatorio").append("<div class='table-responsive'><table class='table table-bordered' id='dataTable1' width='100%' cellspacing='0'> <thead ><tr><th>Descrição</th><th>Valor</th><th>Forma de<br>Pagamento</th><th>Categoria<br>Financeira</th><th>Empresa</th></tr></thead>");
                  
                  if(data.length == 0) //se nao retornar nada
                  $("#resultado_relatorio").append("<br>Nenhuma saída.<br><br>");
          
                  var i=0;
                  for(i=0 ; i<data.length ; i++){
                    $("#dataTable1").append("<tbody><tr><td>"+data[i]["descricao"]+"</td><td>R$ "+data[i]["valor"]+"</td><td>"+data[i]["nome_forma"]+"</td><td>"+data[i]["nome_categoria"]+"</td><td>"+data[i]["nome_empresa"]+"</td></tr></tbody>");
                  }
                  $("#resultado_relatorio").append("</table></div>");

                }
          });
        }









        if(relatorio==4) 
        {
          var ano = $("#ano").val();
          var mes = $("#mes").val();
          var nome_mes = $("#mes option:selected").text();
          var empresa_id = <?= $empresa_id ?>;
          document.getElementById('resultado_relatorio').innerHTML = "<h3>Parceiros cadastrados em "+nome_mes+"/"+ano+"<img style='float: right; width: 60px;' src='../uploads/logo-"+empresa_id+".png'></h3><br>";

          $.ajax({
                url: "../controller/relatorio4.php",
                dataType: "json",
                data: {
                ano: ano,
                mes: mes
            },
                success: function(data) {
                  

                  $("#resultado_relatorio").append("<div class='table-responsive'><table class='table table-bordered' id='dataTable1' width='100%' cellspacing='0'> <thead><tr><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Data de cadastro</th></tr></thead>");
                  
                  if(data.length == 0)
                  $("#resultado_relatorio").append("<br>Nenhum parceiro.<br>");
          
                  var i=0;
                  for(i=0 ; i<data.length ; i++){
                    $("#dataTable1").append("<tbody><tr><td>"+data[i]["nome"]+"</td><td>"+data[i]["email"]+"</td><td>"+data[i]["telefone"]+"</td><td>"+data[i]["data_cadastro"]+"</td></tr></tbody>");
                  }
                  $("#resultado_relatorio").append("</table></div>");
                }
          });
        }




        if(relatorio==5) 
        {
          var ano = $("#ano").val();
          var mes = $("#mes").val();
          var nome_mes = $("#mes option:selected").text();
          var empresa_id = <?= $empresa_id ?>;
          document.getElementById('resultado_relatorio').innerHTML = "<h3>Registros por parceiro de "+nome_mes+"/"+ano+"<img style='float: right; width: 60px;' src='../uploads/logo-"+empresa_id+".png'></h3><br>";

          $.ajax({
                url: "../controller/relatorio5.php",
                dataType: "json",
                data: {
                ano: ano,
                mes: mes
            },
                success: function(data) {
                  

                  $("#resultado_relatorio").append("<div class='table-responsive'><table class='table table-bordered' id='dataTable1' width='100%' cellspacing='0'> <thead><tr><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Quantidade<br>de registros</th><th>Valor total</th></tr></thead>");
                  
                  if(data.length == 0)
                  $("#resultado_relatorio").append("<br>Nenhum parceiro.<br>");
          
                  var i=0;
                  for(i=0 ; i<data.length ; i++){
                    $("#dataTable1").append("<tbody><tr><td>"+data[i]["nome"]+"</td><td>"+data[i]["email"]+"</td><td>"+data[i]["telefone"]+"</td><td>"+data[i]["quantidade"]+"</td><td>R$ "+data[i]["valor_total"]+"</td></tr></tbody>");
                  }
                  $("#resultado_relatorio").append("</table></div>");
                }
          });
        }
      }

      function pega_filtros()
      {
            var relatorio = $("#relatorio").val();
            /*
              1 - Registros (Entradas x Saídas);
              2 - Empresas x valores;
              3 - Formas de pagamento;
              4 - Usuários;
            */









            if(relatorio==6)
            {
              var data = new Date();
              var dia = data.getDate();
              var mes = (data.getMonth() + 1); 
              var ano = data.getFullYear();
              var data_atual = dia+"/0"+mes+"/"+ano;


              document.getElementById('filtros').innerHTML = "<h3>Filtros</h3>Data:<input class='form-control' value='"+data_atual+"' placeholder='xx/xx/xxxx' name='data' id='data' type='text'/>";




              //LISTANDO FORMAS DE PGTO.
              $.ajax({
                url: "../controller/pega_pagamento_json.php",
                dataType: "json",
                data: {
                tipo: 1
                },
                    success: function(data) {
                      document.getElementById('filtros').innerHTML += "Formas de pagamento: <select class='form-control' id='forma_pagamento'><option value='*'>Todas</option>";      
                      var i=0;
                      for(i=0 ; i<data.length ; i++){
                        $("#forma_pagamento").append("<option value='"+data[i]['id']+"'>"+data[i]['nome']+"</option>");
                      }
                    }
              });


            }




















            if(relatorio==1)
            {
              document.getElementById('filtros').innerHTML = "<h3>Filtros</h3>Ano:<select class='form-control' id='ano'><option value='2019'>2019</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option></select>Mês:<select class='form-control' id='mes'><option value='01'>Janeiro</option><option value='02'>Fevereiro</option><option value='03'>Março</option><option value='04'>Abril</option><option value='05'>Maio</option><option value='06'>Junho</option><option value='07'>Julho</option><option value='08'>Agosto</option><option value='09'>Setembro</option><option value='10'>Outubro</option><option value='11'>Novembro</option><option value='12'>Dezembro</option></select>";


              //LISTANDO EMPRESAS
              $.ajax({
                url: "../controller/pega_empresas_json.php",
                dataType: "json",
                data: {
                tipo: 1
                },
                    success: function(data) {
                      document.getElementById('filtros').innerHTML += "Empresa: <select class='form-control' id='empresas'><option value='*'>Todas</option>";      
                      var i=0;
                      for(i=0 ; i<data.length ; i++){
                        $("#empresas").append("<option value='"+data[i]['id']+"'>"+data[i]['nome']+"</option>");
                      }
                    }
              });




              //LISTANDO STATUS
              $.ajax({
                url: "../controller/pega_status_json.php",
                dataType: "json",
                data: {
                tipo: 1
                },
                    success: function(data) {
                      document.getElementById('filtros').innerHTML += "Status: <select class='form-control' id='status'><option value='*'>Todos</option>";      
                      var i=0;
                      for(i=0 ; i<data.length ; i++){
                        $("#status").append("<option value='"+data[i]['id']+"'>"+data[i]['nome']+"</option>");
                      }
                    }
              });




              //LISTANDO FORMAS DE PGTO.
              $.ajax({
                url: "../controller/pega_pagamento_json.php",
                dataType: "json",
                data: {
                tipo: 1
                },
                    success: function(data) {
                      document.getElementById('filtros').innerHTML += "Formas de pagamento: <select class='form-control' id='forma_pagamento'><option value='*'>Todas</option>";      
                      var i=0;
                      for(i=0 ; i<data.length ; i++){
                        $("#forma_pagamento").append("<option value='"+data[i]['id']+"'>"+data[i]['nome']+"</option>");
                      }
                    }
              });





              //LISTANDO TIPOS DE ENTREGA
              $.ajax({
                url: "../controller/pega_entregas_json.php",
                dataType: "json",
                data: {
                tipo: 1
                },
                    success: function(data) {
                      document.getElementById('filtros').innerHTML += "Entrega: <select class='form-control' id='entrega'><option value='*'>Todas</option>";      
                      var i=0;
                      for(i=0 ; i<data.length ; i++){
                        $("#entrega").append("<option value='"+data[i]['id']+"'>"+data[i]['nome']+"</option>");
                      }
                    }
              });
            }





            if(relatorio==2)
            {
              $.ajax({
                url: "../controller/pega_empresas_json.php",
                dataType: "json",
                data: {
                tipo: 1
                },
                    success: function(data) {
                      document.getElementById('filtros').innerHTML = "<h3>Filtros</h3>Convênio: <select class='form-control' id='empresas'>";      
                      var i=0;
                      for(i=0 ; i<data.length ; i++){
                        $("#empresas").append("<option value='"+data[i]['id']+"'>"+data[i]['nome']+"</option>");
                      }
                    }
              });
            }






            if(relatorio==3)
            {
              document.getElementById('filtros').innerHTML = "<h3>Filtros</h3>Ano:<select class='form-control' id='ano'><option value='2019'>2019</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option></select>Mês:<select class='form-control' id='mes'><option value='01'>Janeiro</option><option value='02'>Fevereiro</option><option value='03'>Março</option><option value='04'>Abril</option><option value='05'>Maio</option><option value='06'>Junho</option><option value='07'>Julho</option><option value='08'>Agosto</option><option value='09'>Setembro</option><option value='10'>Outubro</option><option value='11'>Novembro</option><option value='12'>Dezembro</option></select>";


              //LSITANDO EMPRESAS
              $.ajax({
                url: "../controller/pega_empresas_json.php",
                dataType: "json",
                data: {
                tipo: 2
                },
                    success: function(data) {
                      document.getElementById('filtros').innerHTML += "Empresa: <select class='form-control' id='empresas'><option value='*'>Todas</option>";      
                      var i=0;
                      for(i=0 ; i<data.length ; i++){
                        $("#empresas").append("<option value='"+data[i]['id']+"'>"+data[i]['nome']+"</option>");
                      }
                    }
              });


              //LISTANDO CATEGORIAS FINANCEIRAS
              $.ajax({
                url: "../controller/pega_categorias_json.php",
                dataType: "json",
                data: {
                tipo: 2
                },
                    success: function(data) {
                      document.getElementById('filtros').innerHTML += "Categoria Financeira: <select class='form-control' id='categoria'><option value='*'>Todas</option>";      
                      var i=0;
                      for(i=0 ; i<data.length ; i++){
                        $("#categoria").append("<option value='"+data[i]['id']+"'>"+data[i]['nome']+"</option>");
                      }
                    }
              });
            }




            if(relatorio==4)
            {
              document.getElementById('filtros').innerHTML = "<h3>Filtros</h3>Ano:<select class='form-control' id='ano'><option value='2019'>2019</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option></select><br>Mês:<select class='form-control' id='mes'><option value='01'>Janeiro</option><option value='02'>Fevereiro</option><option value='03'>Março</option><option value='04'>Abril</option><option value='05'>Maio</option><option value='06'>Junho</option><option value='07'>Julho</option><option value='08'>Agosto</option><option value='09'>Setembro</option><option value='10'>Outubro</option><option value='11'>Novembro</option><option value='12'>Dezembro</option></select>";
            }

            if(relatorio==5)
            {
              document.getElementById('filtros').innerHTML = "<h3>Filtros</h3>Ano:<select class='form-control' id='ano'><option value='2019'>2019</option><option value='2018'>2018</option><option value='2017'>2017</option><option value='2016'>2016</option><option value='2015'>2015</option><option value='2014'>2014</option></select><br>Mês:<select class='form-control' id='mes'><option value='01'>Janeiro</option><option value='02'>Fevereiro</option><option value='03'>Março</option><option value='04'>Abril</option><option value='05'>Maio</option><option value='06'>Junho</option><option value='07'>Julho</option><option value='08'>Agosto</option><option value='09'>Setembro</option><option value='10'>Outubro</option><option value='11'>Novembro</option><option value='12'>Dezembro</option></select>";
            }
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
    
     <script type="text/javascript">
      window.onload = function () {
        setInterval("verifica_chat();", 500);
      }
     </script>

  </body>

</html>
