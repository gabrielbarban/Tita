<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$nome = $_GET['nome'];
$nascimento = $_GET['nascimento'];
$rg = $_GET['rg'];
$cpf = $_GET['cpf'];

$empresa_id = $_SESSION["empresa_id"];

$data = $config->novo_cliente($nome, $nascimento, $rg, $cpf, $empresa_id);


echo json_encode($data);

?>