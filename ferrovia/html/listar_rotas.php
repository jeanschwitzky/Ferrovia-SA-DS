<?php
ob_clean();
header('Content-Type: application/json');

include 'bd.php';

$sql = "SELECT pk_rota, nome_rota, status_rota, partida_rota, chegada_rota, data_rota, hora_rota FROM rotas";
$resultado = $conn->query($sql);

$rota = array();

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        $rota[] = $linha;
    }
}

$conn->close();

echo json_encode($rota);