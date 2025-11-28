<?php

require_once('bd.php');

$codigo = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM trem WHERE pk_trem = ?");
$stmt->bind_param("i", $codigo);

if ($stmt->execute()) {
    header("Location: trem.php");
    exit;
} else {
    echo "Erro ao excluir o trem: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>