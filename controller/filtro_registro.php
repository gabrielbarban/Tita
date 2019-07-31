<?php

	session_start();
	include("../model/config.php");
	$config = new Config();

	//pegando os dados do form
	$tipo = $_POST['tipo'];
	$forma = $_POST['forma'];
	$status = $_POST['status'];
	$ativo = $_POST['ativo'];

	$empresa_id = $_SESSION["empresa_id"];

	//$config->filtro_registros($tipo, $forma, $status, $ativo, $empresa_id);
	$url = "tipo=".$tipo."&forma=".$forma."&status=".$status."&ativo=".$ativo;
	header('Location: ../view/filtro_registros.php?'.$url);

?>