<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$tipo = $_POST['tipo'];
$forma = $_POST['forma'];
$status = $_POST['status'];

$config->atualiza_registro($id, $descricao, $valor, $tipo, $forma, $status);
header('Location: ../view/registros.php');

?>