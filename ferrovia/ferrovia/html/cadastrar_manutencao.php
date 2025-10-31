<?php
require_once('bd.php');

session_start();

$nome_trem = $_POST['nome_trem'] ?? '';
$problema_manutencao = $_POST['problema_manutencao'] ?? '';
$data_inicio_manutencao = $_POST['data_inicio_manutencao'] ?? '';
$data_termino_manutencao = $_POST['data_termino_manutencao'] ?? '';
$status_manutencao = $_POST['status_manutencao'] ?? '';


$stmt = $conn->prepare("INSERT INTO manutencao (nome_trem, problema_manutencao, data_inicio_manutencao, data_termino_manutencao, status_manutencao) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nome_trem, $problema_manutencao, $data_inicio_manutencao, $data_termino_manutencao, $status_manutencao);

if ($stmt->execute()) {
    header("Location: manutencao.php");
} else {
    $_SESSION['erro'] = "Erro ao inserir manutenção. Tente novamente mais tarde.";
    header("Location: manutencao.php");
}

$stmt->close();


$check->close();
$conn->close();
?>