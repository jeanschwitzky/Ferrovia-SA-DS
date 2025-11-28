<?php
require_once('bd.php');
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

$pk_sensor = $_POST['pk_sensor'] ?? '';
$tipo_sensor = $_POST['tipo_sensor'] ?? '';
$localizacao_sensor = $_POST['localizacao_sensor'] ?? '';
$status_sensor = $_POST['status_sensor'] ?? '';
$data_instalacao = $_POST['data_instalacao'] ?? '';

$stmt = $conn->prepare("UPDATE sensores SET tipo_sensor = ?, localizacao_sensor = ?, status_sensor = ?, data_instalacao = ? WHERE pk_sensor = ?");
$stmt->bind_param("ssssi", $tipo_sensor, $localizacao_sensor, $status_sensor, $data_instalacao, $pk_sensor);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: sensores.php?sucesso=editado");
        exit;
    } else {
        echo "Nenhuma alteração realizada.";
    }
} else {
    echo "Erro ao editar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>