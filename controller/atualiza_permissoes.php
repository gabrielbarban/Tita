<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form

$usuario_id = $_GET['id'];
$url = $_POST['url'];

if(isset($_POST['permissao1'])) //marcado
    $permissao1 = 1;
else //nao marcado
    $permissao1 = 0;

if(isset($_POST['permissao2'])) //marcado
    $permissao2 = 1;
else //nao marcado
    $permissao2 = 0;

if(isset($_POST['permissao3'])) //marcado
    $permissao3 = 1;
else //nao marcado
    $permissao3 = 0;

if(isset($_POST['permissao4'])) //marcado
    $permissao4 = 1;
else //nao marcado
    $permissao4 = 0;

if(isset($_POST['permissao5'])) //marcado
    $permissao5 = 1;
else //nao marcado
    $permissao5 = 0;

if(isset($_POST['permissao6'])) //marcado
    $permissao6 = 1;
else //nao marcado
    $permissao6 = 0;

if(isset($_POST['permissao7'])) //marcado
    $permissao7 = 1;
else //nao marcado
    $permissao7 = 0;

if(isset($_POST['permissao8'])) //marcado
    $permissao8 = 1;
else //nao marcado
    $permissao8 = 0;

if(isset($_POST['permissao9'])) //marcado
    $permissao9 = 1;
else //nao marcado
    $permissao9 = 0;

if(isset($_POST['permissao10'])) //marcado
    $permissao10 = 1;
else //nao marcado
    $permissao10 = 0;

if(isset($_POST['permissao11'])) //marcado
    $permissao11 = 1;
else //nao marcado
    $permissao11 = 0;

if(isset($_POST['permissao12'])) //marcado
    $permissao12 = 1;
else //nao marcado
    $permissao12 = 0;

if(isset($_POST['permissao13'])) //marcado
    $permissao13 = 1;
else //nao marcado
    $permissao13 = 0;



$config->atualiza_permissoes($permissao1, $permissao2, $permissao3, $permissao4, $permissao5, $permissao6, $permissao7, $permissao8, $permissao9, $permissao10, $permissao11, $permissao12, $permissao13, $usuario_id);
$config->atualiza_url_inicial($url, $usuario_id);

echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Permissões atualizadas.')
window.location.href='../view/usuarios.php';
</SCRIPT>");


?>