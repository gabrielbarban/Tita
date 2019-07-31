<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$nome = $_POST['nome'];
$texto = $_POST['texto'];
$tipo = $_POST['tipo'];
$empresa_id = $_SESSION["empresa_id"];

$config->nova_campanha($nome, $texto, $tipo, $empresa_id);
header('Location: ../view/crm.php');

?>