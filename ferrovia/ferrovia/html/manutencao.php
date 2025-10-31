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
    <link rel="stylesheet" href="../css/manutencao.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Ferrovia - Manutenção</title>
</head>

<body>
    <header>
        <div class="main-nav">
            <div class="nav-left">
                <a href="#" id="menuToggle" class="bi bi-list"></a>
            </div>

            <div class="nav-center">
                <h1>Manutenção</h1>
            </div>

            <div class="nav-right">
                <?php
                echo "<p>Bem-vindo, " . htmlspecialchars($_SESSION["nome_usuario"]) . "!</p>";
                ?>
                <a class="bi bi-person-circle" href="perfil.php"></a>
                <a href="sair.php" class="sair-button">Sair</a>
            </div>
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
                    <textarea name="problema_manutencao" rows="3" placeholder="Ex: Modificação no motor" required></textarea>
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
                <div class="card" data-id="1">
                    <button class="delete-btn"><i class="bi bi-trash"></i></button>
                    <button class="edit-btn"><i class="bi bi-pencil-square"></i></button>
                    <div class="card-title">Trem: rrf</div>
                    <div class="card-text">
                        <p><strong>Manutenção:</strong> fefe</p>
                        <p><strong>Data de Início:</strong> 2222-03-12</p>
                        <p><strong>Data de Término:</strong> 3232-02-13</p>
                        <p><strong>Status:</strong> Concluída</p>
                    </div>
                </div>
            </div>


            <div class="flexivel">
                <button id="addBtn" class="botao-adicionar">
                    <i class="bi bi-plus-circle"></i> Adicionar
                </button>
                <button id="removeAllBtn" class="botao-remover">
                    <i class="bi bi-trash"></i> Remover Todas
                </button>
            </div>
        </section>
    </main>

    <script src="../js/manutencao.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
