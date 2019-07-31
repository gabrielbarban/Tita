<?php

session_start();
include("../model/config.php");
$config = new Config();

$empresas_id = $_GET["empresas"];

$data = $config->lista_valores($empresas_id);

echo json_encode($data);

?>