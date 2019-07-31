<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_GET['id'];

$config->deleta_forma_pagamento($id);
header('Location: ../view/formas_pagamento.php');

?>