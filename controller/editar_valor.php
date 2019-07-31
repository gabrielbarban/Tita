<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$nome = $_POST['nome'];
$valor = $_POST['valor'];
$tempo = $_POST['tempo'];

$empresas_id = $_POST['id_empresas'];
$nome_empresa = $_POST['empresa'];

$config->atualiza_valor($id, $nome, $valor, $tempo);

$empresas_id = $empresas_id + 15920 - 350;
header("Location: ../view/listar_valores.php?id=".$empresas_id."&empresa='".$nome_empresa."'");

?>