<?php
require_once('bd.php');
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

$pk_usuario = $_POST['pk_usuario'] ?? '';
$nome_usuario = trim($_POST['nome_usuario'] ?? '');
$email_usuario = trim($_POST['email_usuario'] ?? '');
$senha_usuario = trim($_POST['senha_usuario'] ?? '');
$data_nascimento_usuario = trim($_POST['data_nascimento_usuario'] ?? '');
$genero_usuario = trim($_POST['genero_usuario'] ?? '');
$cpf_usuario = trim($_POST['cpf_usuario'] ?? '');
$endereco_usuario = trim($_POST['endereco_usuario'] ?? '');

$senha_hash = password_hash($senha_usuario, PASSWORD_DEFAULT);


$stmt = $conn->prepare("UPDATE usuario SET nome_usuario = ?, email_usuario = ?, senha_usuario = ?, data_nascimento_usuario = ?, genero_usuario = ?, cpf_usuario = ?, endereco_usuario = ? WHERE pk_usuario = ?");
$stmt->bind_param("sssssssi", $nome_usuario, $email_usuario, $senha_hash, $data_nascimento_usuario, $genero_usuario, $cpf_usuario, $endereco_usuario, $pk_usuario);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        $_SESSION["nome_usuario"] = $nome_usuario;
        $_SESSION["email_usuario"] = $email_usuario;
        $_SESSION["senha_usuario"] = $senha_hash;
        $_SESSION["data_nascimento_usuario"] = $data_nascimento_usuario;
        $_SESSION["genero_usuario"] = $genero_usuario;
        $_SESSION["cpf_usuario"] = $cpf_usuario;
        $_SESSION["endereco_usuario"] = $endereco_usuario;
        header("Location: perfil.php?sucesso=editado");
        exit;
    } else {
        echo "Nenhuma alteração realizada. Verifique se a atividade existe e pertence a turma.";
    }
} else {
    echo "Erro ao editar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>