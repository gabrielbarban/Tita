<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$status = $_POST['status_id'];
$id = $id - 15920 + 350;

$config->atualiza_status_registro($id, $status);
header('Location: ../view/monitor.php');

?>