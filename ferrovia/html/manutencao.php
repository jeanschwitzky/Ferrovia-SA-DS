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
    <link rel="stylesheet" href="../css/notificacoes.css">
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
                        <h1>Manutenção</h1>
                    </div>

                    <a class="bi bi-person-circle" href="perfil.php"></a>
                    <?php
                    echo "<p>Bem-vindo, " . htmlspecialchars($_SESSION["nome_usuario"]) . "!</p>";

                    ?>
                    <a href="sair.php">
                        <input type="button" value="Sair" event="sair.php" class="sair-button">
                    </a>
                </ul>
            </nav>
        </div>

        <div id="side-menu">
            <ul class="menu-list">
                <a class="menu-item" href="perfil.php">Perfil</a>
                <a class="menu-item" href="dashboard.php">Dashboard Geral</a>
                <a class="menu-item" href="notificacoes.php">Notificações</a>
                <a class="menu-item" href="manutencao.php">Manutenção</a>
                <a class="menu-item" href="gestao.php">Gestão de rotas</a>
                <a class="menu-item" href="relatorios.php">Relatórios e Análises</a>
                <a class="menu-item" href="sensores.php">Sensores</a>
                <a class="menu-item" href="trem.php">Trem</a>
            </ul>
        </div>
    </header>

    <main>
        <section class="conteudo">
            <section class="conteudo">
                <div class="card">
                    <h2>Manutenção</h2>
                    <div class="grafico-container">
                        <canvas id="graficoStatus" width="500" height="100"></canvas>
                    </div>
                </div>

                <form id="notificacaoForm" action="cadastrar_manutencao.php" method="POST">
                    <div class="form-group">
                        <label for="nome_trem">Nome do Trem:</label>
                        <input type="text" name="nome_trem" placeholder="Ex: Trem 001" required>
                    </div>

                    <div class="form-group">
                        <label for="problema_manutencao">Manutenção:</label>
                        <input type="text" name="problema_manutencao" placeholder="Ex: Modificação no motor"
                            required></input>
                    </div>

                    <div class="form-group">
                        <label for="data_inicio_manutencao">Data de Início:</label>
                        <input type="date" name="data_inicio_manutencao" required>
                    </div>

                    <div class="form-group">
                        <label for="data_termino_manutencao">Data de Término:</label>
                        <input type="date" name="data_termino_manutencao" required>
                    </div>

                    <div class="form-group">
                        <label for="status_manutencao">Status:</label>
                        <select name="status_manutencao" required>
                            <option value="Em Andamento">Em Andamento</option>
                            <option value="Não Iniciada">Não Iniciada</option>
                            <option value="Concluída">Concluída</option>
                            <option value="Em atraso">Em atraso</option>
                        </select>
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="botao-salvar">Salvar</button>
                        <button type="button" id="cancelBtn" class="botao-cancelar">Cancelar</button>
                    </div>
                </form>

                <div id="cardsContainer">
                </div>


                <div class="flexivel">
                    <button id="addBtn" class="botao-adicionar">
                        <i class="bi bi-plus-circle" style="font-size: 30px;"></i> Adicionar
                    </button>
                    <button id="removeAllBtn" class="botao-remover">
                        <i class="bi bi-trash" style="font-size: 30px;"></i> Remover Todas
                    </button>
                </div>
            </section>
    </main>
    <script src="../js/manutencao.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>