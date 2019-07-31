<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$nome = $_POST['nome'];

$config->atualiza_forma_pagamento($id, $nome);
header('Location: ../view/formas_pagamento.php');

?>