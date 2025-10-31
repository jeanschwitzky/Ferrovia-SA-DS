<?php
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Ferrovia</title>
</head>

<body>
    <header>
        <nav class="main-nav">
            <div class="nav-left">
                <a href="#" class="bi bi-list" id="menuToggle"></a>
            </div>

            <div class="nav-center">
                <h1>Dashboard Geral</h1>
            </div>

            <div class="nav-right">
                <a class="bi bi-person-circle" href="perfil.php" title="Ver Perfil"></a>
                <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION["nome_usuario"] ); ?>!</p>
                <a href="sair.php" class="sair-button">Sair</a>
            </div>
        </nav>
    </header>

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

    <main>
        <section class="conteudo">
            <form id="notificacaoForm" style="display: none;">
                <div class="form-group">
                    <label for="tipoNotificacao">Nome do Relatório</label>
                    <input type="text" id="tipoNotificacao" placeholder="Ex: Balanço Geral" required>
                </div>

                <div class="form-group">
                    <label for="tremNotificacao">Arquivo:</label>
                    <input type="file" id="tremNotificacao" required>
                </div>

                <div class="form-group">
                    <label for="problemaNotificacao">Conteúdo:</label>
                    <textarea id="problemaNotificacao" rows="3" required></textarea>
                </div>
            </form>

            <div class="graficos-container">
                <div class="grafico-item3">
                    <canvas id="graficoTarefas"></canvas>
                </div>
                <div class="grafico-item2">
                    <canvas id="graficoVendas"></canvas>
                </div>
                <div class="grafico-item">
                    <canvas id="graficoManutencao"></canvas>
                </div>
                <div class="grafico-item">
                    <canvas id="graficoNotificacoes"></canvas>
                </div>
            </div>
        </section>
    </main>

    <script src="../js/dashboard.js"></script>
    <script src="../js/graficos copy.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>