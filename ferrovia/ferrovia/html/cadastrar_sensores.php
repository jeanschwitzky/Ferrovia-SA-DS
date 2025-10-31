<?php
require_once('bd.php');

session_start();

$tipo_sensor = $_POST['tipo_sensor'] ?? '';
$localizacao_sensor = $_POST['localizacao_sensor'] ?? '';
$status_sensor = $_POST['status_sensor'] ?? '';
$data_instalacao = $_POST['data_instalacao'] ?? '';


$stmt = $conn->prepare("INSERT INTO sensores (tipo_sensor, localizacao_sensor, status_sensor, data_instalacao) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $tipo_sensor, $localizacao_sensor, $status_sensor, $data_instalacao);

if ($stmt->execute()) {
    header("Location: sensores.php");
} else {
    echo $_SESSION['erro'] = "Erro ao inserir relatório. Tente novamente mais tarde.";
    
}

$stmt->close();


$check->close();
$conn->close();
?>