<?php

session_start();
include("../model/config.php");
$config = new Config();

//pegando os dados do form
$id = $_POST['id'];
$nome = $_POST['nome'];
$data_nasc = $_POST['data_nasc'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$telefone = $_POST['telefone'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$endereco = $_POST['endereco'];

$config->atualiza_cliente($id, $nome, $data_nasc, $rg, $cpf, $telefone, $celular, $email, $endereco);
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Alterações realizadas com sucesso.')
window.location.href='../view/clientes.php';
</SCRIPT>");

?>