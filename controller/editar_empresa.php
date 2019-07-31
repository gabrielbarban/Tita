<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$nome = $_POST['nome'];
$tipo = $_POST['tipo'];
$razao_social = $_POST['razao_social'];
$cnpj = $_POST['cnpj'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

$config->atualiza_empresas($id, $nome, $razao_social, $cnpj, $telefone, $email);


if($tipo==1)
header('Location: ../view/empresas.php');

if($tipo==2)
header('Location: ../view/financas.php');


?>