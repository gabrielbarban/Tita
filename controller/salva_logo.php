<?php

session_start();
include("../model/config.php");
$config = new Config();

$nome = $_POST['arquivo'];
$empresa_id = $_SESSION["empresa_id"];

if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
    echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'arquivo' ][ 'name' ] . '</strong><br />';
    echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'arquivo' ][ 'type' ] . ' </strong ><br />';
    echo 'Temporáriamente foi salvo em: <strong>' . $_FILES[ 'arquivo' ][ 'tmp_name' ] . '</strong><br />';
    echo 'Seu tamanho é: <strong>' . $_FILES[ 'arquivo' ][ 'size' ] . '</strong> Bytes<br /><br />';
 
    $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
    $nome = $_FILES[ 'arquivo' ][ 'name' ];
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
    $extensao = strtolower ( $extensao );
    if ( strstr ( '.png', $extensao ) ) {
        $novoNome = "logo-".$empresa_id.".".$extensao;
        $destino = "../uploads/" . $novoNome;
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Logo alterado com sucesso!')
					window.location.href='../view/config_logo.php';
					</SCRIPT>");
        }
        else
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita. Entre em contato com o suporte.')
                    window.location.href='../view/config_logo.php';
                    </SCRIPT>");
    }
    else
        echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Você poderá enviar apenas arquivos .PNG')
                    window.location.href='../view/config_logo.php';
                    </SCRIPT>");
}
else
    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.alert('Você não enviou nenhum arquivo.')
                    window.location.href='../view/config_logo.php';
                    </SCRIPT>");

?>