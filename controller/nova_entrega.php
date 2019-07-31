<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$nome = $_POST['nome'];

$empresa_id = $_SESSION["empresa_id"];
$config->nova_entrega($nome, $empresa_id);
header('Location: ../view/config-entrega.php');

?>