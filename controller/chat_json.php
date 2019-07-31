<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$usuario1 = $_GET['usuario1'];
$usuario2 = $_GET['usuario2'];

$empresa_id = $_SESSION["empresa_id"];

$data = $config->lista_chat($usuario1, $usuario2, $empresa_id);


echo json_encode($data);

?>