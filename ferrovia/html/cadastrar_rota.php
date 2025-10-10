<?php
require_once('bd.php');

session_start();

$nome_rota = $_POST['nome_rota'] ?? '';
$status_rota = $_POST['status_rota'] ?? '';
$partida_rota = $_POST['partida_rota'] ?? '';
$chegada_rota = $_POST['chegada_rota'] ?? '';
$data_rota = $_POST['data_rota'] ?? '';
$hora_rota = $_POST['hora_rota'] ?? '';


$stmt = $conn->prepare("INSERT INTO rotas (nome_rota, status_rota, partida_rota, chegada_rota, data_rota, hora_rota) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nome_rota, $status_rota, $chegada_rota, $partida_rota, $data_rota, $hora_rota);

if ($stmt->execute()) {
    header("Location: gestao.php");
} else {
    $_SESSION['erro'] = "Erro ao inserir rota. Tente novamente mais tarde.";
    header("Location: gestao.php");
}

$stmt->close();


$check->close();
$conn->close();
?>