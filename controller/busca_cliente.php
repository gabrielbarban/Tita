<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$nome = $_GET['nome'];
$empresa_id = $_SESSION["empresa_id"];

$data = $config->busca_cliente($nome, $empresa_id);

echo json_encode($data);

?>