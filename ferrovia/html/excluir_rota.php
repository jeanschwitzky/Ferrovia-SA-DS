<?php

require_once('bd.php');

$codigo = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM rotas WHERE pk_rota = ?");
$stmt->bind_param("i", $codigo);

if ($stmt->execute()) {
    header("Location: gestao.php");
    exit;
} else {
    echo "Erro ao excluir a rota: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>