<?php
require_once('bd.php');
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

$pk_manutencao = $_POST['pk_manutencao'] ?? '';
$nome_trem = $_POST['nome_trem'] ?? '';
$problema_manutencao = $_POST['problema_manutencao'] ?? '';
$data_inicio_manutencao = $_POST['data_inicio_manutencao'] ?? '';
$data_termino_manutencao = $_POST['data_termino_manutencao'] ?? '';
$status_manutencao = $_POST['status_manutencao'] ?? '';

$stmt = $conn->prepare("UPDATE manutencao SET nome_trem = ?, problema_manutencao = ?, data_inicio_manutencao = ?, data_termino_manutencao = ?, status_manutencao = ? WHERE pk_manutencao = ?");
$stmt->bind_param("sssssi", $nome_trem, $problema_manutencao, $data_inicio_manutencao, $data_termino_manutencao, $status_manutencao, $pk_manutencao);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: manutencao.php?sucesso=editado");
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