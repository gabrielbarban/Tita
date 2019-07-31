<?php

	session_start();
	include("../model/config.php");
	$config = new Config();

	$usuario_id = $_SESSION["usuario_id"];

	$data = $config->verifica_chat($usuario_id);

	echo json_encode($data);

?>