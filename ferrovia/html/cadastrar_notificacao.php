<?php
require_once('bd.php');

session_start();

$nome_notificacao = $_POST['nome_notificacao'] ?? '';
$localizacao_notificacao = $_POST['localizacao_notificacao'] ?? '';
$problema_notificacao = $_POST['problema_notificacao'] ?? '';
$data_notificacao = $_POST['data_notificacao'] ?? '';
$hora_notificacao = $_POST['hora_notificacao'] ?? '';


$stmt = $conn->prepare("INSERT INTO notificacoes (nome_notificacao, localizacao_notificacao, problema_notificacao, data_notificacao, hora_notificacao) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nome_notificacao, $localizacao_notificacao, $problema_notificacao, $data_notificacao, $hora_notificacao);

if ($stmt->execute()) {
    header("Location: notificacoes.php");
} else {
    $_SESSION['erro'] = "Erro ao inserir notificação. Tente novamente mais tarde.";
    header("Location: notificacoes.php");
}

$stmt->close();


$check->close();
$conn->close();
?>