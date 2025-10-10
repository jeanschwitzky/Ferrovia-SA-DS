<?php
ob_clean();
header('Content-Type: application/json');

include 'bd.php';

$sql = "SELECT pk_sensor, tipo_sensor, localizacao_sensor, status_sensor, data_instalacao FROM sensores";
$resultado = $conn->query($sql);

$sensor = array();

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        $sensor[] = $linha;
    }
}

$conn->close();

echo json_encode($sensor);