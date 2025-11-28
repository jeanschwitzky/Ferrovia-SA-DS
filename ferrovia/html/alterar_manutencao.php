<?php
session_start();

require_once('bd.php');

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

$codigo = $_GET['codigo'] ?? '';
$stmt = $conn->prepare("SELECT * FROM manutencao WHERE pk_manutencao = ?");
$stmt->bind_param("i", $codigo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Turma não encontrada.";
    exit;
}

$manutencao = $resultado->fetch_assoc();

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
                        <h1>Editar Manutenção</h1>
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
            <form action="editar_manutencao.php" method="POST"
                onsubmit="return confirm('Deseja realmente salvar as alterações?')">

                <input type="hidden" name="pk_manutencao" value="<?php echo $manutencao["pk_manutencao"]; ?>">

                <div class="linha-campo">
                    <i class="bi bi-card-heading"></i>
                    <input type="text" name="nome_trem" required value="<?php echo $manutencao["nome_trem"]; ?>" />
                </div>

                <div class="linha-campo">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <input type="text" name="problema_manutencao" required
                        value="<?php echo $manutencao["problema_manutencao"]; ?>" />
                </div>

                <div class="linha-campo">
                    <i class="bi bi-calendar-check-fill"></i>
                    <input type="date" name="data_inicio_manutencao" required
                        value="<?php echo $manutencao["data_inicio_manutencao"]; ?>" />
                </div>

                <div class="linha-campo">
                    <i class="bi bi-calendar-check-fill"></i>
                    <input type="date" name="data_termino_manutencao" required
                        value="<?php echo $manutencao["data_termino_manutencao"]; ?>" />
                </div>

                <div class="linha-campo">
                    <i class="bi bi-clock-history"></i>
                    <select name="status_manutencao" required value="<?php echo $manutencao["status_manutencao"]; ?>">
                        <option value="Em Andamento">Em Andamento</option>
                        <option value="Não Iniciada">Não Iniciada</option>
                        <option value="Concluída">Concluída</option>
                        <option value="Em atraso">Em atraso</option>
                    </select>
                </div>

                <div class="linha-campo_botao">
                    <div class="botao_salvar">
                        <input class="botão_salvar" type="submit" value="Salvar">
                    </div>
                    <div class="botao_cancelar">
                        <a href="manutencao.php"><input class="botao_excluir" type="button" value="Cancelar"></a>
                    </div>


            </form>
        </section>

    </main>

    <script src="../js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>