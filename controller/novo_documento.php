<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$nome = $_POST['nome'];
$codigo = $_POST['codigo'];

$empresa_id = $_SESSION["empresa_id"];
$config->novo_documento($nome, $codigo, $empresa_id);

echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Documento cadastrado.')
window.location.href='../view/config_documentos.php';
</SCRIPT>");

?>