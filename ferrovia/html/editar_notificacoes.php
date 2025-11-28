<?php
require_once('bd.php');
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

$pk_notificacao = $_POST['pk_notificacao'] ?? '';
$nome_notificacao = $_POST['nome_notificacao'] ?? '';
$localizacao_notificacao = $_POST['localizacao_notificacao'] ?? '';
$problema_notificacao = $_POST['problema_notificacao'] ?? '';
$data_notificacao = $_POST['data_notificacao'] ?? '';
$hora_notificacao = $_POST['hora_notificacao'] ?? '';

$stmt = $conn->prepare("UPDATE notificacoes SET nome_notificacao = ?, localizacao_notificacao = ?, problema_notificacao = ?, data_notificacao = ?, hora_notificacao = ? WHERE pk_notificacao = ?");
$stmt->bind_param("sssssi", $nome_notificacao, $localizacao_notificacao, $problema_notificacao, $data_notificacao, $hora_notificacao, $pk_notificacao);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: notificacoes.php?sucesso=editado");
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