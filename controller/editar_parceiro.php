<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];


$config->atualiza_parceiro($id, $nome, $email, $telefone);
header('Location: ../view/parcerias.php');

?>