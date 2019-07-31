<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_GET['id'];
$tipo = $_GET['tipo'];

$config->deleta_empresas($id);

if($tipo==1)
header('Location: ../view/empresas.php');

if($tipo==2)
header('Location: ../view/financas.php');

?>