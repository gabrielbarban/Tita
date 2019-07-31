<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$usuario1 = $_GET['usuario1'];
$flag = $_GET['flag'];

$config->atualiza_flag_digitando($usuario1, $flag);

?>