<?php
ob_clean();
header('Content-Type: application/json');

include 'bd.php';

$sql = "SELECT pk_trem, nome_trem, data_operacao, capacidade_trem, velocidade_trem , fabricante_trem, observacoes_trem FROM trem";
$resultado = $conn->query($sql);

$trem = array();

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        $trem[] = $linha;
    }
}

$conn->close();

echo json_encode($trem);