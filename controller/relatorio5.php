<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$ano = $_GET['ano'];
$mes = $_GET['mes'];
$empresa_id = $_SESSION["empresa_id"];

$data = $config->relatorio_5($ano, $mes, $empresa_id);

echo json_encode($data);

?>