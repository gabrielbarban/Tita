<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$data_atual = $_GET['data_atual'];
$data_atual = str_replace('/', '-', $data_atual);
$forma_pagamento = $_GET['forma_pagamento'];

$empresa_id = $_SESSION["empresa_id"];

$data = $config->relatorio_caixa_saidas($data_atual, $forma_pagamento, $empresa_id);
echo json_encode($data);

?>