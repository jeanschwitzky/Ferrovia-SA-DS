<?php
    require_once('bd.php');

    session_start();

    $nome = $_POST['nome_usuario'] ?? '';
    $email = $_POST['email_usuario'] ?? '';
    $senha = $_POST['senha_usuario'] ?? '';
    $data_nascimento = $_POST['data_nascimento_usuario'] ?? '';
    $genero = $_POST['genero_usuario'] ?? '';
    $cpf = $_POST['cpf_usuario'] ?? '';
    $endereco = $_POST['endereco_usuario'] ?? '';

    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $senha)) {
        $_SESSION['erro'] = "A senha deve ter no mínimo 8 caracteres, incluindo letras e números.";
        header("Location: registro.php");
        exit;
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT * FROM usuario WHERE email_usuario = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['erro'] = "Este e-mail já está cadastrado.";
        header("Location: registro.php");
    } else {
        $stmt = $conn->prepare("INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario, data_nascimento_usuario, genero_usuario, cpf_usuario, endereco_usuario ) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $nome, $email, $senha_hash, $data_nascimento, $genero, $cpf, $endereco);

        if ($stmt->execute()) {
            header("Location: login.php");
        } else {
            $_SESSION['erro'] = "Erro ao inserir usuário. Tente novamente mais tarde.";
            header("Location: registro.php");
        }

        $stmt->close();
    }

    $check->close();
    $conn->close();
?>