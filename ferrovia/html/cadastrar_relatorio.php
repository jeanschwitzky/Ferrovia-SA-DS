<?php
require_once('bd.php');

session_start();

$diretorio = "uploads/";

if (!is_dir($diretorio)) {
    mkdir($diretorio, 0755, true);
}

$nome_original = basename($_FILES["arquivo_relatorio"]["name"]);
$novo_nome = time() . "_" . $original_name;
$arquivo_alvo = $diretorio . $novo_nome;

$nome_relatorio = $_POST['nome_relatorio'] ?? '';
$arquivo_relatorio = $_POST['arquivo_relatorio'] ?? '';
$conteudo_relatorio = $_POST['conteudo_relatorio'] ?? '';
$data_relatorio = $_POST['data_relatorio'] ?? '';
$hora_relatorio = $_POST['hora_relatorio'] ?? '';

if (move_uploaded_file($_FILES["arquivo_relatorio"]["tmp_name"], $arquivo_alvo)) {
    $stmt = $conn->prepare("INSERT INTO relatorios (nome_relatorio, arquivo_relatorio, conteudo_relatorio, data_relatorio, hora_relatorio) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome_relatorio, $arquivo_alvo, $conteudo_relatorio, $data_relatorio, $hora_relatorio);

    if ($stmt->execute()) {
        header("Location: relatorios.php");
    } else {
        echo $_SESSION['erro'] = "Erro ao inserir relatório. Tente novamente mais tarde.";
        header("Location: relatorios.php");
    }
}

$stmt->close();


$check->close();
$conn->close();
?>