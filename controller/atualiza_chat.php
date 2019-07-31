<?php

	session_start();
	include("../model/config.php");
	$config = new Config();

	$usuario_id = $_SESSION["usuario_id"];

	$data = $config->atualiza_chat($usuario_id);

?>