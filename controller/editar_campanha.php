<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$nome = $_POST['nome'];
$texto = $_POST['texto'];
$tipo = $_POST['tipo'];

$config->atualiza_campanha($nome, $texto, $tipo, $id);
header('Location: ../view/crm.php');

?>