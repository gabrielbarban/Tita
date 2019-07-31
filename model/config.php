<?php  

class config
{
	function __construct()
	{
		include("../database/conexao.php");
	}

	public function gera_log($acao, $dados)
	{
		$usuario_id = $_SESSION["usuario_id"];
		$empresa_id = $_SESSION["empresa_id"];
		$ip_acesso = $_SERVER['REMOTE_ADDR'];

		if(!$usuario_id) $usuario_id = 1;
		if(!$empresa_id) $empresa_id = 1;

		$conexao = new Conexao();
                $pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
                $sql = "INSERT INTO log (acao, dados, usuario_id, empresa_id, ip_acesso)
                VALUES('".$acao."', '".$dados."', '".$usuario_id."', '".$empresa_id."', '".$ip_acesso."')";
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->exec($sql);
	}

	public function atualiza_usuario($id, $nome, $username, $senha, $email)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE usuarios SET nome='".$nome."', usuario='".$username."', senha='".$senha."', email='".$email."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou cadastro de usuário", "Nome: ".$nome.", E-mail: ".$email.", Username: ".$username);
	}

	public function deleta_usuario($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "DELETE FROM usuarios WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Deletou usuário", "ID do usuário: ".$id);
	}

	public function pega_empresa($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM companhia WHERE id='".$empresa_id."';")->fetchAll();
		return $data;
	}
}
?>