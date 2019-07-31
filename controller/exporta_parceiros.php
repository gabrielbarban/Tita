<?php
    session_start();
    header("Content-type: application/vnd.ms-excel");
    header("Content-type: application/force-download");
    header("Content-Disposition: attachment; filename=parceiros.xls");
    header("Pragma: no-cache");
?>
<table>
    <tr>
        <td>NOME</td>
        <td>EMAIL</td>
        <td>TELEFONE</td>
    </tr>
<?php
    include("../model/config.php");
    $config = new Config();
    $empresa_id = $_SESSION["empresa_id"];
    $data = array();
    $data=$config->lista_parceiros($empresa_id);

    foreach ($data as $row) {
        echo "<tr><td>".$row['nome']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['telefone']."</td></tr>";
    }
?>
</table>