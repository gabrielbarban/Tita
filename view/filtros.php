<?php  
//validando a session
session_start();
$nome_usuario = $_SESSION["nome_usuario"];
$username_usuario = $_SESSION["username_usuario"];
$empresa_id = $_SESSION["empresa_id"];
if(!$nome_usuario)
header('Location: ../index.php');
?>

<?php
          include("../model/config.php");
          $config = new Config();

          $lista_formas = array();
          $lista_status = array();
          $lista_formas = $config->lista_formas_pagamento($empresa_id);
          $lista_status = $config->lista_status($empresa_id);
?>

<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">


<!-- formas de pagamento !-->
<div id="filtro_formas">
Forma de pagamento:
<select class="form-control" name="forma" placeholder="Forma de pagamento" >
  <option value="*">--- Todos</option>
    <?php
        foreach ($lista_formas as $data) {
         echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
        }
    ?>
</select><br>
</div>



<!-- status !-->
<div id="filtro_status">
tatus:
<select class="form-control" name="status" placeholder="Status" >
  <option value="*">--- Todos</option>
    <?php
      foreach ($lista_status as $data) {
        echo "<option value='".$data['id']."'> ".$data['nome']." </option>";
      }
    ?>
</select><br>
</div>

