<?php

	require("../vendor/PHPMailer/src/PHPMailer.php");
    require("../vendor//PHPMailer/src/SMTP.php");
    require("../vendor/PHPMailer/src/Exception.php");
    include("../model/config.php");
    $config = new Config();
    $data=$config->chats_nao_lidos();


    if( count($data)>0 )
    {
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
		$Mailer->Subject = '[SBG] Novas mensagens nao lidas de SUPORTE';

		$texto = "Olá Sr. Gabriel Barban, tudo bem?<br>Segue abaixo as novas mensagens que o SUPORTE recebeu:<br><br><br>Usuário: ".$data[0]["nome_usuario1"]."<br>Texto: ".$data[0]["texto"]."<br><br>";

		$Mailer->Body = $texto;
		$Mailer->addAddress('barbangabriel@gmail.com');

		if($Mailer->Send()){
			echo "E-mail enviado com sucesso";
		}else{
			echo "E-mail não pôde ser enviado... ERRO: ".$Mailer->ErrorInfo;
		}
	}


?>
