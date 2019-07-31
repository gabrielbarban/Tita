<?php  

class registros{

	function __construct(){
		if( !include("../database/conexao.php"))
			include("../database/conexao.php");
	}

	public function lista_registros($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT 
			r.id, r.descricao, r.valor, r.data_cadastro, r.tipo,
			s.nome as 'nome_status', fp.nome as 'nome_forma', u.nome as 'nome_usuario'
			FROM registro r 
			JOIN status s ON (r.status_id = s.id)
			JOIN formas_pagamento fp  ON (r.forma_pagamento_id = fp.id)
			JOIN usuarios u  ON (r.usuario_id = u.id)
			WHERE r.empresa_id='".$empresa_id."' AND r.ativo=1;")->fetchAll();
		return $data;
	}

	public function novo_registro($descricao, $valor, $forma, $status, $empresa_id, $usuario_id, $tipo)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO registro (descricao, valor, forma_pagamento_id, status_id, empresa_id, usuario_id, tipo, ativo) 
		VALUES('".$descricao."', '".$valor."', '".$forma."', 
		'".$status."', '".$empresa_id."', '".$usuario_id."', '".$tipo."', 1)";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
	}

	public function pega_registro($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT 
			r.id, r.descricao, r.valor, r.data_cadastro, r.tipo,
			s.nome as 'nome_status', fp.nome as 'nome_forma', u.nome as 'nome_usuario',
			s.id as 'id_status', fp.id as 'id_forma'
			FROM registro r 
			JOIN status s ON (r.status_id = s.id)
			JOIN formas_pagamento fp  ON (r.forma_pagamento_id = fp.id)
			JOIN usuarios u  ON (r.usuario_id = u.id)
			WHERE r.id='".$id."';")->fetchAll();
		return $data;
	}

	public function atualiza_registro($id, $descricao, $valor, $tipo, $forma, $status)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE registro 
		SET descricao='".$descricao."', valor='".$valor."', tipo='".$tipo."', forma_pagamento_id='".$forma."', status_id='".$status."'
		WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
	}

	public function deleta_registro($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE registro SET ativo=0 WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
	}

}

?>