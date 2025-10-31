<?php
require_once('bd.php');

session_start();

$nome_trem = $_POST['nome_trem'] ?? '';
$data_operacao = $_POST['data_operacao'] ?? '';
$capacidade_trem = $_POST['capacidade_trem'] ?? '';
$velocidade_trem = $_POST['velocidade_trem'] ?? '';
$fabricante_trem = $_POST['fabricante_trem'] ?? '';
$observacoes_trem = $_POST['observacoes_trem'] ?? '';


$stmt = $conn->prepare("INSERT INTO trem (nome_trem, data_operacao, capacidade_trem, velocidade_trem, fabricante_trem, observacoes_trem) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nome_trem, $data_operacao, $capacidade_trem, $velocidade_trem, $fabricante_trem, $observacoes_trem);

if ($stmt->execute()) {
    header("Location: trem.php");
} else {
    echo $_SESSION['erro'] = "Erro ao inserir relatório. Tente novamente mais tarde.";
    header("Location: trem.php");
}

$stmt->close();


$check->close();
$conn->close();
?>