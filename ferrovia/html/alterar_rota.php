<?php
session_start();

require_once('bd.php');

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

$codigo = $_GET['codigo'] ?? '';
$stmt = $conn->prepare("SELECT * FROM rotas WHERE pk_rota = ?");
$stmt->bind_param("i", $codigo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "Turma não encontrada.";
    exit;
}

$rota = $resultado->fetch_assoc();

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
                        <h1>Editar Rota</h1>
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
            <form action="editar_rota.php" method="POST"
                onsubmit="return confirm('Deseja realmente salvar as alterações?')">

                <input type="hidden" name="pk_rota" value="<?php echo $rota["pk_rota"]; ?>">

                <div class="linha-campo">
                    <i class="bi bi-train-front-fill"></i>
                    <input type="text" name="nome_rota" required value="<?php echo $rota["nome_rota"]; ?>" />
                </div>

                <div class="linha-campo">
                    <i class="bi bi-hourglass"></i>
                    <select name="status_rota" required value="<?php echo $rota["status_rota"]; ?>">
                        <option value="Em Andamento">Em Andamento</option>
                        <option value="Não Iniciada">Não Iniciada</option>
                        <option value="Concluída">Concluída</option>
                        
                    </select>
                </div>

                <div class="linha-campo">
                    <i class="bi bi-flag"></i>
                    <input type="text" name="partida_rota" required
                        value="<?php echo $rota["partida_rota"]; ?>" />
                </div>

                <div class="linha-campo">
                    <i class="bi bi-flag-fill"></i>
                    <input type="text" name="chegada_rota" required
                        value="<?php echo $rota["chegada_rota"]; ?>" />
                </div>

                <div class="linha-campo">
                    <i class="bi bi-calendar-check-fill"></i>
                    <input type="date" name="data_rota" required
                        value="<?php echo $rota["data_rota"]; ?>" />
                </div>

                <div class="linha-campo">
                    <i class="bi bi-alarm"></i>
                    <input type="time" name="hora_rota" required
                        value="<?php echo $rota["hora_rota"]; ?>" />
                </div>

                <div class="linha-campo_botao">
                    <div class="botao_salvar">
                        <input class="botão_salvar" type="submit" value="Salvar">
                    </div>
                    <div class="botao_cancelar">
                        <a href="gestao.php"><input class="botao_excluir" type="button" value="Cancelar"></a>
                    </div>


            </form>
        </section>

    </main>

    <script src="../js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>