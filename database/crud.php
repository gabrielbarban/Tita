<?php

class Crud
{
    function __construct()
	{
		require_once("connection.php");
	}

	public function find($query)
	{
		//SELECT in database
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query($query)->fetchAll();
		return $data;
	}

	public function change($query)
	{
		//UPDATE, DELETE or INSERT in database
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($query);
	}
}

?>
