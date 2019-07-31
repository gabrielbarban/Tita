<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_GET['id'];

$config->deleta_parceiro($id);
header('Location: ../view/parcerias.php');

?>