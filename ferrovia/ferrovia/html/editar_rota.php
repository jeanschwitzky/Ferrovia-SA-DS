<?php
require_once('bd.php');
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

$pk_rota = $_POST['pk_rota'] ?? '';
$nome_rota = $_POST['nome_rota'] ?? '';
$status_rota = $_POST['status_rota'] ?? '';
$partida_rota = $_POST['partida_rota'] ?? '';
$chegada_rota = $_POST['chegada_rota'] ?? '';
$data_rota = $_POST['data_rota'] ?? '';
$hora_rota = $_POST['hora_rota'] ?? '';

$stmt = $conn->prepare("UPDATE rotas SET nome_rota = ?, status_rota = ?, partida_rota = ?, chegada_rota = ?, data_rota = ?, hora_rota = ? WHERE pk_rota = ?");
$stmt->bind_param("ssssssi", $nome_rota, $status_rota, $partida_rota, $chegada_rota, $data_rota, $hora_rota, $pk_rota);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: gestao.php?sucesso=editado");
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