<?php

include("../model/usuario.php");
$user = new Usuario();

$name = $_POST['name'];;
$email = $_POST['email'];

if($user->verifica_usuario($email))
{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Já existe um usuário com esse e-mail no sistema. Tente por favor com outro e-mail.')
	window.location.href='../index.php';
	</SCRIPT>");
}

else
{
	$user->novo_usuario($name, $email);
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Usuário cadastrado!')
	window.location.href='../index.php';
	</SCRIPT>");
}

?>