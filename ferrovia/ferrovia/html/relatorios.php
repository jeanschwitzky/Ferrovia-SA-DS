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
    <title>Ferrovia - Relatórios e Análises</title>
    <link rel="stylesheet" href="../css/relatorio.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="main-nav">
        <div class="nav-left">
            <i class="bi bi-list" id="menuToggle"></i>
        </div>
        <div class="nav-center">
            <h1>Relatórios e Análises</h1>
        </div>
        <div class="nav-right">
            <a class="bi bi-person-circle" href="perfil.php"></a>
            <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION["nome_usuario"]); ?>!</p>
            <a href="sair.php"><button class="sair-button">Sair</button></a>
        </div>
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
            <form id="notificacaoForm" action="cadastrar_relatorio.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nome_relatorio">Nome do Relatório:</label>
                    <input type="text" name="nome_relatorio" placeholder="Ex: Balanço Geral" required>
                </div>

                <div class="form-group">
                    <label for="arquivo_relatorio">Arquivo:</label>
                    <input type="file" name="arquivo_relatorio" required>
                </div>

                <div class="form-group">
                    <label for="conteudo_relatorio">Conteúdo:</label>
                    <textarea name="conteudo_relatorio" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="data_relatorio">Data:</label>
                    <input type="date" name="data_relatorio" required>
                </div>

                <div class="form-group">
                    <label for="hora_relatorio">Hora:</label>
                    <input type="time" name="hora_relatorio" required>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="botao-salvar">Salvar</button>
                    <button type="button" id="cancelBtn" class="botao-cancelar">Cancelar</button>
                </div>
            </form>

            <div id="cardsContainer"></div>

            <div class="flexivel">
                <button id="addBtn" class="botao-adicionar">
                    <i class="bi bi-plus-circle" style="font-size: 30px;"></i> Adicionar
                </button>
                <button id="removeAllBtn" class="botao-remover">
                    <i class="bi bi-trash" style="font-size: 30px;"></i> Remover Todos
                </button>
            </div>
        </section>
    </main>

    <script src="../js/relatorios.js"></script>
</body>
</html>
