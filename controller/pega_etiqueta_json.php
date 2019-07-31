<?php

session_start();
include("../model/config.php");
$config = new Config();

$registro_id = $_SESSION["id_etiqueta_individual"];

$data = $config->pega_registro($registro_id);


echo json_encode($data);exit;


?>