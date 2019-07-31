<?php
    session_start();
    header("Content-type: application/vnd.ms-excel");
    header("Content-type: application/force-download");
    header("Content-Disposition: attachment; filename=usuarios.xls");
    header("Pragma: no-cache");
?>
<table>
    <tr>
        <td>NOME</td>
        <td>EMAIL</td>
        <td>USUARIO</td>
    </tr>
<?php
    include("../model/config.php");
    $config = new Config();
    $empresa_id = $_SESSION["empresa_id"];
    $data = array();
    $data=$config->lista_usuarios($empresa_id);

    foreach ($data as $row) {
        echo "<tr><td>".$row['nome']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['usuario']."</td></tr>";
    }
?>
</table>