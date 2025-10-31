<?php
ob_clean();
header('Content-Type: application/json');

include 'bd.php';

$sql = "SELECT pk_relatorio, nome_relatorio, arquivo_relatorio, conteudo_relatorio, data_relatorio, hora_relatorio FROM relatorios";
$resultado = $conn->query($sql);

$relatorio = array();

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        $relatorio[] = $linha;
    }
}

$conn->close();

echo json_encode($relatorio);