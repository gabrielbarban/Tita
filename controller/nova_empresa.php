<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$nome = $_POST['nome'];
$tipo = $_POST['tipo'];
$razao_social = $_POST['razao_social'];
$cnpj = $_POST['cnpj'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];

$empresa_id = $_SESSION["empresa_id"];
$config->nova_empresa($nome, $empresa_id, $tipo, $razao_social, $cnpj, $telefone, $email);

if($tipo==1)
header('Location: ../view/empresas.php');

if($tipo==2)
header('Location: ../view/financas.php');


?>