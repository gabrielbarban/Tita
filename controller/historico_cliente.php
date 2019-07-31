<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$cliente_id = $_GET['id'];

$data = $config->puxa_historico($cliente_id);
$_SESSION["id_cliente_historico"] = $cliente_id; //criando a session temporária do id para ser editado + tarde

echo json_encode($data);

?>