<?php  

class login{

	public function logar($email, $senha)
	{
		include("../database/conexao.php");
		session_start();

		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');

		$busca = $pdo->query("SELECT * FROM usuarios WHERE email='".$email."' AND senha='".$senha."';");
		if($row = $busca->fetch()) 
		{
			$_SESSION["empresa_id"] = $row['empresa_id'];
			$_SESSION["nome_usuario"] = $row['nome'];
			$_SESSION["username_usuario"] = $row['usuario'];
			$_SESSION["usuario_id"] = $row['id'];
			return 1;			
		}
		else
		{
			return 0;
		}
	}

}

?>