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
        <div class="card-header"><center><b>SBG</b></center></div>
        <div class="card-body">
          <form action="controller/login.php" method='POST'>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputEmail" name="email" class="form-control" placeholder="E-mail" required="required" autofocus="autofocus">
                <label for="inputEmail">E-mail</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" required="required">
                <label for="inputPassword">Senha</label>
              </div>
            </div>
            <input type="submit" class="form-control" value="Login" style="background-color: #ced4da;">
          </form><br>
          <b><i><ul>
            <li>Gerencie seus clientes <i class='fas fa-check'></i></li>
            <li>Gere relatórios de forma fácil <i class='fas fa-check'></i></li>
            <li>Mantenha seu caixa organizado <i class='fas fa-check'></i></li>
          </ul></i></b>
	         Quer experimentar gratuitamente? <a href="contato.php">Clique aqui <i class='fas fa-bolt'></i></a>
          <br><br>
          <?php  
          //mensagem de erro ao usuario
          $msg = $_SESSION["msg_erro"];
          if($msg)
            echo "<i>".$msg."</i>";
          ?>
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
