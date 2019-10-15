<?php  

class user
{
	function __construct()
	{
		require_once("../database/crud.php");
	}

	public function verify_user($email)
	{
		$crud = new Crud();
		$query = "SELECT * FROM users WHERE email='".$email."';";
		$data = $crud->find($query);
		if(count($data) > 0){
			return 1;			
		} else{
			return 0;
		}
	}

	public function new_user($name, $email)
	{
		$crud = new Crud();
		$query = "INSERT INTO users (name, email) VALUES('".$name."', '".$email."')";
		$crud->change($query);
	}

	public function lista_usuarios($empresa_id)
	{
		/*
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM usuarios WHERE empresa_id=".$empresa_id)->fetchAll();
		return $data; 
		*/
	}
}

?>