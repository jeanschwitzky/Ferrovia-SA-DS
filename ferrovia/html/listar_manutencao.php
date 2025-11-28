<?php
ob_clean();
header('Content-Type: application/json');

include 'bd.php';

$sql = "SELECT pk_manutencao, nome_trem, problema_manutencao, data_inicio_manutencao, data_termino_manutencao, status_manutencao FROM manutencao";
$resultado = $conn->query($sql);

$manutencao = array();

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        $manutencao[] = $linha;
    }
}

$conn->close();

echo json_encode($manutencao);