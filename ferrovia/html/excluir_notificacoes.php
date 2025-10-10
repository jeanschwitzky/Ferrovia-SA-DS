<?php

require_once('bd.php');

$codigo = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM notificacoes WHERE pk_notificacao = ?");
$stmt->bind_param("i", $codigo);

if ($stmt->execute()) {
    header("Location: notificacoes.php");
    exit;
} else {
    echo "Erro ao excluir a notificacao: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>