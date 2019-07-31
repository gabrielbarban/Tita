<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_GET['id'];

$config->deleta_documento($id);
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Documento excluído.')
window.location.href='../view/config_documentos.php';
</SCRIPT>");

?>