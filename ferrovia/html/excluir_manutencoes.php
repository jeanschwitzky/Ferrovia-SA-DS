<?php

require_once('bd.php');

$codigo = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM manutencao WHERE pk_manutencao = ?");
$stmt->bind_param("i", $codigo);

if ($stmt->execute()) {
    header("Location: manutencao.php");
    exit;
} else {
    echo "Erro ao excluir a manutencao: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>