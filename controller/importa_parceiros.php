<?php
$data = array();
session_start();
include("../model/config.php");
$config = new Config();

 
function add_person( $nome, $email, $telefone)
{
	global $data;
	$empresa_id = $_SESSION["empresa_id"];
	 
	$data []= array(
	'nome' => $nome,
	'email' => $email,
	'telefone' => $telefone,
	'empresa_id' => $empresa_id
	);
}
 
if ( $_FILES['file']['tmp_name'] )
{
	$dom = DOMDocument::load( $_FILES['file']['tmp_name'] );
	$rows = $dom->getElementsByTagName( 'Row' );
	$first_row = true;
	foreach ($rows as $row)
	{
		if ( !$first_row )
		{
			$nome = "";
			$email = "";
			$telefone = "";
			 
			$index = 1;
			$cells = $row->getElementsByTagName( 'Cell' );
			foreach( $cells as $cell )
			{
				$ind = $cell->getAttribute( 'Index' );
				if ( $ind != null ) $index = $ind;
				 
				if ( $index == 1 ) $nome = $cell->nodeValue;
				if ( $index == 2 ) $email = $cell->nodeValue;
				if ( $index == 3 ) $telefone = $cell->nodeValue;
				 
				$index += 1;
			}
			add_person( $nome, $email, $telefone);
		}
		$first_row = false;
	}
}

//importação dos arquivos via populator
$config->importa_parceiros($data);
echo ("<SCRIPT LANGUAGE='JavaScript'>
window.alert('Informações salvas')
window.location.href='../view/importa_arquivos.php';
</SCRIPT>");

?>