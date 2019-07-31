<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$codigo = $_POST['codigo'];


$config->atualiza_etiqueta_individual($id, $codigo);
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Configurações salvas!')
window.location.href='../view/config-etiqueta-individual.php';
</SCRIPT>");

?>