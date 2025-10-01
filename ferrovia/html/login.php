<?php
require "bd.php";

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");

session_start();

if (isset($_SESSION["nome_usuario"])) {
    header("Location: dashboard.php");
    exit;
}

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $senha = trim($_POST["senha"] ?? "");

    $stmt = $conn->prepare("SELECT pk_usuario, nome_usuario, email_usuario, senha_usuario, data_nascimento_usuario, genero_usuario, cpf_usuario, endereco_usuario FROM usuario WHERE email_usuario = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $dados = $resultado->fetch_assoc();

        if (password_verify($senha, $dados["senha_usuario"])) {
            $_SESSION["nome_usuario"] = $dados["nome_usuario"];
            $_SESSION["usuario_id"] = $dados["pk_usuario"];
            $_SESSION["email_usuario"] = $dados["email_usuario"];
            $_SESSION["data_nascimento_usuario"] = $dados["data_nascimento_usuario"];
            $_SESSION["genero_usuario"] = $dados["genero_usuario"];
            $_SESSION["cpf_usuario"] = $dados["cpf_usuario"];
            $_SESSION["endereco_usuario"] = $dados["endereco_usuario"];

            $_SESSION["conectado"] = true;

            header("Location: dashboard.php");
            exit;
        } else {
            $erro = "E-mail ou senha inválidos.";
        }
    } else {
        $erro = "E-mail ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Login</title>
</head>

<body>
    <script>alert(<?php echo $_SESSION['conectado'] ?>)</script>
    <header>
        <div id="cabecalho">
            <nav>
                <ul id="menu">


                </ul>
            </nav>
        </div>

    </header>
    <main>
        <section class="conteudo">
            <div class="icone">
                <i class="bi bi-person-circle"></i>
            </div>
            <form action="#" method="post" autocomplete="off">
                <div class="adicionar">
                    <div class="prencher">
                        <label for="email"><i class="bi bi-person-circle"></i></label>
                        <input type="email" id="email" name="email" required placeholder="Email">
                    </div>
                    <div class="prencher">
                        <label for="senha"><i class="bi bi-lock-fill"></i></label>
                        <input type="password" id="senha" name="senha" minlength="8" required placeholder="Senha">
                    </div>

                </div>

                <button type="submit" class="botao-logar">Logar </button>
                <?php if ($erro): ?>
                    <div class="erro"><?= htmlspecialchars($erro) ?></div>
                <?php endif; ?>

            </form>

        </section>

        <div class="cadastrar">
            <p>Não tem conta ainda? <a href="registro.php">Cadastre-se aqui!</a></p>
        </div>
    </main>

    <script src="../js/validacao.js"></script>
</body>


</html>