<?php

include("../model/user.php");

$user = new User();
$name = $_POST['name'];;
$email = $_POST['email'];

if($user->verify_user($email)){
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Já existe um usuário com esse e-mail no sistema. Tente por favor com outro e-mail.')
	window.location.href='../index.php';
	</SCRIPT>");
}

else{
	$user->new_user($name, $email);
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('Usuário cadastrado!')
	window.location.href='../index.php';
	</SCRIPT>");
}

?>