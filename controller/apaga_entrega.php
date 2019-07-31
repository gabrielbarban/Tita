<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_GET['id'];

$config->deleta_entrega($id);
header('Location: ../view/config-entrega.php');

?>