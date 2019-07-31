<?php

session_start();
include("../model/config.php");
$config = new Config();

$empresa_id = $_SESSION["empresa_id"];
$ano = $_GET["ano"];
$mes = $_GET["mes"];
$categoria = $_GET["categoria"];
$empresa = $_GET["empresa"];

$data = $config->relatorio3($empresa_id, $ano, $mes, $categoria, $empresa);

echo json_encode($data);

?>