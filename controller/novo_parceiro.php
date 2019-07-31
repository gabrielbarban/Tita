<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$empresa_id = $_SESSION["empresa_id"];

$config->novo_parceiro($nome, $email, $telefone, $empresa_id);
header('Location: ../view/parcerias.php');

?>