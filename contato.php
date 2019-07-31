<?php 
  session_start(); 
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
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body background="images/bg-imagem.png">
 <!-- <body class="bg-dark"> !-->

    <div class="container">
	<div class="card card-login mx-auto mt-5">
        <div class="card-header"><center><b>Faça um teste grátis da plataforma:</b></center></div>
        <div class="card-body">
          <form action="controller/cadastro_contato.php" method='POST'>
            <div class="form-group">
                <input type="text" name="nome" class="form-control" placeholder="Nome" required="required" autofocus="autofocus">
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="E-mail" required="required" autofocus="autofocus">
            </div>
     	    <div class="form-group">
                <input type="text" name="telefone" class="form-control" placeholder="Telefone" required="required" autofocus="autofocus">
            </div>
          <div class="form-group">
                <input type="password" name="senha" class="form-control" placeholder="Senha" required="required" autofocus="autofocus">
            </div>
          <div class="form-group">
                <input type="password" name="senha2" class="form-control" placeholder="Senha novamente" required="required" autofocus="autofocus">
            </div>
            <input type="submit" class="form-control" value="Cadastrar" style="background-color: #ced4da;">
          </form><br>
          <center><img src="images/logo-sbg.png" style="width: 90px"></center><br>
          <b>
            <i><ul>
            <li>Controle de caixa e Financeiro <i class='fas fa-check'></i></li>
            <li>Chat interno <i class='fas fa-check'></i></li>
            <li>Prontuário Online <i class='fas fa-check'></i></li>
            <li>E muito mais! <i class='fas fa-check'></i></li>
          </ul></i>
          </b>
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
