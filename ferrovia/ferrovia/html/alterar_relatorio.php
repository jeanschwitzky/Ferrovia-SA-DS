<?php
session_start();

require_once('bd.php');

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

$codigo = $_GET['codigo'] ?? '';
$stmt = $conn->prepare("SELECT * FROM relatorios WHERE pk_relatorio = ?");
$stmt->bind_param("i", $codigo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Turma não encontrada.";
    exit;
}

$relatorio = $resultado->fetch_assoc();

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/editar_notificacoes.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Ferrovia</title>
</head>

<body>
    <header>
        <div id="cabecalho">
            <nav>
                <ul id="menu">

                    <a class="bi bi-list" id="menuToggle"></a>
                    <div id="titulo">
                        <h1>Editar Relatório</h1>
                    </div>
                    <div class="bem-vindo">
                        <a class="bi bi-person-circle" href="perfil.php"></a>
                        <?php
                        echo "<p>Bem-vindo, " . htmlspecialchars($_SESSION["nome_usuario"]) . "!</p>";

                        ?>
                        <a href="sair.php">
                            <input type="button" value="Sair" event="sair.php" class="sair-button">
                        </a>
                    </div>

                </ul>
            </nav>
        </div>
        <div id="side-menu">
        <ul class="menu-list">
            <a class="menu-item" href="perfil.php">Perfil</a>
            <a class="menu-item" href="dashboard.php">Dashboard Geral</a>
            <a class="menu-item" href="notificacoes.php">Notificações</a>
            <a class="menu-item" href="manutencao.php">Manutenção</a>
            <a class="menu-item" href="gestao.php">Gestão de Rotas</a>
            <a class="menu-item" href="relatorios.php">Relatórios e Análises</a>
            <a class="menu-item" href="sensores.php">Sensores</a>
            <a class="menu-item" href="trem.php">Trem</a>
        </ul>
    </div>
    </header>

    <main>
        <section class="conteudo">
            <form action="editar_relatorio.php" method="POST"
                onsubmit="return confirm('Deseja realmente salvar as alterações?')">

                <input type="hidden" name="pk_relatorio" value="<?php echo $relatorio["pk_relatorio"]; ?>">

                <div class="linha-campo">
                    <i class="bi bi-card-heading"></i>
                    <input type="text" name="nome_relatorio" required value="<?php echo $relatorio["nome_relatorio"]; ?>" />
                </div>

                <div class="linha-campo">
                    <i class="bi bi-box-arrow-in-down"></i>
                    <input type="file" name="arquivo_relatorio" required
                        value="<?php echo $relatorio["arquivo_relatorio"]; ?>" />
                </div>

                <div class="linha-campo">
                    <i class="bi bi-alphabet"></i>
                    <input type="text" name="conteudo_relatorio" required
                        value="<?php echo $relatorio["conteudo_relatorio"]; ?>" />
                </div>

                <div class="linha-campo">
                    <i class="bi bi-bullseye"></i>
                    <input type="date" name="data_relatorio" required
                        value="<?php echo $relatorio["data_relatorio"]; ?>" />
                </div>

                <div class="linha-campo">
                    <i class="bi bi-alarm"></i>
                    <input type="time" name="hora_relatorio" required
                        value="<?php echo $relatorio["hora_relatorio"]; ?>" />
                </div>

                <div class="linha-campo_botao">
                    <div class="botao_salvar">
                        <input class="botão_salvar" type="submit" value="Salvar">
                    </div>
                    <div class="botao_cancelar">
                        <a href="relatorio.php"><input class="botao_excluir" type="button" value="Cancelar"></a>
                    </div>


            </form>
        </section>

    </main>

    <script src="../js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>