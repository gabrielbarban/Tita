<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_GET['id'];

$config->deleta_financas($id);
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Excluída!')
window.location.href='../view/financas.php';
</SCRIPT>");

?>