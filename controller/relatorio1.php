<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$ano = $_GET['ano'];
$mes = $_GET['mes'];
$empresas = $_GET['empresas'];
$status = $_GET['status'];
$forma_pagamento = $_GET['forma_pagamento'];
$forma_entrega = $_GET['entrega'];

$empresa_id = $_SESSION["empresa_id"];

$data = $config->relatorio1($ano, $mes, $empresa_id, $status, $forma_pagamento, $forma_entrega, $empresas);

echo json_encode($data);

?>