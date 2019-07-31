<?php  
//validando a session
session_start();
$nome_usuario = $_SESSION["nome_usuario"];
$username_usuario = $_SESSION["username_usuario"];
$id_usuario = $_SESSION["usuario_id"];
$email_usuario = $_SESSION["email_usuario"];

if(!$nome_usuario)
echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Desculpe, você não tem acesso a essas informações.')
	window.location.href='../index.php';
	</SCRIPT>");

//BLOQUEANDO O ACESSO A TELA DE GERENCIAMENTO DE LEADS SOMENTE PARA O EMAIL E O EMAIL DO KADU
if( ($email_usuario != "kadu.doro@gmail.com") && ($email_usuario != "barbangabriel@gmail.com"))
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Acesso bloqueado :)')
	window.location.href='../view/".$_SESSION["url_inicial"].".php';
	</SCRIPT>");

?>

<!DOCTYPE html>
<html>
<head>
	<title>LEADS | SBG</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
</head>
<body>
	<center><img src="../images/lead.png" width="600px" height="250px" style="border-radius: 5px;"><br><h3>Leads:</h3><br><br></center>




	<div class="table-responsive">
              <table class="table table-bordered" width="70%" cellspacing="0">
                <thead>
                    <tr>
                      <th>Nome</th>
                      <th>E-mail</th>
                      <th>Telefone</th>
                      <th>Data de cadastro</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
          <?php
          /*
			STATUS:
			1- Novo;
			2- Conversas iniciais;
			3- Em negociação;
			4- Negócio fechado;
			5- Emperrado;
          */


         	 include("../model/config.php");
     	     $config = new Config();

            $empresa_id = $_SESSION["empresa_id"];
            $data = array();
            $data=$config->lista_leads();

            foreach ($data as $row) {
              echo "<tbody><tr><td><i class='fas fa fa fa-check-circle'></i> ".$row['nome']."</td>";
              echo "<td> ".$row['email']."</td>";
              echo "<td> ".$row['telefone']."</td>";
              echo "<td> ".$row['data_cadastro']."</td>";
              echo "
              <td>
              <form action='../controller/mudar_status_lead.php' METHOD='post'>
              <input type='hidden' name='id' VALUE='".$row['id']."' />
              <select class='form-control' name='status' placeholder='Status' >";
              echo "<option value='".$row['status']."'> ".$row['status']." </option>";
              if($row['status'] != 'Novo') echo "<option value='Novo'>Novo</option>";
              if($row['status'] != 'Conversas iniciais') echo "<option value='Conversas iniciais'>Conversas iniciais</option>";
              if($row['status'] != 'Em negociação') echo "<option value='Em negociação'>Em negociação</option>";
              if($row['status'] != 'Negócio fechado') echo "<option value='Negócio fechado'>Negócio fechado</option>";
              if($row['status'] != 'Emperrado') echo "<option value='Emperrado'>Emperrado</option>";
              echo "
              </select>
              <input type='submit' class='form-control' value='Salvar' style='background-color: #ced4da;''>
              </form>
              </td></tr></tbody>";
            }
          ?>
                </table>
            </div>


</body>
</html>