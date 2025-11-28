<?php

require_once('bd.php');

$codigo = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM relatorios WHERE pk_relatorio = ?");
$stmt->bind_param("i", $codigo);

if ($stmt->execute()) {
    header("Location: relatorios.php");
    exit;
} else {
    echo "Erro ao excluir a relatorio: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>