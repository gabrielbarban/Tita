<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$nome = $_POST['nome'];
$razao_social = $_POST['razao_social'];
$cnpj = $_POST['cnpj'];
$email = $_POST['email'];
$celular = $_POST['celular'];
$telefone = $_POST['telefone'];
$responsavel = $_POST['responsavel'];


$config->atualiza_companhia($id, $nome, $razao_social, $cnpj, $email, $celular, $telefone, $responsavel);
header('Location: ../view/configuracoes.php');

?>