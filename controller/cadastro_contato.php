<?php

require("../vendor/PHPMailer/src/PHPMailer.php");
require("../vendor/PHPMailer/src/SMTP.php");
require("../vendor/PHPMailer/src/Exception.php");


include("../model/config.php");
$config = new Config();

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];


//verifica se o email utilizado ja esta ou não cadastrado
$verifica = $config->verifica_usuario($email);




if($verifica)
{
	//informa para o usuario uma mensagem e redireciona ele para a tela de contato
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Desculpe, esse e-mail já esta cadastrado. Tente novamente por favor.')
		window.location.href='../contato.php';
		</SCRIPT>");
}


if($senha != $senha2)
{
	//informa para o usuario uma mensagem e redireciona ele para a tela de contato
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Desculpe, as senhas não coincidem. Tente novamente por favor.')
		window.location.href='../contato.php';
		</SCRIPT>");
}


//se o email não estiver cadastrado e as senhas forem iguais
if(!$verifica && ($senha == $senha2) )
{
	//cadastra na tabela de leads e cadastra um novo usuário
	$config->novo_contato($nome, $email, $telefone);
	$config->novo_usuario($nome, $email, $senha, $email, '1');
	$usuario_id = $config->pega_ultimo_usuario(1);

	//inicializo as variáveis da session
	session_start();
	$_SESSION["empresa_id"] = 1;
	$_SESSION["nome_usuario"] = $nome;
	$_SESSION["username_usuario"] = $email;
	$_SESSION["usuario_id"] = $usuario_id;
	$_SESSION["url_inicial"] = 'inicial';

	//envia um email para o usuario com os dados de acesso
	$Mailer2 = new PHPMailer\PHPMailer\PHPMailer();
	$Mailer2->IsSMTP(); //protocolo SMTP
	$Mailer2->isHTML(true);
	$Mailer2->Charset = 'UTF-8'; //codificação para caracteres especiais
	$Mailer2->SMTPAuth = true;
	$Mailer2->SMTPSecure = 'ssl';
	$Mailer2->Host='smtp.gmail.com'; //nome do servidor
	$Mailer2->Port=465; //porta de saída
	$Mailer2->Username = 'plataforma.sbg@gmail.com';
	$Mailer2->Password = 'G@briel1995';
	$Mailer2->From = 'plataforma.sbg@gmail.com';
	$Mailer2->FromName = 'Plataforma SBG';
	$Mailer2->Subject = '[SBG] Seja bem-vindo(a), '.strtolower($nome);
	$texto2 = "<b>Voce se cadastrou na plataforma SBG: um sistema de gestao para a sua clinica ou consultorio</b><br>Segue abaixo seus dados de acesso:<br><br><br>E-mail: ".$email."<br>Senha: ".$senha."<br>Link de acesso: <a href='http://barban.ddns.net/sbg/index.php'>http://barban.ddns.net/sbg/index.php</a><br><br><br><i>E-mail enviado atraves do Assistente inteligente da Plataforma</i>";
	$Mailer2->Body = $texto2;
	$Mailer2->addAddress($email);

	if($Mailer2->Send()){
		echo "E-mail enviado com sucesso";
	}else{
		echo "E-mail não pôde ser enviado... ERRO: ".$Mailer2->ErrorInfo;
	}

	//envia um email para o SBG com os dados do novo LEAD
	$Mailer = new PHPMailer\PHPMailer\PHPMailer();
	$Mailer->IsSMTP(); //protocolo SMTP
	$Mailer->isHTML(true);
	$Mailer->Charset = 'UTF-8'; //codificação para caracteres especiais
	$Mailer->SMTPAuth = true;
	$Mailer->SMTPSecure = 'ssl';
	$Mailer->Host='smtp.gmail.com'; //nome do servidor
	$Mailer->Port=465; //porta de saída
	$Mailer->Username = 'plataforma.sbg@gmail.com';
	$Mailer->Password = 'G@briel1995';
	$Mailer->From = 'plataforma.sbg@gmail.com';
	$Mailer->FromName = 'Plataforma SBG';
	$Mailer->Subject = '[SBG] NOVO LEAD';
	$texto = "<b>Eaí, tudo bem?</b><br>Segue abaixo as informacoes do novo LEAD que acabou de se cadastrar:<br><br><br>Nome: ".$nome."<br>E-mail: ".$email."<br>Telefone: ".$telefone."<br><br><br><i>E-mail enviado através do Assistente inteligente da Plataforma</i>";
	$Mailer->Body = $texto;
	$Mailer->addAddress('barbangabriel@gmail.com');
	$Mailer->addAddress('leguedesmello@gmail.com');
	$Mailer->addAddress('kadu.doro@gmail.com');

	if($Mailer->Send()){
		echo "E-mail enviado com sucesso";
	}else{
		echo "E-mail não pôde ser enviado... ERRO: ".$Mailer->ErrorInfo;
	}

	//informa para o usuario uma mensagem e redireciona ele para a tela inicial de cadastro
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Obrigado por se cadastrar, em breve nossa equipe entrará em contato com você :)')
		window.location.href='../view/inicial.php';
		</SCRIPT>");

}


?>
