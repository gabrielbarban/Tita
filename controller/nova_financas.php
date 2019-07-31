<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$forma_id = $_POST['forma_id'];
$empresas_id = $_POST['empresas_id'];
$categoria_id = $_POST['categoria_id'];
$usuario_id = $_SESSION["usuario_id"];

if($valor == 0)
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('O valor não pode ser zero, desculpe.')
window.location.href='../view/financas.php';
</SCRIPT>");

if( ($descricao == '') || ($empresas_id == '---') || ($categoria_id == '---') || ($forma_id == '---') )
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Você não preencheu todos os campos. Volte e tente novamente por favor.')
window.location.href='../view/financas.php';
</SCRIPT>");

$config->novo_registro_financas($descricao, $valor, $forma_id, $empresas_id, $usuario_id, $categoria_id);
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Cadastrado!')
window.location.href='../view/financas.php';
</SCRIPT>");

?>