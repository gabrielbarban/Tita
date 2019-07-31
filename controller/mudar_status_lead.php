<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$status = $_POST['status'];

$config->atualiza_status_lead($id, $status);
header('Location: ../leads');

?>