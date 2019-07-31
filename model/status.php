<?php  

class status{

	
	public function lista_status($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM status WHERE empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

}
