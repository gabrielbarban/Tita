<?php

session_start();
include("../model/config.php");
$config = new Config();

$empresa_id = $_SESSION["empresa_id"];

$data = $config->lista_formas_pagamento($empresa_id);

echo json_encode($data);

?>