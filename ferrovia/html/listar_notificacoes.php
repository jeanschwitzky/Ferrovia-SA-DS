<?php
ob_clean();
header('Content-Type: application/json');

include 'bd.php';

$sql = "SELECT pk_notificacao, nome_notificacao, localizacao_notificacao, problema_notificacao, data_notificacao, hora_notificacao FROM notificacoes";
$resultado = $conn->query($sql);

$notificacao = array();

if ($resultado->num_rows > 0) {
    while ($linha = $resultado->fetch_assoc()) {
        $notificacao[] = $linha;
    }
}

$conn->close();

echo json_encode($notificacao);