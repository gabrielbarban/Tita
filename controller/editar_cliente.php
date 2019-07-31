<?php
session_start();
$id = $_GET['id'];

$_SESSION["id_cliente_historico"] = $id;

header('Location: ../view/edita_cliente.php');

?>