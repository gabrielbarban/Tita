<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_GET['id'];

$config->deleta_categoria($id);
header('Location: ../view/categorias.php');

?>