<?php

require_once('bd.php');

$codigo = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM sensores WHERE pk_sensor = ?");
$stmt->bind_param("i", $codigo);

if ($stmt->execute()) {
    header("Location: sensores.php");
    exit;
} else {
    echo "Erro ao excluir a sensor: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>