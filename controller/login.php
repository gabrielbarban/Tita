<?php

include("../model/config.php");
$config = new Config();

//pegando os dados do form
$email = $_POST['email'];
$senha = $_POST['senha'];

//validando e fazendo o redirecionamento
if($config->logar($email, $senha))
{
	session_start();
	$url_inicial = $_SESSION["url_inicial"];
	header('Location: ../view/'.$url_inicial.'.php');
}
else
{
	session_start();
	$_SESSION["msg_erro"] = "Usuário e/ou senha errado. Tente novamente por favor.";
	header('Location: ../index.php');
}

?>