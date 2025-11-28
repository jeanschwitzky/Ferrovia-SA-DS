<?php
require_once('bd.php');
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

$pk_relatorio = $_POST['pk_relatorio'] ?? '';
$nome_relatorio = $_POST['nome_relatorio'] ?? '';
$arquivo_relatorio = $_POST['arquivo_relatorio'] ?? '';
$conteudo_relatorio = $_POST['conteudo_relatorio'] ?? '';
$chegada_rota = $_POST['chegada_rota'] ?? '';
$data_relatorio = $_POST['data_relatorio'] ?? '';
$hora_relatorio = $_POST['hora_relatorio'] ?? '';

$stmt = $conn->prepare("UPDATE relatorios SET nome_relatorio = ?, arquivo_relatorio = ?, conteudo_relatorio = ?,  data_relatorio = ?, hora_relatorio = ? WHERE pk_relatorio = ?");
$stmt->bind_param("sssssi", $nome_relatorio, $arquivo_relatorio, $conteudo_relatorio, $data_relatorio, $hora_relatorio, $pk_relatorio);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: relatorios.php?sucesso=editado");
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