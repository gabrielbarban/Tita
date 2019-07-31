<?php

session_start();
include("../model/config.php");
$config = new Config();

$descricao = $_POST['descricao'];
$status = $_POST['status'];
$entrega = $_POST['entrega'];
$id_cliente = $_POST['id_cliente'];
$valor = $_POST['valor_final'];
$parceiro = $_POST['parceiro'];
$empresa_id = $_SESSION["empresa_id"];
$usuario_id = $_SESSION["usuario_id"];

//forma de pagamento
$forma_1 = $_POST['forma-1'];
$valor_1 = $_POST['valor-1'];
$forma_2 = $_POST['forma-2'];
$valor_2 = $_POST['valor-2'];

//echo $valor1."<br>".$valor2;exit;


//empresa/valor
$id_valor1 = $_POST['id_valor1'];
$qtd1 = $_POST['qtd1'];
$valor1 = $_POST['valor1'];

$id_valor2 = $_POST['id_valor2'];
$qtd2 = $_POST['qtd2'];
$valor2 = $_POST['valor2'];

$id_valor3 = $_POST['id_valor3'];
$qtd3 = $_POST['qtd3'];
$valor3 = $_POST['valor3'];

$id_valor4 = $_POST['id_valor4'];
$qtd4 = $_POST['qtd4'];
$valor4 = $_POST['valor4'];

$id_valor5 = $_POST['id_valor5'];
$qtd5 = $_POST['qtd5'];
$valor5 = $_POST['valor5'];

//pegando o salto e atualizando-o depois
$salto = $config->pega_salto($empresa_id);
$salto = $salto + 1;
$config->atualiza_salto($salto, $empresa_id);

//cadastrando o registro novo
$id = $config->novo_registro($descricao, $status, $empresa_id, $usuario_id, 1, $id_cliente, $valor, $parceiro, $entrega, $salto);

//CADASTRANDO EM REGISTRO_PAGAMENTO
if($forma_2 == '---') //senao tiver uma segunda forma de pagamento
{
	$config->novo_forma_registro($id, $forma_1 , $valor_1);
}
else
{
	$config->novo_forma_registro($id, $forma_1, $valor_1);
	$config->novo_forma_registro($id, $forma_2, $valor_2);
}

//CADASTRANDO EM REGISTRO_ITENS
if( ($qtd1 >= 1) && (!$qtd2) && (!$qtd3) && (!$qtd4) && (!$qtd5) )
{
	$config->novo_valor_registro($id, $id_valor1, $qtd1);
}

if( ($qtd1 >= 1) && ($qtd2 >= 1) && (!$qtd3) && (!$qtd4) && (!$qtd5) )
{
	$config->novo_valor_registro($id, $id_valor1, $qtd1);
	$config->novo_valor_registro($id, $id_valor2, $qtd2);
}

if( ($qtd1 >= 1) && ($qtd2 >= 1) && ($qtd3 >= 1)  && (!$qtd4) && (!$qtd5) )
{
	$config->novo_valor_registro($id, $id_valor1, $qtd1);
	$config->novo_valor_registro($id, $id_valor2, $qtd2);
	$config->novo_valor_registro($id, $id_valor3, $qtd3);
}

if( ($qtd1 >= 1) && ($qtd2 >= 1) && ($qtd3 >= 1) && ($qtd4 >= 1) && (!$qtd5) )
{
	$config->novo_valor_registro($id, $id_valor1, $qtd1);
	$config->novo_valor_registro($id, $id_valor2, $qtd2);
	$config->novo_valor_registro($id, $id_valor3, $qtd3);
	$config->novo_valor_registro($id, $id_valor4, $qtd4);
}

if( ($qtd1 >= 1) && ($qtd2 >= 1) && ($qtd3 >= 1) && ($qtd4 >= 1) && ($qtd5 >= 1) )
{
	$config->novo_valor_registro($id, $id_valor1, $qtd1);
	$config->novo_valor_registro($id, $id_valor2, $qtd2);
	$config->novo_valor_registro($id, $id_valor3, $qtd3);
	$config->novo_valor_registro($id, $id_valor4, $qtd4);
	$config->novo_valor_registro($id, $id_valor5, $qtd5);
}

$id = $id + 15920 - 350;
header('Location: ../view/ficha_registro.php?id='.$id);

?>