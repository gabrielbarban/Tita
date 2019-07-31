<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$busca = $_POST['busca'];
$empresa_id = $_SESSION["empresa_id"];

$data = $config->busca_registro($empresa_id, $busca);

echo json_encode($data);

?>