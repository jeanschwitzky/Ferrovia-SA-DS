<?php
require_once('bd.php');

session_start();

$nome_notificacao = $_POST['nome_notificacao'] ?? '';

$stmt = $conn->prepare("INSERT INTO notificacoes (nome_notificacao) VALUES (?)");
$stmt->bind_param("s", $nome_notificacao);

if ($stmt->execute()) {
    header("Location: login.php?sucesso=1");
} else {
    $_SESSION['erro'] = "Erro ao inserir notificação. Tente novamente mais tarde.";
    header("Location: registro.php");
}

$stmt->close();
$conn->close();
?>