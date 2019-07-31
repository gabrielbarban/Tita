<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$nome = $_POST['nome'];
$valor = $_POST['valor'];
$prazo = $_POST['prazo'];
$empresas_id = $_POST["empresas_id"]; //convenio

$config->novo_valor($nome, $valor, $prazo, $empresas_id);


//salto =  + 15920 - 350
$empresas_id = $empresas_id + 15920 - 350;
header('Location: ../view/listar_valores.php?id='.$empresas_id);

?>