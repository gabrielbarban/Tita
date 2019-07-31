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

	public function atualiza_companhia($id, $nome, $razao_social, $cnpj, $email, $celular, $telefone, $responsavel)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE companhia SET nome='".$nome."', razao_social='".$razao_social."', cnpj='".$cnpj."', email='".$email."', celular='".$celular."', telefone='".$telefone."', responsavel='".$responsavel."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou dados da companhia", "---");
	}

	public function nova_forma_pagamento($nome, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO formas_pagamento (nome, empresa_id) 
		VALUES('".$nome."', '".$empresa_id."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Cadastrou nova forma de pagamento", "Nome: ".$nome);
	}

	public function lista_formas_pagamento($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM formas_pagamento WHERE empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function pega_forma_de_pagamento($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM formas_pagamento WHERE id='".$id."';")->fetchAll();
		return $data;
	}

	public function atualiza_forma_pagamento($id, $nome)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE formas_pagamento SET nome='".$nome."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou forma de pagamento", "ID da forma de pagamento: ".$id);
	}

	public function deleta_forma_pagamento($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "DELETE FROM formas_pagamento WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Deletou forma de pagamento", "ID da forma de pagamento: ".$id);
	}

	public function pega_status($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM status WHERE id='".$id."';")->fetchAll();
		return $data;
	}

	public function novo_status($nome, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO status (nome, empresa_id) 
		VALUES('".$nome."', '".$empresa_id."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Cadastrou novo status", "Nome do status: ".$nome);
	}

	public function atualiza_status($id, $nome)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE status SET nome='".$nome."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou status", "ID do status: ".$id);
	}

	public function deleta_status($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "DELETE FROM status WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Deletou status", "ID do status: ".$id);
	}

	public function lista_registros($empresa_id, $tipo)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT 
			r.id, LEFT(r.descricao, 25) as 'descricao', r.valor, r.data_cadastro, r.tipo, cc.id as 'id_cliente', cc.nome as 'nome_cliente',
			s.nome as 'nome_status', ee.nome as 'nome_empresa'
			FROM registro r 
			JOIN clientes cc ON (cc.id = r.cliente_id)
			JOIN status s ON (r.status_id = s.id)
			JOIN usuarios u  ON (r.usuario_id = u.id)
			JOIN registro_itens ri ON (r.id = ri.registro_id)
			JOIN valores v  ON (ri.valor_empresa_id = v.id)
			JOIN empresas ee  ON (v.empresas_id = ee.id)
			WHERE r.empresa_id='".$empresa_id."' AND r.tipo='".$tipo."' AND r.ativo=1 ORDER BY r.data_cadastro ASC LIMIT 0,5")->fetchAll();
		return $data;
	}

	public function novo_registro($descricao, $status, $empresa_id, $usuario_id, $tipo, $id_cliente, $valor, $parceiro, $entrega, $codigo)
	{
		$companhia_id = $_SESSION["empresa_id"];
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO registro (descricao, status_id, empresa_id, usuario_id, tipo, ativo, cliente_id, valor, parceiro_id, entrega_id, codigo) 
		VALUES('".$descricao."', '".$status."', '".$empresa_id."', '".$usuario_id."', '".$tipo."', 1, '".$id_cliente."', '".$valor."', '".$parceiro."', '".$entrega."', '".$codigo."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);

		//pegando o ultimo registro incluido
		$id=0;
		$data = $pdo->query("SELECT MAX(id) as 'id' FROM registro WHERE empresa_id='".$empresa_id."';")->fetchAll();
		foreach ($data as $d){
			$id = $d['id'];
		}

		$this->gera_log("Cadastrou novo registro", "ID do registro: ".$id);
		return $id;
	}

	public function novo_forma_registro($registro_id, $forma_id, $valor)
	{
		session_start();
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO registro_pagametno (registro_id, forma_id, valor) 
		VALUES('".$registro_id."', '".$forma_id."', '".$valor."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
	}

	public function novo_valor_registro($registro_id, $valor_empresa_id, $quantidade)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO registro_itens (registro_id, valor_empresa_id, quantidade) 
		VALUES('".$registro_id."', '".$valor_empresa_id."', '".$quantidade."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
	}

	public function pega_registro($id)
	{
		//echo $id;exit;
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT 
			r.codigo, r.id, r.valor, DATE_FORMAT(r.data_cadastro,'%d/%m/%Y %hh%m') as 'data_cadastro', r.tipo, e.nome as 'nome_empresas', c.rg, c.cpf, v.nome as 'descricao', v.tempo as 'tempo',
			s.nome as 'nome_status', fp.nome as 'nome_forma', u.nome as 'nome_usuario', en.nome as 'forma_entrega',
			s.id as 'id_status', fp.id as 'id_forma', c.nome as 'nome_cliente', c.data_nasc as 'data_nasc'
			FROM registro r 
			LEFT JOIN status s ON (r.status_id = s.id)
			LEFT JOIN registro_pagametno rp ON (rp.registro_id = r.id)
			LEFT JOIN formas_pagamento fp  ON (rp.forma_id = fp.id)
			LEFT JOIN usuarios u  ON (r.usuario_id = u.id)
			LEFT JOIN clientes c ON (r.cliente_id = c.id)
			LEFT JOIN registro_itens ri ON (r.id = ri.registro_id)
			LEFT JOIN valores v  ON (ri.valor_empresa_id = v.id)
			LEFT JOIN empresas e  ON (v.empresas_id = e.id)
			LEFT JOIN entrega en ON (r.entrega_id = en.id)
			WHERE r.id='".$id."' LIMIT 0,1;")->fetchAll();
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
		$this->gera_log("Atualizou dados de registro", "ID do registro: ".$id);
	}

	public function deleta_registro($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE registro SET ativo=0 WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
	}

	public function logar($email, $senha)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');

		$busca = $pdo->query("SELECT * FROM usuarios WHERE email='".$email."' AND senha='".$senha."';");
		if($row = $busca->fetch()) 
		{
			session_start();
			$_SESSION["empresa_id"] = $row['empresa_id'];
			$_SESSION["nome_usuario"] = $row['nome'];
			$_SESSION["username_usuario"] = $row['usuario'];
			$_SESSION["usuario_id"] = $row['id'];
			$_SESSION["url_inicial"] = $row['url_inicial'];
			$_SESSION["email_usuario"] = $row['email'];
			$this->gera_log("Logou no sistema", "---");
			return 1;			
		}
		else
		{
			return 0;
		}
	}

	public function lista_status($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM status WHERE empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function verifica_usuario($email)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');

		$busca = $pdo->query("SELECT * FROM usuarios WHERE email='".$email."';");
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
		$sql = "INSERT INTO usuarios (nome, usuario, senha, email, empresa_id, url_inicial, flag_digitando) 
		VALUES('".$nome."', '".$username."', '".$senha."', '".$email."', '".$empresa_id."', 'novo_registro', 0)";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		
		//PEGANDO O MAIOR ID
		$data = $pdo->query("SELECT MAX(id) as 'id' FROM usuarios WHERE empresa_id='".$empresa_id."';")->fetchAll();
		foreach ($data as $d){
			$usuario_id = $d['id'];
		}

		//INSERINDO AS PERMISSOES
		$sql1 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '1', '1')";
		$sql2 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '2', '1')";
		$sql3 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '3', '1')";
		$sql4 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '4', '1')";
		$sql5 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '5', '1')";
		$sql6 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '6', '1')";
		$sql7 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '7', '1')";
		$sql8 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '8', '1')";
		$sql9 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '9', '1')";
		$sql10 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '10', '1')";
		$sql11 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '11', '1')";
		$sql12 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '12', '1')";
		$sql13 = "INSERT INTO usuarios_permissoes (usuario_id, codigo, ativo) VALUES ('".$usuario_id."', '13', '1')";

		$pdo->exec($sql1);
		$pdo->exec($sql2);
		$pdo->exec($sql3);
		$pdo->exec($sql4);
		$pdo->exec($sql5);
		$pdo->exec($sql6);
		$pdo->exec($sql7);
		$pdo->exec($sql8);
		$pdo->exec($sql9);
		$pdo->exec($sql10);
		$pdo->exec($sql11);
		$pdo->exec($sql12);
		$pdo->exec($sql13);
	
		$this->gera_log("Cadastro novo usuário", "Nome do novo usuário: ".$nome);
	}

	public function lista_usuarios($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM usuarios WHERE empresa_id=".$empresa_id)->fetchAll();
		return $data;
	}

	public function filtro_registros($tipo, $forma, $status, $ativo, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$query = "SELECT 
			r.id, r.descricao, r.valor, r.data_cadastro, r.tipo,
			s.nome as 'nome_status', u.nome as 'nome_usuario'
			FROM registro r 
			JOIN status s ON (r.status_id = s.id)
			JOIN usuarios u  ON (r.usuario_id = u.id)
			WHERE r.empresa_id='".$empresa_id."'";


		//filtrando o tipo
		if($tipo != '*')
			$query = $query." AND r.tipo='".$tipo."'";
		else
			$query = $query." AND r.tipo >= 0";


		//filtrando o status
		if($status != '*')
			$query = $query." AND r.status_id=".$status;
		else
			$query = $query." AND r.status_id >= 1";


		//filtrando ativo ou não
		if($ativo != '*')
			$query = $query." AND r.ativo=".$ativo;
		else
			$query = $query." AND r.ativo >= 1";


		//return
		$data = $pdo->query($query)->fetchAll();
		return $data;
	}

	public function pega_usuario($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM usuarios WHERE id='".$id."';")->fetchAll();
		return $data;
	}

	public function lista_registros_ativos($empresa_id)
	{
		$conexao = new Conexao();

		$ano_atual = date('Y');
		$mes_atual = date('m');
		$condicao1 = $ano_atual."-".$mes_atual."-01 00:00:00";
		$condicao2 = $ano_atual."-".$mes_atual."-31 23:59:59";


		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT count(*) as 'qtd' FROM registro 
			WHERE ativo=1 AND empresa_id='".$empresa_id."' AND data_cadastro >='".$condicao1."' AND data_cadastro <='".$condicao2."'")->fetchAll();
		return $data;
	}

	public function lista_empresas_ativas($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT count(*) as 'qtd' FROM parceiros WHERE ativo=1 AND empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function lista_valor_total_registros($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT SUM(valor) as 'valor_total' FROM registro WHERE tipo=1 AND ativo=1 AND empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function dashboardMensal($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');

		$ano_atual = date('Y');
		$mes_atual = date('m');
		$condicao1 = $ano_atual."-".$mes_atual."-01 00:00:00";
		$condicao2 = $ano_atual."-".$mes_atual."-31 23:59:59";
		$dados1 = $pdo->query("SELECT SUM(valor) as 'valor' FROM registro 
			WHERE empresa_id='".$empresa_id."' AND tipo=1 AND ativo=1 AND data_cadastro >='".$condicao1."' AND data_cadastro <='".$condicao2."'")->fetchAll();
		$dados2 = $pdo->query("SELECT SUM(valor) as 'valor' FROM financas f JOIN usuarios u ON (u.id=f.usuario_id)
			WHERE u.empresa_id='".$empresa_id."' AND f.data_cadastro >='".$condicao1."' AND f.data_cadastro <='".$condicao2."'")->fetchAll();


		foreach ($dados1 as $d) {
		  $valor_entrada = number_format($d['valor'], 2);
		}

		foreach ($dados2 as $d) {
		  $valor_saida = number_format($d['valor'], 2);
		}

		$valores = array();
		$valores[0] = $valor_entrada;
		$valores[1] = $valor_saida;
		return $valores;
	}

	public function dashboardAnual($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');

		$ano_atual = date('Y');
		$condicao1 = $ano_atual."-01-01 00:00:00";
		$condicao2 = $ano_atual."-12-31 23:59:59";
		$dados1 = $pdo->query("SELECT SUM(valor) as 'valor' FROM registro 
			WHERE empresa_id='".$empresa_id."' AND tipo=1 AND ativo=1 AND data_cadastro >='".$condicao1."' AND data_cadastro <='".$condicao2."'")->fetchAll();
		$dados2 = $pdo->query("SELECT SUM(valor) as 'valor' FROM financas f JOIN usuarios u ON (u.id=f.usuario_id)
			WHERE u.empresa_id='".$empresa_id."' AND f.data_cadastro >='".$condicao1."' AND f.data_cadastro <='".$condicao2."'")->fetchAll();


		foreach ($dados1 as $d) {
		  $valor_entrada = number_format($d['valor'], 2);
		}

		foreach ($dados2 as $d) {
		  $valor_saida = number_format($d['valor'], 2);
		}

		$valores = array();
		$valores[0] = $valor_entrada;
		$valores[1] = $valor_saida;
		return $valores;
	}

	public function dashboard($empresa_id)
	{
		$conexao = new Conexao();

		$ano_atual = date('Y');
		$mes_atual = date('m');
		$condicao1 = $ano_atual."-".$mes_atual."-01 00:00:00";
		$condicao2 = $ano_atual."-".$mes_atual."-31 23:59:59";

		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$dados1 = $pdo->query("SELECT SUM(valor) as 'valor' FROM registro WHERE empresa_id='".$empresa_id."' AND tipo=1 AND ativo=1 AND data_cadastro >='".$condicao1."' AND data_cadastro <='".$condicao2."'")->fetchAll(); //entradas
		$dados2 = $pdo->query("SELECT SUM(valor) as 'valor' FROM financas f JOIN usuarios u ON (u.id=f.usuario_id)
			WHERE u.empresa_id='".$empresa_id."' AND f.data_cadastro >='".$condicao1."' AND f.data_cadastro <='".$condicao2."'")->fetchAll();


		foreach ($dados1 as $d) {
		  $valor_entrada = number_format($d['valor'], 2);
		}

		foreach ($dados2 as $d) {
		  $valor_saida = number_format($d['valor'], 2);
		}

		$valores = array();
		$valores[0] = $valor_entrada;
		$valores[1] = $valor_saida;
		return $valores;
	}

	public function dashboardMensal_registros($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');

		$ano_atual = date('Y');
		$mes_atual = date('m');
		$condicao1 = $ano_atual."-".$mes_atual."-01 00:00:00";
		$condicao2 = $ano_atual."-".$mes_atual."-31 23:59:59";
		$dados1 = $pdo->query("SELECT count(*) as 'valor' FROM registro 
			WHERE empresa_id='".$empresa_id."' AND tipo=1 AND ativo=1 AND data_cadastro >='".$condicao1."' AND data_cadastro <='".$condicao2."'")->fetchAll();
		$dados2 = $pdo->query("SELECT count(*) as 'valor' FROM financas f JOIN usuarios u ON (u.id=f.usuario_id)
			WHERE u.empresa_id='".$empresa_id."' AND f.data_cadastro >='".$condicao1."' AND f.data_cadastro <='".$condicao2."'")->fetchAll();


		foreach ($dados1 as $d) {
		  $valor_entrada = number_format($d['valor'], 2);
		}

		foreach ($dados2 as $d) {
		  $valor_saida = number_format($d['valor'], 2);
		}

		$valores = array();
		$valores[0] = $valor_entrada;
		$valores[1] = $valor_saida;
		return $valores;
	}

	public function dashboardAnual_registros($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');

		$ano_atual = date('Y');
		$condicao1 = $ano_atual."-01-01 00:00:00";
		$condicao2 = $ano_atual."-12-31 23:59:59";
		$dados1 = $pdo->query("SELECT count(*) as 'valor' FROM registro 
			WHERE empresa_id='".$empresa_id."' AND tipo=1 AND ativo=1 AND data_cadastro >='".$condicao1."' AND data_cadastro <='".$condicao2."'")->fetchAll();
		$dados2 = $pdo->query("SELECT count(*) as 'valor' FROM financas f JOIN usuarios u ON (u.id=f.usuario_id)
			WHERE u.empresa_id='".$empresa_id."' AND f.data_cadastro >='".$condicao1."' AND f.data_cadastro <='".$condicao2."'")->fetchAll();


		foreach ($dados1 as $d) {
		  $valor_entrada = number_format($d['valor'], 2);
		}

		foreach ($dados2 as $d) {
		  $valor_saida = number_format($d['valor'], 2);
		}

		$valores = array();
		$valores[0] = $valor_entrada;
		$valores[1] = $valor_saida;
		return $valores;
	}

	public function lista_empresas($empresa_id, $tipo)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM empresas WHERE ativo=1 AND tipo='".$tipo."' AND empresa_id='".$empresa_id."' ORDER BY nome ASC;")->fetchAll();
		return $data;
	}

	public function pega_empresa_id($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT nome FROM empresas WHERE id='".$id."';")->fetchAll();
		$nome = $data[0]['nome'];
		return $nome;
	}

	public function lista_valores($empresas_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM valores WHERE ativo=1 AND empresas_id='".$empresas_id."';")->fetchAll();
		$this->gera_log("Listou valores de uma empresa", "ID da empresa: ".$empresas_id);
		return $data;
	}

	public function novo_valor($nome, $valor, $prazo, $empresas_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO valores (nome, valor, empresas_id, ativo, tempo) 
		VALUES('".$nome."', '".$valor."', '".$empresas_id."', 1, '".$prazo."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
	}

	public function nova_empresa($nome, $empresa_id, $tipo, $razao_social, $cnpj, $telefone, $email)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO empresas (nome, empresa_id, ativo, tipo, razao_social, cnpj, telefone, email) 
		VALUES('".$nome."', '".$empresa_id."', 1, '".$tipo."', '".$razao_social."', '".$cnpj."', '".$telefone."', '".$email."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Cadastrou nova empresa", "Nome da nova empresa: ".$nome);
	}

	public function pega_valor($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM valores WHERE id='".$id."';")->fetchAll();
		return $data;
		$this->gera_log("Cadastrou novo valor", "ID do valor: ".$id);
	}

	public function atualiza_valor($id, $nome, $valor, $tempo)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE valores SET nome='".$nome."', valor='".$valor."', tempo='".$tempo."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou valor", "Nome do valor: ".$nome);
	}

	public function deleta_valor($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE valores SET ativo=0 WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Deletou valor", "ID do valor: ".$id);
	}

	public function pega_empresas($empresas_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM empresas WHERE id='".$empresas_id."';")->fetchAll();
		return $data;
	}

	public function atualiza_empresas($id, $nome, $razao_social, $cnpj, $telefone, $email)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE empresas SET nome='".$nome."', razao_social='".$razao_social."', cnpj='".$cnpj."', telefone='".$telefone."', email='".$email."'
		 WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou empresa", "ID da empresa: ".$id);
	}

	public function deleta_empresas($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE empresas SET ativo=0 WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Deletou empresa", "ID da empresa: ".$id);
	}

	public function busca_cliente($nome, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT nome, id, data_nasc  FROM clientes 
			WHERE nome LIKE '%".$nome."%' AND empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function novo_cliente($nome, $nascimento, $rg, $cpf, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO clientes (nome, data_nasc, empresa_id, rg, cpf) 
		VALUES('".$nome."', '".$nascimento."','".$empresa_id."','".$rg."','".$cpf."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);

		$data = $pdo->query("SELECT MAX(id) FROM clientes;")->fetchAll();
		$this->gera_log("Cadastrou novo cliente", "Nome do cliente: ".$nome);
		return $data;
	}

	public function pega_valores_empresa($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM valores WHERE ativo=1 AND empresas_id='".$id."';")->fetchAll();
		return $data;
	}

	public function lista_relatorios($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM relatorios WHERE empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function novo_contato($nome, $email, $telefone)
	{
		$conexao = new Conexao();
                $pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
                $sql = "INSERT INTO contato_lead (nome, email, telefone, status)
                VALUES('".$nome."', '".$email."', '".$telefone."', 'Novo')";
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->exec($sql);
	}

	public function puxa_historico($cliente_id)
	{
		session_start();
		$empresa_id = $_SESSION["empresa_id"];

		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT cc.nome as 'nome_cliente', cc.data_nasc, cc.rg, cc.cpf, cc.telefone, cc.celular, cc.email, cc.endereco,
			r.descricao, r.valor, DATE_FORMAT(r.data_cadastro,'%d/%m/%Y') as 'data_cadastro', r.tipo, r.ativo,
			s.nome as 'nome_status', ee.nome as 'nome_empresa', r.id as 'id'
			FROM registro r 
			JOIN status s ON (r.status_id = s.id)
			JOIN usuarios u  ON (r.usuario_id = u.id)
			JOIN registro_itens ri ON (r.id = ri.registro_id)
			JOIN valores v  ON (ri.valor_empresa_id = v.id)
			JOIN empresas ee  ON (v.empresas_id = ee.id)
			JOIN clientes cc ON (r.cliente_id = cc.id)
			WHERE r.empresa_id='".$empresa_id."' AND cc.id='".$cliente_id."';")->fetchAll();

		$this->gera_log("Puxou histórico de cliente", "ID do cliente: ".$cliente_id);
		return $data;
	}

	public function relatorio_4($ano, $mes, $empresa_id)
	{
		$condicao1 = $ano."-".$mes."-01 00:00:00";
		$condicao2 = $ano."-".$mes."-31 23:59:59";
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT 
			p.nome, DATE_FORMAT(p.data_cadastro,'%d/%m/%Y') as 'data_cadastro', p.email, p.telefone
			FROM parceiros p
			WHERE p.ativo=1 AND p.empresa_id='".$empresa_id."' AND data_cadastro >='".$condicao1."' AND data_cadastro <='".$condicao2."' ORDER BY nome ASC")->fetchAll();
		$this->gera_log("Gerou relatorio de parceiros", "---");
		return $data;
	}

	public function relatorio_5($ano, $mes, $empresa_id)
	{
		$condicao1 = $ano."-".$mes."-01 00:00:00";
		$condicao2 = $ano."-".$mes."-31 23:59:59";
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT 
			p.nome, DATE_FORMAT(p.data_cadastro,'%d/%m/%Y') as 'data_cadastro', p.email, p.telefone, count(r.id) as 'quantidade', round(sum(r.valor), 2)  as 'valor_total'
			FROM parceiros p JOIN registro r ON (r.parceiro_id = p.id)
			WHERE r.ativo=1 AND p.empresa_id='".$empresa_id."' AND r.data_cadastro >='".$condicao1."' AND r.data_cadastro <='".$condicao2."' GROUP BY p.id ORDER BY quantidade DESC, nome ASC")->fetchAll();
		$this->gera_log("Gerou relatorio de registros por parceiros", "---");
		return $data;
	}

	public function lista_monitor($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT cm.status_principal_id as 'status_id', s.nome as 'status_nome', cm.tipo_principal
			FROM config_monitor cm JOIN status s ON (cm.status_principal_id = s.id)
			WHERE cm.empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function atualiza_monitor($tipo_principal, $status_principal_id, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE config_monitor SET tipo_principal='".$tipo_principal."', status_principal_id='".$status_principal_id."' WHERE empresa_id='".$empresa_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou dados do monitor", "---");
	}

	public function visualiza_monitor($status_id, $tipo_id)
	{
		session_start();
		$empresa_id = $_SESSION["empresa_id"];

		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT cc.data_nasc, cc.rg, cc.cpf, cc.nome as 'nome_cliente',
			r.descricao, r.valor, DATE_FORMAT(r.data_cadastro,'%d/%m/%Y %hh%m') as 'data_cadastro', r.tipo, r.ativo,
			s.nome as 'nome_status', ee.nome as 'nome_empresa', r.id as 'id'
			FROM registro r 
			JOIN status s ON (r.status_id = s.id)
			JOIN usuarios u  ON (r.usuario_id = u.id)
			JOIN registro_itens ri ON (r.id = ri.registro_id)
			JOIN valores v  ON (ri.valor_empresa_id = v.id)
			JOIN empresas ee  ON (v.empresas_id = ee.id)
			JOIN clientes cc ON (r.cliente_id = cc.id)
			WHERE r.empresa_id='".$empresa_id."' AND r.status_id='".$status_id."' AND r.tipo='".$tipo_id."' AND r.ativo=1;")->fetchAll();
		return $data;
	}

	public function atualiza_status_registro($id, $status)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE registro SET status_id='".$status."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Mudou status de registro", "ID do registro: ".$id);
	}

	public function verifica_permissao($usuario_id, $codigo)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM usuarios_permissoes WHERE usuario_id='".$usuario_id."' AND codigo='".$codigo."';")->fetchAll();
		foreach ($data as $d){
			$ativo = $d['ativo'];
		}
		return $ativo;
	}

	public function lista_permissoes($usuario_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM usuarios_permissoes WHERE usuario_id='".$usuario_id."' ORDER BY codigo ASC")->fetchAll();
		return $data;
	}

	public function atualiza_permissoes($permissao1, $permissao2, $permissao3, $permissao4, $permissao5, $permissao6, $permissao7, $permissao8, $permissao9, $permissao10, $permissao11, $permissao12, $permissao13, $usuario_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');

		$sql1 = "UPDATE usuarios_permissoes SET ativo='".$permissao1."' WHERE codigo=1 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql1);


		$sql2 = "UPDATE usuarios_permissoes SET ativo='".$permissao2."' WHERE codigo=2 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql2);


		$sql3 = "UPDATE usuarios_permissoes SET ativo='".$permissao3."' WHERE codigo=3 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql3);


		$sql4 = "UPDATE usuarios_permissoes SET ativo='".$permissao4."' WHERE codigo=4 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql4);


		$sql5 = "UPDATE usuarios_permissoes SET ativo='".$permissao5."' WHERE codigo=5 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql5);


		$sql6 = "UPDATE usuarios_permissoes SET ativo='".$permissao6."' WHERE codigo=6 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql6);


		$sql7 = "UPDATE usuarios_permissoes SET ativo='".$permissao7."' WHERE codigo=7 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql7);


		$sql8 = "UPDATE usuarios_permissoes SET ativo='".$permissao8."' WHERE codigo=8 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql8);


		$sql9 = "UPDATE usuarios_permissoes SET ativo='".$permissao9."' WHERE codigo=9 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql9);


		$sql10 = "UPDATE usuarios_permissoes SET ativo='".$permissao10."' WHERE codigo=10 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql10);

		$sql11 = "UPDATE usuarios_permissoes SET ativo='".$permissao11."' WHERE codigo=11 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql11);

		$sql12 = "UPDATE usuarios_permissoes SET ativo='".$permissao12."' WHERE codigo=12 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql12);

		$sql13 = "UPDATE usuarios_permissoes SET ativo='".$permissao13."' WHERE codigo=13 AND usuario_id='".$usuario_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql13);
	}

	public function atualiza_url_inicial($url, $usuario_id)
	{
		$conexao = new Conexao();
        $pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
        $sql = "UPDATE usuarios SET url_inicial='".$url."' WHERE id='".$usuario_id."'";
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec($sql);
	}

	public function pega_url_inicial($usuario_id)
	{
		$conexao = new Conexao();
        $pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
        $data = $pdo->query("SELECT url_inicial FROM usuarios WHERE id='".$usuario_id."'")->fetchAll();
        foreach ($data as $d){
			$url_inicial = $d['url_inicial'];
		}
		return $url_inicial;
	}

	public function busca_cliente_id($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM clientes WHERE id=".$id)->fetchAll();
		return $data;
	}

	public function atualiza_cliente($id, $nome, $data_nasc, $rg, $cpf, $telefone, $celular, $email, $endereco)
	{
		$conexao = new Conexao();
        $pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
        $sql = "UPDATE clientes SET nome='".$nome."', data_nasc='".$data_nasc."', rg='".$rg."', cpf='".$cpf."',
        telefone='".$telefone."', celular='".$celular."', email='".$email."', endereco='".$endereco."'
        WHERE id='".$id."'";
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec($sql);
	}

	public function novo_registro_financas($descricao, $valor, $forma_id, $empresas_id, $usuario_id, $categoria_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO financas (descricao, valor, forma_id, empresas_id, usuario_id, categoria_id) 
		VALUES('".$descricao."', '".$valor."', '".$forma_id."', '".$empresas_id."', '".$usuario_id."', '".$categoria_id."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);

		//pegando o ultimo registro incluido
		$id=0;
		$data = $pdo->query("SELECT MAX(id) as 'id' FROM financas;")->fetchAll();
		foreach ($data as $d){
			$id = $d['id'];
		}
		$this->gera_log("Nova entrada em finanças", "ID do registro: ".$id.", ID do usuário: ".$usuario_id);
		return $id;
	}

	public function lista_financas($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT 
			f.id, f.descricao, f.valor, f.data_cadastro, fp.nome as 'nome_forma', ee.nome as 'nome_empresa', u.nome as 'nome_usuario', fc.nome as 'nome_categoria' 
			FROM financas f
			JOIN formas_pagamento fp ON (fp.id = f.forma_id)
			JOIN empresas ee ON (ee.id = f.empresas_id)
			JOIN usuarios u ON (u.id = f.usuario_id)
			JOIN financas_categorias fc ON (fc.id = f.categoria_id)
			WHERE u.empresa_id='".$empresa_id."' ORDER BY f.data_cadastro ASC LIMIT 0,5")->fetchAll();
		return $data;
	}

	public function lista_categorias($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM financas_categorias WHERE empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function pega_categoria($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM financas_categorias WHERE id='".$id."';")->fetchAll();
		return $data;
	}

	public function atualiza_categoria($id, $nome)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE financas_categorias SET nome='".$nome."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou categoria financeira", "ID da categoria: ".$id);
	}

	public function deleta_categoria($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "DELETE FROM financas_categorias WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Deletou categoria financeira", "ID da categoria: ".$id);
	}

	public function nova_categoria($nome, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO financas_categorias (nome, empresa_id) 
		VALUES('".$nome."', '".$empresa_id."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Cadastrou nova categoria financeira", "Nome da categoria: ".$nome);
	}

	public function deleta_financas($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "DELETE FROM financas WHERE id=".$id;
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Deletou saída de finanças", "ID da saída: ".$id);
	}

	public function pega_financas($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT 
			f.id, f.descricao, f.valor, DATE_FORMAT(f.data_cadastro,'%d/%m/%Y %hh%m') as 'data_cadastro', fp.nome as 'nome_forma', fp.id as 'id_forma', ee.nome as 'nome_empresa', ee.id as 'id_empresa', fc.nome as 'nome_categoria', fc.id as 'id_categoria', u.nome as 'nome_usuario' 
			FROM financas f
			JOIN usuarios u ON (f.usuario_id = u.id)
			JOIN formas_pagamento fp ON (fp.id = f.forma_id)
			JOIN empresas ee ON (ee.id = f.empresas_id)
			JOIN financas_categorias fc ON (fc.id = f.categoria_id)
			WHERE f.id='".$id."';")->fetchAll();
		return $data;
	}

	public function atualiza_financas($id, $descricao, $valor, $forma_id, $empresas_id, $usuario_id, $categoria_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE financas SET descricao='".$descricao."', valor='".$valor."', forma_id='".$forma_id."', empresas_id='".$empresas_id."', usuario_id='".$usuario_id."', categoria_id='".$categoria_id."'   
		WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou saída", "ID da saída: ".$id);
	}

	public function gera_txt_recibo($conteudo)
	{
				$arquivo = "/tmp/recibo.txt";
                $f = fopen($arquivo, 'a'); 
                fwrite($f, $conteudo); 
                fclose($f);

                // Configuramos os headers que serão enviados para o browser
                header('Content-Type: "application/zip"');
                header('Content-Disposition: attachment; filename="'.basename($arquivo).'"');
                header("Content-Transfer-Encoding: binary");
                header('Expires: 0');
                header('Pragma: no-cache');
                // Envia o arquivo para o cliente
                ob_clean();
                flush();
                readfile($arquivo);
	}

	public function pega_etiqueta_individual($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM etiqueta_individual WHERE empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function pega_etiqueta_pimaco($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM etiqueta_pimaco WHERE empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}
	
	public function atualiza_etiqueta_individual($id, $codigo)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE etiqueta_individual SET codigo='".$codigo."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou etiqueta individual", "CODIGO NOVO: ".$codigo);
	}

	public function atualiza_etiqueta_pimaco($id, $codigo)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE etiqueta_pimaco SET codigo='".$codigo."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou etiqueta PIMACO", "CODIGO NOVO: ".$codigo);
	}

	public function lista_documentos($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM documentos WHERE empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function novo_documento($nome, $codigo, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO documentos (nome, codigo, empresa_id) 
		VALUES('".$nome."', '".$codigo."','".$empresa_id."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Cadastrou novo novo documento", "Nome do documento: ".$nome);
	}

	public function pega_documento($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM documentos WHERE id='".$id."';")->fetchAll();
		return $data;
	}

	public function atualiza_documento($id, $nome, $codigo)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE documentos SET nome='".$nome."', codigo='".$codigo."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou documento", "ID do documento: ".$id.", Nome do documento: ".$nome);
	}

	public function deleta_documento($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "DELETE FROM documentos WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Deletou documento", "ID do documento: ".$id);
	}

	public function pega_codigo_documento($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM documentos WHERE id='".$id."';")->fetchAll();
		return $data;
	}

	public function lista_chat($usuario1, $usuario2, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT c.*, DATE_FORMAT(c.data_cadastro,'%d/%m/%Y %H:%H') as 'data_cadastro', u.nome as 'nome_usuario1'  
			FROM chat c JOIN usuarios u ON (u.id = c.usuario1)
			WHERE c.empresa_id = '".$empresa_id."' AND ( (c.usuario1 = '".$usuario1."' AND c.usuario2 = '".$usuario2."') OR 
			(c.usuario1 = '".$usuario2."' AND c.usuario2 = '".$usuario1."') ) ORDER BY c.data_cadastro DESC ")->fetchAll();
		return $data;
	}

	public function nova_conversa($usuario1, $usuario2, $texto, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO chat (usuario1, usuario2, texto, empresa_id) 
		VALUES('".$usuario1."', '".$usuario2."', '".$texto."', '".$empresa_id."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Enviou nova mensagem", "Nome do documento: ".$nome);
	}

	public function atualiza_flag_digitando($id, $flag)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE usuarios SET flag_digitando='".$flag."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
	}

	public function lista_parceiros($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM parceiros WHERE ativo=1 AND empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function novo_parceiro($nome, $email, $telefone, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO parceiros (nome, email, telefone, empresa_id) 
		VALUES('".$nome."', '".$email."', '".$telefone."', '".$empresa_id."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Cadastrou novo parceiro", "Nome do parceiro: ".$nome);
	}

	public function atualiza_parceiro($id, $nome, $email, $telefone)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE parceiros SET nome='".$nome."', email='".$email."', telefone='".$telefone."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou parceiro", "ID do parceiro: ".$id);
	}

	public function deleta_parceiro($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE parceiros SET ativo=0 WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Desativou parceiro", "ID do parceiro: ".$id);
	}

	public function pega_parceiro($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM parceiros WHERE id='".$id."';")->fetchAll();
		return $data;
	}

	public function lista_entregas($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM entrega WHERE ativo=1 AND empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function pega_entrega($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM entrega WHERE id='".$id."';")->fetchAll();
		return $data;
	}

	public function atualiza_entrega($id, $nome)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE entrega SET nome='".$nome."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou forma de entrega", "ID da forma de entrega: ".$id);
	}

	public function deleta_entrega($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE entrega SET ativo=0 WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Desativou entrega", "ID da entrega: ".$id);
	}

	public function nova_entrega($nome, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO entrega (nome, empresa_id, ativo) 
		VALUES('".$nome."', '".$empresa_id."', '1')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Cadastrou nova forma de entrega", "Nome da forma de entrega: ".$nome);
	}

	public function relatorio3($empresa_id, $ano, $mes, $categoria, $empresa)
	{
		$condicao1 = $ano."-".$mes."-01 00:00:00";
		$condicao2 = $ano."-".$mes."-31 23:59:59";

		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$query = "SELECT 
			f.id, f.descricao, f.valor, f.data_cadastro, fp.nome as 'nome_forma', ee.nome as 'nome_empresa', u.nome as 'nome_usuario', fc.nome as 'nome_categoria' 
			FROM financas f
			LEFT JOIN formas_pagamento fp ON (fp.id = f.forma_id)
			LEFT JOIN empresas ee ON (ee.id = f.empresas_id)
			LEFT JOIN usuarios u ON (u.id = f.usuario_id)
			LEFT JOIN financas_categorias fc ON (fc.id = f.categoria_id)
			WHERE u.empresa_id='".$empresa_id."' AND f.data_cadastro >= '".$condicao1."' AND f.data_cadastro <= '".$condicao2."'";


			if($categoria != '*')
				$query = $query." AND categoria_id=".$categoria;

			if($empresa != '*')
				$query = $query." AND empresas_id=".$empresa;



		$data = $pdo->query($query)->fetchAll();
		$this->gera_log("Gerou relatorio de saídas", "---");
		return $data;
	}

	public function relatorio1($ano, $mes, $empresa_id, $status, $forma_pagamento, $forma_entrega, $empresas)
	{
		$condicao1 = $ano."-".$mes."-01 00:00:00";
		$condicao2 = $ano."-".$mes."-31 23:59:59";

		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$query = "SELECT 
			r.id, LEFT(r.descricao, 25) as 'descricao', r.valor, r.data_cadastro, r.tipo, cc.id as 'id_cliente', 
			cc.nome as 'nome_cliente', s.nome as 'nome_status', ee.nome as 'nome_empresa', fp.nome as 'nome_forma'
			FROM registro r 
			JOIN clientes cc ON (cc.id = r.cliente_id)
			JOIN status s ON (r.status_id = s.id)
			JOIN usuarios u  ON (r.usuario_id = u.id)
			JOIN registro_itens ri ON (r.id = ri.registro_id)
			JOIN registro_pagametno rp ON (r.id = rp.registro_id)
			JOIN valores v  ON (ri.valor_empresa_id = v.id)
			JOIN empresas ee  ON (v.empresas_id = ee.id)
			JOIN formas_pagamento fp ON (rp.forma_id = fp.id)
			WHERE r.ativo=1 AND r.empresa_id='".$empresa_id."' AND r.data_cadastro >= '".$condicao1."' AND r.data_cadastro <= '".$condicao2."'";

			if($status != '*')
				$query = $query." AND r.status_id='".$status."'";

			if($forma_pagamento != '*')
				$query = $query." AND rp.forma_id='".$forma_pagamento."'";

			if($forma_entrega != '*')
				$query = $query." AND r.entrega_id='".$forma_entrega."'";

			if($empresas != '*')
				$query = $query." AND ee.id='".$empresas."'";


		$data = $pdo->query($query)->fetchAll();
		$this->gera_log("Gerou relatorio de registros", "---");
		return $data;
	}

	public function relatorio_caixa_registros($data, $forma, $empresa_id)
	{
		$dia = substr($data, 0, 2);
		$mes = substr($data, 3, 2);
		$ano = substr($data, 6, 4);
		$condicao1 = $ano."-".$mes."-".$dia." 00:00:00";
		$condicao2 = $ano."-".$mes."-".$dia." 23:59:59";

		//echo $condicao1;exit;

		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$query = "SELECT 
			r.id, LEFT(r.descricao, 25) as 'descricao', r.valor, r.data_cadastro, r.tipo, cc.id as 'id_cliente', 
			cc.nome as 'nome_cliente', s.nome as 'nome_status', ee.nome as 'nome_empresa', fp.nome as 'nome_forma'
			FROM registro r 
			JOIN clientes cc ON (cc.id = r.cliente_id)
			JOIN status s ON (r.status_id = s.id)
			JOIN usuarios u  ON (r.usuario_id = u.id)
			JOIN registro_itens ri ON (r.id = ri.registro_id)
			JOIN registro_pagametno rp ON (r.id = rp.registro_id)
			JOIN valores v  ON (ri.valor_empresa_id = v.id)
			JOIN empresas ee  ON (v.empresas_id = ee.id)
			JOIN formas_pagamento fp ON (rp.forma_id = fp.id)
			WHERE r.ativo=1 AND r.empresa_id='".$empresa_id."' AND r.data_cadastro >= '".$condicao1."' AND r.data_cadastro <= '".$condicao2."'";

			if($forma != '*')
				$query = $query." AND rp.forma_id='".$forma."'";


		$data = $pdo->query($query)->fetchAll();
		$this->gera_log("Gerou relatorio de caixa", "---");
		return $data;
	}

	public function relatorio_caixa_saidas($data, $forma, $empresa_id)
	{
		$dia = substr($data, 0, 2);
		$mes = substr($data, 3, 2);
		$ano = substr($data, 6, 4);
		$condicao1 = $ano."-".$mes."-".$dia." 00:00:00";
		$condicao2 = $ano."-".$mes."-".$dia." 23:59:59";

		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$query = "SELECT 
			f.id, f.descricao, f.valor, f.data_cadastro, fp.nome as 'nome_forma', ee.nome as 'nome_empresa', u.nome as 'nome_usuario', fc.nome as 'nome_categoria' 
			FROM financas f
			LEFT JOIN formas_pagamento fp ON (fp.id = f.forma_id)
			LEFT JOIN empresas ee ON (ee.id = f.empresas_id)
			LEFT JOIN usuarios u ON (u.id = f.usuario_id)
			LEFT JOIN financas_categorias fc ON (fc.id = f.categoria_id)
			WHERE u.empresa_id='".$empresa_id."' AND f.data_cadastro >= '".$condicao1."' AND f.data_cadastro <= '".$condicao2."'";

			if($forma != '*')
				$query = $query." AND rp.forma_id='".$forma."'";


		$data = $pdo->query($query)->fetchAll();
		return $data;
	}

	public function busca_registro($empresa_id, $id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT 
			r.id, LEFT(r.descricao, 25) as 'descricao', r.valor, r.data_cadastro, r.tipo, cc.id as 'id_cliente', cc.nome as 'nome_cliente',
			s.nome as 'nome_status', ee.nome as 'nome_empresa'
			FROM registro r 
			JOIN clientes cc ON (cc.id = r.cliente_id)
			JOIN status s ON (r.status_id = s.id)
			JOIN usuarios u  ON (r.usuario_id = u.id)
			JOIN registro_itens ri ON (r.id = ri.registro_id)
			JOIN valores v  ON (ri.valor_empresa_id = v.id)
			JOIN empresas ee  ON (v.empresas_id = ee.id)
			WHERE r.empresa_id='".$empresa_id."' AND r.id='".$id."' AND r.ativo=1;")->fetchAll();
		return $data;
	}

	public function verifica_chat($usuario)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT DATE_FORMAT(c.data_cadastro,'%d/%m/%Y %HH%m') as 'data_chat', u.nome as 'nome_usuario', c.lido as 'lido', c.texto, c.usuario1 as 'id_usuario'
			FROM chat c JOIN usuarios u ON (u.id = c.usuario1)
			WHERE c.lido=0 AND usuario2 = '".$usuario."'")->fetchAll();
		return $data;
	}

	public function atualiza_chat($usuario)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE chat SET lido=1 WHERE usuario2='".$usuario."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
	}

	public function importa_parceiros($data)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		foreach ($data as $d)
		{
			$sql = "INSERT INTO parceiros (nome, email, telefone, empresa_id) 
			VALUES('".$d['nome']."', '".$d['email']."', '".$d['telefone']."', '".$d['empresa_id']."')";
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->exec($sql);
		}
	}

	public function pega_salto($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT salto FROM companhia WHERE id='".$empresa_id."';")->fetchAll();
		$salto = $data[0]['salto'];
		return $salto;
	}

	public function atualiza_salto($salto, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE companhia SET salto='".$salto."' WHERE id='".$empresa_id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
	}

	public function chats_nao_lidos()
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT c.*, DATE_FORMAT(c.data_cadastro,'%d/%m/%Y %H:%H') as 'data_cadastro', u.nome as 'nome_usuario1'  
			FROM chat c JOIN usuarios u ON (u.id = c.usuario1) JOIN companhia cc ON (u.empresa_id = cc.id)
			WHERE c.usuario2=43 AND c.lido=0;")->fetchAll();
		return $data;
	}

	public function verifica_log($usuario_id)
	{
		$mes = date("m");
		$ano = date("Y");
		$condicao1 = $ano."-".$mes."-01 00:00:00";
		$condicao2 = $ano."-".$mes."-31 23:59:59";

		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM log
			WHERE usuario_id='".$usuario_id."' AND data_cadastro>='".$condicao1."' AND data_cadastro<='".$condicao2."';")->fetchAll();
		return $data;
	}

	public function verifica_log_relatorios($usuario_id)
	{
		$mes = date("m");
		$ano = date("Y");
		$condicao1 = $ano."-".$mes."-01 00:00:00";
		$condicao2 = $ano."-".$mes."-31 23:59:59";

		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM log
			WHERE acao LIKE '%Gerou relatorio%' AND usuario_id='".$usuario_id."' AND data_cadastro>='".$condicao1."' AND data_cadastro<='".$condicao2."';")->fetchAll();
		//echo count($data);exit;
		return $data;
	}

	public function lista_campanhas($empresa_id, $tipo)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT id, nome, texto, tipo, DATE_FORMAT(data_cadastro,'%d/%m/%Y %H:%H') as 'data_cadastro'  FROM campanhas WHERE tipo='".$tipo."' AND empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function verifica_crm($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM companhia WHERE id='".$empresa_id."';")->fetchAll();
		foreach ($data as $d){
			$flag_crm = $d['flag_crm'];
		}
		return $flag_crm;
	}

	public function nova_campanha($nome, $texto, $tipo, $empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "INSERT INTO campanhas (nome, texto, tipo, empresa_id) 
		VALUES('".$nome."', '".$texto."', '".$tipo."', '".$empresa_id."')";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Cadastrou nova campanha", "Nome: ".$nome);
	}

	public function pega_campanha($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM campanhas WHERE id='".$id."';")->fetchAll();
		return $data;
	}

	public function atualiza_campanha($nome, $texto, $tipo, $id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE campanhas SET nome='".$nome."', texto='".$texto."', tipo='".$tipo."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Atualizou dados da campanha", "ID da campanha: ".$id);
	}

	public function deleta_campanha($id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "DELETE FROM campanhas WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
		$this->gera_log("Deletou campanha", "-------");
	}

	public function lista_clientes($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM clientes WHERE empresa_id='".$empresa_id."';")->fetchAll();
		return $data;
	}

	public function pega_ultimo_usuario($empresa_id)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT MAX(id) as 'id' FROM usuarios WHERE empresa_id='".$empresa_id."';")->fetchAll();
		foreach ($data as $d){
			$id = $d['id'];
		}
		return $id;
	}

	public function lista_leads()
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$data = $pdo->query("SELECT * FROM contato_lead")->fetchAll();
		return $data;
	}

	public function atualiza_status_lead($id, $status)
	{
		$conexao = new Conexao();
		$pdo = new PDO('mysql:host='.$conexao->host.':'.$conexao->port.';dbname='.$conexao->dbname.'', ''.$conexao->user.'', ''.$conexao->password.'');
		$sql = "UPDATE contato_lead SET status='".$status."' WHERE id='".$id."';";
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->exec($sql);
	}
}
?>