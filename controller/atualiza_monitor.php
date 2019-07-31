<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$tipo_principal = $_POST['tipo_id'];
$status_principal_id = $_POST['status_id'];

$empresa_id = $_SESSION["empresa_id"];


$config->atualiza_monitor($tipo_principal, $status_principal_id, $empresa_id);
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Configurações do monitor salvas com sucesso.')
window.location.href='../view/config_monitor.php';
</SCRIPT>");

?>