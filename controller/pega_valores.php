<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_GET['id'];

$data = $config->pega_valores_empresa($id);

echo json_encode($data);

?>