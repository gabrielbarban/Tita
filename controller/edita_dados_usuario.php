<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$nome = $_POST['nome'];
$username = $_POST['usuario'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];

//valida a senha informada
if($senha !== $senha2)
{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('As senhas não coincidem. Tente novamente por favor.')
	window.location.href='../view/alterar_cadastro.php';
	</SCRIPT>");
}

else
{
	$config->atualiza_usuario($id, $nome, $username, $senha, $email);
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Usuário Atualizado com sucesso.')
	window.location.href='../view/alterar_cadastro.php';
	</SCRIPT>");
}

?>