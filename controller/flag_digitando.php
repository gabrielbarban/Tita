<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$usuario2 = $_GET['usuario2'];

$data = $config->pega_usuario($usuario2);

echo json_encode($data);

?>