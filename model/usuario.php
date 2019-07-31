<?php  

class usuario{

	function __construct(){
		include("../database/conexao.php");
	}

	public function verifica_usuario($username)
	{
		session_start();

		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');

		$busca = $pdo->query("SELECT * FROM usuarios WHERE usuario='".$usuario."';");
		if($row = $busca->fetch()) 
		{
			return 1;			
		}
		else
		{
			return 0;
		}
	}

	public function novo_usuario($nome, $username, $senha, $email, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO usuarios (nome, usuario, senha, email, empresa_id) 
		VALUES('".$nome."', '".$username."', '".$senha."', '".$email."', '".$empresa_id."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
	}

	public function lista_usuarios($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM usuarios WHERE empresa_id=".$empresa_id)->fetchAll();
		return $data;
	}

}

?>