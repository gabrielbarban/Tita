<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_GET['id'];

$empresas_id = $_GET['id_empresas'];
$nome_empresa = $_GET['empresa'];


$config->deleta_valor($id);

$empresas_id = $empresas_id + 15920 - 350;
header('Location: ../view/listar_valores.php?id='.$empresas_id."&empresa=".$nome_empresa);

?>