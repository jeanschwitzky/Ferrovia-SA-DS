<?php
require_once('bd.php');
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

$pk_trem = $_POST['pk_trem'] ?? '';
$nome_trem = $_POST['nome_trem'] ?? '';
$data_operacao = $_POST['data_operacao'] ?? '';
$capacidade_trem = $_POST['capacidade_trem'] ?? '';
$velocidade_trem = $_POST['velocidade_trem'] ?? '';
$fabricante_trem = $_POST['fabricante_trem'] ?? '';
$observacoes_trem = $_POST['observacoes_trem'] ?? '';

$stmt = $conn->prepare("UPDATE trem SET nome_trem = ?, data_operacao = ?, capacidade_trem = ?, velocidade_trem = ?, fabricante_trem = ?, observacoes_trem = ? WHERE pk_trem = ?");
$stmt->bind_param("ssssssi", $nome_trem, $data_operacao, $capacidade_trem, $velocidade_trem, $fabricante_trem, $observacoes_trem, $pk_trem);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: trem.php?sucesso=editado");
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