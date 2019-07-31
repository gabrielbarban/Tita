<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
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
	header('Location: ../view/novo_usuario.php');
}

//valida se o usuário já existe no sistema - PRECISA CORRIGIR ESSA PORRA DESSA FUNÇÃO
if($config->verifica_usuario($email))
{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Já existe um usuário com esse e-mail no sistema. Tente por favor com outro e-mail.')
	window.location.href='javascript:history.back(1)';
	</SCRIPT>");
}

//depois de validar tudo, cadastra o usuário
else
{
	$empresa_id = $_SESSION["empresa_id"];
	$config->novo_usuario($nome, $username, $senha, $email, $empresa_id);
	header('Location: ../view/usuarios.php?a=1');
}
?>