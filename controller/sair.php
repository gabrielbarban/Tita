<?php

/*
include("../model/config.php");
$config = new Config();
$config->gera_log("Saiu no sistema", "---");
*/

session_start();
unset($_SESSION["nome_usuario"]);
unset($_SESSION["usuario_id"]);
unset($_SESSION["username_usuario"]);
unset($_SESSION["empresa_id"]);
unset($_SESSION["msg_erro"]);
unset($_SESSION["msg_cadastro"]);
unset($_SESSION["flag_cadastro"]);
unset($_SESSION["email_usuario"]);

header('Location: ../index.php');
?>