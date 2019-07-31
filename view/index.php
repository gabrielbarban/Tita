<?php
//validando a session
session_start();
$nome_usuario = $_SESSION["nome_usuario"];
$id_usuario = $_SESSION["id_usuario"];
$empresa_id = $_SESSION["empresa_id"];
$username_usuario = $_SESSION["username_usuario"];
$url_inicial = $_SESSION["url_inicial"];

if(!$nome_usuario)
   header('Location: ../index.php');
else
   header('Location: '.$url_inicial.'.php');
?>
