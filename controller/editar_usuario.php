<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$nome = $_POST['nome'];
$username = $_POST['username'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];

//valida a senha informada
if($senha !== $senha2)
{
	$_SESSION["msg_cadastro"] = "Desculpe, as senhas não coincidem.";
	$_SESSION["flag_cadastro"] = 0;
	header('Location: ../view/usuarios.php');
}

else
{
	$config->atualiza_usuario($id, $nome, $username, $senha, $email);
	header('Location: ../view/usuarios.php');
}
?>