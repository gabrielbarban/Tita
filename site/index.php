<?php 
  session_start(); 
  $usuario_id = $_SESSION["usuario_id"];
  $url_inicial = $_SESSION["url_inicial"];

 // if($usuario_id)
 //   header('Location: '.'/view/'.$url_inicial.'.php');
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

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">

  </head>

  <body background="../images/bg-imagem.png">
<!-- <body class="bg-dark"> !-->
  
    <div class="container">
      <div class="card card-login mx-auto mt-5" style="max-width: 900px !important;">
        <div class="card-body">

        <div>          
        <div style="float: left"><img src="../images/logo-sbg.png" style="width: 170px;"></div>
        <div style="float: right;"><h4><b>Chegou a hora de você assumir o controle da sua clínica!</b></h4>
          <i><ul> 
            <li>Controle de convênios e tabelas</li>
            <li>Relatórios e gráficos otimizados</li>
            <li>Chat interno</li>
            <li>Usuários ilimitados</li>
            <li>Controle de atendimento</li>
            <li>Prontuário do paciente</li>
          </ul></i>
          <br>

          <i class="fa fa-phone"> (11) 93926-1285 / (11) 97084-1241</i><Br>
          <i class="fa fa-envelope-open"> barbangabriel@gmail.com</i><Br>
          
          <br><br>
          <i class="fa fa-unlock-alt" style="font-size: 25px;"><br>Segurança</i>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <i class="fa fa-cloud" style="font-size: 25px;"><br>Acesse de qualquer lugar</i>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <i class="fa fa-check" style="font-size: 25px;"><br>Ganhe rapidez</i>
          <br><Br><br>
          <a class="btn btn-primary" href="../contato.php" ><i class="fa fa-smile"></i>
            <span>Faça um teste gratuito</span></a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a class="btn btn-primary" href="../index.php" ><i class="fa fa-bolt"></i>
            <span>Login</span></a>
        </div>
        </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
