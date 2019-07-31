<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$usuario1 = $_SESSION["usuario_id"];
$usuario2 = $_POST['usuario2'];
$texto = $_POST['texto'];
$empresa_id = $_SESSION["empresa_id"];

$data = $config->nova_conversa($usuario1, $usuario2, $texto, $empresa_id);

//salto =  + 15920 - 350
$usuario2 = $usuario2 + 15920 - 350;
header('Location: ../view/chat_conversa.php?id='.$usuario2);

?>