<?php

session_start();
include("../model/config.php");
$config = new Config();

$empresa_id = $_SESSION["empresa_id"];
$tipo = $_GET["tipo"];

$data = $config->lista_empresas($empresa_id, $tipo);

echo json_encode($data);

?>