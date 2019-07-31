<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$nome = $_POST['nome'];
$codigo = $_POST['codigo'];

$config->atualiza_documento($id, $nome, $codigo);
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Documento atualizado.')
window.location.href='javascript:history.back(1)';
</SCRIPT>");


?>