<?php

	session_start();

	require("../PHPMailer/src/PHPMailer.php");
    require("../PHPMailer/src/SMTP.php");
    require("../PHPMailer/src/Exception.php");
    include("../model/config.php");
    $config = new Config();
    //SALTO: +150-11+18-78

    $id_campanha = $_GET['id'];
    //salto =  + 15920 - 350
    $id_campanha = $id_campanha - 15920 + 350;
    $data = array();
    $data = $config->pega_campanha($id_campanha);

    $empresa_id = $_SESSION["empresa_id"];
    $parceiros = $config->lista_parceiros($empresa_id);

    $dados = $config->pega_empresa($empresa_id);
    $nome_companhia = $dados[0]['nome'];

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
		$Mailer->FromName = $nome_companhia;
		$Mailer->Subject = $data[0]['nome'];

		$texto = $data[0]['texto'];

		$Mailer->Body = $texto;

		//adicionando os solicitantes
		foreach ($parceiros as $d) {
			$Mailer->addAddress($d['email']);
        }

		if($Mailer->Send()){
			echo "E-mail enviado com sucesso";
			echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Campanha enviada!')
			window.location.href='crm.php';
			</SCRIPT>");
		}else{
			echo "E-mail não pôde ser enviado... ERRO: ".$Mailer->ErrorInfo;
			echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Campanha não enviada, entre em contato com o suporte.')
			window.location.href='crm.php';
			</SCRIPT>");
		}

?>
